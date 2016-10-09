<?php
  $db = mysqli_connect('mysql.hostinger.in','u731257621_ait','shayan','u731257621_ait') or die('Error');
  $query = "create table if not exists udata(
    id INT(10) NOT NULL AUTO_INCREMENT,
    name varchar(25),
    X int(10),
    Y int(10),
    Z int(10),
    primary key (id)
    )  ENGINE=InnoDB";
  mysqli_query($db, $query) or die(mysqli_error());
  $query = "create table if not exists coefs(
      id INT(10) NOT NULL AUTO_INCREMENT,
      ts TIMESTAMP(6),
      name varchar(25),
      XY double,
      YZ double,
      ZX double,
      primary key (id)
      )  ENGINE=InnoDB";
    mysqli_query($db, $query) or die(mysqli_error());

    /*
      SAMPLE JSON:
{
  "obj":
      {
      "name": "shadab",
      "data": [{
        "x": 10,
        "y": 10,
        "z": 10
      }, {
        "x": 20,
        "y": 20,
        "z": 20
      }]
      }
}
    */


    function Corr($x, $y){
      $length= count($x);
      $mean1=array_sum($x) / $length;
      $mean2=array_sum($y) / $length;

      $a=0;
      $b=0;
      $axb=0;
      $a2=0;
      $b2=0;

      for($i=0;$i<$length;$i++){
        $a=$x[$i]-$mean1;
        $b=$y[$i]-$mean2;
        $axb=$axb+($a*$b);
        $a2=$a2+ pow($a,2);
        $b2=$b2+ pow($b,2);
      }
      // $sa = array_sum($x);
      // $sb = array_sum($y);
      // $num = ($length*$axb) - ($sa*$sb);
      // $den = sqrt((($length*$a2)-pow(($sa),2))*(($length*$b2)-pow(($sb),2)));


      $corr= $axb / sqrt($a2*$b2);
      // $corr = $num / $den;
      return $corr;
    }


    echo "part1";
    $xa = array();
    $ya = array();
    $za = array();
    // print_r($_POST);
    // $uid = json_decode($_POST["obj"]);
    // $ud = json_decode($uid["obj"]);
    $ud = json_decode($_POST["obj"], true);
    $name = $ud["name"];
    $timestamp = time();
    $data = $ud["data"];
    foreach($data as $mydata){
      array_push($xa, $mydata["x"] );
      array_push($ya, $mydata["y"] );
      array_push($za, $mydata["z"] );
    }
    $pccxy = (string)Corr($xa, $ya);
    $pccyz = (string)Corr($ya, $za);
    $pcczx = (string)Corr($za, $xa);
    echo $pccxy;
    $query = "INSERT INTO coefs (ts, name, XY, YZ, ZX) VALUES (timestamp, '$name', '$pccxy', '$pccyz', '$pcczx')";
    $data = mysqli_query($db, $query) or die(mysqli_error());
    echo "success";
 ?>
