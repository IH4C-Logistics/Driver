<?php

try{

    require('db/dbpdo.php');
    session_start();
    //物流IDがSESSIONに登録されているか確認
    $_SESSION['u_name'] = "ドライバーA";
    if(isset($_SESSION['u_name'])){
        $buturyu_name = $_SESSION['u_name'];
        $sql = "SELECT u_Id FROM t_user WHERE u_Name = '". $buturyu_name ."'";
        $stmt = $dbh->prepare($sql);  
        $stmt->execute();
        $buturyu_id = $stmt->fetchAll();
        $buturyu_id1 = $buturyu_id;
      }else{
        echo "ドライバー名が入ってないよ";
      }

    $userID = isset($_GET['userID']);
    if($userID != NULL){
        $chatid = $_GET['userID'];
        }else{
            $chatid = 1;
        }
    
    $sql = ("SELECT u_Name FROM `t_user` WHERE `u_Id` = '".$chatid."'"); 
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $your = $stmt->fetchAll();
    $your1 = $your[0];


    $sql = ("SELECT * FROM `t_chat` WHERE `player` = '".$chatid."' OR `c_Partner` = '".$chatid."' ORDER BY CAST(`time` AS TIME) ASC"); 
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $chat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //ドライバー一覧
    $sql = ("SELECT * FROM `t_user` where u_administrator = '1'"); 
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);




    // $sql = ("SELECT * FROM t_testuser WHERE MOD(player, 2) = 0"); 
    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();
    // $driver = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    }catch (PDOException $e) {
        exit('データベースに接続できませんでした。' . $e->getMessage());
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Example</title>
    <link rel="stylesheet" href="css/chat.css">
</head>
<body>

    <header class="header">
        <div class="logo"><a href="index.php"><img src="images/kkrn_icon_modoru_16.png" alt="return" class="return"></a></div>
        <div class="nav">
        <input id="drawer_input" class="drawer_input" type="checkbox">
        <label for="drawer_input" class="drawer_toggle" id="toggle_button">
            <img src="images/upper_body-2.png" alt="" id="toggle_image">
            <span id="close_button" style="display: none;"><img src="images/cross_hoso.png" alt="X" class="batu"></span>
        </label>
        <nav class="nav_content">
            <div class="nav_list">
            <?php 
            //物流拠点選択
            foreach($user as $item):?>
            <?php $user = $item['u_Id']; ?>
                <div class="nav_item">
                    <a href="chat.php?userID=<?php echo $user; ?>" class="button">
                        <h4><?php echo($item['u_Name']); ?></h4>
                        <p>最新のチャット入れたいね♡</p>
                    </a>
                </div>
            <?php endforeach; ?>
            <div>
        </nav>
        </div>
    </header>

    <main>
        
        <div class="chat-container">
            <h3 class="chat_user"><?php echo $your1[0]; ?></h3>
            <div class="chcon" id="chatContent">
                <?php 
                //chat表示
                foreach ($chat as $item): ?>
                <?php if($item['player'] == $buturyu_id1[0][0] OR $item['c_Partner'] == $buturyu_id1[0][0]) {?>
                <?php if($item['player'] == $buturyu_id1[0][0]){?>
                <div class="base">
                    <div class="message-content">
                        <?php echo $item['text'];?>
                    </div>
                </div>
                <?php
                } else{?>
                <div class="driver">
                    <div class="message-content">
                        <?php echo $item['text']; ?>
                    </div>
                </div>
                <?php }?>
                <?php } ?>
                <?php endforeach;?>
            </div>
            <div class="form">
                <form method="post" action="db/text.php">
                    <input type="text" value="<?php echo $chatid; ?>" name="test"  hidden>
                    <input type="text" name="text" placeholder="Type your message here" required>
                    <input type="image" src="images/22633428.png" alt="send" class="sendimg" value="">
                </form>
            </div>
        </div>
    </main>

    <script>

        document.getElementById('drawer_input').addEventListener('change', function() {
            const isChecked = this.checked;
            document.getElementById('toggle_image').style.display = isChecked ? 'none' : 'inline';
            document.getElementById('close_button').style.display = isChecked ? 'inline' : 'none';
        });

    </script>
</body>
</html>
