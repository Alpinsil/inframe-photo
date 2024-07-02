<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use DateTime;
use App\Models\UserModel;

class Payment extends BaseController
{
  protected $service;
  protected $user;

  public function __construct()
  {
    $this->service = new ServiceModel;
    $this->user = new UserModel;
  }

  public function index($id)
  {
    $user_id = session()->get('user_id');
    if ($user_id == null) {
      return redirect()->to(base_url('/'));
    }

    // data
    $service_data = $this->service->find($id);
    $user_data = $this->user->find($user_id);


    $data =
      [
        'service_data' => $service_data,
        'user_data' => $user_data,
        'title' => 'Payment Page',
      ];

    return view('payment', $data);
  }
}
