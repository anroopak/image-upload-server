<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{

    public static $TABLE_NAME = 'images';

    function __construct($foo = null)
    {
        $this->redisClient = new \Predis\Client();
    }

    public function create(Request $request, $productId)
    {
        $uploadFile = $request -> file('image');
        $name = $request -> input('name');

        $DEST_PATH = env('STORAGE_PATH', 'images');

        print_r($uploadFile);
        exit();

        $res = $uploadFile -> move($DEST_PATH, $uploadFile -> getClientOriginalName());

        $path = $res -> getPathName();
        $imageId = DB::table(self::$TABLE_NAME)
            -> insertGetId([
                    'product_id' => $productId,
                    'name' => $name,
                    'path' => $path
                ]);

        $key = $productId . "_" . $imageId;
        $this -> redisClient -> set($key, file_get_contents($res -> getRealPath()));

    	return response() -> json(['image_id' => $imageId]);
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
