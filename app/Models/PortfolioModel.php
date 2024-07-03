<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
  protected $table = 'portfolio';
  protected $allowedFields = ['name', 'image', 'tag_id'];

  public function joinTags($query)
  {
    return $query->select('portfolio.id, portfolio.name as name, portfolio.image as image, tags.name as tag_id, tags.slug as slug')->join('tags', 'portfolio.tag_id=tags.id')->findAll();
  }
}
