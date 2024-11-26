<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: ../authentication/login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d7e1ec, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .menu-container {
            background-color: #ffffff;
            border: 4px solid;
            border-image-slice: 1;
            border-width: 3px;
            border-image-source: linear-gradient(to right, #003366, #4CAF50);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .menu-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .menu-container h1 {
            font-size: 2.2em;
            color: #003366;
            margin-bottom: 30px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .menu-container .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
        }

        .menu-container .btn-primary {
            background-color: #003366;
            color: white;
            border: none;
        }

        .menu-container .btn-primary:hover {
            background-color: #002244;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 51, 102, 0.3);
        }

        .menu-container .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .menu-container .btn-danger:hover {
            background-color: #c0392b;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(231, 76, 60, 0.3);
        }

        footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        /* Responsive Styling */
        @media (max-width: 600px) {
            .menu-container {
                padding: 20px;
            }

            .menu-container h1 {
                font-size: 1.8em;
            }

            .menu-container .btn {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <h1>Main Menu</h1>
        <a href="../crud/index.php" class="btn btn-primary">
            <i class="fas fa-database"></i> View Database
        </a>
        <a href="../dashboard/index.html" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <footer>
        <p>&copy; 2024 Created By | Anindia Atikah Putri.</p>
    </footer>
</body>
</html>
