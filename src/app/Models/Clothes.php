<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;
// use Illuminate\Support\Facades\DB;

class Clothes extends Model
{
    use HasFactory;
    // use SoftDeletes;
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // public static function boot(){
    //     parent::boot();

    //     // リレーション先のテーブルデータ削除
    //     static::deleted(function ($entry) {    
    //         $entry->images('id')->delete();
            
    //     });
    // }
    // public function delete(){
    //     DB::beginTransaction();
        
    //         Image::find('id')->delete();
    //         DB::commit();
       
        
    // }
}
