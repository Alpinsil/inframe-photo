<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\DiscussionModel;
use App\Models\ForgotPasswordModel;

class ForgotPassword extends BaseController
{

  protected $userModel;
  protected $helpers = ['form'];
  protected $discussion;
  protected $forgotPasswordModel;

  public function __construct()
  {
    $this->discussion = new DiscussionModel;
    $this->userModel = new UserModel;
    $this->forgotPasswordModel = new ForgotPasswordModel;
  }

  public function index(): string
  {
    $input_fields = [['name', 'text'], ['email', 'email'], ['password', 'password'], ['password2', 'password'], ['phone', 'text'], ['alamat', 'text']];
    return view('auth/forgot-password', ['title' => 'Forgot Password', 'input_fields' => $input_fields]);
  }

  public function otp()
  {
    $email = strtolower($this->request->getPost('email'));
    $stringEmail = "$email";

    $findUser = $this->userModel->where('email', $stringEmail)->find();

    if ($findUser) {


      $email = service('email');
      $email->setTo($stringEmail);
      $email->setFrom('inframephoto@gmail.com', 'Kode OTP Untuk Lupa Password');

      $number = mt_rand(100000, 999999);

      $this->forgotPasswordModel->save(['otp' => $number, 'email' => $stringEmail]);
      $pesan  =
        '<html>
    <h3>Kode otp anda adalah: ' . $number . '</h3>    
      </html>';
      $email->setSubject('Kode OTP');
      $email->setMessage($pesan);


      if ($email->send()) {
        session()->setFlashdata('otp_send', 'Periksa kode otp di email anda');
        return redirect()->to('/forgot-password');
      }
    } else {
      session()->setFlashdata('failed', 'Email salah atau tidak terdaftar dalam database kami');
      return redirect()->to('/forgot-password');
    }
  }

  public function otp_check()
  {
    $password = $this->request->getPost('password');
    $otp = $this->request->getPost('otp');
    $password2 = $this->request->getPost('password2');

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $rules =  [
      'otp'     => 'required|max_length[30]',
      'password'     => 'required|max_length[255]',
      'password2'     => [
        'rules' => 'required|max_length[255]|matches[password]',
        'errors' => [
          'required' => 'Confirm password field is required',
          'matches' => 'Confirm Password not matches',
        ]
      ],
    ];

    if (!$this->validate($rules)) {
      session()->setFlashdata('otp_send', 'Periksa kode otp di email anda');
      return redirect()->to(base_url('/forgot-password'))->withInput();
    }

    $forgot_password_find = $this->forgotPasswordModel->where('otp', $otp)->find();

    $user_id = $this->userModel->where('email', $forgot_password_find[0]['email'])->find();

    $id = $user_id[0]['id'];

    $data = ['password' => $password_hash];

    if (!$forgot_password_find) {
      session()->setFlashdata('otp_wrong', 'Kode Otp Salah');
      return redirect()->to(base_url('/forgot-password'))->withInput();
    }

    $this->userModel->update($id, $data);

    session()->setFlashdata('account_created', 'Password berhasil diubah');

    return redirect()->to(base_url('/login'));
  }
}
