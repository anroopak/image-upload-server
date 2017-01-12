<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app -> get('/test/', function(){
	return "Test";
});

// Products - List
$app -> get('/product', [
	'as'=>'product', 
	'uses'=> 'ProductController@get']);

// Products - Get with ID
$app -> get('/product/{id}', [
	'as'=>'product', 
	'uses'=> 'ProductController@getWithID']);


// Products - Create
$app -> post('/product', [
	'as'=>'product', 
	'uses'=> 'ProductController@create']);

// Image - Upload
$app -> post('/product/{id}/image', [
	'uses' => 'ImageController@create'
	]);
