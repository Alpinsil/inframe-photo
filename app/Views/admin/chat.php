<?= $this->extend('Template/sidebar') ?>

<?= $this->section('content') ?>


<link href="assets/css/chat.css" rel="stylesheet" />


<section style="margin-top: 700px; width:100%;">
  <div class="chat_window">
    <div class="top_menu">
      <div class="buttons">
        <div class="button close"></div>
        <div class="button minimize"></div>
        <div class="button maximize"></div>
      </div>
      <div class="title text-black"><?= session()->get('role') == 'guest' ? 'Admin' : $user['name']; ?></div>
    </div>

    <ul class="messages">

      <!-- <li class="message appeared right test_message ">
        <div class="text_wrapper bg-success text-white">
          <div class="text text-white text-2xl">
          </div>
        </div>
      </li> -->

      <?php foreach ($chats as $key) { ?>
        <li class="message appeared test_message <?= $key['user_id'] == $user_id ? 'right' : 'left'; ?>">
          <div class="text_wrapper">
            <div class="text">
              <?= $key['chat']; ?>
            </div>
          </div>
        </li>
      <?php } ?>

    </ul>
    <form action="" method="post">
      <input type="hidden" name="discussion_id" value="<?= $id; ?>">
      <input type="hidden" name="user_id" value="<?= $user_id; ?>">
      <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
          <input class="message_input" name="input_text" placeholder="Ketik pesan disini..." />
        </div>
        <div class="send_message">
          <!-- <div class="icon"></div> -->
          <button type="submit" class="text btn btn-success px-4 p-0 w-100">Kirim</button>
        </div>
    </form>
  </div>
  </div>
  <div class="message_template">
    <li class="message">
      <!-- <div class="avatar"></div> -->
      <div class="text_wrapper">
        <div class="text left"></div>
      </div>
    </li>
  </div>

  <script src="assets/js/chat.js"></script>


  <script>
    $('.test_message').animate({
      scrollTop: $messages.prop('scrollHeight')
    }, 300);
  </script>

</section>
<?= $this->endSection(); ?>