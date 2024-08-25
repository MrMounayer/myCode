<?php

namespace App\Http\Controllers;

use App\Models\{Form, FormField, UserData};
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query("country") == null || $request->query("country") == "") {
            return redirect("/registration-request");
        }
        return view("registration", [
            "fields" => Form::where('country', $request->query("country"))
                ->first()
                ?->form_fields()
                ->latest()
                ->get(),
            "request" => $request,
            "error"=>"",
            "user"=>""
        ]);
    }

    public function create(Request $request)
    {
        $id = $request->input("form");
        $fields = FormField::where("form_id", $id)->get();
        $user = [];
        foreach ($fields as $field) {
            if ($field->required == 1 &&  ($request->input($field->name) == "" || $request->input($field->name) == null)) {
                return view("registration", [
                    "fields" => Form::where('country', "Algeria")
                        ->first()
                        ?->form_fields()
                        ->latest()
                        ->get(),
                    "error" => "you need to fill all the fields !",
                    "request"=>$request,
                    "user"=>$user
                ]);
            }
            $user[$field->name] = $request->input($field->name);
        }

        UserData::create(["informations"=>$user]);

        return view("registration", [
            "fields" => Form::where('country', "Algeria")
                ->first()
                ?->form_fields()
                ->latest()
                ->get(),
            "request" => request(),
            "error" => "success",
            "user"=>""
        ]);
    }
}
