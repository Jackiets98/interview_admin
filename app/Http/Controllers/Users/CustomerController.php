<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('printReceipt');
    }

    public function index()
    {

        $userFirstName = DB::table('admins')
            ->pluck('first_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $customerList = DB::table('customers')
            ->select('*')
            ->get();

        $totalCustomer = DB::table('customers')
            ->count();

        $totalOrderPlaced = DB::table('delivery')
            ->count();

        return view('customer.list', compact('userFirstName', 'userLastName', 'customerList', 'totalCustomer', 'totalOrderPlaced'));
    }

    public function addCustomer(Request $request)
    {

        $customerFirstName = $request->input('customerFirstName');
        $customerLastName = $request->input('customerLastName');
        $customerContact = $request->input('customerContact');
        $customerLocation = $request->input('customerLocation');

        $customerContact = preg_replace('/^(\+?60|0)/', '', $customerContact);

        DB::table('customers')
            ->insert([
                'id' => Str::random(30),
                'first_name' => $customerFirstName,
                'last_name' => $customerLastName,
                'contact' => $customerContact,
                'location' => $customerLocation,
                'status' => '1',
                'created_at' => now()
            ]);

        return redirect('/customerList')->with('success', 'customer is created successfully!');
    }

    public function viewCustomerDetails($id)
    {
        $userFirstName = DB::table('admins')
            ->pluck('first_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $userDetails = DB::table('customers')
            ->where('id', "=", $id)
            ->select('*')
            ->get();

        $userDetailsForEditing = DB::table('customers')
            ->where('id', "=", $id)
            ->select('*')
            ->get();

        $orderList = DB::table('delivery')
            ->where('customer_id', "=", $id)
            ->join('products', 'products.id', "=", 'delivery.product_id')
            ->select('products.name', 'products.item_code', 'delivery.order_date', 'delivery.status', 'delivery.date', 'delivery.quantity', 'delivery.id', 'delivery.customer_id')
            ->get();

        return view('customer.view', compact('userFirstName', 'userLastName', 'userDetails', 'userDetailsForEditing', 'orderList'));
    }

    public function updateStatus($id, $status)
    {
        $updateStatus = DB::table('customers')
            ->where('customers.id', $id)
            ->update([
                'status' => $status,
                'updated_at' => now()
            ]);

        if ($updateStatus) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Failed to update admin status!');
        }
    }

    public function updateCustomer($id, Request $request)
    {
        $customerFirstName = $request->input('customerFirstName');
        $customerLastName = $request->input('customerLastName');
        $customerLocation = $request->input('customerLocation');
        $customerPhone = $request->input('customerPhone');
        $customerStatus = $request->input('customerStatus');

        // Trim the first digit 0 from the phoneNo
        $customerPhone = preg_replace('/^(?:\+|0|60)?/', '', $customerPhone);

        DB::table('customers')
            ->where('customers.id', $id)
            ->update([
                'first_name' => $customerFirstName,
                'last_name' => $customerLastName,
                'location' => $customerLocation,
                'contact' => $customerPhone,
                'status' => $customerStatus,
                'updated_at' => now()
            ]);

        // Redirect to the customer's profile page with the updated data
        return redirect()->back()->with('success', 'Customer is updated successfully!');
    }

    public function viewReceipt($id, $customerID)
    {
        $userFirstName = DB::table('admins')
            ->pluck('first_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $customerInfo = DB::table('customers')
            ->where('id', "=", $customerID)
            ->select('*')
            ->get();

        $deliveryDate = DB::table('delivery')
            ->where('id', "=", $id)
            ->pluck('end_time')
            ->first();

        $deliveryInvoice = DB::table('delivery')
            ->where('id', "=", $id)
            ->pluck('invoice')
            ->first();

        $formattedDate = Carbon::parse($deliveryDate)->format('d-m-y');

        $totalAddOnPrice = 0;

        // Query to fetch add-ons along with product details and custom pricing
        $addOnList = DB::table('add_ons')
            ->join('products', 'products.id', '=', 'add_ons.product_id')
            ->join('delivery', 'delivery.id', '=', 'add_ons.delivery_id')
            ->join('customers', 'customers.id', '=', 'delivery.customer_id')
            ->leftJoin('custom_price', function ($join) use ($customerID) {
                $join->on('custom_price.product_id', '=', 'add_ons.product_id')
                    ->where('custom_price.customer_id', '=', $customerID);
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

            $totalAddOnPrice += $addOn->final_price;
        }

        // First, retrieve the delivery details along with custom pricing information
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

        $totalPrice = $totalAddOnPrice + $finalDeliveryPrice;


        return view('customer.receipt', compact('userFirstName', 'userLastName', 'customerInfo', 'formattedDate', 'deliveryDetails', 'finalDeliveryPrice', 'addOnList', 'totalPrice','deliveryInvoice','id','customerID'));
    }


    public function printReceipt($id, $customerID)
    {

        $customerInfo = DB::table('customers')
            ->where('id', "=", $customerID)
            ->select('*')
            ->get();

        $deliveryDate = DB::table('delivery')
            ->where('id', "=", $id)
            ->pluck('end_time')
            ->first();

        $deliveryInvoice = DB::table('delivery')
            ->where('id', "=", $id)
            ->pluck('invoice')
            ->first();

        $formattedDate = Carbon::parse($deliveryDate)->format('d-m-y');

        $totalAddOnPrice = 0;

        // Query to fetch add-ons along with product details and custom pricing
        $addOnList = DB::table('add_ons')
            ->join('products', 'products.id', '=', 'add_ons.product_id')
            ->join('delivery', 'delivery.id', '=', 'add_ons.delivery_id')
            ->join('customers', 'customers.id', '=', 'delivery.customer_id')
            ->leftJoin('custom_price', function ($join) use ($customerID) {
                $join->on('custom_price.product_id', '=', 'add_ons.product_id')
                    ->where('custom_price.customer_id', '=', $customerID);
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

            $totalAddOnPrice += $addOn->final_price;
        }

        // First, retrieve the delivery details along with custom pricing information
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

        $totalPrice = $totalAddOnPrice + $finalDeliveryPrice;


        return view('customer.print', compact('customerInfo', 'formattedDate', 'deliveryDetails', 'finalDeliveryPrice', 'addOnList', 'totalPrice','deliveryInvoice'));
    }
}
