<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortfolioModel;
use App\Models\TagsModel;

helper('filesystem');
class Portfolio extends BaseController
{
  protected $portfolio;
  protected $tags;

  public function __construct()
  {
    $this->portfolio = new PortfolioModel;
    // $this->tags = $this->portfolio->join('tags', 'portfolio.tag_id=tags.id')->findAll();
    $this->tags = new TagsModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }



    $btn_link = false;
    $modal_title =
      [
        'tambah' => 'Tambah portfolio',
        'edit' => 'Edit portfolio',
        'delete' => 'Delete portfolio',
      ];
    $delete_msg = 'Are You sure Want To Delete This portfolio ?';
    $modal_field =
      [
        [
          'name' => 'name',
        ],
        ['name' => 'tag_id', 'type' => 'select', 'options' => $this->tags->findAll()],
        ['name' => 'image', 'type' => 'file']
      ];
    $cols = ['name', 'tag', 'image'];
    $rows = ['name', 'tag_id', ['image', 'image']];
    $dataTables = $this->portfolio->joinTags();
    $data = [
      'title' => 'Portfolio Page',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
    ];
    return view('admin/portfolio', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Failed to ' . $msg . ' portfolio', 'danger']);
      return redirect()->to(base_url('/portfolio-admin'));
    } else {
      session()->setFlashdata('message', ['portfolio successfully ' . $msg, 'success']);
      return redirect()->to(base_url('/portfolio-admin'));
    }
  }

  private function form_data($type)
  {
    $name = $this->request->getPost('name');
    $tag_id = $this->request->getPost('tag_id');
    $image = $this->request->getFile('image');
    $imageName = $image->getRandomName();

    $rules =  [
      'name' => 'required|max_length[255]',
      'tag_id' => 'required',
      'image' => 'is_image[image]',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['name' => $name, 'tag_id' => $tag_id, 'image' => $imageName];

    if ($image->move('assets/portfolio', $imageName)) {
      if ($type === 'create') {
        $this->portfolio->save($data);
        return $data;
      } else {
        // $data = $this->portfolio->find($type);
        $path = $this->request->getPost('path');
        $path = 'assets/portfolio/' . $path;
        // $path = 'assets/portfolio/' . $data['image'];
        unlink($path);
        $this->portfolio->update($type, $data);
        return $data;
      }
    };
  }

  public function create()
  {
    if (!$this->form_data('create')) {
      return $this->redirect_back('create', 'fail');
    }
    return $this->redirect_back('created');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data($id)) {
      return $this->redirect_back('update', 'fail');
    }

    return $this->redirect_back('updated');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $path = $this->request->getPost('path');
    unlink($path);
    $this->portfolio->where('id', $id)->delete();
    return $this->redirect_back('deleted' . $id);
  }
}
