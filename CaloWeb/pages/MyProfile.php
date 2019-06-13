<?php
session_start();
include_once '../scripts/config.php';
$email = $_SESSION['u_email'];
$sql= "SELECT * from timeline WHERE email like '$email'";
$result = mysqli_query($conn, $sql);
$count = 0;
$suma = 0;
while($row = $result->fetch_assoc()){
	$count++;
	$food= $row["food"];
	$sql1= "SELECT * from food WHERE name like '$food'";
	$result1 = mysqli_query($conn, $sql1);
	while($rows = $result1->fetch_assoc()){

		$suma = $suma + ($row["gramaj"] * $rows["calories"]) / 100;
		
	}
	
}
$_SESSION['total_calorii'] = $suma;

$sql2= "SELECT * from users WHERE email like '$email'";
$result2 = mysqli_query($conn, $sql2);
$greutate_ideala = 0;
while($rowss = $result2->fetch_assoc()){
	$greutate_ideala++;
	//$greutate_ideala = $greutate_ideala + ();
	$sql3= "SELECT * from myplans1 WHERE firstname like '$email'";
	$result3 = mysqli_query($conn, $sql3);
	while($rowsss = $result3->fetch_assoc()){
		$gender = $rowsss["gender"];
		
	}
		$greutate_ideala = ($greutate_ideala + (10 * $rowss["weight"] + 6.25 * $rowss["height"] - 5*$rowss["age"] + 5)) /100;
	
	

		
}

$_SESSION['RBM'] = $greutate_ideala;
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
			<p>Medie totala:</p>
			<p>Sugestii exercitii:</p>
			
			<p>Rata Metabolica de Baza:</p>
			
		</div>
		<div class="boxes">
			<input type="text" name="name" value="<?php echo $_SESSION['total_calorii']; ?>" readonly><br>
			<input type="email" name="email" value="<?php
			 if($_SESSION['RBM'] > 1.2 && $_SESSION['RBM'] < 1.3) {echo " Munca sedentara si putine alte activitati"; } 
			 else if($_SESSION['RBM'] > 1.3 && $_SESSION['RBM'] < 1.6) {echo " Munca in picioare sau exercitii usoare 1-3 zile pe saptamana"; }
			 else if($_SESSION['RBM'] > 1.6 && $_SESSION['RBM'] < 1.8) {echo " Activitati zilnice moderate sau exercitii 5-6 zile pe saptamana" ;}
			 else  {echo " Esti in forma tine-o tot asa";}
			 
			
			?>" readonly><br>
		
			<input type="text" name="motivation" value="<?php echo $_SESSION['RBM'] ?>" readonly><br>
		
		</div>
	
		
	</div>
	
</body>
</html>