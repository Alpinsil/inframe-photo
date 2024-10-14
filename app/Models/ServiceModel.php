<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
  protected $table = 'services';
  protected $allowedFields = ['name', 'price', 'list_service', 'image'];
}
