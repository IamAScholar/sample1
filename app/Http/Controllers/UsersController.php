<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function create(){
      return view('user.create');
    }
    public function show($id){
      $user = User::findOrFail($id);
      return view('user.show',compact('user'));
    }
    public function store(Request $request){
      $this-> validate($request,['name'=>'required|max:50',
                                 'email' =>'required|email|unique:users|max:255',
                                 'password'=>'required'
                    ]);
      $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password)
      ]);
      session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
      return redirect()->route('users.show',[$user]);
    }

}
