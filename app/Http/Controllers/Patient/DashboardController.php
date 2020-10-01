<?php

namespace App\Http\Controllers\Patient;

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



    /*Patient Edit Personal Information Function */
    public function patient_edit(Request $request, $id)
    {
        $patients = DB::table('patient_record')
        ->where('patient_id',$id)
        ->first();

        return view('patient.patient-modify-personal-information')->with('patients',$patients);
    }



    /*Patient Update Personal Information Function */
    public function patient_update(Request $request, $id)
    {
        /* Find patient in patient page */
        $patients = Patient::find($id);

        /* Validate input in patient page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'email' => 'required|max:191',
            'address' => 'required',
            'gender' => 'required',
            'admission_date' => 'required',
            'birth_date' => 'required',
            'chronic_type' => 'required',
            'blood_type' => 'required',
            'medical_history' => 'required',
            'password' => 'required|min:8|max:191',
        ]);

        /* Get input and update it in patient page */
        $patients->patient_name  = $request->input('username');
        $patients->patient_phone = $request->input('phone');
        $patients->patient_email = $request->input('email');
        $patients->patient_address = $request->input('address');
        $patients->patient_gender = $request->input('gender');
        $patients->patient_admission_date = $request->input('admission_date');
        $patients->patient_birth_date = $request->input('birth_date');
        $patients->patient_chronic_type = $request->input('chronic_type');
        $patients->patient_blood_type = $request->input('blood_type');
        $patients->patient_medical_history = $request->input('medical_history');
        $patients->update();


        $users = User::find($id);

        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->update();
        
        return redirect('patient-modify-personal-information/'. $id)->with('status','Your Data is Updated');
    }



    /*Patient List Out Personal Health Index */
    public function health_index_record()
    {
        $patient = Auth::user();
        $patient_id = $patient->id;


        $patients = DB::table('health_index_record')
        ->where('patient_id', $patient_id)
        ->orderBy('created_at','desc')
        ->paginate(10);


        return view('patient.patient-manage-health-index')->with('patients',$patients);
    }



    /*Patient Create Personal Health Index */
    public function create_health_index(Request $request)
    {

        $create_health_index = new Health_Index;

        /* Validate input in patient page */
        $validatedData = $request->validate([
            'blood_pressure_systolic' => 'required|numeric|between:1,200',
            'blood_pressure_diastolic' => 'required|numeric|between:1,150',
            'fasting_blood_sugar' => 'required|numeric|between:1,150',
            'blood_sugar_after_eat' => 'required|numeric|between:1,250',
            'HbA1c' => 'required|numeric|between:1,10',
            'weight' => 'required|numeric|between:1,300',
            'height' => 'required|numeric|between:1,300',
            'body_temprature' => 'required|regex:/[\d]{2}.[\d]{1}/',
        ]);

          
        $current_date = $request->input('current_date');
        $previous_record = Health_Index::select()->where('created_at', $current_date)->count();

        if($previous_record > 0)
        { 
            return redirect('/patient.patient-manage-health-index')->with('wrong_status','Sorry, today you already record the health index.');
        }
        else
        {
            $create_health_index->patient_id = $request->input('patient_id');
            $create_health_index->blood_pressure_systolic = $request->input('blood_pressure_systolic');
            $create_health_index->blood_pressure_diastolic = $request->input('blood_pressure_diastolic');
            $create_health_index->fasting_blood_sugar = $request->input('fasting_blood_sugar');
            $create_health_index->blood_sugar_after_eat = $request->input('blood_sugar_after_eat');
            $create_health_index->HbA1c = $request->input('HbA1c');
            $create_health_index->weight = $request->input('weight');
            $create_health_index->height = $request->input('height');
            $create_health_index->body_temprature = $request->input('body_temprature');
            $create_health_index->question = $request->input('question');
            $create_health_index->save();

            return redirect('/patient.patient-manage-health-index')->with('status','New health index record is Added');

        }
    }



    /*Patient Edit Personal Health Index */    
    public function health_index_edit(Request $request, $id)
    {
        $health_index_record = DB::table('health_index_record')
        ->where('index_id', $id)
        ->first();

        return view('patient.patient-modify-health-index')->with('health_index_record',$health_index_record);
    }



    /*Patient Update Personal Health Index */    
    public function health_index_update(Request $request, $id)
    {
        /* Find health index in patient page */
        $health_index_record = Health_Index::find($id);

        /* Validate input in patient page */
        $validatedData = $request->validate([
            'blood_pressure_systolic' => 'required|numeric|between:1,200',
            'blood_pressure_diastolic' => 'required|numeric|between:1,150',
            'fasting_blood_sugar' => 'required|numeric|between:1,150',
            'blood_sugar_after_eat' => 'required|numeric|between:1,250',
            'HbA1c' => 'required|numeric|between:1,10',
            'weight' => 'required|numeric|between:1,300',
            'height' => 'required|numeric|between:1,300',
            'body_temprature' => 'required|regex:/[\d]{2}.[\d]{1}/',
        ]);

        /* Get input and update it in patient page */
        $health_index_record->blood_pressure_systolic = $request->input('blood_pressure_systolic');
        $health_index_record->blood_pressure_diastolic = $request->input('blood_pressure_diastolic');
        $health_index_record->fasting_blood_sugar = $request->input('fasting_blood_sugar');
        $health_index_record->blood_sugar_after_eat = $request->input('blood_sugar_after_eat');
        $health_index_record->HbA1c = $request->input('HbA1c');
        $health_index_record->weight = $request->input('weight');
        $health_index_record->height = $request->input('height');
        $health_index_record->body_temprature = $request->input('body_temprature');
        $health_index_record->question = $request->input('question');
        $health_index_record->update();

        return redirect('patient-modify-health-index/'. $id)->with('status','Your health index record is Edited');

    }


    
    /*Patient List Out Personal Advice record */
    public function advice_record()
    {
        $patient = Auth::user();
        $patient_id = $patient->id;

        $patients = Advice::select()
        ->where('patient_id', $patient_id)
        ->get();

        return view('patient.patient-manage-advice')->with('patients',$patients);
    }
}
