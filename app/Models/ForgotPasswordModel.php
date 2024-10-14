<?php

namespace App\Models;

use CodeIgniter\Model;

class ForgotPasswordModel extends Model
{
  protected $table = 'forgot_password';
  protected $allowedFields = ['otp', 'email'];
}
