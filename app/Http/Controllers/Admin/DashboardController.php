<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Doctor;
use App\Patient;
use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

            $create_patient->save();
        }
        else
        {
            $create_user->save();
        }

        return redirect('/admin.admin-user-list')->with('status','New User is Added');
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
        

        return redirect('/admin.admin-user-list')->with('status','Your Data is Updated');
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
        }

        $users->delete();

        return redirect('/admin.admin-user-list')->with('status','Your Data is Deleted');

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

}
