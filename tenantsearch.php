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
                            <th scope="col">Tenant Name</th>
                            <th scope="col">NationalID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Apartment</th>
                            <th scope="col">HouseNo</th>
                            <th scope="col">Rent</th>
                            <th scope="col">Deposit</th>
                            <th scope="col">Occupants</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("newfunc.php");
if(isset($_POST['tenant_search_submit']))
{
  $temail=$_POST['temail'];
  $query ="SELECT * FROM tenanttb WHERE temail = '$temail'";
  $result = mysqli_query($con,$query);
 
  if($row=mysqli_fetch_array($result)){
    $apartment = $row['apartment'];
   
    $Tname=$row['Tname'];
    $NationalID=$row['NationalID'];
    $contact=$row['PhoneNo'];
    $houseno=$row['houseno'];
    $Rent=$row['Rent'];
    $Deposit=$row['Deposit'];
    $houseocc=$row['houseocc'];

    $hquery="select * from housetb where id='$houseno'";
    $hresult=mysqli_query($con,$hquery);
    $hrow = mysqli_fetch_assoc($hresult);
    if($hrow){
        $housenum = $hrow['housenum'];
    }

    $aquery="select * from aparttb where id='$apartment'";
    $aresult=mysqli_query($con,$aquery);
    $arow = mysqli_fetch_assoc($aresult);
    if($arow){
        $apartmentname = $arow['apartment'];
    }
    
         
          echo "<tr>
        <td>$Tname</td>
      <td>$NationalID</td>
      <td>$temail</td>
      <td>$contact</td>
      <td>$apartmentname</td>
      <td>$housenum</td>
      <td>$Rent</td>
      <td>$Deposit</td>
      <td>$houseocc</td>
          </tr>";
    
    
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