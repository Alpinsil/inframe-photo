<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentMethodsModel;

class PaymentMethods extends BaseController
{
  protected $paymentMethods;
  public function __construct()
  {
    $this->paymentMethods = new PaymentMethodsModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }

    $btn_link = false;
    $modal_title = [
      'tambah' => 'Tambah Metode Pembayaran',
      'edit' => 'ubah Metode Pembayaran',
      'delete' => 'hapus Metode Pembayaran',
    ];
    $delete_msg = 'Apakah kamu yakin menghapus metode pembayaran ini?';
    $modal_field = [
      [
        'name' => 'name',
        'title' => 'nama'
      ],
      ['name' => 'norek', 'title' => 'no rekening']
    ];
    $cols = ['name', 'no rekening'];
    $rows = ['name', 'norek'];
    $dataTables = $this->paymentMethods->findAll();
    $data = [
      'title' => 'paymentMethods Page',
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
      session()->setFlashdata('message', ['Gagal untuk ' . $msg . ' metode pembayaran', 'danger']);
      return redirect()->to(base_url('/payment-methods'));
    } else {
      session()->setFlashdata('message', ['metode pembayaran berhasil ' . $msg, 'success']);
      return redirect()->to(base_url('/payment-methods'));
    }
  }

  private function form_data()
  {
    $name = $this->request->getPost('name');
    $norek = $this->request->getPost('norek');

    $rules =  [
      'name' => 'required|max_length[255]',
      'norek' => 'required',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['name' => $name, 'norek' => $norek];
    return $data;
  }

  public function create()
  {
    if (!$this->form_data()) {
      return $this->redirect_back('membuat', 'fail');
    }
    $this->paymentMethods->save($this->form_data());
    return $this->redirect_back('membuat');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('ubah', 'fail');
    }
    $this->paymentMethods->update($id, $this->form_data());
    return $this->redirect_back('diubah');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->paymentMethods->where('id', $id)->delete();
    return $this->redirect_back('dihapus');
  }
}
