<!DOCTYPE html>
<?php #include("func.php");?>
<html>

<head>
    <title>Caretaker Details</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
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
                            <th scope='col'>Caretaker name</th>
                            <th scope='col'>Apartment name</th>
                            <th scope='col'>National ID</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("newfunc.php");
if(isset($_POST['doctor_search_submit']))
{
	$contact=$_POST['doctor_contact'];
  $query = "select * from doctb where email= '$contact'";
  $result = mysqli_query($con,$query);
  

  if($row=mysqli_fetch_array($result)){
    $username = $row['username'];
    $spec = $row['spec'];
    $query = "SELECT * FROM aparttb WHERE id=$spec";
    $result = mysqli_query($con,$query);
    $count = mysqli_fetch_assoc($result);
    $apartment = $count['apartment'];
    $nationalID = $row['nationalID'];
    $email = $row['email'];
    $docFees = $row['docFees'];
    echo "<tr>
      <td>$username</td>
      <td>$apartment</td>
      <td>$nationalID</td>
      <td>$email</td>
      <td>0$docFees</td>
    </tr>";
  }	

}

	

?>
                    </tbody>
                </table>
                <center><a href='admin-panel1.php' class='btn btn-light'>Back to dashboard</a>
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