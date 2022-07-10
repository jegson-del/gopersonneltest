<?php

namespace App\Http\Controllers;

use App\Actions\StoreContactAction;
use App\Http\Requests\ContactsRequest;
use App\Models\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Throwable;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('welcome');
    }

    /**
     * function to fetch data .
     *
     */
    public function fetchcontact()
    {
        $contacts = Contact::orderBy('id','ASC')->paginate(10);

        return response()->json([
           'contacts' => $contacts,
        ]);
    }

    /**
     * function to search data with all database column field.
     *
     */
    public function search(Request $request)
    {
       $output = "";

       $contacts = Contact::where('first_name', 'Like', '%'.$request->search.'%')
           ->orWhere('telephone', 'Like', '%'.$request->search.'%')
           ->orWhere('email', 'Like', '%'.$request->search.'%')
       ->orWhere('last_name', 'Like', '%'.$request->search.'%')->get();

//     looping search result

       foreach ($contacts as $contact)
       {

           $output.='<tr>'.
               '<td>'.$contact->id.'</td>'.
               '<td>'.$contact->first_name.'</td>'.
               '<td>'.$contact->last_name.'</td>'.
               '<td>'.$contact->email.'</td>'.
               '<td>'.$contact->telephone.'</td>'.
               '</tr>';
            }
           return response()->json($output);

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
     * storing data using action class .
     *
     * @return string
     */
    public function store(ContactsRequest $request, StoreContactAction $action)
    {

        try {
            $contact = $action->handle($request);
            return \response()->json($contact, 200, [
                'data'  => 'contact',
                'message' => 'contact added successfully'
            ]);

        }catch (Throwable $e)
        {
            report($e);
            return response()->json(false,400, ['message' => $e->getMessage() ]);
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
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
        //
    }
}
