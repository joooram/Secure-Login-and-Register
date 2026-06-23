<?php
session_start(); // Start the session

// Check if user is logged in (session variable is set)
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { 
            background-color: #0f1511; 
            color: #fff; 
        }
        
        /* Top Navigation Bar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #024423;
            padding: 15px 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            border-bottom: 1px solid #2d3d34;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f3f3f3;
            letter-spacing: 1px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .welcome-text {
            color: #d4d4d8;
            font-weight: 500;
        }

        .welcome-text strong {
            color: #fff;
        }

        /* Logout Button */
        .logout-btn {
        padding: 8px 18px;
        background-color: #5e2004; 
        color: #ddd3d3;                
        border: 2px solid #5e2004;    
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        }

        .logout-btn:hover { 
        background-color: #ad1b1b;     
        color: #fdfffe;                
        }

        /* Main Content Container */
        .main-content {
            padding: 60px 20px;
            text-align: center;
        }

        .main-content h2 {
            font-size: 2rem;
            margin-bottom: 50px;
            font-weight: 600;
            color: #fff;
        }

        /* Team Grid (Centered) */
        .team-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
        }

        /* Individual Member Card */
        .member-card {
            background-color: #1c2621;
            padding: 30px 20px;
            border-radius: 16px;
            width: 300x;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .member-card:hover {
            transform: translateY(-5px);
        }

        /* Round Photo Frame */
        .member-photo {
            width: 300px;
            height: 300px;
            border-radius: 50%; /* Makes it perfectly round */
            object-fit: cover; /* Ensures the image fills the circle without stretching */
            border: 4px solid #09682c; /* Theme green border */
            margin-bottom: 20px;
            background-color: #2d3d34; /* Fallback color before image loads */
        }

        .member-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #e4e4e7;
            text-align: center;
            line-height: 1.4;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">Dashboard</div>
        <div class="navbar-right">
            <div class="welcome-text">
                Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
            </div>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>

    <main class="main-content">
        <h2>Team Carol</h2>
        
        <div class="team-container">

            <div class="member-card">
                <img src="Noriel.png" alt="Noriel P. Mauhay" class="member-photo">
                <div class="member-name">Noriel P. Mauhay</div>
            </div>

            <div class="member-card">
                <img src="Joram.png" alt="Marl Joram M. Mapa" class="member-photo">
                <div class="member-name">Marl Joram M. Mapa</div>
            </div>

            <div class="member-card">
                <img src="Ace.png" alt="Ace Gabriel S. Alcantara" class="member-photo">
                <div class="member-name">Ace Gabriel S. Alcantara</div>
            </div>
        </div>
    </main>

</body>
</html>