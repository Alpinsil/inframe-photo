<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\DiscussionModel;
use App\Controllers\BaseController;
use App\Models\ChatModel;

class ChatToGuest extends BaseController
{

  protected $discussion;
  protected $users;
  protected $chats;
  public function __construct()
  {
    $this->discussion = new DiscussionModel;
    $this->users = new UserModel;
    $this->chats = new ChatModel;
  }

  public function index()
  {
    if (session()->get('role') == null) {
      return redirect()->to(base_url('/'));
    }

    $id = $_GET['id'];
    $user_id = session()->get('user_id');
    $discussion = $this->discussion->find($id);
    $user = $this->users->find($discussion['user_id']);
    // $chats_right = $this->chats->where('user_id', $user['id'])->where('discussion_id', $id)->findAll();
    // $chats_left = $this->chats->where('user_id !=', $user['id'])->where('discussion_id', $id)->findAll();
    $chats = $this->chats->where('discussion_id', $id)->findAll();

    $data = ['title' => 'Chat Page', 'id' => $id, 'discussion' => $discussion, 'user' => $user, 'chats' => $chats, 'user_id' => $user_id];
    return view('admin/chat', $data);
  }

  public function create()
  {
    if (session()->get('role') == null) {
      return redirect()->to(base_url('/'));
    }
    $discussion_id = $this->request->getPost('discussion_id');
    $user_id = $this->request->getPost('user_id');
    $input_text = $this->request->getPost('input_text');
    $data =
      [
        'user_id' => $user_id,
        'discussion_id' => $discussion_id,
        'chat' => $input_text,
      ];
    $this->chats->save($data);
    return redirect()->back();
  }
}
