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
    <title>Admin Page</title>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
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
    </style>
</head>
<body>
    <?php
        if($_SESSION["email"] && $_SESSION["role"] == "admin") {
    ?>
    <div class="wrapper">
        <div class="page-container">
            <div class="add-items-container" id="add-items">
                <div class="container">
                    <button type="button" class="close-button button" onclick="closeAddItems()">
                        <img src="../icons/close.svg" alt="close" id="close-icon">
                    </button>
                    <div class="title"><h2>Add New Centres</h2></div>
                    <form action="insert-centre.php" method="post" autocomplete="off">
                        <table class="entry-table">
                            <thead>
                                <tr>
                                    <th>Centre Name</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody id="add-item-table">
                                <tr>
                                    <td>
                                        <input type="text" id="name" class="input-box" name="name" placeholder="Enter centre name" required>
                                    </td>
                                    <td>
                                        <input type="text" id="price" class="input-box" name="location" placeholder="Enter location" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="buttons-row">
                            <button type="submit" class="button" name="update" value="">
                                <img src="../icons/done.svg" alt="">
                                <p>Insert</p>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <div class="container">
                    <div class="title">
                        <h1>Welcome <?php echo $_SESSION["firstName"]; ?> !</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="container">
                    <h1 class="title">Vaccination Center Details</h1>
                </div>
                <form action="" method="post" autocomplete="off">
                <div class="table-responsive"> 
                    <table id="centres-table" class="entry-table">
                        <thead>
                            <tr>
                                <th>Centre Name</th>
                                <th>Location</th>
                                <th>Vaccinations Today</th>
                            </tr>
                        </thead>
                        <tbody id="add-item-table">
                            <?php  
                                if($_SESSION["role"] == "admin") {
                                    $query="SELECT * FROM centres ORDER BY centre_name;";
                                    $result = mysqli_query($conn, $query);

                                    $i = 0;

                                    while($row = mysqli_fetch_array($result)) {  
                                        echo ' 
                                        <tr>
                                            <td>'.$row["centre_id"].'</td>
                                            <td>'.$row["centre_name"].'</td>
                                            <td>'.$row["location"].'</td>
                                        </tr> 
                                        ';  
                                        $i++;
                                    }
                                }
                            ?> 
                            
                        </tbody>
                    </table>
                </div>
                </form>
                <button onclick="addNewItems()" class="button">
                    <img src="../icons/add.svg" alt="">
                    <p>Add New Centre</p>
                </button>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/jquery/export/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
                $('#centres-table').DataTable();
            } );
    </script>
    <?php
    }
    else
        header("Location:../../");
    ?>
</body>
</html>