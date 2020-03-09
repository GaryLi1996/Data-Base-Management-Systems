
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

<?php
  $conn=mysqli_connect("localhost","root","gofyourselF2!#@", "grk");
  // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  /***************** GLOBAL VARIABLES *****************/
  global $username, $expassword;
  $username = "";
  $expassword="";
  /***************** GLOBAL VARIABLES *****************/

 ?>


<h3>Existing Member? Enter in your Username and Password </h3>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
  Name: <input type = "text" name = "username"><br>
  Password: <input type = "text" name = "expassword"><br>
  <input type = "submit">
</form>


<!-- Post for people to create new accounts -->
<!-- Need to ask more information about user type (employee, reg account) -->
<h3>Not a member yet? Sign up here</h3>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name: <input type = "text" name = "name"><br>
  Password: <input type = "text" name = "password"><br>
  Confirm Password: <input type = "text" name = "CPassword"><br>
  <input type = "submit">

</form>

<h3>New Admin? Sign up here</h3>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Name: <input type = "text" name = "aname"><br>
  Password: <input type = "text" name = "apassword"><br>
  Confirm Password: <input type = "text" name = "CaPassword"><br>
  Admin Code: <input type = "text" name ="admincode"><br>
  <input type = "submit">
</form>


  <?php //Error checking
    $username = $_POST["username"];
    $expassword = $_POST["expassword"];
    $adminname = $_POST["aname"];
    $adminpass = $_POST["apassword"];
    $code = $_POST["admincode"];

    $result = mysqli_query($conn,"SELECT * FROM `account` WHERE username = '".$username."'");
    if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
    }

    $row = mysqli_fetch_array($result);
    session_start();    //need this to send variables


    if ($_SERVER["REQUEST_METHOD"] == "POST"){    //check if this page has been opened before

      //check returning user fields
      if($username !="" & $expassword !=""){
        //check if account exists
        if($result->num_rows==0){
          $msg = "Username does not exist";
        }
        if($row["username"]==$username & $row["password"]==$expassword){
          $_SESSION["user"] = $username;
          header("Location:option.php");
          exit();
        }
        else if($row["username"]==$username & $row["password"]!=$expassword){
          $msg = "invalid password";
        }
      }

        //allCreating new account
      else if ($_POST["name"] != "" & $_POST["password"] != ""){
        if($_POST["CPassword"] != $_POST["password"]){   // error check
          $msg = "Passwords do not match. Re-enter the values.";
        }
        else if ($_POST["name"]!="")
        {
          $_SESSION["name2"] = $_POST["name"];
          $_SESSION["pass"] = $_POST["password"];
          $newname = $_POST["name"];    //save value from post section
          $newpass = $_POST["password"];
          $check = mysqli_query($conn,"SELECT * FROM `account` WHERE username = '".$newname."'");

          if($check->num_rows>0)
          {
            $msg = "username already exists";
          }
          else{
            $insert = mysqli_query($conn, "INSERT INTO `account` VALUES('" .$newname."','".$newpass."', NULL, NULL, NULL, NULL, False)");

            header("Location:new_mem.php");   //relocate to new page
            exit("redirecting");     //end this current scripts
          }

        }
      }
      // Admin Sign up
      else if ($adminname != "") {
        $checkAUser = mysqli_query($conn, "SELECT * FROM `account` WHERE username = '".$adminname."'");
        if (!$checkAUser) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
        }
        // Check if appropriate fields are filled
        if ($adminpass == "" || $code == "") {
          $msg = "Password and Admin Code fields are required";
        }
        // Check if password is filled
        else if ($adminpass == "") {
          $msg = "Admins must enter a password!";
        }
        // Check if password and confirm password are the same
        else if ($adminpass != $_POST["CaPassword"]) {
          $msg = "Passwords do not match.";
        }
        // Check if username exists in database
        else if($checkAUser->num_rows>0) {
          $msg = "User already exists in database!";
        }
        // Check if admin passcode is correct
        else if($code != "admin123") {
          $msg = "Invalid admin code.";
        }
        // Create account
        else {
          echo $adminname;
          echo $adminpass;
          $insertAdmin = mysqli_query($conn, "INSERT INTO `account` VALUES ('" .$adminname."','".$adminpass."', NULL, NULL, NULL, NULL, 1)");
          $msg = "Account Created!";
          if (!$insertAdmin) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
          }
        }
      }

    }
    echo $msg;

  ?>

</body>
</html>
