<html>
  <head>
    <title>registration</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=768px">
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  </head>
<body>

<?php
require_once("./connectDB.php");
$host = getHost();
$user = getUser();
$dbname = getName();
$pass = getPass();
if (isset($_POST['komanetid']) && isset($_POST['nickname'])){
  $komanetid=$_POST['komanetid'];
  $nickname = $_POST['nickname'];
  $sql="select * from oct_users where student_num='". $komanetid . "';";
  $dbconn = pg_connect("host={$host}  dbname={$dbname} user={$user} password={$pass}") or die('Could not connect: ' . pg_last_error());
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  if(pg_num_rows($result)==0){
    $npw=substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 8);
    $npwh=password_hash($npw, PASSWORD_BCRYPT);
    $sql="insert into oct_users (student_num,password,nickname) values ('" . $komanetid . "','" . $npwh . "','".$nickname."');";
    pg_query($sql) or die('Query failed: ' . pg_last_error());
    echo '<p>ユーザ登録を完了しました</p>';
    // location of template file
    $template = "./email.php";

    // create the basic email info to send
    $subject="KomaNaviユーザ登録完了";
    $to ="{$komanetid}@komazawa-u.ac.jp";

    // create email headers
    $headers = "From: Hironori Kuwahara <kuwanori@gms.gdl.jp>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset-ISO-8859-1\r\n";

    // create the html email
    $message ="
    <!DOCTYPE html>
    <html lang='en' dir='ltr'>
      <head>
        <meta charset='utf-8'>
        <title></title>
      </head>
      <body>
        <h1>Welcome to <span style='font-size: 40px; color: #8f8f8f;'>KomaNavi</span>!!!</h1>
        <p style='font-size: 20px;'>KomaNaviへのご登録ありがとうございます。</p>
        <p style='font-size: 20px;'>・Nickname：　{$nickname}</p>
        <p style='font-size: 20px;'>・ID：　{$komanetid}</p>
        <p style='font-size: 20px;'>・仮パスワード：　{$npw}</p>
        <p style='font-size: 20px;'>IDと仮パスワードで<a href='http://gms.gdl.jp/~kuwanori/Bashi-Oct/login.html'>こちら</a>よりログインしてください。</p>
      </body>
    </html>
    ";

    if (mb_send_mail($to, $subject,$message, $headers)) {
      echo "<p>メールが送信されました。</p>";
      echo "<p>※迷惑メールとして届く可能性があります。</p>";
    } else {
      echo "<p>メールの送信に失敗しました。</p>";
    }
    echo "<a href=\"./regist.html\">戻る</a>";
  }
  else{
    echo "<p>IDはすでに登録されています。</p>";
    echo "<a href=\"./regist.html\">戻る</a>";
  }
} else{
  header("location: ./regist.html");
}
?>
          </div>
        </main>
      </div>
    </div>
  </div>
</body>
</html>
