<?php
session_start();
include '../backend/koneksi.php'; // pastikan path sesuai

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cari username di database
    $query = "SELECT * FROM admin WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Cek password menggunakan password_verify
    if ($data && password_verify($password, $data['password'])) {
        // Login berhasil
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php"); // ganti sesuai halaman dashboard kamu
        exit;
    } else {
        // Login gagal
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2B48C;
            --accent-color: #A0522D;
            --light-color: #F5F5DC;
            --dark-color: #5D2906;
            --text-color: #333;
            --white: #fff;
            --gold: #FFD700;
            --transition: all 0.3s ease;
        }
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--light-color); color: var(--text-color);
               display:flex; justify-content:center; align-items:center; height:100vh; padding:1rem; }
        .login-container { background-color: var(--white); padding:3rem; border-radius:15px;
                           box-shadow:0 10px 30px rgba(0,0,0,0.1); max-width:400px; width:100%; text-align:center; }
        .login-container h2 { color: var(--primary-color); margin-bottom:2rem; }
        .login-container form { display:flex; flex-direction:column; gap:1.2rem; }
        .login-container label { text-align:left; font-weight:500; color: var(--dark-color); }
        .login-container input[type="text"],
        .login-container input[type="password"] { padding:0.8rem; border:1px solid #ccc; border-radius:8px; font-size:1rem; }
        .login-container button { padding:0.8rem; background-color:var(--primary-color); color:var(--white);
                                  border:none; border-radius:8px; font-size:1rem; font-weight:600; cursor:pointer;
                                  transition:var(--transition); }
        .login-container button:hover { background-color: var(--accent-color); }
        .error { color:red; margin-bottom:1rem; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
