
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SignIn to Calo'Web</title>
    <link rel="stylesheet" href="SignIn.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div class="container-header">
            <nav>
                <ul>
                    <li><a href="Features.html">Features</a><li>
                    <li><a href="index.html">Home</a><li>
                    <li><a href="SignIn.php">Sign In</a><li>
                    <li><a href="SignUp.html">Sign Up</a><li>
                </ul>
            </nav>
        </div>       
    </header>

    <div class="container">
        <div class="center-text">CALO'WEB Sign In</div>
        <div class="left-wheel" ></div>
        <div class="right-wheel"></div>

        <div class="input_data">
            <form action="login.php" method="post" >
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="E-mail..">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"  placeholder="Password..">
                <input id="button-log" type="submit" name="submit" value="SUBMIT">
            </form>
        </div>
    </div>
</body>
</html>