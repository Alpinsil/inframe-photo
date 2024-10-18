<?php

namespace App\Controllers\Guest;

use App\Models\DiscussionModel;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Chat extends BaseController
{
  protected $discussion;
  protected $users;
  public function __construct()
  {
    $this->discussion = new DiscussionModel;
    $this->users = new UserModel;
  }

  public function index()
  {
    if (session()->get('role') == null || session()->get('role') !== 'guest') {
      return redirect()->to(base_url('/'));
    }

    $user_id = session()->get('user_id');

    $btn_link = '/chat-to-guest';
    $btn_link_name = 'Chat';
    $modal_title = [
      'tambah' => 'Tambah discussion',
      // 'edit' => 'Edit discussion',
      'delete' => 'Delete discussion',
    ];
    $delete_msg = 'Are You sure Want To Delete This discussion ?';
    $modal_field = [
      [
        'name' => 'user_id',
        'type' => 'hidden',
        'options' => $this->users->where('role', 'guest')->findAll()
      ],
      ['name' => 'title']
    ];
    $cols = ['username', 'title'];
    $rows = ['user_id', 'title'];
    $dataTables = $this->discussion->joinUsersWithId($this->discussion, $user_id);
    $data = [
      'title' => 'discussion Page',
      'cols' => $cols,
      'rows' => $rows,
      'dataTables' => $dataTables,
      'modal_title' => $modal_title,
      'modal_field' => $modal_field,
      'btn_link' => $btn_link,
      'delete_msg' => $delete_msg,
      'btn_link_name' => $btn_link_name,
      'title_up' => 'Chat CS'

    ];
    return view('admin/discussion', $data);
  }


  private function redirect_back($msg, $fail = false)
  {
    if ($fail) {
      session()->setFlashdata('message', ['Failed to ' . $msg . ' discussion', 'danger']);
      return redirect()->to(base_url('/chat-guest'));
    } else {
      session()->setFlashdata('message', ['discussion successfully ' . $msg, 'success']);
      return redirect()->to(base_url('/chat-guest'));
    }
  }

  private function form_data()
  {
    $user_id = session()->get('user_id');
    $title = $this->request->getPost('title');

    $rules =  [
      // 'user_id' => 'required|max_length[255]',
      'title' => 'required',
    ];

    if (!$this->validate($rules)) {
      return false;
    }

    $data = ['user_id' => $user_id, 'title' => $title];
    return $data;
  }

  public function create()
  {
    if (!$this->form_data()) {
      return $this->redirect_back('create', 'fail');
    }
    $this->discussion->save($this->form_data());
    return $this->redirect_back('created');
  }

  public function update()
  {
    $id = $this->request->getPost('id');
    if (!$this->form_data()) {
      return $this->redirect_back('update', 'fail');
    }
    $this->discussion->update($id, $this->form_data());
    return $this->redirect_back('updated');
  }

  public function delete()
  {
    $id = $this->request->getPost('id');
    $this->discussion->where('id', $id)->delete();
    return $this->redirect_back('deleted');
  }
}
