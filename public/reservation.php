<?php 
session_start();

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
  <title>新規予約</title>
  <link rel="stylesheet" href="css/reservation.css">
</head>
<body>

  <header class="header">
    <p><?php echo($loginuser."様"); ?></p>
      <div class="nav">
        <input id="drawer_input" class="drawer_hidden" type="checkbox">
        <label for="drawer_input" class="drawer_open"><span></span></label>
        <nav class="nav_content">
          <ul class="nav_list">
            <li class="nav_item"><a class="login_window">ログイン</a></li>
            <li class="nav_item"><a href="reservation.php">新規予約</a></li>
            <li class="nav_item"><a href="reservation_list.php">予約一覧</a></li>
            <li class="nav_item"><a href="chat.php">チャット</a></li>
          </ul>
        </nav>
      </div>
    </header>

  <main>
    <div id="wrap">
      <form action="db/submit.php" method="post">
        <div class="Form">
          <h2>新規予約</h2>
          <div class="Form-Item">
            <p class="Form-Item-Label"> 運転者氏名 </p>
            <input type="text" class="Form-Item-Input" placeholder="例）山田太郎" id="driver_name" name="driver_name" value="<?php echo $loginuser ?>">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> 電話番号<br>(ハイフン無し) </p>
            <input type="text" class="Form-Item-Input" placeholder="例）09012345678"  id="tel_num" name="tel_num">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> 運送依頼会社名 </p>
            <input type="text" class="Form-Item-Input" placeholder="例）〇〇〇株式会社" id="b_name" name="b_name">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> 運送会社名 </p>
            <input type="text" class="Form-Item-Input" placeholder="例）XXX株式会社" id="trans_comp" name="trans_comp">
          </div>                        

          <div class="Form-Item">
            <p class="Form-Item-Label"> 運送先 </p>
            <input type="text" class="Form-Item-Input" placeholder="例）物流拠点A" id="arrival_point" name="arrival_point">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> 到着日付 </p>
            <input type="date" class="Form-Item-Input"  id="a_date" name="a_date" min="<?php echo(date('Y-m-d')); ?>">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> 到着時刻 </p>
            <input type="time" class="Form-Item-Input" id="a_time" name="a_time">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> ナンバープレート </p>
            <input type="text" class="Form-Item-Input" placeholder="例）1234" id="car_num" name="car_num">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label">車種</p>
            <select class="Form-Item-Input" id="vehicle_size" name="vehicle_size">
              <option value="">選択してください</option>
              <option value="2トン車">2トン車</option>
              <option value="4トン車">4トン車</option>
              <option value="10トン車">10トン車</option>
              <option value="トレーラー">トレーラー</option>
              <option value="軽トラ">軽トラ</option>
              <option value="JRコンテナ">JRコンテナ</option>
            </select>
          </div>
          
          <div class="Form-Item">
            <p class="Form-Item-Label"> 商品名 </p>
            <input type="text" class="Form-Item-Input" placeholder="例）炒飯" id="product_name" name="product_name">
          </div>

          <div class="Form-Item">
            <p class="Form-Item-Label"> 数量(ケース) </p>
            <input type="text" class="Form-Item-Input" placeholder="例）24" id="quantity" name="quantity">
          </div>

          <input type="submit" class="Form-Btn" value="予約する">
        </div>
      </form>
    </div>
  </main>
</body>
</html>