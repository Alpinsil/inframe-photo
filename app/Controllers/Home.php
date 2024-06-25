<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\SchedulesModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        $schedules = new SchedulesModel;
        $dates = $schedules->findAll();
        $date_array = [];
        foreach ($dates as $key) {
            if ($key['available'] == 'no') {
                array_push($date_array, $key['date']);
            }
        }
        $faq = new FaqModel;
        $data = ['date' => $date_array, 'faq' => $faq->findAll(5)];
        return view('home', $data);
    }

    public function test()
    {
        $userModel = new UserModel;
        return view('auth/register', ['title' => 'Register']);
    }
}
