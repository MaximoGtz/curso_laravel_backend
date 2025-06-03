<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testFunction(Request $request)
    {
        return response()->json([
            "message" => "La api esta funcionando",
            "input1" => $request->input("text")
        ]);
    }
}
