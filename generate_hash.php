<?php
$password = "admin123"; // Change this to the password you want to hash
$hashed = password_hash($password, PASSWORD_DEFAULT);
echo "Your hashed password: <br><input type='text' value='$hashed' style='width:100%'>";
?>
