<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Branch;

class ClientBranchesController extends Controller
{
	public function __construct()
	{
		view()->share(['page_title' => 'Client Branches']);
	}
    public function getBranches($id)
    {
    	$client = Client::findOrFail($id);

    	return view('pages.superadmin.clients.branches', compact('client'));
    }

    public function create($client_id)
    {
    	$branches = Branch::where('client_id', null)->with(['client'])->get();
        
        $client = Client::findOrFail($client_id);

    	return view('pages.superadmin.clients.create-branch', compact('branches', 'client'));
    }
    public function store(Request $request)
    {
        // Validation
        $this->validation($request);
        // Create
        Branch::create($this->data($request->except(['status', 'client_id'])) + ['status' => true, 'client_id' => $request->client_id]);

        return redirect()->route('client.branches', $request['client_id'])->with('success', 'thank you');
    }
    public function updateClientBranch(Request $request)
    {
        $branches = Branch::whereIn('id', $request['branch_id'])->update(['client_id' => $request['client_id']]);

        return redirect()->route('client.branches', $request['client_id'])->with('success', 'thank you!');
    }

    protected function data(Array $data)
    {
        return [
            'branch_name' => $data['branch_name'],
            'branch_description' => $data['branch_description']
        ];
    }
    protected function validation(Request $request)
    {
        return $request->validate([

            'branch_name' => 'required',
            'branch_description' => 'required'
        ]);
    }
}
