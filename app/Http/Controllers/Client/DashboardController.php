<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    private function getParent(): User
    {
        /** @var User $user */
        $user = Auth::user();

        $treatmentPlan = $user->clientTreatmentPlan()->first();

        /** @var User $parent */
        $parent = User::query()->find(
            $treatmentPlan->parent_id
        );

        return $parent;
    }
    public function index(): View
    {
        $treatmentPlan = Auth::user()->clientTreatmentPlan()->first();

        return view('client.dashboard', [
            'questionnaires' => $treatmentPlan?->questionnaires()->get(),
            'currentUser' => Auth::user(),
            'schoolName' => Auth::user()->school()->first()?->school,
            "parent"=> $this->getParent(),
        ]);
    }
}
