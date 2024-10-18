<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ListOrdersModel;
use App\Models\PaymentMethodsModel;

class ListOrder extends BaseController
{
  protected $listOrders;
  protected $paymentMethods;
  public function __construct()
  {
    $this->listOrders = new ListOrdersModel;
    $this->paymentMethods = new PaymentMethodsModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }

    $btn_link = false;
    $modal_title = [
      // 'tambah' => 'Tambah listOrders',  
      'edit' => 'Ubah daftar pesanan',
      'delete' => 'Hapus daftar pesanan',
    ];
    $delete_msg = 'Apakah kamu yakin ingin menghapus pesanan ini ?';
    $arr_name_statusPembayaran =
      [
        [
          'name' => 'belum_dibayar',
          'id' => 'belum_dibayar'
        ],
        [
          'name' => 'proses_verifikasi',
          'id' => 'proses_verifikasi'
        ],
        [
          'name' => 'terverifikasi',
          'id' => 'terverifikasi'
        ]
      ];

    $arr_name_status =
      [
        [
          'name' => 'belum_diproses',
          'id' => 'belum_diproses'
        ],
        [
          'name' => 'diproses',
          'id' => 'diproses'
        ],
        [
          'name' => 'selesai',
          'id' => 'selesai'
        ]
      ];
    $modal_field = [
      // [
      //   'name' => 'email',
      // ],
      ['name' => 'status_pembayaran', 'type' => 'select', 'options' => $arr_name_statusPembayaran],
      ['name' => 'status', 'type' => 'select', 'options' => $arr_name_status],
    ];

    $cols = ['email', 'metode pembayaran', 'tanggal', 'Paket', 'harga', 'Bukti Pembayaran', 'Status Pembayaran', 'Status'];
    $rows = ['email', 'payment_method', 'date', 'service_name', 'price', ['image', 'image'], 'status_pembayaran', 'status'];
    $dataTables = $this->listOrders->joinAll('!=', 'selesai');
    // dd($dataTables);
    $data = [
      'title' => 'Daftar Pesanan',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'title_up' => 'Daftar Pesanan',
      'path_image' => 'assets/bukti_pembayaran/',
      'delete_msg' => $delete_msg,
    ];
    return view('admin/riwayat', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Gagal untuk ' . $msg . ' pesanan', 'danger']);
      return redirect()->to(base_url('/list-order'));
    } else {
      session()->setFlashdata('message', ['Daftar pesanan berhasil ' . $msg, 'success']);
      return redirect()->to(base_url('/list-order'));
    }
  }

  private function form_data()
  {
    $email = $this->request->getPost('email');
    $status_pembayaran = $this->request->getPost('status_pembayaran');
    $status = $this->request->getPost('status');

    // $rules =  [
    //   'question' => 'required|max_length[255]',
    //   'answer' => 'required',
    // ];

    // if (!$this->validate($rules)) {
    //   return false;
    // }

    $data = ['email' => $email, 'status_pembayaran' => $status_pembayaran, 'status' => $status];
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
      return $this->redirect_back('ubah', 'fail');
    }
    $this->listOrders->update($id, $this->form_data());
    return $this->redirect_back('diubah');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->listOrders->where('id', $id)->delete();
    return $this->redirect_back('dihapus');
  }
}
