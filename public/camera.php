<?php
try {
    require('db/dbpdo.php');
    session_start();

    // セッションにユーザー名が設定されているか確認
    $_SESSION['u_name'] = "ドライバーA";
    if (isset($_SESSION['u_name'])) {
        $buturyu_name = $_SESSION['u_name'];
        
        // SQLインジェクション対策
        $sql = "SELECT u_Id FROM t_user WHERE u_Name = :u_name";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':u_name', $buturyu_name, PDO::PARAM_STR);
        $stmt->execute();
        $buturyu_id = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($buturyu_id) {
            $buturyu_id1 = $buturyu_id['u_Id'];
        } else {
            throw new Exception("ユーザーIDが取得できませんでした。");
        }
    } else {
        throw new Exception("ドライバー名がセッションに設定されていません。");
    }

    // GETパラメータからuserIDを取得
    $userID = isset($_GET['userID']) ? $_GET['userID'] : 1;

    // ユーザー情報の取得
    $sql = "SELECT u_Name FROM t_user WHERE u_Id = :userID";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $your = $stmt->fetch(PDO::FETCH_ASSOC);

    // ドライバー一覧の取得
    $sql = "SELECT * FROM t_user WHERE u_administrator = '1'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $userList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 選択されたユーザーの取得
    $selectedUser = null;
    foreach ($userList as $item) {
        if ($item['u_Id'] == $userID) {
            $selectedUser = $item;
            break;
        }
    }

} catch (PDOException $e) {
    exit('データベースエラー: ' . $e->getMessage());
} catch (Exception $e) {
    exit('エラー: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Example</title>
    <link rel="stylesheet" href="css/camera.css">
</head>
<body>

    <header class="header">
        <div class="logo"><a href="index.php"><img src="images/kkrn_icon_modoru_16.png" alt="return" class="return"></a></div>
    </header>

    <main>
        <div class="container">
            <div class="camera_list">
                <?php foreach ($userList as $item): ?>
                <div class="nav_item">
                    <a href="camera.php?userID=<?php echo htmlspecialchars($item['u_Id'], ENT_QUOTES, 'UTF-8'); ?>" class="button">
                        <h4><?php echo htmlspecialchars($item['u_Name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p>拠点カメラ</p>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="camera_container">
                <h3 class="chat_user"><?php echo htmlspecialchars($selectedUser['u_Name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <?php if ($selectedUser['u_Name'] == '物流拠点A'): ?>
                    <!-- A -->
                    <iframe width="100%" height="250px" src="https://www.youtube.com/embed/oyxdKe7cj3s?si=1M0hue-IIkmkpJsZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <?php elseif ($selectedUser['u_Name'] == '物流拠点B'): ?>
                    <!-- B -->
                    <iframe width="100%" height="250px" src="https://www.youtube.com/embed/gHWoLGdhRxY?si=o6bbcBAmLNI0yCix" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <?php else: ?>
                    <p>選択された物流拠点が無効です。</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
