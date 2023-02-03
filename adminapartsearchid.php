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
                            <th scope="col">Apartment ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">No of houses</th>
                            <th scope="col">Occupied</th>
                            <th scope="col">Vacant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
include("newfunc.php");
if(isset($_POST['house_search_submit']))
{
	$id = $_POST['id'];
    $query3 = "SELECT * FROM aparttb WHERE id='$id'";                  
    $result3 = mysqli_query($con,$query3);              
    while ($row3 = mysqli_fetch_array($result3)){
        $aid = $row3['id'];
        $apartname = $row3['apartment'];
        $location = $row3['location'];
        $query4 = "SELECT * FROM housetb WHERE apartmentID='$aid'";
        $result4 = mysqli_query($con,$query4);
        $sum = 0;
        $sumoccupied=0;
        $sumnotoccupied = 0;
        while($row4= mysqli_fetch_assoc($result4)){
            $sum = $sum + 1;
            $status = $row4['status'];
            if($status=='Not occupied'){
                $sumnotoccupied = $sumnotoccupied + 1;
            }elseif($status=='Occupied'){
                $sumoccupied = $sumoccupied + 1;
            }
        }                    
                echo " <tr>
                    <td>$aid</td>
                    <td>$apartname</td>
                    <td>$location</td>
                    <td>$sum</td>
                    <td>$sumoccupied</td>
                    <td>$sumnotoccupied</td>
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