<?php

namespace App\Http\Controllers\Contact;

use App\Http\Requests\Contact\ContactRequest;
use App\Models\Contact\ContactForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        //dd($request);

        $user_id=null;
        if (Auth::user()){
            $user_id=Auth::user()->id;
        }
        $contactForm = new ContactForm;

        $contactForm->user_id = $user_id;
        $contactForm->name = $request->name;
        $contactForm->surname = $request->surname;
        $contactForm->email = $request->email;
        $contactForm->phone = $request->phone;
        $contactForm->message = $request->message;
        $contactForm->save();

        if ($contactForm){
            return response()->json(['message' => 'Form tarafımıza ulaştı.'], 200);

        }else{
            return response()->json(['errors'=>['Kayıt alınamadı.']]);
        }
        }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
