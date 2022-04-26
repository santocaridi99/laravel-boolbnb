<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->validate([
            "name" => "nullable|string",
            'lastname' => "required|string",
            "email" => "required|email",
            "content" => "required|string",
            'apartment_id' => 'required'
        ]);

        $newContact = new Message();
        $newContact->fill($data);
        $newContact->save();

        return response()->json($newContact);
    }
}
