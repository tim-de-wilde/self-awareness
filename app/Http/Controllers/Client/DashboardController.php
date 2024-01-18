<?php

namespace App\Http\Controllers\Client;

use App\Enums\Sticker;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
    public function index(): View | RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->hasCompletedOnboarding()) {
            return redirect()->route('client.welcome', ['step' => 1]);
        }

        $treatmentPlan = Auth::user()->clientTreatmentPlan()->first();
        $colors = ['red', 'orange', 'green'];
        $stickers = Sticker::cases();
        $dataGroup = [];

        foreach ($treatmentPlan?->questionnaires()->get() ?? [] as $key => $questionnaire) {
            $dataGroup[] = [
                'questionnaire' => $questionnaire,
                'color' => $colors[$key % count($colors)],
                'sticker' => $stickers[$key % count($stickers)],
            ];
        }

        return view('client.dashboard', [
            'dataGroup' => $dataGroup,
            'treatmentPlan' => $treatmentPlan,
            'currentUser' => Auth::user(),
            'parent' => $this->getParent(),
        ]);
    }
}
