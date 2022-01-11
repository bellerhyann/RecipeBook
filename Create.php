<?php
$host = $_POST["host"];
$user = $_POST["user"];
$pass = $_POST["password"];
$dbName = $user;
// build the connection ...
$conn = new mysqli($host, $user, $pass, $dbName);
if ($conn->connect_error)
        die("Could not connect:".mysqli_connect_error());
else
        echo "Adding that ingredient into the Recipe ";
      // try and create the Recipe table (if it does not exist) ...
$queryString = "create table if not exists Recipe".
               " (Rname char(200), Iname char(100), Quan int, PRIMARY KEY (Rname, Iname))";
if (! $conn->query($queryString))
   die("Error creating table: " . $conn->error() );
   //Insert the data into the Recipe table
$stmt = $conn->prepare("insert into Recipe values (?, ? , ?)");
$stmt->bind_param( "sss", $Rname, $Iname, $quanity);
$Rname = $_POST["Rname"];
$Iname = $_POST["Iname"];
$quanity = $_POST["Quan"];
$stmt->execute();
   //Insert the name into the inventory table
$stmt->execute();

// close connection
$conn->close();


?>
<p><a href="Create.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add Another Ingredient </a></p>
<p><a href="List.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Look up a Recipe</a></p>
<p><a href="Buy.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Buy ingredients for a recipe from the store </a></p>
<p><a href="Add.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add ingredients to store Inventory </a></p>
<p><a href="MainMenu.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Go Back to Main Menu </a></p>
