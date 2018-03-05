<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Stock Checker</title>
</head>

<body>

   <div class="centered">

     <form action="target-post.php" method="post">
     <div class="form-group">
       <label for="formGroupExampleInput"><a href="#" data-toggle="tooltip" data-placement="top" title="The TCIN is located in the Item Details section of your item">Target Product ID (TCIN)</a></label>
       <input type="text" class="form-control" name="tpin" id="formGroupExampleInput" placeholder="49382959">
       <label>13958213 if you dont know one</label>
     </div>
     <div class="form-group">
       <label for="formGroupExampleInput2">Zip Code</label>
       <input type="text" class="form-control" name="zip" id="formGroupExampleInput2" placeholder="92010">
     </div>
     <button type="submit" class="btn btn-primary" formaction="target-post.php">Submit</button>

   </form>

   </div>

</body>

</html>
