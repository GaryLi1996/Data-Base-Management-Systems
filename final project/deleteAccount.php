<html>
<head>
  <title>GRK Clothing Warehouse</title>
  <style>
    body{
      padding-top :5px;
      padding-bottom: 40px;
      background-color: lightblue;
    }


  </style>

</head>


<!-- Post for users with accounts already -->
<!-- A current user should have access to personal info -->
<!-- Need to keep track of account status (reg customer, employee ...) -->
<body>
<h1>Welcome to GRK Clothing Warehouse</h1>

 <h3>ARE YOU SURE YOU WANT TO DELETE YOUR ACCOUNT?</h3>
 <body>
  <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    <select name = "action">
      <option value = ""> Select.. </option>
      <option value = "Yes">YesDelete</option>
      <option value = "No">NoDelete</option>
    </select>
    <input type = "submit">
  </form>
  
  <h3>Return to Home Page</h3>
  <form method = "post" action = "website.php">
  <Button type = "Return">Return</Button>
  </form>

  <!-- Manage redirect -->  
 <?php
  $conn=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
  // Check connection
  if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  session_start();
  
  $input = $_POST["action"];
  $user1 = $_SESSION["t2"]; // Username saved from profile.php
  
  // Checking whether or not User wants account deleted
  
  // User wants account deleted
  if ($input == "Yes") {
	  $delete = mysqli_query($conn, "DELETE FROM `account` WHERE username = '".$user1."'");
	  echo "Account " .$user1. " deleted!";
  }
  // User doesn't want account deleted
  else if ($input == "No") {
	  echo "Account " .$user1. " not deleted!";
  } 
 ?>
 