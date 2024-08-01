<?php

namespace App\Http\Controllers;

use App\Models\FactoryUser;
use Illuminate\Http\Request;

class FactoryUserController extends Controller
{
    public function store(Request $request)
    {
//        $request->validate([
//            'factory_id' => 'required|exists:factories,id',
//            'user_id' => 'required|exists:users,id',
//            'access_level' => 'required|in:owner,employee',
//        ]);

        FactoryUser::create([
            'factory_id' => $request->factory_id,
            'user_id' => $request->user_id,
            'access_level' => $request->access_level,
        ]);

        return response()->json(['success' => true, 'message' => 'User linked successfully!']);
    }
}
