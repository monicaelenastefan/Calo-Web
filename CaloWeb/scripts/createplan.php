<?php

 if(isset($_POST['submit'])){
     
      include_once 'config.php';
      $name=mysqli_real_escape_string($conn, $_POST['name']);
      $days=mysqli_real_escape_string($conn, $_POST['days']);
      $activity=mysqli_real_escape_string($conn, $_POST['activity']);
      $startdate=mysqli_real_escape_string($conn, $_POST['startdate']);
      $kg=mysqli_real_escape_string($conn, $_POST['kg']);
      $age=mysqli_real_escape_string($conn, $_POST['age']);
      $weight=mysqli_real_escape_string($conn, $_POST['weight']);
      $restrictions=mysqli_real_escape_string($conn, $_POST['restrictions']);
      
       if (empty($first) || empty($last) || empty($email) || empty($password) || empty($age) || empty($weight) || empty ($height)){
        
            header("Location: ../pages/MyPLans.php?signup= Please fill in the blanks!");
            exit();
        }
      