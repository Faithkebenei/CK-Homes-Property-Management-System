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
                            <th scope='col'>House No</th>
                            <th scope='col'>No of Rooms</th>
                            <th scope='col'>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("newfunc.php");
if(isset($_POST['house_search_submit']))
{
	$apartment = $_POST['apartment'];
    $housenum = $_POST['housenum'];
    $status = $_POST['status'];
	$query = "select * from housetb where status= '$status'";
  $result = mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result)){
    $housenum = $row['housenum'];
    $description = $row['description'];
    $status = $row['status'];
    echo "<tr>
    <td>$housenum</td>
    <td>$description</td>
    <td>$status</td>
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