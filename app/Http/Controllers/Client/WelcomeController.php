<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    public function index(int $step): View
    {
        if ($step < 1 || $step > 6) {
            dd('Step needs to be between 1 and 6.');
        }

        return view(
            sprintf('client.welcome.step%s', $step)
        );
    }
}