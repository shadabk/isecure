<?php
  $name1 = $_REQUEST['name1'];
  $name2 = $_REQUEST['name2'];
  $db = mysqli_connect('localhost','root','','ait') or die('Error');
  $query = "SELECT * FROM coefs WHERE name='$name1' ORDER BY ts DESC";
  $result1 = mysqli_query($db, $query);
  $query = "SELECT * FROM coefs WHERE name='$name2' ORDER BY ts DESC";
  $result2 = mysqli_query($db, $query);
  $i = 0;
  while($r = mysqli_fetch_assoc($result1)) {
    $rows1[] = $r;
    $i = $i + 1;
  }
  $i = 0;
  while($r = mysqli_fetch_assoc($result2)) {
    $rows2[] = $r;
    $i = $i + 1;
  }
  $fin = "{\"p1\":".json_encode($rows1).", \"p2\":".json_encode($rows2)."}";
  echo json_encode($fin);
	//  echo json_encode($rows1);
 ?>
