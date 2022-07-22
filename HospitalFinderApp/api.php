<?php
//simple api for database insertion
// Citation

/***
  Ismail, M. H. (2021, July 11). Android: Building a Simple RESTful Client-Server Application. Coding Malaya. https://youtu.be/LjWyxm5HPK8
***/

require_once('db.php');

 if (!isset($_POST['name']) && !isset($_POST['coord']) ){
   die("Error incomplete HTTP request");
 }

 if (strlen($_POST['name']) < 3  || strlen($_POST['coord'])<5) {

   die("Error please fill in the form");

 }

//filter all inputs for securing
$POSTV = filter_input_array(INPUT_POST,
    ['name' => FILTER_SANITIZE_STRING,
     'coord' => FILTER_SANITIZE_STRING,
     'address' => FILTER_SANITIZE_STRING,
    ]
);
$name = $POSTV['name'];
$coord = $POSTV['coord'];
$address = $POSTV['address'];
$addr = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

$query= "INSERT INTO checkin (id, name, coord, address, ip_address, user_agent, notes)
VALUES (NULL,'$name','$coord', '$address', '$addr','$agent')";

$result=mysqli_query($link, $query);

if (!$result) {

  echo mysqli_error($link);

} else {

echo "User Check In Feedback Posted";
}
 ?>
