<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        
        
        $user = User::find(Auth::id());
        $id = $user->id;
        $validate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->nick = $request->input('nick');
        $user->email = $request->input('email');
        
        $image = $request->file('image');
        if($image){
            //poner nombre unico
            $image_name = time().$image->getClientOriginalName();
            //selecciono el disco y el metodo put para ingresar el nombre image y el fichero 
            Storage::disk('users')->put($image_name, file::get($image));
            $user->image = $image_name;
        }

        $user->update();

        return redirect()->route('config')
                         ->with(['message'=>'usuario actualizado correctamente']);
                         
     }

     public function getImage($image_name){
       $file = Storage::disk('users')->get($image_name);
       return new Response($file,200);
     }


}
