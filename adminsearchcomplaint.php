<!DOCTYPE html>
<?php #include("func.php");?>
<html>

<head>
    <title>User Messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>

<body>
    <div class='container-fluid' style='margin-top:50px;'>
        <div class='card'>
            <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th scope="col">Comp ID</th>
                            <th scope="col">Complaint</th>
                            <th scope="col">Tenant Contact</th>
                            <th scope="col">Apartment</th>
                            <th scope="col">HouseNo</th>
                            <th scope="col">Caretaker Contact</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("newfunc.php");
if(isset($_POST['admin_comp_search_submit']))
{
	$compID=$_POST['compID'];
  $apartID = $_POST['apartID'];
	$query = "select * from contact where id= '$compID'";
  $result = mysqli_query($con,$query);
  
  if($row=mysqli_fetch_array($result)){
          $complaint = $row['message'];
          $status = $row['status'];
          $apartment = $row['apartment'];
          $email = $row['email'];
          $aquery ="SELECT * FROM aparttb WHERE id='$apartment'";
          $aresult= mysqli_query($con,$aquery);
          $arow = mysqli_fetch_assoc($aresult);
           if($arow){
            $apartmentname = $arow['apartment'];
        }

          $tquery ="SELECT * FROM tenanttb WHERE temail='$email'";
          $tresult= mysqli_query($con,$tquery);
          $trow = mysqli_fetch_assoc($tresult);
           if($trow){
                                    $tcontact = $trow['PhoneNo'];
                                    $houseno = $trow['houseno'];
                                }

                                $hquery ="SELECT * FROM housetb WHERE id='$houseno'";
                                $hresult= mysqli_query($con,$hquery);
                                $hrow = mysqli_fetch_assoc($hresult);
                                if($hrow){
                                    $housenum = $hrow['housenum'];
                                }

                                $cquery ="SELECT * FROM doctb WHERE spec='$apartment'";
                                $cresult= mysqli_query($con,$cquery);
                                $crow = mysqli_fetch_assoc($cresult);
                                if($crow){
                                    $ccontact = $crow['docFees'];
                                }
         
          echo "<tr>
          <td>$compID</td>
          <td>$complaint</td>
          <td>0$tcontact</td>
          <td>$apartmentname</td>
          <td>$housenum</td>
          <td>0$ccontact</td>
          <td>$status</td></tr>";
    
    
  }
  }
	
?>
                    </tbody>
                </table>
                <center><a href='admin-panel1.php' class='btn btn-light'>Back to your Dashboard</a>
            </div>
            </center>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>
</body>

</html>