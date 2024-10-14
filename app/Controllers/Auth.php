<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\DiscussionModel;

class Auth extends BaseController
{

  protected $userModel;
  protected $helpers = ['form'];
  protected $discussion;

  public function __construct()
  {
    $this->discussion = new DiscussionModel;
    $this->userModel = new UserModel;
  }

  public function register(): string
  {
    $input_fields = [['name', 'text'], ['email', 'email'], ['password', 'password'], ['password2', 'password'], ['phone', 'text'], ['alamat', 'text']];
    return view('auth/register', ['title' => 'Register Form', 'input_fields' => $input_fields]);
  }

  public function login(): string
  {
    $input_fields = [['name/email', 'text'], ['password', 'password']];
    return view('auth/login', ['title' => 'Login Form', 'input_fields' => $input_fields]);
  }


  private function req($name)
  {
    $req = $this->request->getPost($name);
    return $req;
  }


  public function proses_register()
  {
    helper('date');
    $name = strtolower($this->req("name"));
    $email = strtolower($this->req("email"));
    $password = $this->req("password");
    $phone = join("", explode('-', $this->req("phone")));
    $alamat = $this->req("alamat");

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $rules =  [
      'name'     => 'required|max_length[30]',
      'email'        => ['rules' => 'required|max_length[254]|valid_email|is_unique[users.email]', 'errors' => [
        'is_unique' => 'email already exist'
      ]],
      'password'     => 'required|max_length[255]',
      'password2'     => [
        'rules' => 'required|max_length[255]|matches[password]',
        'errors' => [
          'required' => 'Confirm password field is required',
          'matches' => 'Confirm Password not matches',
        ]
      ],
      'phone' => 'required|max_length[255]',
      'alamat' => 'required|max_length[255]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->to(base_url('/register'))->withInput();
    }

    $currentDateTime = now();
    // dd($currentDateTime);
    $this->userModel->save([
      'name' => $name,
      'email' => $email,
      'role' => 'guest',
      'password' => $password_hash,
      'nohp' => $phone,
      'alamat' => $alamat,
      // 'created_at' => $currentDateTime,
    ]);

    $data = $this->userModel->where('email', $email)->find();

    $this->discussion->save(['user_id' => $data[0]['id'], 'title' => 'ada yang bisa saya bantu?']);

    session()->setFlashdata('account_created', 'Account successfully created');

    return redirect()->to(base_url('/login'));
  }

  public function proses_login()
  {

    $nameOrEmail = $this->req("name/email");
    $password = $this->req("password");

    $rules =  [
      'name/email'     => 'required|max_length[30]',
      'password'     => 'required|max_length[255]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->to(base_url('/login'))->withInput();
    }

    $getData = $this->userModel->search($nameOrEmail);


    // validation

    if ($getData && password_verify($password, $getData['password'])) {
      // if ($getData && $password == $getData['password']) {
      session()->set('role', $getData['role']);
      session()->set('user_id', $getData['id']);
      session()->set('user_name', $getData['name']);
      return redirect()->to('/kelola-admin');
    } else {
      session()->setFlashdata('login_failed', 'password or email wrong');
      return redirect()->to('/login')->withInput();
    }
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url('/'));
  }
}
