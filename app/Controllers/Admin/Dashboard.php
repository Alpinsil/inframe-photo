<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;


class Dashboard extends BaseController
{
  public function index()
  {
    if (session()->get('role') == null) {
      return redirect()->to(base_url('/'));
    }
    $data = ['title' => 'Dashboard Page'];
    return view('admin/dashboard', $data);
    dd(uri_string());
  }
}
