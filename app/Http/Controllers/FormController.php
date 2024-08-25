<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        return view("registration-request", [
            
            'forms' => Form::latest()->get(),
        ]);
    }

    public function create(Request $request)
    {
        // dd($request->all());
        return view("registration-request", [
            "result" => "POSTING TO THIS PAGE"
        ]);
    }
    //
}
