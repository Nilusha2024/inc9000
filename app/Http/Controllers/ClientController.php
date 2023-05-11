<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('client_create');
        //
        $clientdetals = Client::with([])->paginate(25);
        return view('client_create')->with(['clientdetals' => $clientdetals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function create()
    {
        // return view('client.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
 
        $request->validate([            
            'first_name' => 'required|string|max:255', 
            'last_name' => 'required|string|max:255',
            'email' => 'email|unique:users,email',
            'phone_1' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'phone_2' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required'
        ]);

        $messages = [
            'phone_1.regex' => 'The phone number format is invalid.',
            'phone_1.min' => 'The phone number must be at least 10 digits.'
        ];
        
       
        Client::create($input);
        return redirect('client')->with('flash_message', 'Member Added!'); 
    } 

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function clientedit(Client $client, $id)
    {
        $client = Client::where('id', $id )->firstOrfail();     
        return view('client_edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function clientupdate(Request $request, Client $client)
    {
        $client = Client::find($request->input('id'));
        $input = $request->all();
        $request->validate([
            'first_name' => 'required|string|max:255', 
            'last_name' => 'required|string|max:255',
            'email' => 'email|unique:users,email',
            'phone_1' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'phone_2' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required'
        ]);
        DB::table('client')
        ->where('id', $request->id)
        ->update([          
            'first_name' => $request->first_name , 
            'last_name' => $request->last_name ,
            'email' => $request->email ,
            'phone_1' => $request->phone_1 ,
            'phone_2' => $request->phone_2 ,
            'address' => $request->address ,
        ]);
        

       
    return back()->with('success', 'Successfully Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Client::find($request->input('id'))->delete();
        return back()->with('success','Successfully deleted client !');
    }
}
