<?php
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
if(isset($_POST['search_submit'])){
  $email=$_POST['email'];
  $docname = $_SESSION['dname'];
  $cquery ="SELECT * FROM doctb WHERE email = '$docname'";
  $cresult = mysqli_query($con,$cquery);
  $crow = mysqli_fetch_assoc($cresult);
  $apartment = $crow['spec'];
 $query="select * from tenanttb where temail='$email' and apartment='$apartment'";
 $result=mysqli_query($con,$query);

 echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body style="background-color:#342ac1;color:white;text-align:center;padding-top:50px;">
  <div class="container" style="text-align:left;">
  <center><h3>Search Results</h3></center><br>
  <table class="table table-hover">
  <thead>
    <tr>    					
      <th>Tenant Name</th>
      <th>National ID</th>
      <th>Email</th>
      <th>Contact</th>
      <th>House No</th>
      <th>Rent</th>
      <th>Deposit</th>
      <th>Occupants</th>
    </tr>
  </thead>
  <tbody>
  ';
  while($row=mysqli_fetch_array($result)){
    $Tname=$row['Tname'];
    $NationalID=$row['NationalID'];
    $Temail=$row['temail'];
    $contact=$row['PhoneNo'];
    $houseno=$row['houseno'];
    $Rent=$row['Rent'];
    $Deposit=$row['Deposit'];
    $houseocc=$row['houseocc'];
    echo '<tr>
      <td>'.$Tname.'</td>
      <td>'.$NationalID.'</td>
      <td>'.$Temail.'</td>
      <td>0'.$contact.'</td>
      <td>'.$houseno.'</td>
      <td>'.$Rent.'</td>
      <td>'.$Deposit.'</td>
      <td>'.$houseocc.'</td>
    </tr>';
  }
echo '</tbody></table></div> 
<div><a href="caretaker-panel.php" class="btn btn-light">Go Back</a></div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>';
}

?>