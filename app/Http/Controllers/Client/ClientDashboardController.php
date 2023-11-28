<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\View\View;



class ClientDashboardController extends Controller
{   
    private $currentUser;
    private $questionairList;


    public getCurrentUser(){
    
        return $this-> currentUser;
    }
    public getQuestionaires():collection{
        return $this -> questionairList;
    }
    public index()
    {


        //vairable current_user
        //auth:user()


    }
}
