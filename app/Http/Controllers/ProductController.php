<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
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

        $itemList = DB::table('products')
            ->select('*')
            ->get();

        $totalItem = DB::table('products')
            ->count();

        return view('warehouse.list', compact('userFirstName', 'userLastName', 'itemList', 'totalItem'));
    }

    public function addItem(Request $request)
    {

        $itemCode = $request->input('itemCode');
        $itemName = $request->input('itemName');
        $itemPrice = $request->input('itemPrice');
        $itemQuantity = $request->input('itemQuantity');


        DB::table('products')
            ->insert([
                'id' => Str::random(30),
                'item_code' => $itemCode,
                'name' => $itemName,
                'default_price' => $itemPrice,
                'quantity' => $itemQuantity,
                'status' => '1',
                'created_at' => now()
            ]);

        return redirect('/itemList')->with('success', 'item is created successfully!');
    }

    public function viewitemDetails($id)
    {
        $userFirstName = DB::table('admins')
            ->pluck('first_name')
            ->first();

        $userLastName = DB::table('admins')
            ->pluck('last_name')
            ->first();

        $productDetails = DB::table('products')
            ->where('id', "=", $id)
            ->select('*')
            ->get();

        $productDetailsForEditing = DB::table('products')
            ->where('id', "=", $id)
            ->select('*')
            ->get();

        $customerList = DB::table('customers')
            ->select('*')
            ->get();

        $customPriceList = DB::table('custom_price')
            ->where('product_id', "=", $id)
            ->join('customers', 'customers.id', "=", 'custom_price.customer_id')
            ->join('products', 'products.id', "=", 'custom_price.product_id')
            ->select('customers.first_name', 'customers.last_name', 'products.name', 'custom_price.price', 'custom_price.foc_every_unit', 'custom_price.id', 'custom_price.status')
            ->get();

        return view('warehouse.view', compact('userFirstName', 'userLastName', 'productDetails', 'productDetailsForEditing', 'customerList', 'id', 'customPriceList'));
    }

    public function addCustomPrice($id, Request $request)
    {
        $customer = $request->input('customer');
        $customPrice = $request->input('customPrice');
        $numberOfUnitFreeAfter = $request->input('numberOfUnitFreeAfter');
        $focAfter = $request->input('focAfter');
        $numberOfUnitFreeEvery = $request->input('numberOfUnitFreeEvery');
        $focEvery = $request->input('focEvery');

        $originalPrice = DB::table('products')
            ->where('id', "=", $id)
            ->pluck('default_price')
            ->first();

        DB::table('custom_price')
            ->insert([
                'id' => Str::random(30),
                'customer_id' => $customer,
                'product_id' => $id,
                'price' => $customPrice,
                'foc_after_unit' => $focAfter ? $focAfter : 0,
                'foc_every_unit' => $focEvery ? $focEvery : 0,
                'foc_after_amount' => $numberOfUnitFreeAfter ? $numberOfUnitFreeAfter : 0,
                'foc_every_amount' => $numberOfUnitFreeEvery ? $numberOfUnitFreeEvery : 0,
                'status' => '1',
                'created_at' => now()
            ]);


            DB::table('delivery')
                ->where('customer_id', "=", $customer)
                ->where('product_id', "=", $id)
                ->where('status', "=", '0')
                ->update([
                    'price' => $customPrice,
                    'updated_at' => now()
                ]);

            DB::table('add_ons')
                ->where('customer_id', "=", $customer)
                ->where('product_id', "=", $id)
                ->where('status', "=", '0')
                ->update([
                    'price' => $customPrice,
                    'updated_at' => now()
                ]);


        return Redirect::back();
    }

    public function getCustomPriceDetails(Request $request, $id)
    {
        $item = DB::table('custom_price')
            ->where('id', "=", $id)
            ->select('*')
            ->first();

        // Return the details as JSON response
        return response()->json($item);

    }

    public function updateCustomPrice(Request $request)
    {
        $customID = $request->input('customPriceID');
        $customer = $request->input('customer');
        $customPrice = $request->input('customPrice');
        $focEditAfter = $request->input('focEditAfter');
        $focEditEvery = $request->input('focEditEvery');
        $numberOfUnitEditFreeAfter = $request->input('numberOfUnitEditFreeAfter');
        $numberOfUnitEditFreeEvery = $request->input('numberOfUnitEditFreeEvery');
        $customStatus = $request->input('customStatus');

        $product_id = DB::table('custom_price')
            ->where('id', "=", $customID)
            ->pluck('product_id')
            ->first();

        $originalPrice = DB::table('products')
            ->where('id', "=", $product_id)
            ->pluck('default_price')
            ->first();

        DB::table('custom_price')
            ->where('id', "=", $customID)
            ->update([
                'customer_id' => $customer,
                'price' => $customPrice,
                'foc_every_unit' => $focEditEvery,
                'foc_every_amount' => $numberOfUnitEditFreeEvery,
                'foc_after_unit' => $focEditAfter,
                'foc_after_amount' => $numberOfUnitEditFreeAfter,
                'status' => $customStatus,
                'updated_at' => now()
            ]);

        if ($customStatus == "1") {
            DB::table('delivery')
                ->where('customer_id', "=", $customer)
                ->where('product_id', "=", $product_id)
                ->where('status', "=", '0')
                ->update([
                    'price' => $customPrice,
                    'updated_at' => now()
                ]);

            DB::table('add_ons')
                ->where('customer_id', "=", $customer)
                ->where('product_id', "=", $product_id)
                ->where('status', "=", '0')
                ->update([
                    'price' => $customPrice,
                    'updated_at' => now()
                ]);
        } else {
            DB::table('delivery')
                ->where('customer_id', "=", $customer)
                ->where('product_id', "=", $product_id)
                ->where('status', "=", '0')
                ->update([
                    'price' => $originalPrice,
                    'updated_at' => now()
                ]);

            DB::table('add_ons')
                ->where('customer_id', "=", $customer)
                ->where('product_id', "=", $product_id)
                ->where('status', "=", '0')
                ->update([
                    'price' => $originalPrice,
                    'updated_at' => now()
                ]);
        }

        return Redirect::back();
    }

    public function updateStatus($id, $status)
    {
        $updateStatus = DB::table('products')
            ->where('items.id', $id)
            ->update([
                'status' => $status,
                'updated_at' => now()
            ]);

        if ($updateStatus) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Failed to update item status!');
        }
    }

    public function updateItem($id, Request $request)
    {
        $productItemCode = $request->input('productItemCode');
        $productName = $request->input('productName');
        $productPrice = $request->input('productPrice');
        $productQuantity = $request->input('productQuantity');
        $productStatus = $request->input('productStatus');


        DB::table('products')
            ->where('products.id', $id)
            ->update([
                'item_code' => $productItemCode,
                'name' => $productName,
                'default_price' => $productPrice,
                'quantity' => $productQuantity,
                'status' => $productStatus,
                'updated_at' => now()
            ]);

        // Redirect to the item's profile page with the updated data
        return redirect()->back()->with('success', 'Item is updated successfully!');
    }
}
