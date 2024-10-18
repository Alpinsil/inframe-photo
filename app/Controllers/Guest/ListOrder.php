<?php

namespace App\Controllers\Guest;

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
    if (session()->get('role') == null || session()->get('role') !== 'guest') {
      return redirect()->to(base_url('/'));
    }

    $btn_link = false;
    $modal_title = [
      // 'tambah' => 'Tambah listOrders',  
      // 'edit' => 'Upload Bukti Pembayaran',
      // 'delete' => 'Delete listOrders',
    ];
    $delete_msg = 'Are You sure Want To Delete This Order ?';
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
      ['name' => 'image', 'type' => 'file'],
    ];

    $cols = ['email', 'Metode Pembayaran', 'date', 'Paket', 'harga', 'Bukti', 'Status Pembayaran', 'Status'];
    $rows = ['email', 'payment_method', 'date', 'service_name', 'price', ['image', 'image'], 'status_pembayaran', 'status'];
    $dataTables = $this->listOrders->joinAllGuest('!=', 'selesai', session()->get('user_id'));
    // dd($dataTables);
    $data = [
      'title' => 'Daftar Pesanan',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
      'path_image' => 'assets/bukti_pembayaran/',
      'title_up' => 'Riwayat pesanan pelanggan'
    ];
    return view('list-order-guest', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Failed to ' . $msg . ' Riwayat', 'danger']);
      return redirect()->to(base_url('/list-orders-guest'));
    } else {
      session()->setFlashdata('message', ['Riwayat successfully ' . $msg, 'success']);
      return redirect()->to(base_url('/list-orders-guest'));
    }
  }

  private function form_data()
  {
    $image = $this->request->getFile('image');
    $imageName = $image->getRandomName();
    $path = $this->request->getPost('path');
    $id = $this->request->getPost('id');


    $rules =  [
      'image' => 'is_image[image]|uploaded[image]'
    ];


    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['image' => $imageName];
    if ($image->move('assets/bukti_pembayaran', $imageName)) {
      $this->listOrders->update($id, $data);
      return $data;
    }
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

    $path = $this->request->getPost('path');
    if (!$this->form_data()) {
      return $this->redirect_back('update', 'fail');
    }
    // $this->listOrders->update($id, $this->form_data());
    return $this->redirect_back('updated');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->listOrders->where('id', $id)->delete();
    return $this->redirect_back('deleted');
  }
}
