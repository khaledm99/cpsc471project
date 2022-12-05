<?php     session_start(); ?>

<html>
<style type = "text/css">
    body {
        background-color: #37FF8B;
        /* background-image: url(bg3.png); */
        background-repeat: no-repeat;
        background-size: cover;
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
    $connection = mysqli_connect("localhost","root","","main");
    if(!$connection) {
        exit("there was an error".mysqli_connect_errno());
    } 

    $username = $_SESSION['username'] ;
    if (isset($_POST['Logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php?=loggedout");
    }

    $query = "SELECT SYSTEM_REPORT.Timestamp,GENERATES_SYS_REPORT.Admin_username FROM SYSTEM_REPORT,GENERATES_SYS_REPORT where SYSTEM_REPORT.Timestamp = GENERATES_SYS_REPORT.Report_timestamp";
    if($prepared_query = mysqli_prepare($connection, $query)){
        mysqli_stmt_bind_param($prepared_query, 's', $username);
        if(mysqli_stmt_execute($prepared_query)){
            $result = mysqli_stmt_get_result($prepared_query);
            echo"<div>";
            while ($o = mysqli_fetch_object($result)) {
                printf("%s - generated by %s", $o->Timestamp, $o->Admin_username);
                echo ('</br>');
            }
            echo"</div>";
        } else {
            echo("<div>Error executing SQL</div>");
        }
    }
    
    
    
?>
</br>
<form action="admin_dashboard.php">
    <input type = "submit" name = "Dashboard" value = "Return to Dashboard">
</form>
<form action="view_sys_reports.php" method="post">
    <input type = "submit" name = "Logout" value = "Logout">
</form>
</body>