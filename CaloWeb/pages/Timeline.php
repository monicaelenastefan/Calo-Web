<?php
session_start();
ini_set('memory_limit','16M');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Calo'Web</title>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="../css/Timeline.css">
  <link rel="stylesheet" href="../css/MyPlans.css">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
</head>

<body>
  <header>
    <div class="container-header">  
      <nav>
        <ul>
          <li><a href="../pages/MyProfile.php">My Profile</a><li>
          <li><a href="../pages/Timeline.php">Timeline</a><li>
          <li><a href="../pages/MyPlans.php">MyPlans</a><li>
          <li><a href="../scripts/logout.php">Sign Out</a><li>
          <div class="Username"><?php echo $_SESSION['u_first'];?> </div>       
        </ul>
      </nav>
    </div>
  </header>	
 
    
    <div class="container-create-button">
    <div>
    <?php
        
        if(@$_GET['signup']==true)
        {
        ?>
           <div  class="notification"> <?php echo $_GET['signup'] ?> 
           </div>
        <?php
        }
        
        ?>
    </div>
      <div id="create-button" >Create Plan</div>
    </div>
    
  <div class="lists" id="CevaNou"> 
      <?php
      include_once '../scripts/config.php';
      $email = $_SESSION['u_email'];

      $planuri="SELECT * from myplans1 WHERE firstname like '$email'";
      $planuri_result= mysqli_query($conn, $planuri);
      

      //$sql= "SELECT count(*) as total from myplans1 WHERE firstname like '$email'";
      //$tot= mysqli_query($conn, $sql);
      //$nr_planuri=mysqli_fetch_assoc($tot);
      $count=0;
      $planuri=array();
      while($row=mysqli_fetch_array($planuri_result))
      { 
        $count++;
        $plan = stripslashes($row['tablename']);
        array_push($planuri,$plan);
        $start_date = stripslashes($row['Sdate']);
        $emailplan=stripslashes($row['firstname']);
        $nr_days=stripslashes($row['days']);
        $gender=stripslashes($row['gender']);
        $restriction=stripslashes($row['restriction']);

        $timeline="SELECT * from timeline where email like '$emailplan' and planname like '$plan'";
        $timeline_result= mysqli_query($conn, $timeline);
        for($j = 1; $j <= $nr_days; $j++){
          //if(empty(mysqli_fetch_array($timeline_result)))
            //echo '<li>Day'.$j.'</li>';    
            if($j%7 === 1){
              echo '<div class="list"> <h4>'.$plan.':Week '. intval($j/7 + 1) .'</h4> <ul>';
              $countdays=0;
              $total_calorii = 0;
             
                while($rowtl=mysqli_fetch_array($timeline_result))
                { 
               
                $countdays++;
                $daytl = stripslashes($rowtl['days']);
                $foodtl = stripslashes($rowtl['food']);
                $gramaj = stripslashes($rowtl['gramaj']);
      
                $cal="SELECT * from food where name like '$foodtl'";
                $calres= mysqli_query($conn, $cal);
                $cal_data=mysqli_fetch_assoc($calres);
                
                $nr_calorii=intval($gramaj)*intval($cal_data['calories'])/100;
                
                $total_calorii += $nr_calorii;
                $nr=$countdays-1;
                $hei=date('Y-m-d',strtotime($start_date."+".$nr." days"));
                echo '<li>Day '. $countdays . ': ' . $hei . ' : '. $nr_calorii .'kcal</li>';
                
      
                }
               
                $i = 0;
                while($i < 7 - intval($countdays)){
                  echo '<li>Day'.(7 - intval($countdays) - $i).'</li>';
                  $i++;
      
                }
                $media_saptamanii = 0;
                if($i%7===0 || $i%5 === 0||$i%6===0||$i%4===0||$i%3===0||$i%2===0||$i%1===0){
                    if(intval($countdays) > 0){
                    echo '</ul> <footer>Average week:'. $total_calorii/intval($countdays)   .'kcal</footer> </div>';
                    $media_saptamanii = $total_calorii/intval($countdays);
                  }
                  else{
                    echo '</ul> <footer>Average week:'. $total_calorii   .'kcal</footer> </div>';
      
                  }
                }
                $count = 0;
               
              }
            }
        }
       
      ?>         		
  </div>  
  <form action="../scripts/finalstuff.php" method="get">

<div class="bg-modal">   
  <div class="modal-content"> 
    <div class="container-form">
    <div class="input_data">
      <label for="name">Plan Name</label>
      <input type="text" id="name" name="Name" placeholder="Sample..">

      <label for="name">Food</label>
      <input type="text" id="name" name="Name1" placeholder="Sample..">

      <label for="name">Gramaj</label>
      <input type="text" id="name" name="Name2" placeholder="Sample..">

  
    
      <input type="submit" name="submit" value="CREATE" class="CreateButton" onclick="myFunction();" />
    </form>
    <div class="close">+</div>  




    
  <div class="add-item-modal">
    <div class="modal-content"> 
      <div class="border">
        <div class="container-field">Search for aliment: </div>
        <input type="text" placeholder="Search..">
        <div class="container-field"> <label for="portion">Portion size in grams: </label>
        <input type="number" id="portion" name="portion" min="0" max="5000"> </div>
        <div class="container-buttons-add"> 
          <div id="save"> Save</div>
          <div id="ex-button">Close </div>
        </div>
      </div>
    </div>
  </div>

 
  <script>
    var list= document.getElementById("create-button");
    tab= [];
   
    console.log("test");
    list.addEventListener('click', function() {
      document.querySelector('.bg-modal').style.display= 'flex'; 
    });
    document.querySelector('.close').addEventListener('click', 
    function(){
      document.querySelector('.bg-modal').style.display= 'none';
    });

    var plan=document.querySelectorAll(".plan");
    
   for ( var i = 0; i< plan.length ; i++){
      plan[i].addEventListener('click', function() {
        document.querySelector('.plan-modal').style.display= 'flex'; 
      });
    }   
      document.querySelector('.close-plan').addEventListener('click', 
      function(){
        document.querySelector('.plan-modal').style.display= 'none';
    });
  </script>
<!-- 
<script>
    var list= document.getElementById("create-button-delete");
    tab= [];
   
    console.log("test");
    list.addEventListener('click', function() {
      document.querySelector('.bg-modal').style.display= 'flex'; 
    });
    document.querySelector('.close').addEventListener('click', 
    function(){
      document.querySelector('.bg-modal').style.display= 'none';
    });

    var plan=document.querySelectorAll(".plan");
    
   for ( var i = 0; i< plan.length ; i++){
      plan[i].addEventListener('click', function() {
        document.querySelector('.plan-modal').style.display= 'flex'; 
      });
    }   
      document.querySelector('.close-plan').addEventListener('click', 
      function(){
        document.querySelector('.plan-modal').style.display= 'none';
    });
  </script> -->
</body>
</html>