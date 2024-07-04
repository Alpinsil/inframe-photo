<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\PortfolioModel;
use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\TagsModel;

class Home extends BaseController
{
    public function index(): string
    {
        // $schedules = new SchedulesModel;
        $services = new ServiceModel;
        $tags = new TagsModel;
        $portfolio = new PortfolioModel;
        // $dates = $schedules->findAll();
        // $date_array = [];
        // foreach ($dates as $key) {
        //     if ($key['available'] == 'no') {
        //         array_push($date_array, $key['date']);
        //     }
        // }
        $faq = new FaqModel;
        $data =
            [
                // 'date' => $date_array,
                'faq' => $faq->findAll(5),
                'services' => $services->findAll(5),
                'tags' => $tags->findAll(),
                'portfolio' => $portfolio->joinTags($portfolio),
            ];
        return view('home', $data);
    }

    public function test()
    {
        $userModel = new UserModel;
        return view('auth/register', ['title' => 'Register']);
    }
}
