<?php
    session_start();

    include("config.php");
    $query = "INSERT INTO centres (centre_name, location) VALUES ";
    $itemValues = 0;

    $trimCentreName=trim($_POST["name"]);
    $trimLocation=trim($_POST["location"]);

    if(($trimCentreName!='')&&($trimLocation!='')) {
        $countQuery = "select count(*) from centres where centre_name = '" . $trimCentreName . "'";
        $countResult = mysqli_query($conn, $countQuery);
        $countRow=mysqli_fetch_row($countResult);
        $count = $countRow[0];
        $queryValue = "";

        if($count == 0) {
            $itemValues++;
            echo $itemValues;
            $queryValue = "('" . $trimCentreName . "','" . $trimLocation . "')";
            $sql = $query.$queryValue;
            mysqli_query($conn, $sql);
        }
    }
    if($itemValues==0) {
        echo "<script>
                    alert('Centre Already Exists!');
                    window.location = 'admin-page.php';
                </script>";
    } else {
        echo "<script>
                alert('New Centre Added!');
                window.location = 'admin-page.php';
            </script>";
    }
?>