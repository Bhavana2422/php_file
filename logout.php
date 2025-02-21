<!DOCTYPE html>
<html>
<head>
    <title>Logout Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 100px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            opacity: 0; /* Initially hidden */
            transform: translateY(-20px);
            animation: fadeIn 1s ease-in-out forwards; /* Fade-in animation */
        }
        h2 {
            color: #28a745;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            text-decoration: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        a:hover {
            background: #0056b3;
            transform: scale(1.05); /* Slight zoom effect */
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>✅ Logout Successful!</h2>
        <a href="login.php">🔑 Login Again</a>
    </div>
</body>
</html>
