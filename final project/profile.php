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

<body>
<h1>Welcome to GRK Clothing Warehouse</h1>
<?php
  $conn=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
  // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  /* ####################### GLOBAL VARIABLES ########################### */
  global $newpassword, $wishlist, $amount_paid, $pay_type;
  $newpassword="";
  $newwishlist="";
  $newamount_paid="";
  $newpay_type="";
  /* ####################### GLOBAL VARIABLES ########################### */
 ?>

 <h3>Account Information</h3>
<?php
	session_start();

	$user = $_SESSION["t1"]; // Username transfered over from option.php
	$account = mysqli_query($conn, "SELECT * FROM `account` WHERE username = '".$user."'");
	if (!$account) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
    }

	$row = mysqli_fetch_array($account);

	echo "Username: " .$row["username"]. "<br>";
	echo "Wishlist: " .$row["wishlist"]. "<br>";
	echo "Payment Type: " .$row["payment_type"];
	echo "<br>";
?>


 <h3>Edit Account</h3>
 <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  New Password: <input type = "text" name = "password"><br>
  Pay Type: <input type = "text" name = "pay_type"><br>
  Wishlist: <input type = "text" name = "wishlist"><br>
  <input type = "submit">
 </form>

 <h3>Return to Options</h3>
 <form method = "post" action = "option.php">
  <Button type = "Back">Return</Button>
 </form>

 <h3>Delete Account</h3>
 <form method = "post" action = deleteAccount.php>
  <Button type = "Delete">Delete</Button>
 </form>
<?php //Error checking

	session_start();    //need this to send variables

	$newpassword = $_POST["password"];
	$newpay_type = $_POST["pay_type"];
	$newwishlist = $_POST["wishlist"];
	$user = $_SESSION["t1"]; // Username transfered over from option.php
	$_SESSION["t2"] = $user; // Username to transfer over to deleteAccount.php

    $result = mysqli_query($conn,"SELECT * FROM `account` WHERE username = '".$user."'");
    if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
    }

	// password, wishlist, amount_paid, payment_type
	/* Updating profile information */
	// Updating Password
	if ($newpassword != "") {
		$update = mysqli_query($conn, "UPDATE `account` SET password = '".$newpassword."' WHERE username = '".$user."'");
		echo "Password Updated!";
	}
	// Updating Pay_Type
	if ($newpay_type != "") {
		// Checking if payment type is appropriate
		if ($newpay_type == "Debit" || $newpay_type == "debit" || $newpay_type == "Credit" || $newpay_type == "credit") {
			$update = mysqli_query($conn, "UPDATE `account` SET payment_type = '".$newpay_type."' WHERE username = '".$user."'");
			echo "Payment Type Updated!";
		}
		// Payment type was inappropriate
		else {
			echo "Invalid Payment type.";
		}
	}
	// Updating Wish List
	if ($newwishlist != "") {
		$update = mysqli_query($conn, "UPDATE `account` SET wishlist = '".$newwishlist."' WHERE username = '".$user."'");
		echo "Wishlist Updated!";
	}

?>
</body>
</html>
