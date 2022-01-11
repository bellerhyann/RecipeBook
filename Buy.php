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
        echo "Selecting the ingredients to buy for the Recipe... ";
//Connection Built

//Start Transaction
$queryString = "START TRANSACTION";
$conn->query($queryString);
//Update Inventory (only works for one ingredient recipies)
$stmt = $conn->prepare("UPDATE Inventory SET Quan = (SELECT Inventory.Quan - Recipe.Quan FROM Recipe, Inventory WHERE Recipe.Iname = Inventory.Iname AND Rname = ?) WHERE Iname = (Select Iname FROM Recipe WHERE Rname = ?)");
$stmt->bind_param( "ss",  $Rname, $Rname);
$Rname = $_POST["Rname"];
$stmt->execute();

//Return the lowest value
$quanity = mysql_query("SELECT MIN(Quan) FROM Inventory");
$result = mysql_fetch_array($quanity);
//Check for 0's in enventory
if($result['Quan']<0)
	{
	$queryString = "ROLLBACK";
	$conn->query($queryString);
	echo "Sorry but we do not have the supplies for that recipe at this time.";
	}
else
	{
	$queryString = "COMMIT";
	$conn->query($queryString);
	echo "You have just recieved your items needed for your recipe.";
	}


?>
<p><a href="Buy.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Buy ingredients for another recipe from the store </a></p>
<p><a href="Create.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add Another Ingredient </a></p>
<p><a href="List.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Look up a Recipe</a></p>
<p><a href="Add.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add ingredients to store Inventory </a></p>
<p><a href="MainMenu.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Go Back to Main Menu </a></p>
