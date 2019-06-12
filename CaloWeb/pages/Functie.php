<?php
function Functie(){
    session_start();
    include_once '../scripts/config.php';
    $email = $_SESSION['u_email'];
    $result = mysqli_query($conn,"select tablename, Sdate, days, weight, restriction from myplans1 where firstname like '$email'");
    
    $xml = new DOMDocument("1.0");
    $xml->formatOutput = true;
    $plans = $xml->createElement("Plans");
    $xml->appendChild($plans);
    
    while($row = mysqli_fetch_array($result)){
        $plan = $xml->createElement("Plan");
        $plans->appendChild($plan);
    
        $name = $xml->createElement("Name", $row['tablename']);
        $plan->appendChild($name);

        $startdate = $xml->createElement("StartDate", $row['Sdate']);
        $plan->appendChild($startdate);

        $duration = $xml->createElement("Duration", $row['days']);
        $plan->appendChild($duration);

        $restrictions = $xml->createElement("Restriction", $row['restriction']);
        $plan->appendChild($restrictions);

        header('Location: ../pages/MyPlans.php');
    }
    
    $xml->save("ceva.xml");
}

Functie();
?>