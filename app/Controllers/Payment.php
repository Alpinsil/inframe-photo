<?php

namespace App\Controllers;

use App\Models\ListOrdersModel;
use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\PaymentMethodsModel;

helper('filesystem');

class Payment extends BaseController
{
  protected $helpers = ['form'];
  protected $user;
  protected $service;
  protected $payment_methods;
  protected $schedules;
  protected $list_orders;
  protected $user_id;

  public function __construct()
  {
    $this->user = new UserModel;
    $this->service = new ServiceModel;
    $this->payment_methods = new PaymentMethodsModel;
    $this->list_orders = new ListOrdersModel;
    $this->schedules = $this->list_orders->select('date')->where('available', 'no')->findAll();
    $this->user_id = session()->get('user_id');
  }

  public function index($id)
  {

    if ($this->user_id == null) {
      return redirect()->to(base_url('/login'));
    }

    // data
    $service_data = $this->service->find($id);
    $user_data = $this->user->find($this->user_id);
    $payment_methods_data = $this->payment_methods->findAll();


    $dates = $this->schedules;
    $date_array = [];
    foreach ($dates as $key) {
      array_push($date_array, $key['date']);
    }

    $data =
      [
        'service_data' => $service_data,
        'user_data' => $user_data,
        'date_array' => $date_array,
        'payment_methods_data' => $payment_methods_data,
        'title' => 'Payment Page',
      ];

    return view('payment', $data);
  }

  public function create($service_id)
  {
    $payment_id = $this->request->getPost('paymentMethod');
    $date = $this->request->getPost('date');
    $bukti_pembayaran = $this->request->getFile('bukti_pembayaran');
    $bukti_pembayaran_name = $bukti_pembayaran->getRandomName();


    $rules =  [
      'date' => 'required',
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput();
    }

    if ($bukti_pembayaran->getName() == null) {
      return redirect()->back();
    } else {

      if ($bukti_pembayaran->move('assets/bukti_pembayaran', $bukti_pembayaran_name)) {
        $date = date_create($date);
        $date = date_format($date, "Y-m-d");
        $arr_save =
          [
            'date' => $date,
            'user_id' => $this->user_id,
            'service_id' => $service_id,
            'payment_method_id' => $payment_id,
            'status' => 'belum_diproses',
            'status_pembayaran' => 'proses_verifikasi',
            'image' => $bukti_pembayaran_name,
            'available' => 'yes'
          ];
        if ($this->list_orders->save($arr_save)) {
          return redirect()->to('/list-orders-guest');
        }
      }
    }
  }
}
