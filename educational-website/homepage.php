<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome page</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .btn a {
            color: white;
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <div style="text-align:center; padding:15%;">
        <p style="font-size:50px; font-weight:bold;">
            WELCOME 
            <?php 
            if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];
                $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                while($row=mysqli_fetch_array($query)){
                    echo $row['firstName'].' '.$row['lastName'];
                }
            }
            ?>
            !
        </p>
        <div>
            <button class="btn"><a href="home-page.html">CONTINUE</a></button>
        </div>
        <p></p>
        <div>
            <button class="btn"><a href="logout.php">LOGOUT</a></button>
        </div>
    </div>
</body>
</html>
