
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SignIn to Calo'Web</title>
    <link rel="stylesheet" href="../css/SignUpSignIn.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <div class="container-header">
            <nav>
                <ul>
                    <li><a href="../pages/Features.html">Features</a><li>
                    <li><a href="../index.html">Home</a><li>
                    <li><a href="../pages/SignIn.php">Sign In</a><li>
                    <li><a href="../pages/SignUp.php">Sign Up</a><li>
                </ul>
            </nav>
        </div>       
    </header>

    <div class="container">
        <div class="center-text">CALO'WEB Sign In</div>
        <div class="left-wheel" ></div>
        <div class="right-wheel"></div>

        <div class="input_data">
            <form action="../scripts/login.php" method="post" >
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="E-mail..">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"  placeholder="Password..">
                <input type="submit" name="submit" value="SUBMIT" class="SubmitButton">
            </form>
            
            <?php
        
                if(@$_GET['login']==true)
                {
            ?>
                <div  class="notification"> <?php echo $_GET['login'] ?> 
                </div>
            <?php
                }
        
            ?>
        </div>
    </div>
</body>
</html>