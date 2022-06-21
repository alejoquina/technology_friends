<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    
    public function create(){
        return view('image.create');
    } 

    public function save(Request $request){
        $image = new Image();
        $validate = $this->validate($request,[
            'image_path' => 'required|image',
            'description' => 'required',
        ]);
       
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        
        $user = User::find(Auth::id());
        $image->user_id = $user->id;
        $image->description = $description;

        if($image_path){
            $image_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_name, file::get($image_path));
            $image->image_path = $image_name; 
        }

        $image->save();

        return redirect()->route('home')->with(['mensage' => 'publicacion realziada correctamente']);


     
    }
    
    
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file,200);
    }

    public function detail($id){
        $image = Image::find($id);
        return view('image.detail',['image'=> $image]);
    }
}
