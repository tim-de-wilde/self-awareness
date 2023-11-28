<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\TreatmentPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\PseudoTypes\List_;

class QuestionnaireLookup extends Controller
{
    protected array $user;



    public function getQuestionaire():array {
       $this->getQuestionaireData();
       $local = [];
       foreach ($this->user['owned_questionnaires'] as $value){
           array_push($local,[$value['id'],$value['name']]);
       }
       return $local;


    }

    protected function getQuestionaireData(): void{

        $this->user = User::with('ownedQuestionnaires')->find(Auth::id())->toArray();
    }

    public function index(): View
    {
        $this->getQuestionaireData();
        return view();

    }
}
