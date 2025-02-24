<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id',
            'doctor_id' => 'required|exists:users,id',
            'response_text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $response = Response::create([
            'question_id' => $request->question_id,
            'doctor_id' => $request->doctor_id,
            'response_text' => $request->response_text
        ]);

        // تحديث حالة السؤال ليصبح "answered"
        Question::where('id', $request->question_id)->update(['status' => 'answered']);

        return response()->json(['message' => 'Response sent successfully!', 'data' => $response], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getResoureformdoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $response = Response::where('question_id', $request->question_id)
            ->where('doctor_id', $request->doctor_id)
            ->get();

        return response()->json(['Answer' => $response]);
    }
}
