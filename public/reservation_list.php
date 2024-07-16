<?php 
require('db/dbpdo.php');
session_start();

if(isset($_SESSION['u_name'])){
  $loginuser = $_SESSION['u_name'][0];
}else{
  $loginuser = "なし";
}
//echo($loginuser);


$sql = "SELECT `contract_num` AS `契約番号`,`arrival_point` AS `到着地点`,`a_date` AS `到着日`,`a_time` AS `到着時間`
FROM `t_reservation` WHERE driver_name = '". $loginuser ."'";
$stmt = $dbh->prepare($sql);  
$stmt->execute();
$reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($reservation);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reservation_list.css">
  <title>予約一覧</title>
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
      <h2>予約情報一覧</h2>
      <p>詳細確認または修正するには、予約番号をクリックしてください。</p>
      <?php if (!empty($reservation)): ?>
      <table class="design">
        <tr>
          <?php foreach (array_keys($reservation[0]) as $header): ?>
            <th><?php echo htmlspecialchars($header); ?></th>
          <?php endforeach; ?>
        </tr>
        <?php foreach ($reservation as $row): ?>
          <tr>
            <?php foreach ($row as $key => $cell): ?>
              <?php if ($key === '契約番号'): ?>
                <td><a href="resevation_change.php?key=<?php echo $cell; ?>"><?php echo htmlspecialchars($cell); ?></a></td>
              <?php else: ?>
                <td><?php echo htmlspecialchars($cell); ?></td>
              <?php endif; ?>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php endif; ?>
    </div>
  </main>

</body>
</html>
