<?php
session_start();
  $mode = 'input';
  if(isset($_POST['back']) &&$_POST['back']){
  } else if (isset($_POST['confirm']) && $_POST['confirm'] ) {
    $_SESSION['fullname'] = $_POST['fullname'];
    $_SESSION['email']    = $_POST['email'];
    $_SESSION['message']  = $_POST['message'];
    $mode = 'confirm';
  } else if (isset($_POST['send']) && $_POST['send'] ) {
    //送信ボタン
    $message  = "お問い合わせを受け付けました \r\n"
              . "名前: " . $_SESSION['fullname'] . "\r\n"
              . "email: " . $_SESSION['email'] . "\r\n"
              . "お問い合わせ内容:\r\n"
              . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
	  mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
    mail('daikii0212@gmail.com','お問い合わせありがとうございます',$message);
    $_SESSION = array();
    $mode = 'send';
  } else {
    $_SESSION['fullname'] = "";
    $_SESSION['email']    = "";
    $_SESSION['message']  = "";
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/common2.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/js2.js"></script>
    <title>Contact</title>
</head>
<body>
    <div id="loading">
        <div class="sk-circle">
            <div class="sk-circle1 sk-child"></div>
            <div class="sk-circle2 sk-child"></div>
            <div class="sk-circle3 sk-child"></div>
            <div class="sk-circle4 sk-child"></div>
            <div class="sk-circle5 sk-child"></div>
            <div class="sk-circle6 sk-child"></div>
            <div class="sk-circle7 sk-child"></div>
            <div class="sk-circle8 sk-child"></div>
            <div class="sk-circle9 sk-child"></div>
            <div class="sk-circle10 sk-child"></div>
            <div class="sk-circle11 sk-child"></div>
            <div class="sk-circle12 sk-child"></div>
          </div>
    </div>

    <div class="wrap"> <!--コンテンツ-->
        <div class="top"></div>
            <div class="title">
                    <div class="border">
                        <div class="name">Yokoyama Daiki</div>
                        <div class="profile">Profile Site</div>
                    </div>
            </div>
            <!--フォーム画面-->
      <div class="form">
        <?php if($mode == 'input'){ ?>
          <!--入力画面-->
            <form action ="./index2.php" method="post">
              <div class="formname"><span>名前</span><input type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>"><br></div>
              <div class="formmail">Eメール<input type="email" name="email" value="<?php echo $_SESSION['email'] ?>"><br></div>
              <div class="formmess">お問い合わせ内容<br><textarea cols="40" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea><br></div>
              <input type="submit" name="confirm" value="確認" />
            </form>
        <?php } else if($mode == 'confirm') { ?>
          <!--確認画面-->
            <form action ="./index2.php" method="post">
            名前　<?php echo $_SESSION['fullname'] ?><br>
            Eメール <?php echo $_SESSION['email'] ?><br>
            お問い合わせ
            <?php echo nl2br($_SESSION['message']) ?><br>
            <input type="submit" name="back" value ="戻る">
            <input type="submit" name="send" value ="送信">
            </form>
        <?php } else { ?>
            <!--最後-->
            送信しました。　お問い合わせありがとうございました。　<br>
        <?php } ?>
      </div>
     <div class="top">製作者：横山大希</div>
</body>
</html>


