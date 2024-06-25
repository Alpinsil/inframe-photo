<?php

namespace App\Models;

use CodeIgniter\Model;

class SchedulesModel extends Model
{
  protected $table = 'schedules';
  protected $allowedFields = ['date', 'available'];
}
