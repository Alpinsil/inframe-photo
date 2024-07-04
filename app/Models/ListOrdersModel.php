<?php

namespace App\Models;

use CodeIgniter\Model;

class ListOrdersModel extends Model
{
  protected $table = 'list_orders';
  protected $allowedFields = ['user_id', 'service_id', 'payment_method_id', 'status', 'status_pembayaran', 'image', 'date', 'available'];

  public function joinAll($a, $b)
  {
    return $this->db->query('SELECT a.*,b.email, c.name as service_name, c.price,d.name as payment_method FROM `list_orders` a JOIN users b ON a.user_id=b.id JOIN services c ON a.service_id=c.id JOIN payment_methods d ON a.payment_method_id=d.id WHERE status' . $a . "'$b'")->getResultArray();
  }
}
