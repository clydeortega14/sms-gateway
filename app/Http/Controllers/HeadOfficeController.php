<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use App\RoleUser;
use App\Credentials;
use App\Informations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Gate;
use DB;

class HeadOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        view()->share([
                        'page_title'=>'Users'
                    ]);
    }

    public function index()
    {
        #AUTHORIZATION
        if(!Gate::allows('isSuperadmin') && !Gate::allows('isAdmin')){
            abort(404, "Sorry, You can't do this action");
        }

        $user = User::all();
        $branch = Branch::all();
        $credentials = Credentials::all();
        return view('admin.head_office', compact('user', 'branch', 'credentials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function head_office_information()
    {
        if(auth()->user()->information_id != null){
            if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')){
                return redirect('/dashboard');
            }elseif(auth()->user()->hasRole('head_office') || auth()->user()->hasRole('branch')){
                return redirect('/head-office-dashboard');
            }
        }

        $branches = Branch::where('user_id', auth()->user()->id)->get();

        return view('headoffice.company-information',['branches' => $branches]);
    }
    public function post_head_office_information(Request $request)
    {

            // MAIN || HEAD OFFICE
            if(auth()->user()->hasRole('head_office')){
                //VALIDATION
                $this->validate($request,[

                    'company_name'    =>    'required',
                    'company_address' =>    'required',
                    'zip_code'        =>    'required'
                ]);

                 #save data in informations table
                $informations = new Informations;
                $informations->branch_id = $request->input('branch_id');
                $informations->company = $request->input('company_name');
                $informations->address = $request->input('company_address');
                $informations->zip_code = $request->input('zip_code');
                $informations->save();

                #update information_id in users table
                User::where('id', auth()->user()->id)->update(['information_id' => $informations->id]);

            }//BRANCH
            elseif(auth()->user()->hasRole('branch')){
                //VALIDATION
                $this->validate($request,[

                    'branch_name'    =>    'required',
                    'branch_address' =>    'required',
                    'zip_code'       =>    'required'
                ]);

                 #save data in informations table
                $informations = new Informations;
                $informations->branch_id = $request->input('branch_id');
                $informations->company = $request->input('branch_name');
                $informations->address = $request->input('branch_address');
                $informations->zip_code = $request->input('zip_code');
                $informations->save();

                #update information_id in users table
                User::where('id', auth()->user()->id)->update(['information_id' => $informations->id]);
            }


            return redirect('/head-office-dashboard');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        #VALIDATION
        $this->validate($request,[

            'username'      => 'required',
            'coop_name'          => 'required',
            'email'         => 'required|unique:users,email|email',
            'password'      => 'required',
        ]);

        $user = new User;
        $user->status_id        = 1;
        $user->name             = $request->input('coop_name');
        $user->username         = $request->input('username');
        $user->email            = $request->input('email');
        $user->password         = Hash::make($request->input('password'));
        $user->save();

        $branch = new Branch;
        $branch->user_id        = $user->id;
        $branch->branch_id      = 0;
        $branch->branch_name    = 'Head Office';
        $branch->save();

        $role = RoleUser::create(['user_id'=>$user->id,'role_id'=> 3]);
        return back()->with('message','Clients Account created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        #AUTHORIZATION
        if(!Gate::allows('isSuperadmin') && !Gate::allows('isAdmin')){
            abort(404, "Sorry, You can't do this action");
        }

        $credentials = Credentials::all();
        return view('admin.credentials_info', compact('credentials'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_head_office_information()
    {
        $users = User::find(auth()->user()->id);
       $branch = DB::table('branches')
        ->join('users', 'users.id', '=', 'branches.user_id')->get();


        return view('headoffice.edit-user-information',['users' => $users], ['branch'=>$branch]);
    }
    public function update_head_office_information(Request $request)
    {
        #MATCHING PASSWORD

         #VALIDATION
        $validation = $request->validate([

            'new_password' => 'min:6|confirmed',
        ]);

        #UPDATE IF THERE'S NO ERROR
        $users = User::find(auth()->user()->id);

        $users->username               = $request->input('username');
        $users->name                   = $request->input('user_fullname');
        $users->email                  = $request->input('user_email');
        $users->save();

        #USER PASSWORD
        if(empty($request->input('password'))){

            $users->password = auth()->user()->password;
            $users->save();
        }else{
            $users->password               = Hash::make($request->input('password'));
            $users->save();
        }


        #COMPANY INFORMATION
        $users->informations->company  = $request->input('user_company');
        $users->informations->address  = $request->input('user_address');
        $users->informations->zip_code = $request->input('user_zipcode');
        $users->informations->save();

        return redirect('/view-user-profile');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $txt = [];

        $data = [];
        $data['status'] =  $request->get('status')==1 ? 2 : 1;
        $data['cli_id'] =  $request->get('cli_id');
        $access = Credentials::where('id', $data['cli_id'])->first();


        $state = Credentials::where('id', $access->id)->update(array('status'=>$data['status']));
        if($state) {
            if($data['status'] == 1) {
                $txt['label'] = "<label class='label label-success'>Active</label>";
                $txt['status_id'] = 1;
            }else  {
                $txt['label'] = "<label class='label label-danger'>Inactive</label>";
                $txt['status_id'] = 2;
            }
        }
        return $txt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
