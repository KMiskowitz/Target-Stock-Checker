<!DOCTYPE html>
<html lang="en">
<?php
$tpin = trim($_POST['tpin']);
$zip = trim($_POST['zip']);
$zipjson = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $zip);
$zipdata = json_decode($zipjson, true);

$lat = $zipdata['results']['0']['geometry']['location']['lat'];
$long = $zipdata['results']['0']['geometry']['location']['lng'];


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_VERBOSE => 1,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_URL => "https://api.target.com/available_to_promise/v2/" . $tpin ."/search?key=eb2551e4accc14f38cc42d32fbc2b2ea&nearby=". $lat . "," . $long . "&inventory_type=stores&multichannel_option=none&field_groups=location_summary&requested_quantity=1&radius=100"
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
  echo "On Hand Quantity: " .($sale >= 1 ? "<span style='color:green'>$sale</span>" : "<span style='color:red'>$sale</span>");
  echo "<br>";
  echo "Saleable Quantity: " .($onhand >= 1 ? "<span style='color:green'>$onhand</span>" : "<span style='color:red'>$onhand</span>");
  echo "<br>";
  echo "<hr>";
  echo "<br>";
  $i++;
}
}
} ?>
</body>

</html>
