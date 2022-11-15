<?php
    session_start();

    include("config.php");
    $query = "INSERT INTO login (first_name, last_name, email, password, role) VALUES ";
    $itemValues = 0;

    $trimFirstName=trim($_POST["firstname"]);
    $trimLastName=trim($_POST["lastname"]);
    $trimEmail=trim($_POST["email"]);
    $password=$_POST["password"];
    $role = "user";
    if(($trimFirstName!='')&&($trimLastName!='')&&($trimEmail!='')&&($password!='')) {
        $countQuery = "select count(*) from login where email = '" . $trimEmail . "'";
        $countResult = mysqli_query($conn, $countQuery);
        $countRow=mysqli_fetch_row($countResult);
        $count = $countRow[0];
        $queryValue = "";

        if($count == 0) {
            $itemValues++;
            echo $itemValues;
            $queryValue = "('" . $trimFirstName . "','" . $trimLastName . "','" . $trimEmail . "', PASSWORD('" . $password . "'),'" . $role . "')";
            $sql = $query.$queryValue;
            mysqli_query($conn, $sql);
        }
    }
    if($itemValues==0) {
        echo "<script>
                    alert('You're already registred, please login!');
                    window.location = '../../';
                </script>";
    } else {
        echo $trimFirstName;
        echo "<script>
                alert('You're signed up successfully!');
            </script>";
    }
?>