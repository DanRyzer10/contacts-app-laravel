<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = auth()->user()->contacts()->orderBy("name","asc")->paginate(6);
        return view("contacts.index",compact("contacts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("contacts.create");
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $data=$request->validated();
        if($request->hasFile("profile_picture")){
            $path=$request->file('profile_picture')->store("profiles",'public');
            $data['profile_picture']=$path;
        }

       
       
        // $data['user_id'] = auth()->id();
        // Contact::create($data);
        $contact=auth()->user()->contacts()->create($data);
        //session()->flash('alert',["message"=>"contact  $contact->name created successfully","type"=>"success"]);
        //Contact::create($request->all());
        return redirect()->route("home")->with("alert",["message"=>"contact  $contact->name created successfully","type"=>"success"]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
       $this->authorize("view",$contact);
        return view("contacts.show",compact("contact"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $this->authorize("edit",$contact);
        return view("contacts.edit",compact("contact"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContactRequest $request, Contact $contact)
    {
        $this->authorize("edit",$contact);
        $contact->update($request->validated());
        return redirect()->route("home")->with("alert",["message"=>"contact  $contact->name updated successfully","type"=>"success"]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize("delete",$contact);

        $contact->delete();
        return redirect()->route("home")->with("alert",["message"=>"contact  $contact->name deleted successfully","type"=>"success"]);
        
    }
}
