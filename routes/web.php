<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/put" ,function(){
    return "put ok";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/contacts", fn ()  => Response::view("contacts"));

Route::post("contacts", function(Request $request){
    dd($request);
});
Route::post("ejercicio2/a", function(Request $request){
    $request->validate([
        "name"=>"required",
        "description"=>"required",
        "price"=>"required|numeric"
    ]);
    $request->get("name");
    $request->get("description");
    $request->get("price");
    return Response::json([
        "name"=>$request->get("name"),
        "description"=>$request->get("description"),
        "price"=>$request->get("price")
    ]);
});
Route::post("ejercicio2/b",  function(Request $request){
    $request->validate([
        "name"=>"required",
        "description"=>"required",
        "price"=>"required|numeric|min:0"
    ]);
    $request->get("name");
    $request->get("description");
    $request->get("price");

    return Response::json([
        "name"=>$request->get("name"),
        "description"=>$request->get("description"),
        "price"=>$request->get("price")
    ]);

});
Route::post("ejercicio2/c", function(Request $request){
    $discounts=["SAVE5","SAVE10","SAVE15"];
    //agregar un query parameter a al url
    $request->validate([
        "name"=>"required",
        "description"=>"required",
        "price"=>"required|numeric|min:0",
    ]);
    $request->query("discount");
    $request->get("name");
    $request->get("description");
    $request->get("price");
    
    //verificar si el discount es valido
    if(in_array($request->query("discount"),$discounts)){
        $price=$request->get("price");
        $discount=$request->query("discount");
        $discountValue=0;
        switch($discount){
            case "SAVE5":
                $discountValue=5;
                break;
            case "SAVE10":
                $discountValue=10;
                break;
            case "SAVE15":
                $discountValue=15;
                break;
        }
        $price=$price-($price*($discountValue/100));
        return Response::json([
            "name"=>$request->get("name"),
            "description"=>$request->get("description"),
            "price"=>$price,
            "discount"=>$discountValue,
        ]);
    }else{
        return Response::json([
            "name"=>$request->get("name"),
            "description"=>$request->get("description"),
            "price"=>$request->get("price"),
            "discount"=>0,
        ]);
    }
});