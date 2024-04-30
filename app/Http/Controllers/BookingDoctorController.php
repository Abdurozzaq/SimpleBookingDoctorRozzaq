<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingDoctorRequest;
use App\Http\Resources\BookingDoctorResource;
use App\Models\BookingDoctor;
use App\Models\Doctor;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingDoctorController extends Controller
{
    public function showForm(Request $request)
    {
        $treatments = Treatment::all();
        $doctors = Doctor::all();

        return view('patient.index', [
            'doctors' => $doctors,
            'treatments' => $treatments,
        ]);
    }

    public function submitForm(Request $request)
    {
        // Validasi request
        $request->validate([
            'treatment' => 'required',
            'doctor' => 'required',
            'datetime' => 'required',
        ]);

        // Proses data form
        BookingDoctor::insert([
            'patient_id' => Auth::id(),
            'treatment_id' => $request->treatment,
            'doctor_id' => $request->doctor,
            'booking_datetime' => $request->datetime,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Mengirim response
        return response()->json([
            'message' => 'Appointment successfully created!'
        ]);
    }

    public function index()
    {
        $bookingDoctors = BookingDoctor::join('treatments', 'booking_doctors.treatment_id', '=', 'treatments.id')
            ->join('doctors', 'booking_doctors.doctor_id', '=', 'doctors.id')
            ->join('users', 'booking_doctors.patient_id', '=', 'users.id')
            ->select([
                'booking_doctors.id',
                'booking_doctors.patient_id',
                'booking_doctors.doctor_id',
                'booking_doctors.treatment_id',
                'booking_doctors.booking_datetime',
                'treatments.name as treatment_name',
                'doctors.name as doctor_name',
                'users.name as patient_name'
            ])
            ->get();
        return datatables()->of($bookingDoctors)
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function update(StoreBookingDoctorRequest $request, $id)
    {
        $validatedData = $request->validated();
        $bookingDoctor = BookingDoctor::find($id);
        $bookingDoctor->update($validatedData);
        return new BookingDoctorResource($bookingDoctor);
    }

    public function destroy($id)
    {
        $bookingDoctor = BookingDoctor::find($id);
        $bookingDoctor->delete();
        return response(null, 204);
    }

    public function show($id)
    {
        $bookingDoctor = BookingDoctor::find($id);

        if ($bookingDoctor) {
            return response()->json($bookingDoctor);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }

    public function getPatient()
    {
        $data = User::all();
        return response()->json($data);
    }

    public function getDoctor()
    {
        $data = Doctor::all();
        return response()->json($data);
    }

    public function getTreatment()
    {
        $data = Treatment::all();
        return response()->json($data);
    }
}
