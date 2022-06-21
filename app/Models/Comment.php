<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";

    public $fillable = [
        'id',
        'user_id',
        'image_id',
        'content',
    ]; 

    public function user(){
       return $this->belongsTo(User::class,'user_id'); 
    }

    public function image(){
        return $this->belongsTo(Image::class,'image_id');
    }
}
