<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Confirmation</title>
</head>
<body>
<h1>Welcome aboard!! </h1>

<p>
    Welcome to Nepal Scout. Before you can proceed for registration, We need you to <a href='{{ url("/confirm/{$user->token}") }}'>confirm your email address</a> real quick!
</p>
</body>
</html>