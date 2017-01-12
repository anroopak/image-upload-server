<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

	public static $TABLE_NAME = 'products';

    public function create(Request $request)
    {
    	$name = $request -> json() -> get('name');
    	$price = $request -> json() -> get('price');

    	$productId = DB::table(self::$TABLE_NAME)->insertGetId([
    	    		'name' => $name,
    	    		'price' => $price
    	    		]);

    	return response() -> json(['product_id' => $productId]);
    }

    public function get(Request $request)
    {
    	$results = DB::table(self::$TABLE_NAME)->get();
    	return response() -> json($results);
    }

    public function getWithID(Request $request, $productId)
    {
    	$results = DB::table(self::$TABLE_NAME)
    		-> where('product_id', $productId)
    		-> get();

    	if (count($results) == 0)
    		return response() -> json(["message" => "ID not found"], 404);

    	return response() -> json($results[0]);
    }
}
