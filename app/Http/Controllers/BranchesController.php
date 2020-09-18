<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Credentials;
use App\User;
use App\RoleUser;
use App\Role;
use App\Informations;
use Illuminate\Support\Facades\Hash;
use Gate;

class BranchesController extends Controller
{
      public function __construct()
    {
        view()->share([
                        'page_title'=>'Branches'
                    ]);
    }


    public function get_branch()
    {
        #AUTHORIZATION
        if(!Gate::allows('isHeadOffice')){
            abort(404, "Sorry, You can't do this action");
        }

        $users = User::find(auth()->user());

        foreach($users as $user){
            $branch = Branch::where('user_id', $user->id)->get();

            foreach($branch as $br){
                $br->credentials_id;
            }
        }
        $cre_id = $br->credentials_id;

        return view('branch.branch-access', compact('cre_id'));
    }
    public function post_branch_access(Request $request)
    {
        #validation
        $request->validate([

            'branch_username' => 'required|unique:users,username',
            'branch_password' => 'required',
            'branch_email'     => 'required|email|unique:users,email',
            'branch_name'     => 'required',
            'branch_code'     => 'required|numeric'
        ]);

        #user credential
        $users = new User;
        $users->status_id = 1;
        $users->username = $request->input('branch_username');
        $users->name = $request->input('name');
        $users->email = $request->input('branch_email');
        $users->password =  Hash::make($request->input('branch_password'));
        $users->save();

        #branch detail
        $branches = new Branch;
        $branches->user_id = $users->id;
        $branches->credentials_id = $request->input('credentials_id');
        $branches->branch_id = $request->input('branch_code');
        $branches->branch_name = $request->input('branch_name');
        $branches->save();

        $informations = new Informations;

        #user role
        $role = RoleUser::create(['user_id'=>$users->id,'role_id'=> 4]);

        return redirect('/branch-details')->with('message', 'you have added new branch');

    }
    public function get_branch_details()
    {
        #AUTHORIZATION
        if(!Gate::allows('isHeadOffice')){
            abort(404, "Sorry, You can't do this action");
        }

        $users = auth()->user();
        $branches = Branch::all()->where('user_id', $users->id)->first();
        $credential = Credentials::where('id',$branches->credentials_id)->get();
        if($credential)
        {
             $getid = Credentials::all()->where('id', $branches->credentials_id);
            foreach($getid as $id)
            {
                $branchID = Branch::where('credentials_id', $id->id)->get();

                return view('branch.branch-details', ['branchID' => $branchID]);
            }
        }
        return view('branch.branch-details', ['branches' => $branches]);
    }


    public function update($id){

        $branch = Branch::findOrFail($id);

        $branch->update(['status' => !$branch->status]);

        return response()->json(['status' => 'success', 'message' => 'Success!'], 200);
    }
}
