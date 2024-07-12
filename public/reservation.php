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
      <table>
            <tr>
              <td colspan="2"><h1>予約内容を入力してください</h1></td>
            </tr>
            <?php $today = date('Y-m-d'); ?>
            <tr>
                <td><label for="textbox1">運転者名</label></td>
                <td><label for="textbox2">電話番号</label></td>
            </tr>
            <tr>
                <td><input type="text" id="driver_name" name="driver_name" value="<?php echo $loginuser ?>"></td>
                <td><input type="text" id="tel_num" name="tel_num"></td>
            </tr>
            <tr>
                <td><label for="textbox3">運送依頼会社名</label></td>
                <td><label for="textbox4">運送会社名</label></td>
            </tr>
            <tr>
                <td><input type="text" id="b_name" name="b_name"></td>
                <td><input type="text" id="trans_comp" name="trans_comp"></td>
            </tr>
            <tr>
                <td><label for="textbox5">運送先</label></td>
                <td><label for="textbox6">到着日付</label></td>
            </tr>
            <tr>
                <td><input type="text" id="arrival_point" name="arrival_point"></td>
                <td><input type="date" id="a_date" name="a_date" min="<?php echo $today; ?>"></td>
            </tr>
            <tr>
                <td><label for="textbox7">到着時刻</label></td>
            </tr>
            <tr>
                <td><input type="time" id="a_time" name="a_time" ></td>
            </tr>
            <tr>
                <td><label for="textbox9">ナンバープレート</label></td>
                <td><label for="textbox10">車種</label></td>
            </tr>
            <tr>
                <td><input type="text" id="car_num" name="car_num"></td>
                <td>        
                  <select id="vehicle_size" name="vehicle_size">
                    <option value="2トン車">2トン車</option>
                    <option value="4トン車">4トン車</option>
                    <option value="10トン車">10トン車</option>
                    <option value="トレーラー">トレーラー</option>
                    <option value="軽トラ">軽トラ</option>
                    <option value="JRコンテナ">JRコンテナ</option>
                  </select>
            </td>
            </tr>
            <tr>
                <td><label for="textbox11">商品名</label></td>
                <td><label for="textbox12">数量(ケース)</label></td>
            </tr>
            <tr>
                <td><input type="text" id="product_name" name="product_name"></td>
                <td><input type="text" id="quantity" name="quantity"></td>
            </tr>
            
            <tr>
              <td></td>
                <td>
                    <input type="submit" value="送信">
                </td>
            </tr>
        </table>
      </form>
    </div>

  </main>
</body>
</html>