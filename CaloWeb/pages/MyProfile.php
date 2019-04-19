<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>My Profile Calo'Web</title>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="../css/MyProfile.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<header>
	 	<div class="container-header">
      <nav>
        <ul>
          <li><a href="MyProfile.php">My Profile</a><li>
					<li><a href="Timeline.php">Timeline</a><li>
					<li><a href="MyPlans.php">My Plans</a><li>
					<li>
                        <a href="logout.php">Sign Out</a>
                    <li>
                    <div class="Username"><?php echo $_SESSION['u_first'];?> </div>
        </ul>
      </nav>
    </div>
	</header>	

	<div class="container">
		<div class="paragraphs">
			<p>Name:</p>
			<p>E-mail:</p>
			<p>Password:</p>
			<p>Motivation:</p>
			<p>Weight:</p>
		</div>
		<div class="boxes">
			<input type="text" name="name" value="MyName" readonly><br>
			<input type="email" name="email" value="myemail@mail.com" readonly><br>
			<input type="password" name="password" value="MyPassword" readonly><br>
			<input type="text" name="motivation" value="MyMotivation" readonly><br>
			<input type="number" name="weight" value="65" readonly><br>
		</div>
		<div class="buttonsave">
			<input class="SaveButton" type="submit" value="Save" onclick="myFunction()">
		</div>
		<div class="editbutton">
			<input class="EditButton" type="submit" value="Edit" onclick="myFunction1()">
		</div>
		<script>
			function myFunction1()
			{
				document.getElementById("toedit").readOnly=false;
			}
			function myFunction()
			{
				document.getElementById("toedit").readOnly=true;
			}
		</script>
	</div>
	
</body>
</html>