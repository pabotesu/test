<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid darkcyan;
}
</style>
</head>
<body>

<?php
$servername = "127.0.0.1:53070";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "localdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>user_id</th><th>userid2</th><th>username</th><th>email</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>";
        echo $row["user_id"];
        echo "</td><td>";
        echo $row["userid2"];
        echo "</td><td> ";
        echo $row["username"];
        echo "</td><td>";
        echo $row["email"];
        echo "</td></tr>";
       

    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?> 

</body>
</html>