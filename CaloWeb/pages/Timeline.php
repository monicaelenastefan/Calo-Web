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
                if($media_saptamanii < 600){
                  echo '<div class="">chestie</div>';
                }
              }
            }
        }
       
      ?>         		
  </div>  
  <div class="bg-modal">   
    <div class="modal-content"> 
      <div class="food-list">
        <table id="food">
          <tr>
            <th> Food</th>
            <th> Portion </th>
            <th> Calories </th>
          </tr>
<!--         
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr> -->
        <?php
        include_once '../scripts/config.php';
          for($i=0;$i<count($planuri);$i++)
          {
            
            $nume_plan=strval($planuri[$i]);
            $sql_result=mysqli_query($conn,"SELECT * from timeline where email like '$email' and planname like '$nume_plan' order by days asc");
            $count=0;
            while($row=mysqli_fetch_array($sql_result))
            {
              $count++;
              $foods=stripslashes($row['food']);
              $qs=mysqli_query($conn,"SELECT calories from food where name like '$foods'");
              $food_data=mysqli_fetch_assoc($qs);

              $current_date=stripslashes($row['days']);

              $qsl=mysqli_query($conn,"SELECT Sdate from myplans1 where tablename like '$nume_plan' and firstname like '$email'");
              $start_data=mysqli_fetch_assoc($qsl);

              $final=$start_data['Sdate'];

              echo '<tr>';
              $final1=date('Y-m-d',strtotime($final."+".($count-1)." days"));


              $pola=new DateTime($final1);
              $result = $pola->format('Y-m-d');

              $sql_result=mysqli_query($conn,"SELECT * from timeline where email like '$email' and planname like '$nume_plan' and days like '$result'");
              while($rows=mysqli_fetch_array($sql_result))
              {
                
                $food=stripslashes($rows['food']);
                $gramaj=stripslashes($rows['gramaj']);
                $current_date=stripslashes($rows['days']);
                  if(strcmp($current_date,$result))
                    {
                    $calorii=intval($gramaj)*intval($food_data['calories'])/100;
                    echo '<td>'.$food.'</td>';
                    echo '<td>'.$gramaj.'</td>';
                    echo '<td>'.$calorii.'</td>';
                  }
              }

              if(strcmp($current_date,$result))
              {
                $calorii=intval($gramaj)*intval($food_data['calories'])/100;
                echo '<td>'.$food.'</td>';
                echo '<td>'.$gramaj.'</td>';
                echo '<td>'.$calorii.'</td>';
               }
              echo '</tr>';
              $count=0;
            }
          }
        
        
        ?>
      </table>
      </div>
      <div class="container-buttons">
        <div id="add">Add </div>
        <div class="aec-button">Edit </div>
        <div class="aec-button">Delete </div>
      </div>
      <div class="close">+</div>
    </div>  
  </div>   
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

  </div>
      <div id="create-button" >Add</div>
  </div>
  <script>
    var list= document.querySelectorAll(".list ul li");
    tab= [];
    for (var i = 0 ; i < list.length; i++) {
      console.log("test");
      list[i].addEventListener('click', function() {
        document.querySelector('.bg-modal').style.display= 'flex'; 
      });
      document.querySelector('.close').addEventListener('click', 
      function(){
        document.querySelector('.bg-modal').style.display= 'none'; 
      });
   } 
  
    var el=document.getElementById("add");
    el.addEventListener('click', function() {  
      document.querySelector('.add-item-modal').style.display= 'flex'; 
    });
    document.querySelector('#ex-button').addEventListener('click', 
    function(){
    document.querySelector('.add-item-modal').style.display= 'none';
    });
  </script>
</body>
</html>