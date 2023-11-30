<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use function Webmozart\Assert\Tests\StaticAnalysis\string;

class DashboardController extends Controller
{

    private function getPatent()
    {
        $parent_id= Auth::user()->parent()->first()->toArray()['parent_id'];
        $parent= User::where('id',$parent_id)->first(['name','last_name']);
        return ($parent['name']. " " . $parent["last_name"]);

    }
    public function index(): View
    {

        $treatmentPlan = Auth::user()->clientTreatmentPlans()->first();

        return view('client.dashboard', [
            'questionnaires' => $treatmentPlan?->questionnaires()->get(),
            'currentUser' => Auth::user(),
            'school' => Auth::user()->school()->first('school')['school'],
            "parent"=> $this->getPatent()
        ]);
    }
}
