<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqModel;

class Faq extends BaseController
{
  protected $faq;
  public function __construct()
  {
    $this->faq = new FaqModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }

    $btn_link = false;
    $modal_title = [
      'tambah' => 'Tambah FAQ',
      'edit' => 'ubah FAQ',
      'delete' => 'hapus FAQ',
    ];
    $delete_msg = 'Apakah kamu yakin ingin menghapus FAQ ?';
    $modal_field = [
      [
        'name' => 'question',
        'title' => 'pertanyaan'
      ],
      ['name' => 'answer', 'title' => 'jawaban']
    ];
    $cols = ['pertanyaan', 'jawaban'];
    $rows = ['question', 'answer'];
    $dataTables = $this->faq->findAll();
    $data = [
      'title' => 'FAQ Page',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
    ];
    return view('admin/faq', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Gagal untuk ' . $msg . ' FAQ', 'danger']);
      return redirect()->to(base_url('/faq-admin'));
    } else {
      session()->setFlashdata('message', ['FAQ berhasil ' . $msg, 'success']);
      return redirect()->to(base_url('/faq-admin'));
    }
  }

  private function form_data()
  {
    $question = $this->request->getPost('question');
    $answer = $this->request->getPost('answer');

    $rules =  [
      'question' => 'required|max_length[255]',
      'answer' => 'required',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['question' => $question, 'answer' => $answer];
    return $data;
  }

  public function create()
  {
    if (!$this->form_data()) {
      return $this->redirect_back('membuat', 'fail');
    }
    $this->faq->save($this->form_data());
    return $this->redirect_back('membuat');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('diubah', 'fail');
    }
    $this->faq->update($id, $this->form_data());
    return $this->redirect_back('diubah');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->faq->where('id', $id)->delete();
    return $this->redirect_back('dihapus');
  }
}
