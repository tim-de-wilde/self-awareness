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
        $colors = ['red', 'orange', 'green'];
        $questionnaireColorGroup = [];

        foreach ($treatmentPlan?->questionnaires()->get() ?? [] as $key => $questionnaire) {
            $questionnaireColorGroup[] = [
                'questionnaire' => $questionnaire,
                'color' => $colors[$key % 3],
            ];
        }

        return view('client.dashboard', [
            'questionnaireColorGroup' => $questionnaireColorGroup,
            'currentUser' => Auth::user(),
            "parent"=> $this->getParent(),
        ]);
    }
}
