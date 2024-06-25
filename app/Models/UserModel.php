<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';
  protected $allowedFields = ['name', 'role', 'created_at', 'email', 'password', 'phone', 'alamat'];


  public function search($searches)
  {
    $userModel = new UserModel;
    $search = strtolower($searches);
    return $userModel->where('name', $search)->orWhere('email', $search)->first();
  }
}
