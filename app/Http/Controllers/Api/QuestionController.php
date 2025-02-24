<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
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
            'question_text' => 'required|string',
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // حفظ السؤال في قاعدة البيانات
        $question = Question::create([
            'question_text' => $request->question_text,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'Question sent successfully!', 'data' => $question], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function getPatientDoctorQuestions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $questions = Question::where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->get();

        return response()->json(['questions' => $questions]);
    }

}
