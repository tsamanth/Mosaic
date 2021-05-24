
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "on");

    $server = "spring-2021.cs.utexas.edu";
    $loginuser = "cs329e_bulko_tvshah";
    $loginpwd = "bogus3shrewd2hamlet";
    $dbName = "cs329e_bulko_tvshah";
    
    $mysqli = new mysqli($server, $loginuser, $loginpwd, $dbName);

    if ($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno . ": " .  $mysqli->connect_error);
    } 

    $mysqli->select_db($dbName) or die($mysqli->error);
    $user = $_GET["user"];
    $pwd = $_GET["pwd"];
    $user = $mysqli->real_escape_string($user);
    $pwd = $mysqli->real_escape_string($pwd);
    $countquery = "SELECT COUNT(*) FROM passwords WHERE username = '$user'";
    $num_rows = $mysqli->query($countquery)->fetch_row()[0];
    if ($num_rows == 0) {
            $insertquery = "INSERT INTO passwords VALUES ('$user', '$pwd')";
            $insertresult = $mysqli->query($insertquery) or die($mysqli->error);
            setcookie ("loggedIn", $user, time()+(60*60*24*30));
            echo "<p> You have been registered!</p>";
        
    }
    else {
                echo "<p> This username has already been taken. Please try again. </p>";
    } 
?>

