<html>
  <head>
    <title>registration</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=768px">
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  </head>
<body>
<?php
if (isset($_POST['komanetid']) && isset($_POST['nickname'])){
  $komanetid=$_POST['komanetid'];
  $nickname = $_POST['nickname'];
  $sql="select * from oct_users where student_num='". $komanetid . "';";
    $dbconn = pg_connect("host=localhost  dbname=ktsubasa283 user=ktsubasa283 password=FFNAN6bu") or die('Could not connect: ' . pg_last_error());
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  if(pg_num_rows($result)==0){
    $npw=substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 8);
    $npwh=password_hash($npw, PASSWORD_BCRYPT);
    $sql="insert into oct_users (student_num,password,nickname) values ('" . $komanetid . "','" . $npwh . "','".$nickname."');";
    pg_query($sql) or die('Query failed: ' . pg_last_error());
    echo '<p>ユーザ登録を完了しました</p>';
    $mailfr="ktsubasa283@gms.gdl.jp";
    $mailsb="ユーザ登録完了";
    $mailms="下記のとおりユーザ登録を完了しました。\n\n" .
      "   ID:" . $komanetid . "\n\n" .
      "   Nickname:" . $nickname . "\n\n" .
      "   あなたのパスワードは、\n\n" .
      "   " . $npw . "\n\n" .
      "   です。このパスワードを使ってログインしてください。\n\n" .
      "https://gms.gdl.jp/~/login.php\n\n";
    if (mb_send_mail($komanetid . "@komazawa-u.ac.jp", $mailsb,
      $mailms, "From: " . $mailfr)) {
      echo "<p>メールが送信されました。</p>";
    } else {
      echo "<p>メールの送信に失敗しました。</p>";
    }
    echo "<a href=\"./index.php\">戻る</a>";
    #とうろく
  }
  else{
    echo "<p>IDはすでに登録されています。</p>";
    echo "<a href=\"./regform.php\">戻る</a>";
  }
}
else{echo 'error';}
?>
          </div>
        </main>
      </div>
    </div>
  </div>
</body>
</html>
