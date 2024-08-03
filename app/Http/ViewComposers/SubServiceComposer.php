<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\SubService;

class SubServiceComposer
{
    public function compose(View $view)
    {
        $mainSubService = SubService::all();
        $view->with('mainSubService', $mainSubService);
    }
}
