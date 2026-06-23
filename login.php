<?php
session_start(); // Start the session
require 'db.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Authenticate using password_verify()
        if (password_verify($password, $row['password'])) {
            // Success: Set session variables and redirect
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "<div class='error-msg'>Invalid password.</div>";
        }
    } else {
        $error = "<div class='error-msg'>No user found with that email address.</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { 
            display: flex; 
            height: 100vh; 
            background-color: #0f1511; 
            color: #fff; 
            justify-content: center; /* Centers horizontally */
            align-items: center;     /* Centers vertically */
        }
        
        /* Form Card */
        .form-card {
            background-color: #1c2621;
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .form-card h2 { text-align: center; font-size: 1.8rem; margin-bottom: 30px; font-weight: 600; }

        /* Form Elements */
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.85rem; margin-bottom: 8px; color: #d4d4d8; font-weight: 500; }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            background-color: #131a16;
            border: 1px solid #2d3d34;
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.3s;
        }
        input:focus { border-color: #4ade80; }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.85rem;
        }
        .form-options a { color: #4ade80; text-decoration: none; }
        .form-options label { margin-bottom: 0; display: flex; align-items: center; gap: 5px; cursor: pointer;}
        
        button {
            width: 100%;
            padding: 14px;
            background-color: #4ade80;
            color: #064e3b;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover { background-color: #22c55e; }

        .error-msg { color: #f87171; background: #7f1d1d; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 0.9rem;}
        .footer-text { text-align: center; font-size: 0.75rem; color: #71717a; margin-top: 20px;}
        .footer-text a { color: #4ade80; text-decoration: none; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>Login</h2>
        
        <?php if($error != "") echo $error; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit">Log in</button>
        </form>
        <p class="footer-text" style="margin-top: 15px;">Don't have an account? <a href="register.php">Register here</a></p>
    </div>

</body>
</html>