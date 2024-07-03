<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
  protected $table = 'chat_discussion';
  protected $allowedFields = ['user_id', 'discussion_id', 'chat'];
}
