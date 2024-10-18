<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TagsModel;

class Tags extends BaseController
{
  protected $tags;
  public function __construct()
  {
    $this->tags = new TagsModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }

    $btn_link = false;
    $modal_title = [
      'tambah' => 'Tambah tags',
      'edit' => 'Ubah tags',
      'delete' => 'Hapus tags',
    ];
    $delete_msg = 'Apakah kamu yakin ingin menghapus tag ini ?';
    $modal_field = [
      [
        'name' => 'slug',
      ],
      ['name' => 'name', 'title' => 'nama']
    ];
    $cols = ['slug', 'nama'];
    $rows = ['slug', 'name'];
    $dataTables = $this->tags->findAll();
    $data = [
      'title' => 'Tags Page',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
    ];
    return view('admin/tags', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Gagal untuk ' . $msg . ' tag', 'danger']);
      return redirect()->to(base_url('/tags-admin'));
    } else {
      session()->setFlashdata('message', ['tag berhasil ' . $msg, 'success']);
      return redirect()->to(base_url('/tags-admin'));
    }
  }

  private function form_data()
  {
    $slug = $this->request->getPost('slug');
    $name = $this->request->getPost('name');

    $rules =  [
      'slug' => 'required|max_length[255]',
      'name' => 'required',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['slug' => $slug, 'name' => $name];
    return $data;
  }

  public function create()
  {
    if (!$this->form_data()) {
      return $this->redirect_back('membuat', 'fail');
    }
    $this->tags->save($this->form_data());
    return $this->redirect_back('membuat');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('diubah', 'fail');
    }
    $this->tags->update($id, $this->form_data());
    return $this->redirect_back('diubah');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->tags->where('id', $id)->delete();
    return $this->redirect_back('dihapus');
  }
}
