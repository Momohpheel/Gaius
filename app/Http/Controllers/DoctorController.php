<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Record;
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/doctor/dashboard');
        }
        Session::flash('error', 'User not found');
        return back();

    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/doctor/login');


    }


    public function dashboard(Request $request)
    {
        try{
            //$appointment = Appointment::where("user_id", auth()->user()->id)->count();
            $appointment = Appointment::get();
            $accepted_appointment = Appointment::where("status", "pending")->get();
            $user = User::count();
            $prescription = Prescription::count();
            
           
            foreach($appointment as $appointmen){

                // $appointment['doctor_name'] =  "nil";
     
                 if (isset($appointmen->doctor_id)){
                     $doctor = User::where("id", $appointmen->doctor_id)->first();
                     $appointmen['doctor_name'] = $doctor->name ?? "";
                 }
                
                 $appointmen['clinic_id'] = $record->clinicId ?? "";
                 
             }


             foreach($accepted_appointment as $appointmen){
                // $appointment['doctor_name'] =  "nil";
     
                if (isset($appointmen->doctor_id)){
                    $doctor = User::where("id", $appointmen->doctor_id)->first();
                    $appointmen['doctor_name'] = $doctor->name ?? "";
                }
               
                $appointmen['clinic_id'] = $record->clinicId ?? "";
            }
             $output = [
                'appointments' => $appointment->count(),
                'prescription' => $prescription,
                'user' => $user,
                'appointment_list' => $appointment,
                'accepted_appointment' => $accepted_appointment,
            ];


            return view("doctor.docdashboard", compact('output'));
        }catch(\Exception $e){
            Session::flash('error', 'Doc not found'.$e->getMessage());
            return back();
        }
    }

    public function scheduleAppointment(Request $request)
    {}

    public function getAppointments(Request $request)
    {}

    public function getStudentAppointments(Request $request, int $od)
    {}

    public function getAppointment(Request $request, int $od)
    {}

    public function getDoctors(Request $request, int $od)
    {}

    public function getDoctor(Request $request, int $od)
    {}

    public function getStudents(Request $request, int $od)
    {}

    public function getStudent(Request $request, int $od)
    {}

    public function getMedications(Request $request, int $od)
    {}

    public function getMedication(Request $request, int $od)
    {}

    public function report(Request $request)
    {}

    public function updateProfile(Request $request)
    {}


}
