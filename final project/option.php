<html land = "en">
<head>
  <title>GRK Clothing Warehouse</title>
  <h1>GRK Clothing Warehouse<h1>
  <h1>Select an action<h1>
  <style>
    body{
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: lightblue;
    }

  </style>
</head>
<?php
  $input = "";
?>
<body>
  <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
    <select name = "action">
      <option value = ""> Select.. </option>
      <option value = "search_store">Check inventory of a Store </option> <!-- Done -->
      <option value = "search_for_Item">Search for an Item </option> <!-- Done -->
      <option value = "update_quant">Update quantities (admins only)</option> <!-- Done -->
      <option value = "new_item">Add a new Item to the data base (admins Only)</option> <!-- Done -->
      <option value = "add_shops"> Add a new shop (admins only)</option>
      <option value = "manage employees"> Manage Employees (admins only)</option> <!-- Done -->
      <option value = "profile">Account profile</option> <!--Kevin's Working on this -->
    </select>
    <input type = "submit">
  </form>


  <!-- Manage redirect -->
  <!-- Still need to implement some of these pages + queries -->
  <?php
    $conn = mysqli_connect("localhost","root","gofyourselF2!#@","grk");
    session_start();
    $userTransfer = $_SESSION["user"];
    $jack = $_POST["action"];

    if ($jack == "search_store"){
      header("Location:search.php");
      exit();
    }
    if($jack == "profile"){

      $_SESSION["t1"] = $userTransfer;
      header("Location:profile.php");
      exit();
    }

    if( $jack == "search_for_Item"){
      header("Location:look_for_item.php");
      exit();
    }
    if ( $jack == "manage employees"){
      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:employeeManage.php");
        exit();
      }
      else{
        echo "You are not an Admin";
      }
    }

    if( $jack == "update_quant"){

      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:updateQuant.php");
        exit();
      }
      else{
        echo "You are not an Admin";
      }

    }
    if($jack == "new_item"){

      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:addItem.php");
        exit();
      }
      else{
        echo "You are not an Admin";
      }
    }

    if($jack == "add_shops"){

      //admin only thing
      $result = mysqli_query($conn, "SELECT isAdmin FROM `account` WHERE `account`.username = '".$userTransfer."'");
      $row = mysqli_fetch_array($result);
      if($row["isAdmin"] == True){
        header("Location:addShops.php");
        exit();
      }
      else{
        echo "You are not an Admin";
      }
    }




  ?>

</body>
