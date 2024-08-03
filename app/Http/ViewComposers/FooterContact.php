<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Contact;

class FooterContact
{
    public function compose(View $view)
    {
        $footerContact = Contact::all();
        $view->with('footerContact', $footerContact);
    }
}
