<?php
print "<form><table border=\"1\" cellpadding=\"5\">\n";
for($i=0;$i<7;$i++){
if($i==0){print
  "<tr>
  <td>&nbsp;</td>
  <th>月曜日</th>
  <th>火曜日</th>
  <th>水曜日</th>
  <th>木曜日</th>
  <th>金曜日</th>
  <th>土曜日</th>
  </tr>
  \n";continue;}
print "<tr><td align=\"center\">$i<br>限</td>";
for($j=1;$j<7;$j++){
   print "<td> </td>";
}
print "</tr>\n";
}
print "</table>\n</form>";
?>
