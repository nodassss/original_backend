<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Storage;
class ClothesController extends Controller
{
    public function index()
    {
        $clothes = Clothes::with('images')->get();
        
        return response()->json($clothes, 200);
        // return response()->json($image, 200);
        
    }


    public function create(Request $request)
    {
        //Storage::disk('local')->put('public/images/', $request->file('formの名前'));
        \Log::debug($request);
        $clothes = new Clothes;
        $image = new Image;
        $clothes->user_id = $request->user_id;
        $clothes->product_name = $request->product_name;
        $clothes->price = $request->price;
        $clothes->gender = $request->gender;
        $clothes->size = $request->size;
        $clothes->condition = $request->condition;
        $clothes->message = $request->message;
        $clothes->save();
       
        $image->clothes_id = $clothes->id;
        $image->img_path = $request->img_path;
        $image->save();
        return response()->json($clothes, 200);
        return response()->json($image, 200);
       

        
    }

    public function update(Request $request)
    {   //削除処理
        //Clothes::with('images')->whereNotIn('img_path', $request)->delete();
        
        $id = $request->id;
        $clothe = Clothes::with('images')->find($id);
        $image = Image::find($clothe->id);
        
        \Log::debug($image);
        $clothe->user_id = $request->user_id;
        $clothe->product_name = $request->product_name;
        $clothe->price = $request->price;
        $clothe->gender = $request->gender;
        $clothe->size = $request->size;
        $clothe->condition = $request->condition;
        $clothe->message = $request->message;
        $clothe->save();

        $image->clothes_id = $request->clothes_id;
        $image->img_path = $request->img_path;
        $image->save();
        return $clothe;
        return $image;

    }

    public function delete(Request $request)
    {
        
        $clothes =  Clothes::find($request->id);
        $clothes->delete();
        $clothes = Clothes::all();
        return $clothes;
        
    }
    
}
