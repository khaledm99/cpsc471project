<?php     session_start(); ?>
<style type = "text/css">
    body {
        background-color: #37FF8B;
        margin: 100px;
        color: #457B9D; 

    }
    h1 {
        text-align: center;
        font-family: tahoma;
        margin: 50px;
    }
    form {
        text-align: center;
        font-family: tahoma;
    }
    div {
        text-align: center;
        font-family: tahoma;
    }
    input[type=text] {
        border: none;
    }
    input[type=button], input[type=submit] {
        border: none;
        border-radius: 2px;
        font-size: 18px;
        padding: 10px;
    } 
    input[type=submit]:hover {
        color: #E63946;
    }

</style>
<body>
<?php
    $connection = mysqli_connect("localhost","root","password","main");
    if(!$connection) {
        exit("there was an error".mysqli_connect_errno());
    } 

    echo "<h1>Welcome, " . $_SESSION['username'] ."</h1>";
    if (isset($_POST['Logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php?=loggedout");
    }
?>

<form action="wishlist.php">
    <input type = "submit" name = "Wishlist" value = "View Wishlist">
</form>
<form action="sup_report.php">
    <input type = "submit" name = "sup_report" value = "View Super-Collection Report">
</form>
<form action="dashboard.php" method="post">
    <input type = "submit" name = "Logout" value = "Logout">
</form>
</body>