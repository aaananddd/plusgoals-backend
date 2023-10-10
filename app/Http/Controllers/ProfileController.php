<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth; 
use Session;

class ProfileController extends Controller
{
    public function index(Request $request){

        $user = Session::get('user'); 
        $id = $user->id;
        $response = User::select('*')->where('id', $id)->get();
        return view('profile', ['data' => array($response)]);
   
    }
   
    
}
