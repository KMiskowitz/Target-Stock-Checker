<!DOCTYPE html>
<html lang="en">
<?php
$tpin = trim($_POST['tpin']);
$zip = trim($_POST['zip']);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_VERBOSE => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_URL => "https://api.target.com/available_to_promise/v2/" . $tpin ."/search?key=6B7d7fAIJJyGQ084KTLOjPGiGzFIGxgf&nearby=" . $zip . "&inventory_type=stores&multichannel_option=none&field_groups=location_summary&requested_quantity=1&radius=100"
));
$response = curl_exec($curl);
echo curl_error($curl);
curl_close($curl);
$tarData = json_decode($response, true);
$num = count($tarData['products'][0]['locations']);
$num = $num - 1;
$i = 0;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Stock Checker</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
</head>

<body>

  <?php
  include('static.nav');
   ?>
<!---Stuff Goes Here-->
<h1>Results</h1>
<p>This will look a lot better when I decide to design it.</p>
<?php
foreach ($tarData as $tarData) {
  echo "Item Name: ";

  {
  while ($i <= $num)
  {
  $onhand = $tarData[0]['locations'][$i]['onhand_quantity'];
  $sale = $tarData[0]['locations'][$i]['location_available_to_release_quantity'];

  echo "Store Number: " . $tarData[0]['locations'][$i]['location_id'];
  echo "<br>";
  echo "Store Name: " . $tarData[0]['locations'][$i]['store_name'];
  echo "<br>";
  echo "Store Address " . $tarData[0]['locations'][$i]['store_address'];
  echo "<br>";
  echo "On Hand Quantity: " .($onhand >= 1 ? "<span style='color:green'>$sale</span>" : "<span style='color:red'>$sale</span>");
  echo "<br>";
  echo "Saleable Quantity: " .($sale >= 1 ? "<span style='color:green'>$onhand</span>" : "<span style='color:red'>$onhand</span>");
  echo "<br>";
  echo "<hr>";
  echo "<br>";
  $i++;
}
}
} ?>
   <?php
   include('staticp');
   ?>


   <!-- Bootstrap core JavaScript
================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
   <script>
       if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
           // some code..
       } else {
           $('ul.nav li.dropdown').hover(function() {
               $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
           }, function() {
               $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
           });
       }
   </script>
</body>

</html>
