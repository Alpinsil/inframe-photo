<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ListOrdersModel;

class Riwayat extends BaseController
{
  protected $listOrders;
  public function __construct()
  {
    $this->listOrders = new ListOrdersModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }

    $btn_link = false;
    $modal_title = [
      // 'tambah' => 'Tambah listOrders',
      // 'edit' => 'Edit listOrders',
      // 'delete' => 'Delete listOrders',
    ];
    $delete_msg = 'Are You sure Want To Delete This Order ?';
    $modal_field = [
      [
        'name' => 'user_id',
      ],
    ];

    $cols = ['email', 'payment method', 'date', 'riwayat', 'price'];
    $rows = ['email', 'payment_method', 'date', 'service_name', 'price'];
    $dataTables = $this->listOrders->joinAll('=', 'selesai');
    // dd($dataTables);
    $data = [
      'title' => 'Riwayat Page',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
    ];
    return view('admin/riwayat', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Failed to ' . $msg . ' Riwayat', 'danger']);
      return redirect()->to(base_url('/riwayat-admin'));
    } else {
      session()->setFlashdata('message', ['Riwayat successfully ' . $msg, 'success']);
      return redirect()->to(base_url('/riwayat-admin'));
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
      return $this->redirect_back('create', 'fail');
    }
    $this->listOrders->save($this->form_data());
    return $this->redirect_back('created');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('update', 'fail');
    }
    $this->listOrders->update($id, $this->form_data());
    return $this->redirect_back('updated');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->listOrders->where('id', $id)->delete();
    return $this->redirect_back('deleted');
  }
}
