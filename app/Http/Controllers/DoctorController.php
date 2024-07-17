<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Record;
use App\Models\Doctor;
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
            $user = User::where("email", $request['email'])->first();

            if ($user->role != "doctor") {
                Session::flash('error', 'Not a Doctor, Login through the student portal');
                return back();
            }else{
                return redirect()->intended('/doctor/dashboard');
            }
            //return redirect()->intended('/doctor/dashboard');
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
            $user = User::where("role", "user")->count();
            $doctors = User::where("role", "doctor")->count();
            $pending_appointment = Appointment::where("status", "pending")->count();
            $prescription = Prescription::count();
            
           
            foreach($appointment as $appointmen){

                // $appointment['doctor_name'] =  "nil";
     
                 if (isset($appointmen->doctor_id)){
                     $doctor = User::where("id", $appointmen->doctor_id)->first();
                     $appointmen['doctor_name'] = $doctor->name ?? "";
                     
                 }

                 $student = User::where("id", $appointmen->user_id)->first();
                 $appointmen['student_name'] = $student->name ?? "";
                
                 $appointmen['clinic_id'] = $record->clinicId ?? "";
                 
             }


             foreach($accepted_appointment as $appointmen){
                // $appointment['doctor_name'] =  "nil";
     
                if (isset($appointmen->doctor_id)){
                    $doctor = User::where("id", $appointmen->doctor_id)->first();
                    $appointmen['doctor_name'] = $doctor->name ?? "";
                }

                $student = User::where("id", $appointmen->user_id)->first();
                $appointmen['student_name'] = $student->name ?? "";
               
                $appointmen['clinic_id'] = $record->clinicId ?? "";
            }
             $output = [
                'appointments' => $appointment->count(),
                'prescription' => $prescription,
                'students' => $user,
                'doctors' => $doctors,
                'pending_appointment' => $pending_appointment,
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
    {
        try{
           
            $appointment = new Appointment;
            $appointment->user_id = $request['student_id'];
            $appointment->reason = $request['reason'];
            $appointment->status = 'pending';
            $appointment->save();

            Session::flash('success', 'Appointment Scheduled');
            return redirect("/doctor/appointment");
        }catch(\Exception $e){
           
            return back();
        }
    }

    public function getAppointments(Request $request)
    {
        $appointments = Appointment::get();
        $doctors = User::where("role", "doctor")->get();
        $students = User::where("role", "user")->get();
        
        foreach($appointments as $appointment){
            $record = Record::where("user_id", $appointment->user_id)->first();
        

            if (isset($appointment->doctor_id)){
                $doctor = User::where("id", $appointment->doctor_id)->first();
                $appointment['doctor_name'] = $doctor->name ?? "";
            }
           
            $student = User::where("id", $appointment->user_id)->first();
            $appointment['student_name'] = $student->name ?? "";
           

            $appointment['clinic_id'] = $record->clinicId ?? "";
            
        }

        return view("doctor.appointments", compact('appointments', 'doctors', 'students'));
    }

    public function approveAppointment(Request $request, int $id)
    {
        $appointment = Appointment::where("id", $id)->first();
        $appointment->doctor_id = $request['doctor_id'];
        $appointment->doctors_note = $request['doctors_note'];
        $appointment->appointment_time = $request['appointment_date'];
        $appointment->status = 'accepted';
        $appointment->save();

        Session::flash('success', 'Appointment accepted');
        return back();
    }
   
    public function getDoctors(Request $request)
    {
        $doctor = User::where("role", "doctor")->get();
        return view("doctor.doctors", compact('doctor'));
    }

    public function addDoctors(Request $request)
    {
        $user = new User;
        $user->name = $request['fullName'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->role = 'doctor';
        $user->sex = $request['sex'];
        $user->qualification = $request['qualification'];
        $user->level = $request['level'];
        $user->start_date = $request['start_date'];
        $user->status = $request['status'];
        $user->save();

        return redirect('/doctor/all');
    }

    public function getStudents(Request $request)
    {
        $students = User::where("role", "user")->get();

        foreach($students as $student){
            $record = Record::where("user_id", $student->id)->first();
        

            $student['record'] = $record ?? "";
            $student['clinic_id'] = $record->clinicId ?? "";
            $student['phone'] = $record->phoneNumber ?? "";
            
        }
        return view("doctor.students", compact('students'));
    }

    public function addStudentRecord(Request $request, $id)
    {

        $user = User::where("id", $id)->first();
        $record = Record::where("user_id", $id)->first();
        $record->genotype = $request['genotype'];
        $record->bloodgroup = $request['bloodgroup'];
        $record->deformity = $request['deformity'];
        $record->deformityType = $request['deformityType'];
        $record->recurringIllness = $request['recurringIllness'];
        $record->phoneNumber = $request['phoneNumber'];
        $record->save();

        Session::flash('success', 'Record added for '.$user->name);
        return back();
    }
   
    public function getMedications(Request $request)
    {}

    
    public function report(Request $request)
    {}

    public function updateProfile(Request $request)
    {}


}
