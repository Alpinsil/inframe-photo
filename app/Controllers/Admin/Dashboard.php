<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class Dashboard extends BaseController
{
  public function index()
  {
    if (session()->get('role') != 'admin') {
      return redirect()->to(base_url('/'));
    }

    return redirect()->to(base_url('/list-order'));

    $data = ['title' => 'Dashboard Page'];
    return view('admin/dashboard', $data);
    dd(uri_string());
  }
}
