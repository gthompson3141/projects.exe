<?php
    include_once 'header.php';
?>

<section class="booking-form">
    <h2>New Booking</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Restaurant Name...">
        <input type="datetime-local" name="datetime" >
        <input type="text" name="cuisine" placeholder="Cuisine...">
        <button type="submit" name="booking">Complete Booking</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == 'emptyinput') {
            echo "<p>Fill in all fields!</p>";
        }
        else if($_GET["error"] == 'invaliddate'){
            echo "<p>Enter valid date!";
        }
        else if($_GET["error"] == 'stmtfailed'){
            echo "<p>Something went wrong!";
        }
        else if($_GET["error"] == 'none'){
            echo "<p>Booking Complete!";
        }
    }
    ?>
</section>

<?php
    include_once 'footer.php';
?>