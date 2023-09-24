<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Credentials</title>
</head>

<body>
    <h1>Welcome to Our System</h1>

    <p>Your login credentials for our system are:</p>

    <ul>
        <li><strong>Username:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>
        To log in, please click the following link:
        <a href="{{ route('login') }}">Login Now</a>
    </p>

    <p>Thank you for using our system!</p>
</body>

</html>