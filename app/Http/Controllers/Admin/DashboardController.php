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
    public function userlist()
    {
        $users = User::all();
        return view('admin.admin-user-list')->with('users',$users);
    }


    public function usercreate(Request $request)
    {
        $create_user = new User;
        
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'usertype' => 'required',
            'email' => 'required|max:191',
            'password' => 'required|min:8|max:191',
        ]);

        $create_user->name = $request->input('username');
        $create_user->phone = $request->input('phone');
        $create_user->usertype = $request->input('usertype');
        $create_user->email = $request->input('email');
        $create_user->password = Hash::make($request->input('password'));

        $user = Auth::user();
        $creator_id = $user->id;

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




    public function useredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.admin-modify-user-profile')->with('users',$users);
    }



    public function userupdate(Request $request, $id)
    {
        $users = User::find($id);
        
        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'usertype' => 'required',
            'email' => 'required|max:191',
            'password' => 'required|min:8|max:191',
        ]);
        
        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->usertype = $request->input('usertype');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));

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
                $patient->delete();
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
                $doctor->delete();
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
        

        return redirect('/admin.admin-user-list')->with('status','User data is updated');
    }



    public function userdelete($id)
    {
        $users = User::findOrFail($id);

        if($users->usertype == "doctor")
        {
            $doctor = Doctor::find($id);
            $doctor->delete();
        }
        else if($users->usertype == "patient")
        {
            $patient = Patient::find($id);
            $patient->delete();

            $advice = DB::table('advice_record')
            ->where('patient_id', $id)
            ->delete();
        }

        $users->delete();

        return redirect('/admin.admin-user-list')->with('status','User data is deleted');

    }



    public function doctorlist()
    {
        $doctors = Doctor::all();
        return view('admin.admin-manage-doctor')->with('doctors',$doctors);
    }



    public function doctoredit(Request $request, $id)
    {
        $doctors = Doctor::findOrFail($id);
        return view('admin.admin-modify-doctor-information')->with('doctors',$doctors);
    }



    public function doctorupdate(Request $request, $id)
    {
        $doctors = Doctor::find($id);

        $validatedData = $request->validate([
            'username' => 'required|max:191',
            'phone' => 'required|max:191',
            'email' => 'required|max:191',
            'address' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8|max:191',
        ]);

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
        
        return redirect('admin.admin-manage-doctor/')->with('status','Doctor data is updated');
    }



    public function doctordelete($id)
    {
        $users = DB::table('users')
        ->where('id', $id)
        ->delete();

        $doctors = DB::table('doctor_record')
        ->where('doctor_id', $id)
        ->delete();

        return redirect('admin.admin-manage-doctor/')->with('status','Doctor data is Deleted');

    }



    public function patientlist()
    {
        $patients = Patient::all();

        return view('admin.admin-manage-patient')->with('patients',$patients);
    }


    
    public function patientedit(Request $request, $id)
    {
        $patients = Patient::findOrFail($id);
        return view('admin.admin-modify-patient-information')->with('patients',$patients);
    }



    public function patientupdate(Request $request, $id)
    {
        $patients = Patient::find($id);

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

        $users = User::find($id);

        $users->name = $request->input('username');
        $users->phone = $request->input('phone');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));

        $users->update();

        return redirect('admin.admin-manage-patient')->with('status','Patient data is edited');

    }



    public function patientdelete($id)
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



    public function supplierlist()
    {
        $suppliers = DB::table('supplier_record')
        ->orderBy('supplier_id','desc')
        ->get();

        return view('admin.admin-manage-supplier')->with('suppliers',$suppliers);

    }   



    public function acceptstatus(Request $request, $id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->status = "Accept";
        $suppliers->update();

        return redirect('admin.admin-manage-supplier')->with('status','The supplier data has been accepted');

    }



    public function declinestatus(Request $request, $id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->status = "Decline";
        $suppliers->update();

        return redirect('admin.admin-manage-supplier')->with('status','The supplier data has been declined');

    }

    public function suppliercreate(Request $request)
    {
        $create_supplier = new Supplier;

        $validatedData = $request->validate([
        'supplier_name' => 'required|max:191',
        'supplier_phone' => 'required|max:191',
        'supplier_email' => 'required',
        'supplier_address' => 'required',
        'supplier_description' => 'required',
        ]);

        $create_supplier->supplier_name = $request->input('supplier_name');
        $create_supplier->supplier_phone = $request->input('supplier_phone');
        $create_supplier->supplier_email = $request->input('supplier_email');
        $create_supplier->supplier_address = $request->input('supplier_address');
        $create_supplier->supplier_description = $request->input('supplier_description');
        $create_supplier->save();
        

        return redirect('/supplier-create-personal-record')->with('status','New User is Added');
    }



    public function supplierstatus()
    {
        $suppliers = DB::table('supplier_record')
        ->orderBy('created_at','desc')
        ->get();

        return view('admin.supplier-create-personal-record')->with('suppliers',$suppliers);

    }   


}
