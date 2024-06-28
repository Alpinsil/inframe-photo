<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsModel extends Model
{
  protected $table = 'tags';
  protected $allowedFields = ['slug', 'name'];
}
