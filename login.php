<?php
session_start();
if(isset($_POST['kode'])){
    if($_POST['kodeInput'] === "admingtg"){
        $_SESSION['login'] = true;
        header("Location:index.php");
    }
    else{
        echo "
        <script>
        alert('Password salah')
        </script>
        ";
        return false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <div style=" padding-top: 240px;display: flex;
    justify-content: center;  ">
        <div style="height: auto; width: 50%; background: ; border-radius: 5px;">
            <div>
                <form action="" method="post">
                    <label for="kode">kode admin</label>
                    <input type="password" name="kodeInput">
                    <button name="kode">submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>