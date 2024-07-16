<?php
session_start();
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'][0];
  }else{
    $error = "error";
  }

// ログアウトがリクエストされた場合、セッションを破棄
if (isset($_POST['logout'])) {
      // セッションの全変数を解除
      $_SESSION = array();      
  }

if(isset($_SESSION['u_name'])){
  $loginuser = $_SESSION['u_name'][0];
}else{
  $loginuser = "なし";
}

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/index.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

  <header class="header">
  <p><?php echo($loginuser."様"); ?></p>
    <div class="nav">
      <input id="drawer_input" class="drawer_hidden" type="checkbox">
      <label for="drawer_input" class="drawer_open"><span></span></label>
      <nav class="nav_content">
        <ul class="nav_list">
          <li class="nav_item">
            <?php if(isset($_SESSION['u_name'])){ ?>
            <a class="logout_window">ログアウト</a>
            <?php }else{?>
            <a class="login_window">ログイン</a>
            <?php } ?>
          </li>
          <li class="nav_item"><a href="reservation.php">新規予約</a></li>
          <li class="nav_item"><a href="reservation_list.php">予約一覧</a></li>
          <li class="nav_item"><a href="chat.php">チャット</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class="modal"></div>
  <div class="login_modal">
  <h2>ログイン</h2>
      <form id="login_form" method="POST" action="logincheck.php">
          <label for="baseid">メールアドレス</label>
          <input type="mail" id="mail" name="mail" required>
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" required>
          <button type="submit" class="button">ログイン</button>
          <button class="close">閉じる</button>
      </form>
  </div>

  <div class="modal"></div>
  <div class="logout_modal">
  <h3>ログアウトします。<br>よろしいですか？</h2>
      <form id="logout_form" method="post">
          <button type="submit" name="logout">はい</button>
          <button type="submit">いいえ</button>
      </form>
  </div>

  <main>
</main>




    <!-- ログイン用 -->
    <script>
    $(document).on('click', '.login_window', function() {
        // 背景をスクロールできないように & スクロール場所を維持
        scroll_position = $(window).scrollTop();
        $('body').addClass('fixed').css({ 'top': -scroll_position });
        // モーダルウィンドウを開く
        $('.login_modal').fadeIn();
        $('.modal').fadeIn();
    });

    $(document).on('click', '.modal', function() {
        // 背景スクロールを再開し、モーダルを閉じる
        $('body').removeClass('fixed').css({ 'top': '' });
        $(window).scrollTop(scroll_position);
        $('.login_modal').fadeOut();
        $('.modal').fadeOut();
    });

    $(document).on('click', '.close', function() {
        // 背景スクロールを再開し、モーダルを閉じる
        $('body').removeClass('fixed').css({ 'top': '' });
        $(window).scrollTop(scroll_position);
        $('.login_modal').fadeOut();
        $('.modal').fadeOut();
    });

    $(document).on('click', '.logout_window', function() {
        // 背景をスクロールできないように & スクロール場所を維持
        scroll_position = $(window).scrollTop();
        $('body').addClass('fixed').css({ 'top': -scroll_position });
        // モーダルウィンドウを開く
        $('.logout_modal').fadeIn();
        $('.modal').fadeIn();
    });

    $(document).on('click', '.modal', function() {
        // 背景スクロールを再開し、モーダルを閉じる
        $('body').removeClass('fixed').css({ 'top': '' });
        $(window).scrollTop(scroll_position);
        $('.logout_modal').fadeOut();
        $('.modal').fadeOut();
    });
</script>

</body>
</html>