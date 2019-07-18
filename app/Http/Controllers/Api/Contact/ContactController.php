<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Contact\ContactStoreRequest;
use App\Models\Contact\ContactForm;
use Auth;

class ContactController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        if(Auth::user()){
            $userId=Auth::user()->id;
        }else{
            $userId=null;
        }
        $contact = new ContactForm;
        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->user_id = $userId;
        $contact->save();
    }
}
