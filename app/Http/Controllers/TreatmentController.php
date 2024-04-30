<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Resources\TreatmentResource;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::select('*');
        return datatables()->of($treatments)
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(StoreTreatmentRequest $request)
    {
        $treatment = Treatment::create($request->validated());
        return new TreatmentResource($treatment);
    }

    public function update(StoreTreatmentRequest $request, Treatment $treatment)
    {
        $treatment->update($request->validated());
        return new TreatmentResource($treatment);
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response(null, 204);
    }

    public function show($id)
    {
        $treatment = Treatment::find($id);

        if ($treatment) {
            return response()->json($treatment);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
}
