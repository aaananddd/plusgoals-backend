<?php

namespace App\Http\Controllers;
use App\Model\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){

        $client = new \GuzzleHttp\Client();
        $response = $client->request('  GET', 'http://localhost:8000/api/users/', [
            'form_params' => [
                'id' => '1',
            ]
        ]);
    
       return view('profile', compact('response'));

    }
   
    
}
