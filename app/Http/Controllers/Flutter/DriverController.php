<?php

namespace App\Http\Controllers\FLutter;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class DriverController extends Controller
{
    public function driverLogin(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required',
        ]);

        $phone = preg_replace('/^(\+?60|0)/', '', $request->phone);

        // Get a driver account
        $driver = DB::table('drivers')
            ->select('drivers.*')
            ->where('drivers.contact', $phone)
            ->first();

        if ($driver) {
            // Driver found, return data
            return response()->json(['success' => true, 'driver' => $driver], 200);
        } else {
            // Driver not found, return error
            return response()->json(['success' => false, 'message' => 'Driver not found'], 404);
        }
    }

    public function driverDeliveryList(Request $request, $id)
    {
        $today = Carbon::now()->format('Y-m-d');

        $deliveryList = DB::table('delivery')
            ->join('drivers', 'drivers.id', "=", 'delivery.driver_id')
            ->join('customers', 'customers.id', "=", 'delivery.customer_id')
            ->join('products', 'products.id', "=", 'delivery.product_id')
            // ->join('driver_timelines', 'driver_timelines.shipment_id', "=", 'shipments.id')
            ->whereDate('delivery.date', $today)
            ->where('delivery.driver_id', "=", $id)
            ->where('delivery.status', "!=", '3')
            ->select('customers.first_name', 'customers.last_name', 'products.item_code', 'customers.location', 'customers.contact', 'products.name', 'delivery.quantity', 'delivery.date', 'delivery.order_date', 'delivery.status', 'delivery.id', 'delivery.customer_id', 'delivery.payment_done')
            ->orderBy('delivery.order_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'deliveryList' => $deliveryList
        ]);

    }

    public function startDelivery(Request $request, $id, $deliveryID)
    {
        // Get the current time from the request
        $currentTime = $request->input('currentTime');

        DB::table('delivery')
            ->where('id', "=", $deliveryID)
            ->update([
                'start_time' => $currentTime,
                'status' => '1'
            ]);

        return response()->json(['success' => true]);
    }

    public function stopDelivery(Request $request, $id, $deliveryID)
    {
        // Get the current time from the request
        $currentTime = $request->input('currentTime');

        DB::table('delivery')
            ->where('id', "=", $deliveryID)
            ->update([
                'end_time' => $currentTime,
                'status' => '2'
            ]);


        return response()->json(['success' => true]);
    }

    public function productList(Request $request, $id)
    {


        $priceList = DB::table('products')
            ->leftJoin('custom_price', function ($join) use ($id) {
                $join->on('custom_price.product_id', '=', 'products.id')
                    ->where('custom_price.customer_id', '=', $id);
            })
            ->select(
                'products.name',
                'products.default_price',
                'products.quantity',
                'products.id',
                DB::raw('IFNULL(custom_price.price, products.default_price) as final_price')
            )
            ->get();

        return response()->json(['success' => true, 'priceList' => $priceList]);

    }

    public function addOns(Request $request, $id, $customerID)
    {
        // Validate the incoming request data if needed
        $request->validate([
            'itemsToAdd' => 'required|array', // Assuming itemsToAdd is an array of objects
        ]);

        // Retrieve the items to add from the request
        $itemsToAdd = $request->input('itemsToAdd');

        // Loop through each item and add it to the database
        foreach ($itemsToAdd as $item) {
            // Assuming each item has productId and quantity fields
            $productId = $item['productId'];
            $quantity = $item['quantity'];

            // Retrieve the quantity of the product from the database
            $existing = DB::table('products')
                ->where('id', $productId)
                ->pluck('quantity')
                ->first();

            // Retrieve the price for the product dynamically
            $priceList = DB::table('products')
                ->leftJoin('custom_price', function ($join) use ($productId, $customerID) {
                    $join->on('custom_price.product_id', '=', 'products.id')
                        ->where('custom_price.customer_id', '=', $customerID);
                })
                ->where('products.id', $productId) // Filter by product ID
                ->pluck(DB::raw('IFNULL(custom_price.price, products.default_price) as final_price'))
                ->first();

            // Insert the item into the add_ons table
            DB::table('add_ons')->insert([
                'id' => Str::random(30),
                'customer_id' => $customerID,
                'delivery_id' => $id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $priceList,
                'status' => '0',
                'created_at' => now()
            ]);

            // Update the quantity of the product in the products table
            DB::table('products')
                ->where('id', $productId)
                ->update([
                    'quantity' => $existing - $quantity,
                    'updated_at' => now()
                ]);
        }

        // Return a response indicating success or failure
        return response()->json(['message' => 'Items added to cart successfully'], 200);
    }

    public function addOnList(Request $request, $id, $customer_id)
    {
        // Query to fetch add-ons along with product details and custom pricing
        $addOnList = DB::table('add_ons')
            ->join('products', 'products.id', '=', 'add_ons.product_id')
            ->join('delivery', 'delivery.id', '=', 'add_ons.delivery_id')
            ->join('customers', 'customers.id', '=', 'delivery.customer_id')
            ->leftJoin('custom_price', function ($join) use ($customer_id) {
                $join->on('custom_price.product_id', '=', 'add_ons.product_id')
                    ->where('custom_price.customer_id', '=', $customer_id);
            })
            ->select(
                'add_ons.quantity as a_quantity',
                'add_ons.price',
                'products.item_code',
                'products.name',
                'customers.contact',
                'products.name',
                'custom_price.foc_every_unit',
                'custom_price.foc_every_amount',
                'custom_price.foc_after_unit',
                'custom_price.foc_after_amount',
                'add_ons.id'
            )
            ->where('add_ons.delivery_id', '=', $id)
            ->orderBy('add_ons.created_at', 'desc')
            ->get();


        // Iterate through the add-on list and calculate the final price based on custom pricing rules
        foreach ($addOnList as $addOn) {
            // Calculate the total quantity after considering free items based on custom pricing rules
            $totalQuantity = $addOn->a_quantity;
            $freeQuantity = 0;

            if ($addOn->foc_every_unit && $addOn->foc_every_amount) {
                // Calculate free items after every certain unit
                $freeQuantity += floor($totalQuantity / $addOn->foc_every_unit) * $addOn->foc_every_amount;
            }

            if ($addOn->foc_after_unit && $addOn->foc_after_amount) {
                // Calculate free items after reaching a certain unit threshold
                if ($totalQuantity >= $addOn->foc_after_unit) {
                    $freeQuantity += $addOn->foc_after_amount;
                }
            }

            // Calculate the final price after deducting free items
            $finalPrice = $addOn->price * ($totalQuantity - $freeQuantity);
            $addOn->final_price = $finalPrice;
        }

        // First, retrieve the delivery details along with custom pricing information
        $deliveryDetailsForReturning = DB::table('delivery')
            ->join('custom_price', 'custom_price.customer_id', '=', 'delivery.customer_id')
            ->join('products', 'products.id', "=", 'delivery.product_id')
            ->where('delivery.id', '=', $id)
            ->select(
                'delivery.quantity',
                'delivery.price',
                'custom_price.foc_every_unit',
                'custom_price.foc_every_amount',
                'custom_price.foc_after_unit',
                'custom_price.foc_after_amount',
                'products.name',
                'products.item_code'
            )
            ->get();
        
        $deliveryDetails = DB::table('delivery')
            ->join('custom_price', 'custom_price.customer_id', '=', 'delivery.customer_id')
            ->join('products', 'products.id', "=", 'delivery.product_id')
            ->where('delivery.id', '=', $id)
            ->select(
                'delivery.quantity',
                'delivery.price',
                'custom_price.foc_every_unit',
                'custom_price.foc_every_amount',
                'custom_price.foc_after_unit',
                'custom_price.foc_after_amount',
                'products.name',
                'products.item_code'
            )
            ->first();

        // Calculate the total quantity after considering free items based on custom pricing rules
        $totalDeliveryQuantity = $deliveryDetails->quantity;
        $freeDeliveryQuantity = 0;

        if ($deliveryDetails->foc_every_unit && $deliveryDetails->foc_every_amount) {
            // Calculate free items after every certain unit
            $freeDeliveryQuantity += floor($totalDeliveryQuantity / ($deliveryDetails->foc_every_unit + $deliveryDetails->foc_every_amount)) * $deliveryDetails->foc_every_amount;
        }

        if ($deliveryDetails->foc_after_unit && $deliveryDetails->foc_after_amount) {
            // Calculate free items after reaching a certain unit threshold
            if ($totalDeliveryQuantity >= $deliveryDetails->foc_after_unit) {
                $freeDeliveryQuantity += $deliveryDetails->foc_after_amount;
            }
        }

        // Calculate the final price after deducting free items
        $finalDeliveryPrice = $deliveryDetails->price * ($totalDeliveryQuantity - $freeDeliveryQuantity);

        return response()->json([
            'success' => true,
            'addOnList' => $addOnList,
            'finalDeliveryPrice' => $finalDeliveryPrice,
            'deliveryDetails' => $deliveryDetailsForReturning
        ]);
    }
    public function cancelAddOns(Request $request, $id)
    {

        $product_id = DB::table('add_ons')
            ->where('id', "=", $id)
            ->pluck('product_id')
            ->first();

        $addOnAmount = DB::table('add_ons')
            ->where('id', "=", $id)
            ->pluck('quantity')
            ->first();

        $existing = DB::table('products')
            ->where('id', "=", $product_id)
            ->pluck('quantity')
            ->first();

        DB::table('products')
            ->where('id', "=", $product_id)
            ->update([
                'quantity' => $existing + $addOnAmount,
                'updated_at' => now()
            ]);

        DB::table('add_ons')
            ->where('id', "=", $id)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function confirmPayment(Request $request, $id)
    {

        DB::table('delivery')
            ->where('id', "=", $id)
            ->update([
                'payment_done' => '1',
                'updated_at' => now()
            ]);

        DB::table('add_ons')
            ->where('delivery_id', "=", $id)
            ->update([
                'status' => '1',
                'updated_at' => now()
            ]);

        return response()->json(['success' => true]);
    }

    public function updateDriver(Request $request, $id)
    {
        $phone = $request->input('phone');
        $ic = $request->input('ic');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');

        $phone = preg_replace('/^(\+?60|0)/', '', $request->phone);

        DB::table('drivers')
            ->where('id', "=", $id)
            ->update([
                'contact' => $phone,
                'ic' => $ic,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true]);
    }

    public function getDriverDetails(Request $request, $id)
    {

        $driver = DB::table('drivers')
            ->where('id', "=", $id)
            ->select('*')
            ->first();

        return response()->json([
            'success' => true,
            'driver' => $driver
        ]);
    }

}
