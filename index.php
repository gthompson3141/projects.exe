<?php
    include_once 'header.php';
?>

<?php if(isset($_SESSION["useruid"])){
    echo '<form class="booking">
    <section class="intro-title">
        <h2>Reservations</h2>
        <button type="submit" name="export">Export Data</button> 
    </section>
    <table><br></br>
    <tr>
        <th>Name</th>
        <th>Date/Time</th>
        <th>Cuisine</th>
    </tr>';
}else{
    echo "<h2>Please Login to see reservations</h2>";
}
?>


<?php if(isset($_SESSION["useruid"])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phpproject01";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT name, dateTime, cuisine FROM bookings";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo  "<tr><td>" . $row["name"]. "</td><td>" . $row["dateTime"]. "</td><td>" . $row["cuisine"] . "</td></tr>";
            }
            echo "</table><br></br>";
        } else {
            echo "0 results";
        }

        mysqli_close($conn);
        
        echo '<button class="new-booking" type="button" ><a href="booking.php">New Booking</a></button>
        </form>';
    }
?>

<?php
    include_once 'footer.php';
?>