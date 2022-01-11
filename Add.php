<?php
$host = $_POST["host"];
$user = $_POST["user"];
$pass = $_POST["password"];
$dbName = $user;

// build the connection ...
$conn = new mysqli($host, $user, $pass , $dbName);
if ($conn->connect_error)
        die("Could not connect:".mysqli_connect_error());
else
        echo "Adding ingedients to the Store's Inventory";      
      // try and create the table (if it does not exist) ...
$queryString = "create table if not exists Inventory".
               " (Iname char(100), Quan int DEFAULT 0, PRIMARY KEY (Iname))";
if (! $conn->query($queryString))
   die("Error creating table: " . $conn->error() );
//Insert into with the PRIMARY KEY should allow insert to be 'ran' without changing table
$stmt = $conn->prepare("insert into Inventory(Iname) values (?)");
$stmt->bind_param( "s", $Iname);
$Iname = $_POST["Iname"];
$stmt->execute();
//Update the inventory to the right quanity
$stmt = $conn->prepare("UPDATE Inventory SET Quan = Quan + ? WHERE Iname = ?");
$stmt->bind_param( "ss",  $quanity, $Iname);
$Iname = $_POST["Iname"];
$quanity = $_POST["Quan"];
$stmt->execute();
// close connection
$conn->close();
echo " ... Your Ingredients Have been Added";  
?>
<p><a href="Add.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add More to Inventory </a></p>
<p><a href="Buy.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Buy ingredients for another recipe from the store </a></p>
<p><a href="Create.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add Another Ingredient </a></p>
<p><a href="List.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Look up a Recipe</a></p>
<p><a href="MainMenu.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Go Back to Main Menu </a></p>
