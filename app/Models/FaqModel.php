<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
  protected $table = 'faq';
  protected $allowedFields = ['question', 'answer'];
}
