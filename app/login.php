<?php
session_start();
include '../db.php'; // go one folder up to include DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];  // 'user_name' comes from form input
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            if ($user['role'] == 'admin') {
                header("Location: ../admin.php");
                exit();
            } else {
                header("Location: ../employee.php");
                exit();
            }
        } else {
            header("Location: ../login.html?error=Incorrect+password");
            exit();
        }
    } else {
        header("Location: ../login.html?error=User+not+found");
        exit();
    }
}
?>
