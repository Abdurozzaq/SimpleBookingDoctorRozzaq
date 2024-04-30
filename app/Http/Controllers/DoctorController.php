<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::select('*');
        return datatables()->of($doctors)
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->validated());
        return new DoctorResource($doctor);
    }

    public function update(StoreDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());
        return new DoctorResource($doctor);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response(null, 204);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            return response()->json($doctor);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
}
