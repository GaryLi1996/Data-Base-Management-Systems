<html land = "en">
<head>
  <title>GRK Clothing Warehouse</title>
  <h1>You have successfully created your account<h1>
  <style>
    body{
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>

<!-- Need to add users to the data base -->

<body>
  <h3> You have been added to the Database </h3>

  <?php
    session_start();
    echo "<br>Your name is: ";
    echo $_SESSION["name2"];
    echo "<br>Your E-mail is: ";
    echo $_SESSION["email"];
    echo "<br>Your password is: ";
    echo $_SESSION["pass"];
  ?>

  <h3>Click here to continue</h3>
<form method ="post" action="option.php">
  <button type="submit">Continue</button>
</form>


</body>
<html>
