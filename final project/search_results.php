<html land = "en">
<head>
  <title>GRK Clothing Warehouse</title>
  <h1>GRK Search Manager<h1>
  <style>
    body{
      padding-top: 10px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<body>
  <?php
    session_start();
    echo "<br>Search results for: ";
    echo $_SESSION["transfer"];
    echo "<br>";
    echo "Nothing"
  ?>
</body>
<html>
