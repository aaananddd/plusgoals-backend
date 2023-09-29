<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;

class LoginController extends Controller
{
    
    public function index()
    {
       
        return view('login');
    }

    public function loginCheck(Request $request){
<<<<<<< HEAD
        // dd($request);
=======
     
>>>>>>> 490f88b336041dacc80e83bd90b93c470d165bdc
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://localhost:8000/api/login'); 
        return $response->view(['login']);

    }
}
