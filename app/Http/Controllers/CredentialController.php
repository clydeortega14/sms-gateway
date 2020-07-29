<?php

namespace App\Http\Controllers;

use App\Credentials;
use App\SubscriptionType;
use App\User;
use App\Branch;
use Illuminate\Http\Request;
use Gate;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        view()->share([
                        'page_title'=>'Credentials'
                    ]);
    }


    public function index()
    {
        #AUTHORIZATION
        if(!Gate::allows('isSuperadmin') && !Gate::allows('isAdmin')){
            abort(404, "Sorry, You can't do this action");
        }

        $subscription = SubscriptionType::all();
        $clients = Branch::where('branch_id', 0)->get();
        return view('admin.credentials', compact('subscription','clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'subscriber'              =>  'required',
            'subscription'            =>  'required',
            'passphrase'              =>  'required',
            'app_id'                  =>  'required',
            'app_secret'              =>  'required',
            'text_rate'               =>  'required',
        ]);

        $credentials = new Credentials;

        $credentials->user_id      = $request->input('subscriber');
        $credentials->access_token = str_random(12);
        $credentials->status       = 1;
        $credentials->subscription = $request->input('subscription');
        $credentials->passphrase   = $request->input('passphrase');
        $credentials->app_id       = $request->input('app_id');
        $credentials->app_secret   = $request->input('app_secret');
        $credentials->text_rate    = $request->input('text_rate');
        $credentials->save();

        Branch::where('user_id', $credentials->user_id)->update(['credentials_id' => $credentials->id]);

        return back()->with('msg', 'Credentials Information Successfully save!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
