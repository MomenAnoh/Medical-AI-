<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\XRay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use const App\Http\Controllers\Ray;

class XRayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name_of_XRay' => 'required|string|max:255',
            'Description_of_XRay' => 'nullable|string',
            'Result_of_XRay' => 'required|string',
            'type_of_XRay' => 'required|string',
            'image_of_XRay' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // رفع الصورة وحفظها
        if ($request->hasFile('image_of_XRay')) {
            $imagePath = $request->file('image_of_XRay')->store('xrays', 'public');
        } else {
            return response()->json(['error' => 'Image upload failed'], 500);
        }

        // حفظ بيانات الأشعة في قاعدة البيانات
        $xray = new XRay();
        $xray->Name_of_XRay = $request->Name_of_XRay;
        $xray->Description_of_XRay = $request->Description_of_XRay;
        $xray->Result_of_XRay = $request->Result_of_XRay;
        $xray->type_of_XRay = $request->type_of_XRay;
        $xray->image_of_XRay = $imagePath;
        $xray->user_id = $request->user_id;
        $xray->save();

        return response()->json($xray, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id=$request->user_id;
        $XRay_of_patient = User::with('XRay')->find($id);


        if (!$XRay_of_patient) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($XRay_of_patient, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(XRay $xRay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, XRay $xRay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(XRay $xRay)
    {
        //
    }
    public function Unique_XRay(Request $request)
    {
        $id=$request->XRay_id;
        $XRay= XRay::find($id);


        if (!$XRay) {
            return response()->json(['message' => 'XRay not found'], 404);
        }

        return response()->json($XRay, 200);
    }
}
