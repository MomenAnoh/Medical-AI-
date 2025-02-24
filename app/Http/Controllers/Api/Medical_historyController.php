<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Medical_history;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Medical_historyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name_of_Surgery' => 'required|string|max:255',
            'Description_of_Surgery' => 'nullable|string',
            'user_id' => 'required|exists:users,id', // تأكد أن المستخدم موجود في جدول users
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
       $store_history = new Medical_history;
       $store_history->Name_of_Surgery=$request->Name_of_Surgery;
       $store_history->Description_of_Surgery=$request->Description_of_Surgery;
       $store_history->user_id=$request->user_id;
       $store_history->save();
       return response()->json($store_history,200);


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id=$request->user_id;
        $histories_of_patient = User::with('Medical_history')->find($id);


        if (!$histories_of_patient) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($histories_of_patient, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medical_history $medical_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medical_history $medical_history)
    {
        //
    }
}
