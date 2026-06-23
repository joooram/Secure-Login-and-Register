<?php
require 'db.php'; // Include database connection
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Securely hash the password using password_hash()
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    // FIX: Wrap the execute() command in a try-catch block to handle duplicate emails gracefully
    try {
        $stmt->execute();
        $message = "<div class='success-msg'>Registration successful! <a href='login.php'>Login here</a></div>";
    } catch (mysqli_sql_exception $e) {
        // Error code 1062 means "Duplicate entry" in MySQL
        if ($e->getCode() == 1062) {
            $message = "<div class='error-msg'>Error: That email address is already registered.</div>";
        } else {
            $message = "<div class='error-msg'>Error: Could not register. Please try again.</div>";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { 
            display: flex; 
            height: 100vh; 
            background-color: #0f1511; 
            color: #fff; 
            justify-content: center; 
            align-items: center;     
        }
        
        /* Form Card */
        .form-card {
            background-color: #1c2621;
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .form-card h2 { text-align: center; font-size: 1.8rem; margin-bottom: 10px; font-weight: 600; }
        .form-card .sub-heading { text-align: center; font-size: 0.9rem; color: #a1a1aa; margin-bottom: 30px; }
        .form-card .sub-heading a { color: #4ade80; text-decoration: none; font-weight: 500; }

        /* Form Elements */
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 0.85rem; margin-bottom: 8px; color: #d4d4d8; font-weight: 500; }
        input[type="text"], input[type="email"], input[type="password"] {
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
            margin-top: 10px;
        }
        button:hover { background-color: #22c55e; }

        /* Messages */
        .success-msg { color: #4ade80; background: #064e3b; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 0.9rem;}
        .error-msg { color: #f87171; background: #7f1d1d; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; font-size: 0.9rem;}
        .success-msg a { color: #fff; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>Register</h2>
        <p class="sub-heading">Already have an account? <a href="login.php">Login here</a></p>
        
        <?php if($message != "") echo $message; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="e.g. Juan Dela Cruz" required>
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="e.g. juan@gmail.com" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create a password" required>
            </div>
            
            <button type="submit">Create Account</button>
        </form>
    </div>

</body>
</html>