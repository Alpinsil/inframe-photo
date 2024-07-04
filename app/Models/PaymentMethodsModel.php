<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodsModel extends Model
{
  protected $table = 'payment_methods';
  protected $allowedFields = ['name', 'norek'];
}
