<?php
require 'functions.php'; 

if( isset($_POST["login"]) ) {

   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

   // Cek username
   if( mysqli_num_rows($result) === 1 ) {

     // Cek password
     $row = mysqli_fetch_assoc($result);
     if( password_verify($password, $row["password"]) ) {
         header("Location: index.php");
         exit;
     }

   }

   $error = true;

}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>

<h1>Halaman Login</h1>

<?php if( isset($error) ) : ?>
    <p style="color: blue; font-style: italic;">username / password salah</p>
<?php endif; ?>

<form action="" method="post">

    <ul>
        <li>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>

</form>


</body>
</html>