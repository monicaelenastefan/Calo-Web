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
      <div id="create-button" >Add Today</div>
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
            if($j%7 === 1){
              echo '<div class="list"> <h4>'.$plan.':Week '. intval($j/7 + 1) .'</h4> <ul>';
              $countdays=0;
              $total_calorii = 0;
              $prev=date('Y-m-d');
                while($rowtl=mysqli_fetch_array($timeline_result))
                { 
               
                $countdays++;
                $daytl = stripslashes($rowtl['days']);
                $foodtl = stripslashes($rowtl['food']);
                $gramaj = stripslashes($rowtl['gramaj']);

                $sqln=mysqli_query($conn,"SELECT * FROM timeline where email like '$email' and planname like '$plan' and days like '$daytl'");
                $suma_pe_zi=0;
                while($row_d=mysqli_fetch_array($sqln))
                {
                  $cal="SELECT * from food where name like '$foodtl'";
                  $calres= mysqli_query($conn, $cal);
                  $cal_data=mysqli_fetch_assoc($calres);
                  $nr=$countdays-1;
                  $hei=date('Y-m-d',strtotime($start_date."+".$nr." days"));
                  if($countdays==1)
                  {
                    $nr_calorii=intval($gramaj)*intval($cal_data['calories'])/100;
                    //echo $nr_calorii;
                    $suma_pe_zi+=$nr_calorii;
                    
                    $total_calorii += $nr_calorii;
                  }
                  if($countdays>1)
                  {
                    $nr_calorii=intval($gramaj)*intval($cal_data['calories'])/100;
                    //echo $nr_calorii;
                    $suma_pe_zi+=$nr_calorii;
                    
                    $total_calorii += $nr_calorii;
                    
                    //echo '<li>';
                    if($prev==$hei)
                    {
                      $suma_pe_zi+=$nr_calorii;
                      
                      //echo '<li>Day '. $countdays . ': ' . $hei . ' : '. $suma_pe_zi .'kcal</li>';
                    }
                    else {
                      if($prev!=$hei)
                      {
                        $suma_pe_zi=0;
                        $prev=date('Y-m-d');
                        //echo '</li>';
                      }
                    }
                    
                  }
                  else {echo '<li>Day '. $countdays . ': ' . $hei . ' : '. $suma_pe_zi .'kcal</li>';}
                  $prev=$hei;
                }
      
                
      
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
               $countdays=0;
              }
              $countdays=0;
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

      <label for="name">Portion</label>
      <input type="text" id="name" name="Name2" placeholder="Sample..">

  
    
      <input type="submit" name="submit" value="CREATE" class="CreateButton" onclick="myFunction();" />
    </form>
    <div class="close">+</div>  


 
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
</body>
</html>