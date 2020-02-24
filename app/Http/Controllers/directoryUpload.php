<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class directoryUpload extends Controller
{
    public function directory_data(){
        $thefolder = "168.232.79.90";
        if ($handler = opendir($thefolder)) {
            while (false !== ($file = readdir($handler))) {
                    echo "$file<br>";
            }
            closedir($handler);
        }
    }

    public function index(){
        return view('welcome');
    }
}
