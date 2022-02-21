<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LeadController extends Controller {





    public function index() {

        return view( 'lead.index', [ 'leads' => Lead::all() ] );
    }





    public function create() {

        return view( 'lead.create' );
    }





    public function store( Request $request ) {

        $data = $request->validate( [
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'zip'     => 'nullable|integer',
            'city'    => 'nullable|string|max:255',
            'url'     => 'nullable|url',
            'email'   => 'nullable|email',
        ]);

        $data['user_id'] = Auth::id();

        Lead::create($data);

        return redirect(route('lead.index'));
    }


    public function edit(Lead $lead){
        return view('lead.edit', ['lead' => $lead ]);
    }

    public function update( Lead $lead, Request $request) {

        $lead->update($request->validate( [
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'zip'     => 'nullable|integer',
            'city'    => 'nullable|string|max:255',
            'url'     => 'nullable|url',
            'email'   => 'nullable|email',
        ]));

        return redirect(route('lead.index'));
    }
}
