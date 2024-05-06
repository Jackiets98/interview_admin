<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Logistics System</title>
    <style>
        body {
            background: url('{{ asset('images/login_page.jpeg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(45deg, rgba(255, 176, 130, 0.467), transparent);
            box-shadow: 2px 4px 5px #000000, 2px 2px 6px #0386ca, 1px 2px 6px rgb(10 21 27);
            border-radius: 5px;
            border: 2px solid transparent; /* Transparent border */
            padding: 20px;
        }

        h2 {
            color: #fff;
        }

        .form {
            width: 300px;
        }

        .field {
            position: relative;
            margin-bottom: 20px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .toggle-password i {
            font-size: 18px;
            color: #999;
        }

        .toggle-password i:hover {
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px 10px;
            border: none;
            border-radius: 5px;
            margin-top: 5px;
        }

        label {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #0c0c0c;
            pointer-events: none;
            transition: 0.3s ease all;
        }

        input:focus + label,
        input:valid + label {
            top: -10px;
            left: 5px;
            font-size: 12px;
            background: #fff;
            padding: 0 5px;
            border-radius: 3px;
            color: #000;
        }

        button {
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            background: #1e90ff;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0d47a1;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <h2>Logistics System</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
        <div class="form">
            <div class="field">
                <input type="email" required spellcheck="false" name="email">
                <label>Email</label>
            </div>
            <div class="field">
                <input type="password" required spellcheck="false" name="password" id="password">
                <label>Password</label>
                <div class="toggle-password" onclick="togglePassword()">
                    <i class="fa fa-eye" id="toggleIcon"></i>
                </div>
            </div>
            <button type="submit">Submit</button>
        </div>
    </form>
    </div>

        <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.className = "fa fa-eye-slash";
            } else {
                passwordInput.type = "password";
                toggleIcon.className = "fa fa-eye";
            }
        }
    </script>

</body>
</html>
