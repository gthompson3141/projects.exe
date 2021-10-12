<?php

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name,$email,$username,$pwd,$pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if(invalidUid($username) !== false){
        header("location: ../signup.php?error=invaliduid");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=emptyemail");
        exit();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    if(uidExists($conn, $username, $email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);

}
else if(isset($_POST["booking"])){
    $name = $_POST["name"];
    $date = $_POST["datetime"];
    $datetime = date('Y-m-d H:i:s', strtotime($_POST["datetime"]));
    $cuisine = $_POST["cuisine"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputBooking($name, $cuisine) !== false){
        header("location: ../booking.php?error=emptyinput");
        exit();
    }

    if(invalidDate($date) !== false){
        header("location: ../booking.php?error=invaliddate");
        exit();
    }

    createBooking($conn, $name, $datetime, $cuisine);
}
else if(isset($_POST["export"])){

    require_once 'dbh.inc.php';

    $sql = "SELECT cuisine FROM bookings";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $delimiter = ",";
        $filename = "res-data" . ".csv";

        // create file pointer
        $f = fopen('php://memory', 'w');

        $fields = array('Cuisine');
        fputcsv($f, $fields, $delimiter);

        // output each row
        while($row = $result->fetch_assoc()){
            $status = ($row['status'] == 1)?'Active':'Inactive';
            $lineData = array($row['cuisine']);
            fputcsv($f, $lineData, $delimiter);
        }

        // move back to file
        fseek($f, 0);

        // set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        // output all remaining data on the file pointer
        fpassthru($f);
    }
    exit;
}
else{
    header("location: ../signup.php");
    exit();
}