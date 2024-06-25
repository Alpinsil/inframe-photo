<?php

namespace App\Controllers\Admin;

use App\Models\SchedulesModel;
use App\Controllers\BaseController;

class ListOrder extends BaseController
{
  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }
    $schedules = new SchedulesModel;
    $dates = $schedules->findAll();
    $date_array = [];
    foreach ($dates as $key) {
      if ($key['available'] == 'no') {
        array_push($date_array, $key['date']);
      }
    }
    $data = ['title' => 'List Order Page', 'date' => $date_array];
    return view('admin/list-order', $data);
    dd(uri_string());
  }
}
