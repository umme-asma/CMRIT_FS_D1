<!DOCTYPE html>
<?php
    session_start();
    include("config.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <title>COVID Vaccination</title>
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        
        .wrapper {
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .title {
            width: auto;
            margin: 15px 0;
            text-align: center;
        }

        .container img {
            height: 100%;
        }

        #search-bar {
            margin: 0 15px 0 0;
        }

        #logout-button {
            top: 15px;
            right: 15px;
            position: absolute;
        }

    </style>
</head>
<body>
    <?php
        if($_SESSION["email"]) {
        ?>
        <div class="wrapper">
            <div class="page-container">
                <div id="logout-button" class="logout-button" onclick="location.href='logout.php'">
                    <button class="button">
                        <p>Logout</p>
                    </button>
                </div>
                <div class="container">
                    <div class="container">
                        <div class="title">
                            <h1>Welcome <?php echo $_SESSION["firstName"]; ?> !</h1>
                        </div>
                    </div>
                </div>
                <form action="">
                    <div class="container">
                        <h1 class="title">Search For Vaccination Centers</h1>
                    </div>
                    <div class="container">
                        <div class="buttons-row">
                            <input id="search-bar" class="input-box" name="keyword">
                            <button type="submit" class="button">
                                <img src="../icons/search.svg" alt="">
                                <p style="margin-left: 10px;">Search</p>
                            </button>
                        </div>
                    </div>
                </form>

                <?php 
                    if (isset($_POST['submit'])) {
                        $query= "SELECT * FROM centres WHERE centre_name LIKE %".$_POST['keyword']."%;"; 
                        $result = mysqli_query($conn, $query);
                    } else {
                        $query="SELECT * FROM centres ORDER BY centre_name;";
                        $result = mysqli_query($conn, $query);
                    }

                    while($row = mysqli_fetch_array($result)){
                        echo '
                            <div class="centres">
                                <div class="centre-container">
                                    <div class="centre">
                                        <h2 class="centre-name">'.$row["centre_name"].'</h2>
                                        <h4 class="location">'.$row["location"].'</h4>
                                        <h4 class="location">None</h4>
                                    </div>
                                    <button class="button">Apply Now</button>
                                </div>
                            </div>
                        ';
                    }
                ?>

                
            </div>
        </div>
        <script type="text/javascript" src="../js/main.js"></script>
    <?php
        }
        else
            header("Location:../../");
    ?>
    </body>
</html>