<?php
require('dbpdo.php');
session_start();
if(isset($_SESSION['u_name'])){
  $buturyu_name = $_SESSION['u_name'];
  $sql = "SELECT u_Id FROM t_user WHERE u_Name = '". $buturyu_name[0] ."'";
  $stmt = $dbh->prepare($sql);  
  $stmt->execute();
  $buturyu_id = $stmt->fetchAll();
  $buturyu_id1 = $buturyu_id[0];
  print_r($buturyu_id1);
}else{
  echo "拠点名が入ってないよ";
}
$partner = $_POST['test'];
  $text = $_POST['text'];
  print_r($buturyu_id1);
  echo $partner;
  echo $text;
  $sql = "INSERT INTO `t_chat` (`player`, `c_Partner`, `time`, `text`) VALUES ('".$buturyu_id1[0]."', '".$partner."', NOW(), '".$text."')";  //SQL文

  // SQL実行
  $res = $dbh->prepare($sql);
  $res->execute();

 // header('Location: ../chat.php');//URL飛ばす
header('Location: ../chat.php?userID=' . $partner);

?>