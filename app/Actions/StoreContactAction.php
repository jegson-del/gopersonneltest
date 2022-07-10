<?php


namespace App\Actions;


use App\Http\Requests\ContactsRequest;
use App\Models\Contact;

class StoreContactAction
{
    public function handle(ContactsRequest $request):Contact
    {
        /**
         * Extracted the create enquiries to action class.
         */
        $data = $request->all();
        $contact = new Contact($data);
        $contact->save();
        /**
         * returning model instance.
         */
        return $contact;
    }
}
