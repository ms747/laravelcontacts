<?php

use Illuminate\Http\Request;
use App\Contacts;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/contacts',function(){
    $contacts = Contacts::all();
    return response()->json($contacts,201);
});

Route::post('/contacts',function(Request $request){
     $contact = new Contacts();
     $contact->name = $request->name;
     $contact->number = $request->number;
     $contact->save();
    return response()->json(["message" => "inserted"],200);
});

Route::delete('/contact/{id}',function($id){
    $contact = Contacts::find($id);
    if($contact){
        $contact->delete();
        return response()->json(["message" => "Contact deleted"],201);
    }
    else{
        return response()->json(["message" => "Contact not found"],404);
    }
});