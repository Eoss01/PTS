<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Doctor;
use App\Patient;
use App\Supplier;
use App\Advice;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    /* Display all user in admin page */
    public function user_list()
    {
        $users = DB::table('users')
        ->orderBy('id','desc')
        ->get();

        return view('admin.admin-user-list')->with('users',$users);
    }

    /* Create an user in admin page */
    public function user_create(Request $request)
    {

        $create_user = new User;
        
        /* Validate input in admin page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'usertype' => 'required',
            'email' => 'required|max:191',
            'password' => 'required|min:8|max:191',
        ]);

        /* Get input in admin page */
        $create_user->name = $request->input('username');
        $create_user->phone = $request->input('phone');
        $create_user->usertype = $request->input('usertype');
        $create_user->email = $request->input('email');
        $create_user->password = Hash::make($request->input('password'));

        /* Get admin ID in admin page */
        $user = Auth::user();
        $creator_id = $user->id;

        /* Insert the doctor and patient data into the patient_record and doctor_record in same time */
        if($create_user->usertype == "doctor")
        {
            $create_user->save();

            $doctor_record = $create_user->id;

            $create_doctor = new Doctor;
            $create_doctor->doctor_id = $doctor_record;
            $create_doctor->doctor_name = $request->input('username');
            $create_doctor->doctor_phone = $request->input('phone');
            $create_doctor->doctor_email = $request->input('email');
            
            $create_doctor->save();   
        }

        else if($create_user->usertype == "patient")
        {
            $create_user->save();

            $patient_record = $create_user->id;

            $create_patient = new Patient;
            $create_patient->patient_id = $patient_record;
            $create_patient->patient_name = $request->input('username');
            $create_patient->patient_phone = $request->input('phone');
            $create_patient->patient_email = $request->input('email');
            $create_patient->created_by = $creator_id;

            $create_patient->save();

            $create_advice = new Advice;
            $create_advice->doctor_id = $creator_id;
            $create_advice->patient_id = $patient_record;

            $create_advice->save();
        }

        else
        {
            $create_user->save();
        }

        return redirect('/admin.admin-user-list')->with('status','New user is created');
    }


    /* Edit user in admin page */
    public function user_edit(Request $request, $id)
    {
        $users = DB::table('users')
        ->where('id',$id)
        ->first();

        return view('admin.admin-modify-user-profile')->with('users',$users);
    }

    /* Update user in admin page */
    public function user_update(Request $request, $id)
    {

        /* Find user in admin page */
        $users = User::findOrFail($id);
        
        /* Validate edit input in admin page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'usertype' => 'required',
            'email' => 'required|max:191',
            'password' => 'required|min:8|max:191',
        ]);
        
        /* Get edit input in admin page */
        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->usertype = $request->input('usertype');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));

        /* If edit usertype, difference condition will appear */
        /* If edit usertype to doctor, if previous result is patient than delete it, else keep update the doctor record */
        if($users->usertype == "doctor")
        {

            $doctor = Doctor::find($id);
            
            if($doctor == null)
            {
                $create_doctor = new Doctor;
                $create_doctor->doctor_id = $id;
                $create_doctor->doctor_name = $request->input('username');
                $create_doctor->doctor_phone = $request->input('phone');
                $create_doctor->doctor_email = $request->input('email');
                
                $create_doctor->save();  

                $patient = Patient::find($id);

                if ($patient != null) {
                    $patient->delete();
                }

            }
            else
            {
                $doctor->doctor_name = $request->input('username');
                $doctor->doctor_phone = $request->input('phone');
                $doctor->doctor_email = $request->input('email');
                
                $doctor->update();   
            }

            $users->update();

        }
        
        /* If edit usertype to patient, if previous result is doctor than delete it, else keep update the patient record */
        else if($users->usertype == "patient")
        {

            $patient = Patient::find($id);

            if($patient == null)
            {
                $create_patient = new Patient;
                $create_patient->patient_id = $id;
                $create_patient->patient_name = $request->input('username');
                $create_patient->patient_phone = $request->input('phone');
                $create_patient->patient_email = $request->input('email');
    
                $create_patient->save();

                $doctor = Doctor::find($id);

                if ($doctor != null) {
                    $doctor->delete();
                }
            }
            else
            {
                $patient->patient_name  = $request->input('username');
                $patient->patient_phone = $request->input('phone');
                $patient->patient_email = $request->input('email');
                
                $patient->update(); 
            }

            $users->update();

        }
        
        /* If edit usertype to admin, if previous result is patient or doctor than delete it, else keep update the admin record */
        
        else if($users->usertype == "admin")
        {

            $patient = Patient::find($id);

            if($patient != null)
            {
                $patient = Patient::find($id);
                $patient->delete();
            }

            $doctor = Doctor::find($id);

            if($doctor != null)
            {
                $doctor = Doctor::find($id);
                $doctor->delete();
            }

            $users->update();

        }

        return redirect('/admin.admin-user-list')->with('status','User data is updated');
    }


    /* Delete an user in admin page */
    public function user_delete($id)
    {
        /* Find and delete an user in admin page */
        $users = User::find($id);

        /* Find and delete an user in each database record */
        /* If delete usertype is doctor, it will delete the doctor record, his advice record and finally user record */
        if($users->usertype == "doctor")
        {
            $doctor = DB::table('doctor_record')
            ->where('doctor_id',$id)
            ->delete();

            $advice = DB::table('advice_record')
            ->where('doctor_id', $id)
            ->delete();

            $users->delete();
        }

        /* If delete usertype is patient, it will delete the patient record, his advice record, personal health index record and finally user record */
        else if($users->usertype == "patient")
        {
            $patient = DB::table('patient_record')
            ->where('patient_id',$id)
            ->delete();

            $advice = DB::table('advice_record')
            ->where('patient_id', $id)
            ->delete();

            $advice = DB::table('health_index_record')
            ->where('patient_id', $id)
            ->delete();

            $users->delete();
        }

        /* If delete usertype is patient, it will delete the user record */
        else if($users->usertype == "admin")
        {
            $users->delete();
        }

        return redirect('/admin.admin-user-list')->with('status','User data is deleted');

    }


    /* Display all user in admin page */
    public function doctor_list()
    {
        $doctors = DB::table('doctor_record')
        ->orderBy('doctor_id','desc')
        ->get();

        return view('admin.admin-manage-doctor')->with('doctors',$doctors);
    }


    /* Edit doctor in admin page */
    public function doctor_edit(Request $request, $id)
    {
        $doctors = DB::table('doctor_record')
        ->where('doctor_id', $id)
        ->first();

        return view('admin.admin-modify-doctor-information')->with('doctors',$doctors);
    }


    /* Update doctor in admin page */
    public function doctor_update(Request $request, $id)
    {
        /* Find doctor in admin page */
        $doctors = Doctor::find($id);

        /* Validate edit input in admin page */
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'email' => 'required|max:191',
            'address' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8|max:191',
        ]);

        /* Get edit input update it in admin page */
        $doctors->doctor_name  = $request->input('username');
        $doctors->doctor_phone = $request->input('phone');
        $doctors->doctor_email = $request->input('email');
        $doctors->doctor_clinic_address = $request->input('address');
        $doctors->doctor_gender = $request->input('gender');
        $doctors->update();

        /* Find user record in admin page */
        $users = User::find($id);

        /* Get edit input and update it in admin page */
        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->update();
        
        return redirect('admin.admin-manage-doctor/')->with('status','Doctor data is updated');
    }


    /* Delete doctor in admin page */
    public function doctor_delete($id)
    {
        /* Find and delete doctor user in admin page */
        $users = DB::table('users')
        ->where('id', $id)
        ->delete();

        /* Find and delete doctor record in admin page */
        $doctors = DB::table('doctor_record')
        ->where('doctor_id', $id)
        ->delete();

        return redirect('admin.admin-manage-doctor/')->with('status','Doctor data is Deleted');

    }


    /* Display all patient in admin page */
    public function patient_list()
    {
        $patients = DB::table('patient_record')
        ->orderBy('patient_id','desc')
        ->get();

        return view('admin.admin-manage-patient')->with('patients',$patients);
    }


    /* Edit patient in admin page */
    public function patient_edit(Request $request, $id)
    {
        $patients = DB::table('patient_record')
        ->where('patient_id',$id)
        ->first();

        return view('admin.admin-modify-patient-information')->with('patients',$patients);
    }


    /* Update patient in admin page */
    public function patient_update(Request $request, $id)
    {
        /* Find patient in admin page */
        $patients = Patient::find($id);

        /* Validate edit input in admin page */
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

        /* Get edit input and update it in admin page */
        $patients->patient_name = $request->input('username');
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

        /* Find patient user record and update it in admin page */
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->update();

        return redirect('admin.admin-manage-patient')->with('status','Patient data is edited');

    }


    /* Delete patient in admin page */
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

        return redirect('admin.admin-manage-patient/')->with('status','Patient data is deleted');

    }


    /* Display all supplier in admin page */
    public function supplier_list()
    {
        $suppliers = DB::table('supplier_record')
        ->orderBy('supplier_id','desc')
        ->get();

        return view('admin.admin-manage-supplier')->with('suppliers',$suppliers);

    }   


    /* Accept supplier request in admin page */
    public function accept_status(Request $request, $id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->status = "Accepted";
        $suppliers->update();

        return redirect('admin.admin-manage-supplier')->with('status','The supplier data has been accepted');

    }


    /* Decline supplier request in admin page */
    public function decline_status(Request $request, $id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->status = "Declined";
        $suppliers->update();

        return redirect('admin.admin-manage-supplier')->with('status','The supplier data has been declined');

    }

    /* Supplier sent personal information at main page */
    public function supplier_create(Request $request)
    {
        $create_supplier = new Supplier;

        /* Validate input at main page */
        $validatedData = $request->validate([
        'supplier_name' => 'required|max:191',
        'supplier_phone' => 'required|max:191',
        'supplier_email' => 'required',
        'supplier_address' => 'required',
        'supplier_description' => 'required',
        ]);

        /* Get input at main page */
        $create_supplier->supplier_name = $request->input('supplier_name');
        $create_supplier->supplier_phone = $request->input('supplier_phone');
        $create_supplier->supplier_email = $request->input('supplier_email');
        $create_supplier->supplier_address = $request->input('supplier_address');
        $create_supplier->supplier_description = $request->input('supplier_description');
        $create_supplier->status = $request->input('status');
        $create_supplier->save();
        

        return redirect('/#request')->with('status','Your request is sent!');
    }


    /* Supplier see personal information status at main page */
    public function supplier_status()
    {
        $suppliers = DB::table('supplier_record')
        ->where('status','accepted')
        ->orderBy('created_at','desc')
        ->get();

        return view('welcome')->with('suppliers',$suppliers);

    }   

}
