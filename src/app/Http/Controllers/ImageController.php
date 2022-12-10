<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function imgindex()
    {
        $image = Image::all();
        return response()->json($image, 200);
        // $clothes_image = Clothes::find(61)->images->toArray();
        // $image = Image::find(16)->clothes->product_name;
        // \Log::debug($clothes_image,$image);
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        // \Log::debug($request);
        // $image = new Image;
        // $image->clothes_id = $request->clothes_id;
        // $image->img_path = $request->img_path;
        // $image->save();
        // return response()->json($image, 200);
        // $filename = $request->photo->name;

     

    }
}
