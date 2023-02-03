<!DOCTYPE html>
<?php 
$con=mysqli_connect("localhost","root","","myhmsdb");

include('newfunc.php');

if(isset($_POST['updatecaretaker']))
{
  $doctor=$_POST['doctor'];
  $nationalID = $_POST['nationalID'];
  $dpassword=$_POST['dpassword'];
  $demail=$_POST['demail'];
  $spec=$_POST['getapartname'];
  $docFees=$_POST['docFees'];
  $query="UPDATE doctb SET username='$doctor',nationalID='$nationalID',password='$dpassword',email='$demail',spec='$spec',docFees='$docFees' WHERE spec = '$spec'";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Caretaker updated successfully!');</script>";
      header("Location:admin-panel1.php");
  }else{
    echo "<script>alert('Could not update caretaker!');</script>";
    header("Location:admin-panel1.php");
  }
}

if(isset($_POST['acaretaker']))
{
  $doctor=$_POST['doctor'];
  $nationalID = $_POST['nationalID'];
  $dpassword=$_POST['dpassword'];
  $demail=$_POST['demail'];
  $spec=$_POST['getapartname'];
  $docFees=$_POST['docFees'];
  $query="INSERT into doctb (username,nationalID,password,email,spec,docFees) VALUES ('$doctor','$nationalID','$dpassword','$demail','$spec','$docFees')";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Caretaker added successfully!');</script>";
      header("Location:admin-panel1.php#list-doc");
  }else{
    echo "<script>alert('Could not add caretaker!');</script>";
    header("Location:admin-panel1.php#list-doc");
  }
}

if (isset($_POST['addhouse'])) {
  $getapartname = $_POST['getapartname'];
  $housenum = $_POST['housenum'];
  $description = $_POST['description'];
  $status = $_POST['status'];  
  $query = "SELECT * FROM housetb WHERE housenum = '$housenum' and apartmentID = '$getapartname'";
  $result = mysqli_query($con,$query);
  $row = mysqli_fetch_assoc($result);
  $count = mysqli_num_rows($result);
  if($count==0){
    $query = "INSERT into housetb (apartmentID, housenum, description,status) VALUES ('$getapartname', '$housenum','$description','$status')";
    $result = mysqli_query($con, $query);
    echo "<script>alert('House added successfully!');</script>";
    header("Location:admin-panel1.php#list-doc");
  }else{
    echo "<script>alert('House already exists in this apartment!');</script>"; 
    header("Location:admin-panel1.php#list-doc");
  }

}


// Add apartment to db
if(isset($_POST['addapart']))
{
  $apartment=$_POST['apartment'];
  $location=$_POST['location'];
  $query="insert into aparttb(apartment,location)values('$apartment','$location')";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Apartment added successfully!');</script>";
      header("Location:admin-panel1.php#list-doc");
  }
}


if(isset($_POST['docsub1']))
{
  $demail=$_POST['demail'];
  $query="delete from doctb where email='$demail';";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Caretaker removed successfully!');</script>";
      header("Location:admin-panel1.php#list-doc");
  }
  else{
    echo "<script>alert('Unable to delete!');</script>";
    header("Location:admin-panel1.php#list-doc");
  }
}


?>
<html lang="en">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> CK HOMES </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <script>
        var check = function() {
            if (document.getElementById('dpassword').value == document.getElementById('cdpassword').value) {
                document.getElementById('message').style.color = '#5dd05d';
                document.getElementById('message').innerHTML = 'Matched';
            } else {
                document.getElementById('message').style.color = '#f55252';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        };

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        }

        $(function() {
            $("#date").datepicker();
            $("#date").datepicker({
                dateFormat: "dd-mm-yyyy"
            });
        });
        </script>

        <style>
        .bg-primary {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }

        .col-md-4 {
            max-width: 20% !important;
        }

        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #342ac1;
            border-color: #007bff;
        }

        .text-primary {
            color: #342ac1 !important;
        }

        #cpass {
            display: -webkit-box;
        }

        #list-app {
            font-size: 15px;
        }

        .btn-primary {
            background-color: #3c50c1;
            border-color: #3c50c1;
        }
        </style>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
        </div>
    </nav>
</head>
<style type="text/css">
button:hover {
    cursor: pointer;
}

#inputbtn:hover {
    cursor: pointer;
}
</style>

<body style="padding-top:50px;">
    <div class="container-fluid" style="margin-top:50px;">
        <h3 style="margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;"> WELCOME
            LANDLORD</h3>
        <div class="row">
            <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list"
                        href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
                    <a class="list-group-item list-group-item-action" href="#list-aapart" id="list-aapart-list"
                        role="tab" data-toggle="list" aria-controls="home">Add Apartment</a>
                    <a class="list-group-item list-group-item-action" href="#list-apart" id="list-apart-list" role="tab"
                        data-toggle="list" aria-controls="home">Apartment List</a>
                    <a class="list-group-item list-group-item-action" href="#list-ahouse" id="list-ahouse-list"
                        role="tab" data-toggle="list" aria-controls="home">Add Houses</a>
                    <a class="list-group-item list-group-item-action" href="#list-house" id="list-house-list" role="tab"
                        data-toggle="list" aria-controls="home">House List</a>
                    <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list"
                        role="tab" data-toggle="list" aria-controls="home">Add Caretaker</a>
                    <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list"
                        role="tab" data-toggle="list" aria-controls="home">Update Caretaker</a>
                    <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list" role="tab"
                        aria-controls="home" data-toggle="list">Caretaker List</a>
                    <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" role="tab"
                        data-toggle="list" aria-controls="home">Tenant List</a>
                    <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab"
                        data-toggle="list" aria-controls="home">Payments</a>
                    <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab"
                        data-toggle="list" aria-controls="home">Payment Status</a>
                    <a class="list-group-item list-group-item-action" href="#list-mes" id="list-mes-list" role="tab"
                        data-toggle="list" aria-controls="home">Complaints</a>

                </div><br>
            </div>
            <div class="col-md-8" style="margin-top: 3%;">
                <div class="tab-content" id="nav-tabContent" style="width: 950px;">

                    <div class="tab-pane fade show active" id="list-dash" role="tabpanel"
                        aria-labelledby="list-dash-list">
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Caretaker List</h4>
                                            <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                            </script>
                                            <p class="links cl-effect-1">
                                                <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                                                    View Caretakers
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="left: -3%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Tenant List</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                                                    View Tenants
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Payments</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-app-list')">
                                                    View Payments
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4" style="left: 13%;margin-top: 5%;">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Payment Status</h4>

                                            <p class="cl-effect-1">
                                                <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                                                    View Payment Status
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-4" style="left: 18%;margin-top: 5%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-plus fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Manage Caretakers</h4>

                                            <p class="cl-effect-1">
                                                <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Add
                                                    Caretaker</a>
                                                &nbsp|
                                                <a href="#app-hist" onclick="clickDiv('#list-ddoc-list')">
                                                    Delete Caretaker
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>

                    <!-- Add apartment           -->
                    <div class="tab-pane fade" id="list-aapart" role="tabpanel" aria-labelledby="list-aapart-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">
                                <div class="col-md-4"><label>Apartment Name:</label></div>
                                <div class="col-md-8"><input autocomplete="off" type="text" class="form-control"
                                        name="apartment" onkeydown="return alphaOnly(event);" required></div><br><br>
                                <div class="col-md-4"><label>Location:</label></div>
                                <div class="col-md-8"><input autocomplete="off" type="text" class="form-control"
                                        name="location" onkeydown="return alphaOnly(event);" required></div><br><br>
                            </div>
                            <input type="submit" name="addapart" value="Add Apartment" class="btn btn-primary"
                                onClick="alert('Apartment added successfully!')">
                        </form>
                    </div>


                    <div class="tab-pane fade" id="list-apart" role="tabpanel" aria-labelledby="list-apart-list">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="form-group" action="adminapartsearchid.php" method="post">
                                    <div class="row">

                                        <div class="col-md-10"><input autocomplete="off" type="text" name="id"
                                                placeholder="Search By ID" class="form-control"></div>
                                        <div class="col-md-2"><input type="submit" name="house_search_submit"
                                                class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6">
                                <form class="form-group" action="adminapartsearchname.php" method="post">
                                    <div class="row">

                                        <div class="col-md-10"><input autocomplete="off" type="text" name="name"
                                                placeholder="Search By Name" class="form-control"></div>
                                        <div class="col-md-2"><input type="submit" name="house_search_submit"
                                                class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6 justify-content-center">
                                <form class="form-group" action="adminapartsearchlocation.php" method="post">
                                    <div class="row">
                                        <div class="col-md-10"><input autocomplete="off" type="text" name="location"
                                                placeholder="Search By Location" class="form-control"></div>
                                        <div class="col-md-2"><input type="submit" name="house_search_submit"
                                                class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table">
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

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query3 = "SELECT * FROM aparttb";                  
                    $result3 = mysqli_query($con,$query3);              
                    while ($row3 = mysqli_fetch_array($result3)){
                        $aid = $row3['id'];
                        $apartname = $row3['apartment'];
                        $location = $row3['location'];
                        $query4 = "SELECT * FROM housetb WHERE apartmentID='$aid'";
                        $result4 = mysqli_query($con,$query4);
                        $sum = 0;
                        $sumoccupied = 0;
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
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- Add houses -->
                    <div class="tab-pane fade" id="list-ahouse" role="tabpanel" aria-labelledby="list-ahouse-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">
                                <div class="col-md-4"><label>Select Apartment:</label></div>
                                <div class="col-sm-8">
                                    <select name="getapartname" class="form-control" id="special" required="required">
                                        <option name="apartment"> </option>
                                        <?php
                                        function  func($id,$apartment){$element = ' <option value=' . $id . '>' . $apartment . '</option>';
                                          echo $element;}
                                        $query = "SELECT * FROM aparttb";
                                        mysqli_query($con, $query) or die('error querying database.');
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {func($row['id'], $row['apartment'], $row['location']);}
                                        ?>
                                    </select>
                                </div><br><br>
                                <div class="col-md-4"><label>House Number:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="housenum" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Description:</label></div>
                                <div class="col-md-8">
                                    <select name="description" class="form-control" id="special" required="required">
                                        <option value="head" name="spec" disabled selected>Select Description</option>
                                        <option value="Bedsitter" name="spec">Bedsitter</option>
                                        <option value="One Bedroom" name="spec">One Bedroom</option>
                                        <option value="Two Bedroom" name="spec">Two Bedroom</option>
                                        <option value="Three Bedroom" name="spec">Three Bedroom</option>
                                    </select>
                                </div><br><br>

                                <div class="col-md-8"><input type="hidden" class="form-control" value="Not occupied"
                                        name="status" required>
                                </div><br><br>

                                <input type="submit" name="addhouse" value="Add House" class="btn btn-primary"
                                    onClick="alert('House added successfully!')">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="list-house" role="tabpanel" aria-labelledby="list-house-list">
                        <div class="col-md-8">
                            <form class="form-group" action="adminhousesearch.php" method="post">
                                <div class="row">
                                    <input type="text" hidden name="apartment" value="<?php echo $apartment?>">
                                    <input type="text" hidden name="housenum" value="<?php echo $housenum?>">
                                    <div class="col-md-10"><input type="text" name="status"
                                            placeholder="Search By Status" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="house_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">House No</th>
                                    <th scope="col">Apartment</th>
                                    <th scope="col">No of Rooms</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "SELECT * FROM housetb";                  
                    $result = mysqli_query($con,$query);              
                    while ($row = mysqli_fetch_array($result)){
                        $housenum = $row['housenum'];
                        $apartment = $row['apartmentID'];
                        $query2 = "SELECT * FROM aparttb WHERE id='$apartment'";
                        $result2 = mysqli_query($con,$query2);
                        if($row2= mysqli_fetch_assoc($result2)){
                            $apartmentname = $row2['apartment'];
                        }
                        $description = $row['description'];
                        $status = $row['status'];
                         if($status == 'Occupied')
                        {
                            $color = 'success';

                        } else
                        {
                            $color = 'danger';
                        }
                    
                                echo " <tr>
                                    <td>$housenum</td>
                                    <td>$apartmentname</td>
                                    <td>$description</td>
                                    <td><button style='min-width: 130px; display: inline-block; ' class='btn btn-$color'>$status</button></td>

                                </tr>";

                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="col-md-8">
                            <form class="form-group" action="caretakersearch.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="doctor_contact"
                                            placeholder="Enter Email ID" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="doctor_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <script>
                        let func = clickDiv('#list-ddoc-list');
                        </script>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Caretaker Name</th>
                                    <th scope="col">Apartment Name</th>
                                    <th scope="col">National ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;
                    $query = "select * from doctb";
                    $result = mysqli_query($con,$query);
                    
                    while($row = mysqli_fetch_assoc($result)){                
                      $username = $row['username'];            
                      $nationalID = $row['nationalID'];
                      $email = $row['email'];
                      $docFees = $row['docFees'];
                      $spec = $row['spec'];                    
                      $aquery = "SELECT * FROM aparttb WHERE id='$spec'";
                      $aresult = mysqli_query($con,$aquery);                      
                      $count = mysqli_fetch_assoc($aresult);          
                      $apartmentname = $count['apartment'];  
                        echo "<tr>
                        <td>$username</td>
                        <td>$apartmentname</td>
                        <td>$nationalID</td>
                        <td>$email</td>
                        <td>0$docFees</td>
                        </tr>";
                    }?>
                            </tbody>
                        </table>
                        <br>
                    </div>


                    <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">
                        <div class="col-md-8">
                            <form class="form-group" action="tenantsearch.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="temail" placeholder="Enter Email ID"
                                            class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="tenant_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
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
                                $con=mysqli_connect("localhost","root","","myhmsdb");
                                global $con;                                
                                $query = "SELECT * FROM tenanttb";
                                $result = mysqli_query($con,$query);
                                
                                while ($row = mysqli_fetch_array($result)){
                                    $tname = $row['Tname'];
                                    $nationalID = $row['NationalID'];
                                    $temail = $row['temail'];
                                    $contact = $row['PhoneNo'];
                                    $houseno = $row['houseno'];
                                    $apartment = $row['apartment'];
                                    $rent = $row['Rent'];
                                    $deposit = $row['Deposit'];
                                    $houseocc = $row['houseocc'];
                                    $query3 = "SELECT * FROM aparttb WHERE id = '$apartment'";
                                    $result3 = mysqli_query($con,$query3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                    if($row3){
                                        $apartmentname1 = $row3['apartment'];
                                    }
                                    
                                    $sql = "SELECT * FROM housetb WHERE id='$houseno'";
                                    $newresult=mysqli_query($con,$sql);
                                    $newrow = mysqli_fetch_assoc($newresult);
                                    if($newrow){
                                        $housenum = $newrow['housenum'];
                                    }
                                    
                                  
                                
                                echo "<tr>
                                    <td>$tname</td>
                                    <td>$nationalID</td>
                                    <td>$temail</td>
                                    <td>0$contact</td>
                                    <td>$apartmentname1</td>
                                    <td>$housenum</td>
                                    <td>$rent</td>
                                    <td>$deposit</td>
                                    <td>$houseocc</td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>
                    </div>


                    <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                        <!-- Payment status -->
                        <div class="col-md-8">
                            <form class="form-group" action="adminpaymentsearch.php" method="post">
                                <div class="row">

                                    <div class="col-md-10"><input type="text" name="emailID"
                                            placeholder="Enter Email ID" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="admin_payment_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Apartment</th>
                                    <th scope="col">House No</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "SELECT * FROM paymentstatustb";                  
                    $result = mysqli_query($con,$query);              
                    while ($row = mysqli_fetch_array($result)){
                        $tid = $row['tid'];
                        $status = $row['status']; 
                        $tquery = "SELECT * FROM tenanttb WHERE Tid = '$tid'"; 
                        $tresult = mysqli_query($con,$tquery);
                        if($trow = mysqli_fetch_array($tresult)){
                            $apartment = $trow['apartment'];
                            $houseno = $trow['houseno'];
                            $temail = $trow['temail'];
                        }
                        $hquery = "SELECT * FROM housetb WHERE id = '$houseno'"; 
                        $hresult = mysqli_query($con,$hquery);
                        if($hrow = mysqli_fetch_array($hresult)){
                            $housenum = $hrow['housenum'];
                        }
                        $aquery = "SELECT * FROM aparttb WHERE id = '$apartment'"; 
                        $aresult = mysqli_query($con,$aquery);
                        if($arow = mysqli_fetch_array($aresult)){
                            $apartmentname = $arow['apartment'];
                        }                                            
                                echo "<tr>
                                    <td>$apartmentname</td>
                                    <td>$housenum</td>
                                    <td>$temail</td>
                                    <td>$status</td>    
                                    </tr>";

                                }
                                ?>

                            </tbody>
                        </table>
                        <br>
                    </div>

                    <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">
                        <div class="row">
                            <div class="col-sm-6">
                                <form class="form-group" action="adminpaymentsearch.php" method="post">
                                    <input type="text" name="emailID" placeholder="Enter Email ID" class="form-control">
                                    <input type="submit" name="admin_payment_search_submit" class="btn btn-primary"
                                        value="Search">
                                </form>
                            </div>


                            <div class="col-md-6">
                                <form action="admin-payment-search-period.php" method="post">
                                    <input type="date" id="Test_DatetimeLocal" name="start">
                                    <input type="date" id="Test_Datetime" name="stop">
                                    <input type="submit" name="admin-payment-search-period" class="btn btn-primary"
                                        value="Search">
                                </form>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">Apartment</th>
                                    <th scope="col">House No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "SELECT * FROM paymenttb";                  
                    $result = mysqli_query($con,$query);              
                    while ($row = mysqli_fetch_array($result)){
                        $pid = $row['pid'];
                        $tid = $row['tid'];
                        $apartment = $row['apartment'];
                        $aquery = "SELECT * FROM aparttb WHERE id = '$apartment'";
                        $aresult = mysqli_query($con,$aquery);
                        if($arow=mysqli_fetch_assoc($aresult)){
                            $apartmentname = $arow['apartment'];
                        }
                        $tquery = "SELECT * FROM tenanttb WHERE Tid = '$tid'";
                        $tresult = mysqli_query($con,$tquery);
                        if($trow=mysqli_fetch_assoc($tresult)){
                            $temail=$trow['temail'];
                        }   
                        $houseno = $row['houseno'];
                        $hquery = "SELECT * FROM housetb WHERE id= '$houseno'";
                        $hresult = mysqli_query($con,$hquery);
                        if($hrow=mysqli_fetch_assoc($hresult)){
                            $housenum=$hrow['housenum'];
                        }
                        $month = $row['currentdate'];
                        $amount = $row['amount'];                                            
                                echo "<tr>
                                    <td>$pid</td>
                                    <td>$temail</td>
                                    <td>$apartmentname</td>
                                    <td>$housenum</td>
                                    <td>$month</td>
                                    <td>$amount</td>
                                    </tr>";

                                }
                                ?>

                            </tbody>
                        </table>
                        <br>
                    </div>

                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        ...</div>

                    <!-- Add caretaker -->
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">
                                <div class="col-md-4"><label>Caretaker Name:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="doctor"
                                        onkeydown="return alphaOnly(event);" required></div><br><br>
                                <div class="col-md-4"><label>National ID:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="nationalID"
                                        required>
                                </div><br><br>
                                <div class="col-md-4"><label>Apartment Name:</label></div>
                                <div class="col-md-8">

                                    <select name="getapartname" class="form-control" id="special" required="required">
                                        <option value="" name="apartment"> </option>
                                        <?php
                                        function  funct($id,$apartment)
                                        {
                                          $element = ' <option value=' . $id . '>' . $apartment . '</option>';
                                          echo $element;
                                        }
                                        $query = "SELECT * FROM aparttb";
                                        mysqli_query($con, $query) or die('error querying database.');
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                          func($row['id'], $row['apartment'], $row['location']);
                                        }
                                        ?>
                                    </select>


                                </div><br><br>
                                <div class="col-md-4"><label>Email ID:</label></div>
                                <div class="col-md-8"><input type="email" class="form-control" name="demail" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Phone Number:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="docFees" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Password:</label></div>
                                <div class="col-md-8"><input autocomplete="off" type="password" class="form-control"
                                        onkeyup='check();' name="dpassword" id="dpassword" required></div><br><br>
                                <div class="col-md-4"><label>Confirm Password:</label></div>
                                <div class="col-md-8" id='cpass'><input autocomplete="off" type="password"
                                        class="form-control" onkeyup='check();' name="cdpassword" id="cdpassword"
                                        required>&nbsp &nbsp<span id='message'></span> </div><br><br>
                            </div>
                            <input type="submit" name="acaretaker" onClick="alert('Caretaker added successfully!')"
                                value="Add Caretaker" class="btn btn-primary">
                        </form>
                    </div>

                    <!-- <div class="tab-pane fade" id="list-settings1" role="tabpanel"
                        aria-labelledby="list-settings1-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">

                                <div class="col-md-4"><label>Email ID:</label></div>
                                <div class="col-md-8"><input type="email" class="form-control" name="demail" required>
                                </div><br><br>

                            </div>
                            <input type="submit" name="docsub1" value="Delete Caretaker" class="btn btn-primary"
                                onclick="confirm('do you really want to delete?')">
                        </form>
                    </div> -->

                    <!-- Update caretaker -->
                    <div class="tab-pane fade" id="list-settings1" role="tabpanel"
                        aria-labelledby="list-settings1-list">
                        <form class="form-group" method="post" action="admin-panel1.php">
                            <div class="row">
                                <div class="col-md-4"><label>Caretaker Name:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="doctor"
                                        onkeydown="return alphaOnly(event);" required></div><br><br>
                                <div class="col-md-4"><label>National ID:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="nationalID"
                                        required>
                                </div><br><br>
                                <div class="col-md-4"><label>Apartment Name:</label></div>
                                <div class="col-md-8">
                                    <select name="getapartname" class="form-control" id="special" required="required">
                                        <option value="" name="apartment"> </option>
                                        <?php
                                        function  funct1($id,$apartment)
                                        {
                                          $element = ' <option value=' . $id . '>' . $apartment . '</option>';
                                          echo $element;
                                        }
                                        $query = "SELECT * FROM aparttb";
                                        mysqli_query($con, $query) or die('error querying database.');
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                          funct1($row['id'], $row['apartment'], $row['location']);
                                        }
                                        ?>
                                    </select>
                                </div><br><br>
                                <div class="col-md-4"><label>Email ID:</label></div>
                                <div class="col-md-8"><input type="email" class="form-control" name="demail" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Phone Number:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="docFees" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Password:</label></div>
                                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();'
                                        name="dpassword" id="dpassword" required></div><br><br>
                                <div class="col-md-4"><label>Confirm Password:</label></div>
                                <div class="col-md-8" id='cpass'><input type="password" class="form-control"
                                        onkeyup='check();' name="cdpassword" id="cdpassword" required>&nbsp &nbsp<span
                                        id='message'></span> </div><br><br>



                            </div>
                            <input type="submit" name="updatecaretaker" value="Update Caretaker" class="btn btn-primary"
                                onClick="alert('Caretaker updated successfully!')">
                        </form>
                    </div>

                    <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...
                    </div>

                    <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
                        <div class="col-md-8">
                            <form class="form-group" action="adminsearchcomplaint.php" method="post">
                                <div class="row">
                                    <input type="text" name="apartID" hidden value="<?= $apartID?>">
                                    <div class="col-md-10"><input type="text" name="compID"
                                            placeholder="Enter Complaint ID" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="admin_comp_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Comp ID</th>
                                    <th scope="col">Complaint</th>
                                    <th scope="col">Apartment</th>
                                    <th scope="col">HouseNo</th>
                                    <th scope="col">Caretaker Contact</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM contact";
                                $result = mysqli_query($con,$query);
                                while($row = mysqli_fetch_assoc($result)){                     
                                $cid = $row['id'];
                                $tid = $row['tid'];
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
                                echo " <tr>
                                <td>$cid</td>
                                <td>$complaint</td>
                                <td>$apartmentname</td>
                                <td>$housenum</td>
                                <td>0$ccontact</td>";
                                
                                if($status == "Not Addressed"):?>
                                <form method="post" action="contact.php">
                                    <td>
                                        <input type="hidden" name="ID" value="<?php echo $cid?>" />
                                        <input type="submit" disabled name="addressed" class="btn btn-success"
                                            value="Not Addressed" />
                                    </td>

                                </form>
                                </tr>
                                <?php elseif($status == "Addressed"):?>
                                <td>
                                    <input type="text" disabled name="notaddressed" class="btn btn-danger"
                                        value="Addressed" />
                                </td>
                                </tr>
                                <?php endif;?>
                                <?php }?>

                            </tbody>
                        </table>
                        <br>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
</body>

</html>