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
      'edit' => 'Edit Metode Pembayaran',
      'delete' => 'Delete Metode Pembayaran',
    ];
    $delete_msg = 'Are You sure Want To Delete This Payment Methods ?';
    $modal_field = [
      [
        'name' => 'name',
      ],
      ['name' => 'norek']
    ];
    $cols = ['name', 'norek'];
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
      session()->setFlashdata('message', ['Failed to ' . $msg . ' paymentMethods', 'danger']);
      return redirect()->to(base_url('/payment-methods'));
    } else {
      session()->setFlashdata('message', ['paymentMethods successfully ' . $msg, 'success']);
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
      return $this->redirect_back('create', 'fail');
    }
    $this->paymentMethods->save($this->form_data());
    return $this->redirect_back('created');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('update', 'fail');
    }
    $this->paymentMethods->update($id, $this->form_data());
    return $this->redirect_back('updated');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->paymentMethods->where('id', $id)->delete();
    return $this->redirect_back('deleted');
  }
}
