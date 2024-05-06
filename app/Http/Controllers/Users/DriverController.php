<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $userFirstName = DB::table('admins')
            ->pluck('first_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $driverList = DB::table('drivers')
            ->select('*')
            ->get();

        $totalDriver = DB::table('drivers')
            ->count();

        $totalOrderCompleted = DB::table('delivery')
            ->where('status', "=", '2')
            ->count();

        return view('driver.list', compact('userFirstName', 'userLastName', 'driverList', 'totalDriver', 'totalOrderCompleted'));
    }

    public function addDriver(Request $request)
    {

        $driverFirstName = $request->input('driverFirstName');
        $driverLastName = $request->input('driverLastName');
        $driverIC = $request->input('driverIC');
        $driverContact = $request->input('driverContact');
        $plateNo = $request->input('driverPlateNo');
        $driverRace = $request->input('driverRace');
        $driverPassword = $request->input('driverPassword');

        $driverContact = preg_replace('/^(\+?60|0)/', '', $driverContact);

        DB::table('drivers')
            ->insert([
                'id' => Str::random(30),
                'first_name' => $driverFirstName,
                'last_name' => $driverLastName,
                'ic' => $driverIC,
                'contact' => $driverContact,
                'race' => $driverRace,
                'plate_no' => $plateNo,
                'password' => Hash::make($driverPassword),
                'status' => '1',
                'created_at' => now()
            ]);

        return redirect('/driverList')->with('success', 'Driver is created successfully!');
    }

    public function viewDriverDetails($id)
    {
        $userFirstName = DB::table('admins')
            ->pluck('first_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $userDetails = DB::table('drivers')
            ->where('id', "=", $id)
            ->select('*')
            ->get();

        $userDetailsForEditing = DB::table('drivers')
            ->where('id', "=", $id)
            ->select('*')
            ->get();

        $customerList = DB::table('customers')
            ->select('*')
            ->get();

        $productList = DB::table('products')
            ->where('status', "=", '1')
            ->select('*')
            ->get();

        $deliveryList = DB::table('delivery')
            ->where('driver_id', "=", $id)
            ->join('customers', 'customers.id', "=", 'delivery.customer_id')
            ->join('products', 'products.id', "=", 'delivery.product_id')
            ->select('delivery.date', 'delivery.status', 'customers.first_name', 'customers.last_name', 'products.name', 'delivery.id', 'products.item_code')
            ->get();

        return view('driver.view', compact('userFirstName', 'userLastName', 'userDetails', 'userDetailsForEditing', 'customerList', 'productList', 'id', 'deliveryList'));
    }

    public function updateStatus($id, $status)
    {
        $updateStatus = DB::table('drivers')
            ->where('drivers.id', $id)
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

    public function updateDriver($id, Request $request)
    {
        $driverFirstName = $request->input('driverFirstName');
        $driverLastName = $request->input('driverLastName');
        $driverIC = $request->input('driverIC');
        $driverPhone = $request->input('driverPhone');
        $driverPlateNo = $request->input('driverPlateNo');
        $driverRace = $request->input('driverRace');
        $driverStatus = $request->input('driverStatus');
        $driverPassword = $request->input('driverPassword');
        // Trim the first digit 0 from the phoneNo
        $driverPhone = preg_replace('/^(?:\+|0|60)?/', '', $driverPhone);

        if ($driverPassword != "") {
            DB::table('drivers')
                ->where('drivers.id', $id)
                ->update([
                    'first_name' => $driverFirstName,
                    'last_name' => $driverLastName,
                    'plate_no' => $driverPlateNo,
                    'contact' => $driverPhone,
                    'ic' => $driverIC,
                    'race' => $driverRace,
                    'status' => $driverStatus,
                    'password' => Hash::make($driverPassword),
                    'updated_at' => now()
                ]);
        } else {
            DB::table('drivers')
                ->where('drivers.id', $id)
                ->update([
                    'first_name' => $driverFirstName,
                    'last_name' => $driverLastName,
                    'plate_no' => $driverPlateNo,
                    'contact' => $driverPhone,
                    'ic' => $driverIC,
                    'race' => $driverRace,
                    'status' => $driverStatus,
                    'updated_at' => now()
                ]);
        }

        // Redirect to the driver's profile page with the updated data
        return redirect()->back()->with('success', 'Driver is updated successfully!');
    }

    public function createDelivery(Request $request, $id)
    {

        $deliveryCustomer = $request->input('deliveryCustomer');
        $deliveryProduct = $request->input('deliveryProduct');
        $deliveryDate = $request->input('deliveryDate');
        $deliveryOrderDate = $request->input('deliveryOrderDate');
        $deliveryStatus = $request->input('deliveryStatus');
        $deliveryQuantity = $request->input('deliveryQuantity');

        // Retrieve the price for the product dynamically
        $priceList = DB::table('products')
            ->leftJoin('custom_price', function ($join) use ($deliveryProduct, $deliveryCustomer) {
                $join->on('custom_price.product_id', '=', 'products.id')
                    ->where('custom_price.customer_id', '=', $deliveryCustomer);
            })
            ->where('products.id', $deliveryProduct) // Filter by product ID
            ->pluck(DB::raw('IFNULL(custom_price.price, products.default_price) as final_price'))
            ->first();

        $existingAmount = DB::table('products')
            ->where('id', "=", $deliveryProduct)
            ->pluck('quantity')
            ->first();

        DB::table('delivery')
            ->insert([
                'id' => Str::random(30),
                'driver_id' => $id,
                'invoice' => mt_rand(10000000, 99999999),
                'customer_id' => $deliveryCustomer,
                'product_id' => $deliveryProduct,
                'date' => $deliveryDate,
                'order_date' => $deliveryOrderDate,
                'price' => $priceList,
                'quantity' => $deliveryQuantity,
                'payment_done' => '0',
                'status' => $deliveryStatus,
                'created_at' => now()
            ]);

        if ($deliveryStatus != '3') {
            DB::table('products')
                ->where('id', "=", $deliveryProduct)
                ->update([
                    'quantity' => $existingAmount - $deliveryQuantity,
                    'updated_at' => now()
                ]);
        }

        return redirect()->back();
    }

    public function getDeliveryDetails(Request $request, $id)
    {
        $item = DB::table('delivery')
            ->where('id', "=", $id)
            ->select('*')
            ->first();

        // Return the details as JSON response
        return response()->json($item);
    }

    public function updateDelivery(Request $request)
    {
        $deliveryID = $request->input('deliveryID');
        $customer = $request->input('customer');
        $product = $request->input('product');
        $deliveryQuantity = $request->input('deliveryEditQuantity');
        $deliveryDate = $request->input('deliveryEditDate');
        $deliveryOrderDate = $request->input('deliveryEditOrderDate');
        $deliveryStatus = $request->input('deliveryEditStatus');

        $itemQuantity = DB::table('products')
            ->where('id', "=", $product)
            ->pluck('quantity')
            ->first();

        if ($deliveryQuantity >= $itemQuantity) {
            $deliveryQuantity = $itemQuantity;
        }

        DB::table('delivery')
            ->where('id', "=", $deliveryID)
            ->update([
                'customer_id' => $customer,
                'product_id' => $product,
                'date' => $deliveryDate,
                'order_date' => $deliveryOrderDate,
                'quantity' => $deliveryQuantity,
                'status' => $deliveryStatus,
                'updated_at' => now()
            ]);

        if ($deliveryStatus == '3') {
            DB::table('products')
                ->where('id', "=", $product)
                ->update([
                    'quantity' => $itemQuantity + $deliveryQuantity,
                    'updated_at' => now()
                ]);
        }


        return redirect()->back();
    }
}
