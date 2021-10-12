<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Booking</title>
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <h1  id="site-title" href="index.php">Restaurant Booking</h1>
            <ul>
                <li><a href="index.php">Reservations</a><li>
                <?php
                    if(isset($_SESSION["useruid"])){
                        echo "<li><a>User: " . $_SESSION["useruid"] . "</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    }
                    else{
                        echo "<li><a href='signup.php'>Sign up</a></li>";
                        echo "<li><a href='login.php'>Log in</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>
