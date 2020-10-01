<?php

namespace App\Http\Controllers\Doctor;

use App\User;
use App\Doctor;
use App\Patient;
use App\Health_Index;
use App\Advice;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{



    /*Doctor Edit Personal Information Function */
    public function doctor_edit(Request $request, $id)
    {
        /* Find doctor in doctor page */
        $doctors = DB::table('doctor_record')
        ->where('doctor_id',$id)
        ->first();
        
        return view('doctor.doctor-modify-personal-information')->with('doctors',$doctors);
    }



    /*Doctor Update Personal Information Function */
    public function doctor_update(Request $request, $id)
    {
        /* Find doctor in doctor page */
        $doctors = Doctor::find($id);

        /* Validate input in doctor page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'email' => 'required|max:191',
            'address' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8|max:191',
        ]);

        /* Get input in doctor page */
        $doctors->doctor_name  = $request->input('username');
        $doctors->doctor_phone = $request->input('phone');
        $doctors->doctor_email = $request->input('email');
        $doctors->doctor_clinic_address = $request->input('address');
        $doctors->doctor_gender = $request->input('gender');
        $doctors->update();

        $users = User::find($id);

        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->update();
        
        return redirect('doctor-modify-personal-information/'. $id)->with('status','Your Data is Updated');
    }



    /*Doctor List Out Personal Patient List */
    public function patient_list()
    {
        $user = Auth::user();
        $userid = $user->id;

        /* Find patient in doctor page */
        $patients = DB::table('patient_record')
        ->where('created_by', $userid)
        ->get();

        return view('doctor.doctor-manage-patient')->with('patients',$patients);
    }



    /*Doctor List Out Personal Patient Details */
    public function patient_information(Request $request, $id)
    {
        /* Find patient in doctor page */
        $patient = DB::table('patient_record')
        ->where('patient_id',$id)
        ->first();

        return view('doctor.doctor-view-patient-information')->with('patient',$patient);
    }



    /*Doctor Create Patient Account */    
    public function patient_create(Request $request)
    {
        $create_user = new User;
        
        /* Validate input in doctor page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'email' => 'required|max:191',
            'password' => 'required|min:8|max:191',
        ]);

        /* Get input and create patient user in doctor page */
        $create_user->name = $request->input('username');
        $create_user->phone = $request->input('phone');
        $create_user->usertype = $request->input('usertype');
        $create_user->email = $request->input('email');
        $create_user->password = Hash::make($request->input('password'));
        $create_user->save();


        $patient_record = $create_user->id;
        $user = Auth::user();
        $doctor_id = $user->id;

        /* Get input and create patient record in doctor page */
        $create_patient = new Patient;
        $create_patient->patient_id = $patient_record;
        $create_patient->patient_name = $request->input('username');
        $create_patient->patient_phone = $request->input('phone');
        $create_patient->patient_email = $request->input('email');
        $create_patient->created_by = $request->input('created_by');
        $create_patient->save();

        /* Get input and create patient advice in doctor page */
        $create_advice = new Advice;
        $create_advice->doctor_id = $doctor_id;
        $create_advice->patient_id = $patient_record;
        $create_advice->save();


        return redirect('doctor.doctor-manage-patient/')->with('status','New Patient is Added');

    }



    /*Doctor Edit Patient Account */ 
    public function patient_edit(Request $request, $id)
    {
        /* Find patient user record in doctor page */
        $patients = DB::table('users')
        ->where('id',$id)
        ->first();

        return view('doctor.doctor-modify-patient-information')->with('patients',$patients);
    }



    /*Doctor Update Patient Account */ 
    public function patient_update(Request $request, $id)
    {
        /* Find patient user record in doctor page */
        $users = User::findOrFail($id);

        /* Validate input in doctor page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'email' => 'required|max:191',
            'password' => 'required|min:8|max:191',
        ]);

        /* Get input in doctor page */
        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->usertype = $request->input('usertype');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->update();

        /* Find patient user record in doctor page */
        $patient = Patient::find($id);

        $patient->patient_name  = $request->input('username');
        $patient->patient_phone = $request->input('phone');
        $patient->patient_email = $request->input('email');
        $patient->update();

        return redirect('doctor-modify-patient-information/'. $id)->with('status','Your Patient Information is Edited');

    }



    /*Doctor Delete Patient Account */ 
    public function patient_delete($id)
    {
        $users = DB::table('users')
        ->where('id', $id)
        ->delete();

        $patient = DB::table('patient_record')
        ->where('patient_id', $id)
        ->delete();

        $advice = DB::table('advice_record')
        ->where('patient_id', $id)
        ->delete();

        return redirect('doctor.doctor-manage-patient/')->with('status','Your Patient is Deleted');

    }



    /*Doctor List Out Personal Patient Health Index */
    public function patient_health_record()
    {
        $user = Auth::user();
        $userid = $user->id;

        $patients = DB::table('patient_record')
        ->where('created_by', $userid)
        ->leftJoin('advice_record', 'patient_record.patient_id', '=', 'advice_record.patient_id')
        ->get();

        return view('doctor.doctor-manage-health-index')->with('patients',$patients);
    }  



    /*Doctor View Personal Patient Health Index */
    public function patient_health_record_details($id)
    {
        $health_index_records = DB::table('health_index_record')
        ->where('patient_id', $id)
        ->orderBy('created_at','desc')
        ->paginate(10);


        return view('doctor.doctor-view-patient-health-index')->with('health_index_records',$health_index_records);
    }


    /*Doctor Get Personal Patient Advice */
    public function doctor_update_advice(Request $request, $id)
    {
        $advice_records = DB::table('advice_record')
        ->where('patient_id', $id)
        ->get();

        return view('doctor.doctor-modify-advice')->with('advice_records',$advice_records);

    }


    /*Doctor Update Personal Patient Advice */
    public function advice_update(Request $request, $id)
    {
        $advice_records = Advice::find($id);

        $validatedData = $request->validate([
        'advice' => 'required',
        'prescription' => 'required',
        'appointment_date' => 'required',
        'appointment_time' => 'required',
        ]);

        $advice_records->advice = $request->input('advice');
        $advice_records->prescription = $request->input('prescription');
        $advice_records->appointment_date = $request->input('appointment_date');
        $advice_records->appointment_time = $request->input('appointment_time');
        $advice_records->update();

        return redirect('doctor.doctor-manage-health-index')->with('status','Your Advice is Updated');
    }

    
}
    
