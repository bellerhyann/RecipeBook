<?php

$host = $_POST["host"];
$user = $_POST["user"];
$pass = $_POST["password"];

//remember, for our purposes the DB is the same as the username ...
$dbName = $user;

// build the connection ...
$conn = new mysqli($host, $user, $pass, $dbName);

if ($conn->connect_error)
        die("Could not connect:".mysqli_connect_error());
else
        echo " connected!<br>";
         
$stmt = $conn->prepare("SELECT * FROM Recipe WHERE Rname = ?");
$stmt->bind_param( "s", $Rname);
$Rname = $_POST["Rname"];
$stmt->execute();

$stmt->bind_result($Rname, $Iname, $Quan); 
// print table header
echo "<table border=1>";
echo "<tr> <th>Recipe</th> <th>Ingredient </th> <th>Quanity</th> </tr>";
// as long as there are more rows in result, pull next row into 
//    bound variables (see bind_result() above)
while($stmt->fetch() ) 
    {
        echo "<tr> <td>".$Rname."</td>". 
                  "<td>".$Iname."</td>". 
                  "<td>".$Quan."</td> </tr>";
    }

echo "</table>";

// close connection
$conn->close();

?>
<p><a href="List.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Look at another Recipe</a></p>
<p><a href="MainMenu.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Go Back to Main Menu </a></p>
<p><a href="Create.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Create a recipe or add ingredient to a recipe </a></p>
<p><a href="Buy.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Buy ingredients for a recipe from the store </a></p>
<p><a href="Add.html" target="Option 1" rel="a" hreflang="en" type="text/html"> Add ingredients to store Inventory </a></p>
