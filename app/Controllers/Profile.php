<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;

class Profile extends BaseController
{

  protected $users;
  public function __construct()
  {

    $this->users = new UserModel;
  }

  public function index()
  {
    if (session()->get('user_id') == null) {
      return redirect()->to(base_url('/'));
    }

    $id = session()->get('user_id');
    $data =
      [
        'title' => 'Profile Page',
        'user' => $this->users->find($id)
      ];
    return view('profile', $data);
  }

  private function form_data()
  {
    $name = $this->request->getPost('name');
    $nohp = $this->request->getPost('nohp');
    $alamat = $this->request->getPost('alamat');


    $rules =  [
      'name' => 'required|max_length[255]',
      'nohp' => 'required|numeric',
      'alamat' => 'required',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data =
      [
        'name' => $name,
        'nohp' => $nohp,
        'alamat' => $alamat,
      ];
    return $data;
  }

  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Failed to ' . $msg . ' Profile', 'danger']);
      return redirect()->to(base_url('/profile'));
    } else {
      session()->setFlashdata('message', ['Profile successfully ' . $msg, 'success']);
      return redirect()->to(base_url('/profile'));
    }
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('update', 'fail');
    }

    session()->set('user_name', $this->form_data()['name']);


    $this->users->update($id, $this->form_data());
    return $this->redirect_back('updated');
  }
}
