<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(int $step): View
    {
        if ($step < 1 || $step > 6) {
            dd('Step needs to be between 1 and 6.');
        }

        if ($step === 6) {
            Auth::user()->update(['completed_onboarding' => true]);
        }

        return view(
            sprintf('client.welcome.step%s', $step)
        );
    }
}