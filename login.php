<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form Design</title>
    <style>
        body {
            background-image: url('https://www.idfcfirstbank.com/content/dam/idfcfirstbank/images/blog/importance-of-having-savings-717x404.jpg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .box img.user {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border-radius: 50%;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="box">
       <img src="data:image/png;base64,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" class="user">
        <h1>Register Here</h1>
        <form name="myform2" action="register.php" method="POST" aria-label="Register Form">
            <p><label for="username">Username</label></p>
            <input type="text" id="username" name="uname1" placeholder="Enter Username" required>
            <p><label for="email">Email</label></p>
            <input type="email" id="email" name="email" placeholder="Enter Email ID" required>
            <p><label for="password">Password</label></p>
            <input type="password" id="password" name="upswd1" placeholder="Enter Password" required>
            <p><label for="confirm-password">Retype Password</label></p>
            <input type="password" id="confirm-password" name="upswd2" placeholder="Re-Enter Password" required>
            <input type="submit" value="Register">
            <br><br>
            <a href="log.php">Existing user? Login!</a>
        </form>
    </div>
</body>
</html>
