<?php
session_start();
// 以下三行ブラウザの戻る、進むボタンによる操作を可能にする、エラー回避
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
session_cache_expire(60 * 24 * 30);
// ファイル読み込み
require_once("./connectDB.php");
if (isset($_SESSION['ems'])){$ems=$_SESSION['ems'];}
if (isset($_SESSION['pws'])){$pws=$_SESSION['pws'];}
if (isset($_POST['komanetid'])){$ems=$_POST['komanetid'];}
if (isset($_POST['password'])){$pws=$_POST['password'];}
$aflag=0;
// 接続情報
$host = getHost();
$name = getName();
$user = getUser();
$pass = getPass();
if (isset($ems) &&isset($pws)){
  $sql="select * from oct_users where student_num='". $ems . "';";
  $dbconn = pg_connect("host=$host dbname=$name user=$user password=$pass") or die('Could not connect: ' . pg_last_error());
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  if(pg_num_rows($result)==1){
    $row = pg_fetch_row($result);
    if (password_verify($pws, $row[2])){
      $_SESSION['ems']=$ems;
      $_SESSION['pws']=$pws;
      $aflag=1;
    }
  }

}
if($aflag==0){
  header('location: ./login.html');
}

?>

<html>
<head>
  <title>
    login
  </title>
</head>

<body>
</body>
</html>
