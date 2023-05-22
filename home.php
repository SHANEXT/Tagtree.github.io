<?php
//starts the session
session_start();
//visits counter
$total_visits = 0;
//gets the current user IP address
$ipaddress = $_SERVER['REMOTE_ADDR'];
//for simulation
//$ipaddress = '143.121.3.0'; for simulation
$_SESSION['ipAddress'] = $ipaddress;
$storedIpAddress = $_SESSION['ipAddress'];

$conn = mysqli_connect('localhost', 'root', '', 'tagpunosigninup');

if (!$conn) {
    echo 'Connection Failed : ' . mysqli_error();
} else {
    //query to check if the current user IP address exists in the database
    $sqlqry = "SELECT IP_ADDRESS FROM IP_ADD_LIST WHERE IP_ADDRESS = '$storedIpAddress'";
    $result = mysqli_query($conn, $sqlqry);

    //executing the query
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 0) {
        //query to insert the new IP address
        $sqlqry2 = "INSERT INTO IP_ADD_LIST (IP_ADDRESS) VALUES ('$storedIpAddress')";
        $result2 = mysqli_query($conn, $sqlqry2);
        $total_visits += 1;
        header("Refresh:0");
    } else {
        //query to get the total visits based on the unique IP address
        $sqlqry2 = "SELECT COUNT(*) AS TOTAL FROM IP_ADD_LIST";
        $result = mysqli_query($conn, $sqlqry2);
        $row = mysqli_fetch_assoc($result);
        $total_visits = $row["TOTAL"];
    }
}

echo '<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>TagTree</h1>
        <h1>Welcome</h1>
        <p>You are logged in!</p>
        <p>Sorry We are on maintenance! So please come back a little later</p>
        <p> Total Visits: <br />' . $total_visits . '</p>
        <form action="logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
    </div>
    <footer>SHANE AUDREY R. TAGPUNO</footer>
</body>
</html>';
?>
