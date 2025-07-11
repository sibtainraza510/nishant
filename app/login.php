<?php
session_start();
include __DIR__ . '/../DB_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // ✅ Correct way to get result
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $user = $res->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            if ($user['role'] == 'admin') {
                header("Location: ../index.php");
            } else {
                header("Location: ../employee.php");
            }
            exit();
        } else {
            header("Location: ../login.php?error=Incorrect+password");
            exit();
        }
    } else {
        header("Location: ../login.php?error=User+not+found");
        exit();
    }
}
?>
