<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ListOrdersModel;
use App\Models\ServiceModel;

helper('filesystem');
class Services extends BaseController
{
  protected $services;
  protected $listOrdersModel;

  public function __construct()
  {
    $this->services = new ServiceModel;
    $this->listOrdersModel = new ListOrdersModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'admin') {
      return redirect()->to(base_url('/'));
    }

    // $btn_link = '/edit-services';
    $btn_link = false;
    $modal_title = [
      'tambah' => 'Tambah Services',
      'edit' => 'Edit Services',
      'delete' => 'Delete Services',
    ];
    $delete_msg = 'Are You sure Want To Delete This Services ?';
    $modal_field = [
      [
        'name' => 'name',
      ],
      ['name' => 'price'],
      ['name' => 'list_service', 'type' => 'textarea'],
      ['name' => 'image', 'type' => 'file']
    ];
    $cols = ['name', 'price', 'list_service', 'image'];
    $rows = ['name', 'price', 'list_service', ['image', 'image']];
    $dataTables = $this->services->findAll();
    $data = [
      'title' => 'Services Page',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
      'path_image' => 'assets/services/'
    ];
    return view('admin/services/index', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Failed to ' . $msg . ' Services', 'danger']);
      return redirect()->to(base_url('/services'));
    } else {
      session()->setFlashdata('message', ['Services successfully ' . $msg, 'success']);
      return redirect()->to(base_url('/services'));
    }
  }

  private function form_data($type = 'create')
  {
    $name = $this->request->getPost('name');
    $price = $this->request->getPost('price');
    $list_service = $this->request->getPost('list_service');
    $image = $this->request->getFile('image');


    $imageName = $image->getRandomName();
    $path = $this->request->getPost('path');

    $rules =  [
      'name' => 'required|max_length[255]',
      'price' => 'required',
      'list_service' => 'required',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['name' => $name, 'price' => $price, 'list_service' => $list_service, 'image' => $imageName];

    if ($type === 'create') {
      if ($image->move('assets/services', $imageName)) {
        $this->services->save($data);
        return $data;
      }
    } else {
      // $data = $this->portfolio->find($type);
      // $path = 'assets/portfolio/' . $data['image'];
      if ($image->getName()) {
        $path = 'assets/services/' . $path;
        unlink($path);
        if ($image->move('assets/services', $imageName)) {
          $this->services->update($type, $data);
          return $data;
        }
      } else {
        // dd('sini');
        $data = ['name' => $name, 'price' => $price, 'list_service' => $list_service];
        $this->services->update($type, $data);
        return $data;
      }
    };

    return $data;
  }

  public function create()
  {
    if (!$this->form_data()) {
      return $this->redirect_back('create', 'fail');
    }
    return $this->redirect_back('created');
  }


  public function edit($id)
  {
    $data = $this->services->find($id);
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data($id)) {
      return $this->redirect_back('update', 'fail');
    }
    // $this->services->update($id, $this->form_data());
    return $this->redirect_back('updated');
  }

  public function delete()
  {

    $id = $this->request->getPost('id');
    $this->listOrdersModel->where('service_id', $id)->delete();
    $this->services->where('id', $id)->delete();
    return $this->redirect_back('deleted');
  }
}
