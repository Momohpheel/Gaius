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

class StudentController extends Controller
{

    public function register(Request $request)
    {
        $validate = $request->validate([
            'fullName' => 'required',
            'matricNumber' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request['fullName'];
        $user->matric_number = $request['matricNumber'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->role = 'user';
        $user->save();

        $clinicId = generateRandomNumericString();
        
        $record = new Record;
        $record->genotype = "";
        $record->bloodgroup = "";
        $record->deformity = "";
        $record->deformityType = "";
        $record->recurringIllness = "";
        $record->phoneNumber = "";
        $record->clinicId = $clinicId;
        $record->user_id = $user->id;
        $record->save();
       // Session::flash('error', 'User not found');
        return redirect('/student/login');
    
    }

    function generateRandomNumericString() {
        $numbers = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefgjijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $index = rand(0, strlen($numbers) - 1);
            $randomString .= $numbers[$index];
        }
        return $randomString;
    }

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

            if ($user->role != "user") {
                Session::flash('error', 'Not a Student, Login through the admin portal');
                return back();
            }else{
                return redirect()->intended('/student/dashboard');
            }
            
        }

        Session::flash('error', 'User not found');
        return back();        

    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/student/login');


    }


    public function dashboard(Request $request)
    {

        try{
            //$appointment = Appointment::where("user_id", auth()->user()->id)->count();
            $appointment = Appointment::where("user_id", auth()->user()->id)->get();
            $accepted_appointment = Appointment::where("user_id", auth()->user()->id)->where("status", "accepted")->get();
            $user = User::find(auth()->user()->id);
            $prescription = Prescription::where("user_id", auth()->user()->id)->count();
            $record = Record::where("user_id", auth()->user()->id)->first();
           
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
                'record' => $record,
                'appointment_list' => $appointment,
                'accepted_appointment' => $accepted_appointment,
            ];


            return view("student.dashboard", compact('output'));
        }catch(\Exception $e){
            Session::flash('error', 'User not found'.$e->getMessage());
            return back();
        }
    }

    public function scheduleAppointment(Request $request)
    {

        try{
           
            $appointment = new Appointment;
            $appointment->user_id = auth()->user()->id;
            $appointment->reason = $request['reason'];
            $appointment->status = 'pending';
            $appointment->save();

            Session::flash('success', 'Appointment Scheduled');
            return redirect("/student/appointments");
        }catch(\Exception $e){
           
            return back();
        }
    }

    public function getAppointments(Request $request)
    {
        $appointments = Appointment::where("user_id", auth()->user()->id)->get();
        $record = Record::where("user_id", auth()->user()->id)->first();
        

        foreach($appointments as $appointment){

           // $appointment['doctor_name'] =  "nil";

            if (isset($appointment->doctor_id)){
                $doctor = User::where("id", $appointment->doctor_id)->first();
                $appointment['doctor_name'] = $doctor->name ?? "";
            }
           
            $appointment['clinic_id'] = $record->clinicId ?? "";
            
        }

        return view("student.appointments", compact('appointments'));
    }

    public function getAppointment(Request $request, int $od)
    {
        $appointment = Appointment::where("id", $id)->first();
        return view("student.appointments", compact('appointment'));
    }

    public function profile(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view("student.profile", compact('user'));

    }

    public function updateProfile(Request $request)
    {
        try{
           
            $user = User::where('id', auth()->user()->id)->first();
            $user->name = $request['name'] ?? $user->name;
            $user->email = $request['email'] ?? $user->email;
            
            $user->save();
            Session::flash('success', 'Profile Updated');
            return redirect("/student/profile");
        }catch(\Exception $e){
           
            return back();
        }
    }

   

    

}
