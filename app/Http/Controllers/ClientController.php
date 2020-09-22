<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        view()->share(['page_title' => 'Clients']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with(['branches'])->get();

        return view('pages.superadmin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.superadmin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate inputs
        $this->validateClient($request);

        //Create Client
        Client::create($request->except('status') + ['status' => true]);

        return redirect()->route('clients.create')->with('success', 'Success Created new client');

    }

    protected function clientData(Array $data)
    {
        return [

            'name' => $data['name'],
            'description' => $data['description'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'address' => $data['description']
        ];
    }

    protected function validateClient(Request $request)
    {
        return $request->validate([

            'name' => 'required',
            'email' => 'required|unique:clients',
            'contact_number' => 'required',
            'address' => 'required',
        ]);
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
        $client = Client::findOrFail($id);

        return view('pages.superadmin.clients.create', compact('client'));

        // return redirect()->route('clients.create')->with('client', $client);
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
        Client::where('id', $id)->update($this->clientData($request->toArray()));

        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function clientStatus($id)
    {
        $client = Client::findOrFail($id);

        $client->update(['status' => !$client->status]);

        return response()->json('success');
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

    public function addCredential($client_id)
    {
        $client = Client::findOrFail($client_id);

        return view('pages.credentials.add-credential', compact('client'));
    }
}
