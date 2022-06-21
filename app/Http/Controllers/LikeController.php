<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\like;
use Illuminate\Support\Facades\Auth;
class LikeController extends Controller
{
    

    public function __construct(){
        $this->middleware('auth');
    }

    public function like($image_id){
        $user = Auth::user();
        $like_user = Like::where('user_id',$user->id)->where('image_id',$image_id)->count();       
        if($like_user == 0){
       
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = $image_id;
            $like->save();
            return response()->json([
                'like' => $like 
            ]);
        }else{
            return response()->json([
                'message' => 'ya tiene like' 
            ]);
        }
       
    }

    public function dislike($image_id){

        $user = Auth::user();
        $like = Like::where('user_id',$user->id)->where('image_id',$image_id)->first();       
        if($like){
            $like->delete();
            return response()->json([
                'like' => $like,
                'message' => 'dislike correctamente' 
            ]);
        }else{
            return response()->json([
                'message' => 'el like no existe' 
            ]);
        }
    }
        
}
