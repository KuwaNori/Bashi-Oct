<?php
// php Query でスクレイピングします
require_once("./phpQuery-onefile.php");
// サイトを文字列にして変数htmlに代入
// サイト自体が重いので少し読み込みに時間がかかるかもしれない
$html = file_get_contents("https://www.komazawa-u.ac.jp/~kyoumu/syllabus_html/");
$query = phpQuery::newDocument($html);
echo $query->find("right-side");
 ?>
