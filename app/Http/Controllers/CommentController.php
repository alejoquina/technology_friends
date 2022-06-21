<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        
        $comment = new Comment();
        $validate = $this->validate($request,[
            'image_id' =>  'required|integer',
            'content' =>  'required|string|max:200',            

        ]);
        $user = User::find(Auth::id());
        $id = $user->id;
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        $comment->user_id = $id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        $comment->save();
        return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'se realizo comentario correctamnete']);
        

        
    
    }


    public function delete($id){
        $user = Auth::user();     
        $comment = Comment::find($id);
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id) ){
            $comment->delete();
            return redirect()->route('image.detail',['id'=>$comment->image->user_id])->with(['message'=>'se elimimo comentario correctamnete']);

        }else{
            return redirect()->route('image.detail',['id'=>$comment->image->user_id])->with(['message'=>'no se elimimo comentario ']);
        }

    }
}
