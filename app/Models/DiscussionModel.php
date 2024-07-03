<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscussionModel extends Model
{
  protected $table = 'discussion';
  protected $allowedFields = ['user_id', 'title'];

  public function joinUsers($query)
  {
    return $query->join('users', 'discussion.user_id=users.id')->select('title, discussion.id, users.name as user_id')->findAll();
  }
}
