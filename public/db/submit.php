<?php
require('dbpdo.php');

$driver_name = $_POST['driver_name'] ?? '';
$tel_num = $_POST['tel_num'] ?? '';
$b_name = $_POST['b_name'] ?? '';
$trans_comp = $_POST['trans_comp'] ?? '';
$arrival_point = $_POST['arrival_point'] ?? '';
$a_date = $_POST['a_date'] ?? '';
$a_time = $_POST['a_time'] ?? '';
$car_num = $_POST['car_num'] ?? '';
$vehicle_size = $_POST['vehicle_size'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$quantity = $_POST['quantity'] ?? '';

$rand_num = rand(1,2147483647);
$contract_num = str_pad($rand_num, 10, '0', STR_PAD_LEFT);
echo $contract_num;

$sql = ("INSERT INTO `t_reservation`(`contract_num`, `b_name`, `arrival_point`, `a_date`, `a_time`, `trans_comp`, `driver_name`, `tel_num`, `car_num`, `vehicle_size`, `product_name`, `quantity`, `status`) VALUES
                                  ('".$contract_num."','".$b_name."','".$arrival_point."','".$a_date."','".$a_time."','".$trans_comp."','".$driver_name."','".$tel_num."','".$car_num."','".$vehicle_size."','".$product_name."','".$quantity."','3')"); //SQL文
// SQL実行
$res = $dbh->prepare($sql);
$res->execute();

header('Location: ../index.php');//後で予約完了ページを作りそこに飛ばす(予約番号表示する)


//後で消す///////////
echo "<p>運転者名: $driver_name</p>";
echo "<p>電話番号: $tel_num</p>";
echo "<p>運送依頼会社名: $b_name</p>";
echo "<p>運送会社名: $trans_comp</p>";
echo "<p>運送先: $arrival_point</p>";
echo "<p>到着日付: $a_date</p>";
echo "<p>到着時刻: $a_time</p>";
echo "<p>ナンバープレート: $car_num</p>";
echo "<p>車種: $vehicle_size</p>";
echo "<p>商品名: $product_name</p>";
echo "<p>数量(ケース): $quantity</p>";
////////////////////////////////


?>