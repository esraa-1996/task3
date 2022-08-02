<html>
   <body>

      <form action = "<?php $_PHP_SELF ?>" method = "GET">
        firstname : <input type = "text" name = "name" />
         lastname: <input type = "text" name = "name" />
      email  : <input type = "text" name = "text" />
         <input type = "submit" />
      </form>

   </body>
</html>




<?php

// Create connection
$conn = new mysqli("localhost", "root", "","myDB");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
$sql = "CREATE TABLE MyTable (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),

)";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}




$stmt = $conn->prepare("INSERT INTO MyTable (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);


echo "New records created successfully";

$stmt->close();


$conn = new mysqli("localhost", "root", "","myDB");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$result = mysqli_query($conn, "SELECT * FROM MyTable");
$all_property = array();

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '</td>'; //get items using property value
    }
    echo '</tr>';
}
echo "</table>";
$conn->close();
?>
