<!DOCTYPE html>
<?php 
include('func1.php');
$con=mysqli_connect("localhost","root","","myhmsdb");
$doctor = $_SESSION['dname'];
$query = "SELECT * FROM doctb WHERE email='$doctor'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$apartID = $row['spec'];
$sql = "SELECT * FROM aparttb WHERE id='$apartID'";
$value = mysqli_query($con,$sql);
$count = mysqli_fetch_assoc($value);
$apartment = $count['apartment'];



if(isset($_POST['dtenant']))
{
    $tntid = $_POST['tntid'];
    $dquery = "SELECT * FROM tenanttb WHERE Tid='$tntid'";
    $dresult = mysqli_query($con,$dquery);
    // if($dresult){
        $drow = mysqli_fetch_assoc($dresult);
        $dhouseno = $drow['houseno'];


        $hdquery = "UPDATE housetb SET status='Not Occupied' WHERE id = '$dhouseno'";
        $hdresult = mysqli_query($con,$hdquery);
    
    
        $dtquery = "DELETE FROM tenanttb WHERE Tid='$tntid'";
        $dtquery = mysqli_query($con,$dtquery);
    // }
}



?>
<html lang="en">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>CK Homes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <style>
        .btn-outline-light:hover {
            color: #25bef7;
            background-color: #f8f9fa;
            border-color: #f8f9fa;
        }
        </style>

        <style>
        .bg-primary {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
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
            <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Enter email ID" aria-label="Search"
                    name="email">
                <input type="submit" class="btn btn-outline-light" id="inputbtn" name="search_submit" value="Search">
            </form>
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
        <h3 style="margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;"> Welcome
            &nbsp<?php echo $username; ?> </h3>
        <div class="row">
            <div class="col-md-4" style="max-width:18%;margin-top: 3%;">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" href="#list-dash" role="tab"
                        aria-controls="home" data-toggle="list">Dashboard</a>
                    <a class="list-group-item list-group-item-action" href="#list-atenant" id="list-atenant-list"
                        role="tab" data-toggle="list" aria-controls="home">Add Tenant</a>
                    <a class="list-group-item list-group-item-action" href="#list-tenant" id="list-tenant-list"
                        role="tab" data-toggle="list" aria-controls="home">Tenant List</a>
                    <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab"
                        data-toggle="list" aria-controls="home">House List</a>
                    <a class="list-group-item list-group-item-action" href="#list-payment" id="list-payment-list"
                        role="tab" data-toggle="list" aria-controls="home">Payments</a>
                    <a class="list-group-item list-group-item-action" href="#list-comp" id="list-comp-list" role="tab"
                        data-toggle="list" aria-controls="home">Complaints</a>

                </div><br>
            </div>
            <div class="col-md-8" style="margin-top: 3%;">
                <div class="tab-content" id="nav-tabContent" style="width: 950px;">

                    <div class="tab-pane fade  show active" id="list-dash" role="tabpanel"
                        aria-labelledby="list-dash-list">
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-sm-4" style="left: 5%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Tenants</h4>
                                            <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                            </script>
                                            <p class="links cl-effect-1">
                                                <a href="#list-tenant" onclick="clickDiv('#list-tenant-list')">
                                                    View Tenants
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="left: 10%">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                            <h4 class="StepTitle" style="margin-top: 5%;">Payments</h2>

                                                <p class="cl-effect-1">
                                                    <a href="#list-payment" onclick="clickDiv('#list-payment-list')">
                                                        View Payments
                                                    </a>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4" style="left: 20%;margin-top:5%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Complaints</h2>

                                            <p class="cl-effect-1">
                                                <a href="#list-comp" onclick="clickDiv('#list-comp-list')">
                                                    View Complaints
                                                </a>
                                            </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>



                    <!-- Add tenant -->
                    <div class="tab-pane fade" id="list-atenant" role="tabpanel" aria-labelledby="list-atenant-list">
                        <form class="form-group" method="post" action="func2.php">
                            <div class="row">
                                <div class="col-md-4"><label>Tenant Name:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="Tname"
                                        onkeydown="return alphaOnly(event);" required></div><br><br>
                                <div class="col-md-4"><label>National ID:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="nationalID"
                                        required>
                                </div><br><br>
                                <div class="col-md-4"><label>Email ID:</label></div>
                                <div class="col-md-8"><input type="email" class="form-control" name="temail" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Phone Number:</label></div>
                                <div class="col-md-8"><input type="text" class="form-control" name="PhoneNo" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Apartment Name:</label></div>
                                <div class="col-md-8"><input type="text" readonly="readonly" class="form-control"
                                        name="apartment" value="<?php echo $apartment?>" required>
                                </div><br><br>
                                <div class="col-md-4"><label>House No:</label></div>
                                <div class="col-md-8">
                                    <select name="houseno" class="form-control" id="special" required="required">
                                        <option value="" name="houseno"> </option>
                                        <?php
                                        function  func($id,$housenum)
                                        {
                                          $element = ' <option value=' . $id . '>' . $housenum . '</option>';
                                          echo $element;
                                        }
                                        $query = "SELECT * FROM housetb WHERE apartmentID='$apartID' and status='Not Occupied'";
                                        mysqli_query($con, $query) or die('error querying database.');
                                        $result = mysqli_query($con, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                          func($row['id'], $row['housenum']);
                                        }
                                        ?>
                                    </select>
                                </div><br><br>
                                <div class="col-md-4"><label>House Occupants:</label></div>
                                <div class="col-md-8"><input type="number" class="form-control" name="houseocc"
                                        required>
                                </div><br><br>
                                <div class="col-md-4"><label>Rent:</label></div>
                                <div class="col-md-8"><input type="number" class="form-control" name="Rent" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Deposit:</label></div>
                                <div class="col-md-8"><input type="number" class="form-control" name="Deposit" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Caretaker Email:</label></div>
                                <div class="col-md-8"><input type="email" readonly="readonly" class="form-control"
                                        value="<?php echo $doctor; ?>" name="cemail" required>
                                </div><br><br>
                                <div class="col-md-4"><label>Password:</label></div>
                                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();'
                                        name="password" id="dpassword" required></div><br><br>
                                <div class="col-md-4"><label>Confirm Password:</label></div>
                                <div class="col-md-8" id='cpass'><input type="password" class="form-control"
                                        onkeyup='check();' name="cpassword" id="cdpassword" required>&nbsp &nbsp<span
                                        id='message'></span> </div><br><br>

                            </div>
                            <input type="submit" name="atenant" value="Add Tenant" class="btn btn-primary"
                                onClick="alert('Tenant added Successfully!');">
                        </form>
                    </div>

                    <div class="tab-pane fade" id="list-tenant" role="tabpanel" aria-labelledby="list-tenant-list">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tenant Name</th>
                                    <th scope="col">National ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">House No</th>
                                    <th scope="col">Rent</th>
                                    <th scope="col">Deposit</th>
                                    <th scope="col">Occupants</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $con=mysqli_connect("localhost","root","","myhmsdb");
                                global $con;                                
                                $query = "SELECT * FROM tenanttb WHERE apartment='$apartID'";
                                $result = mysqli_query($con,$query);
                                
                                while ($row = mysqli_fetch_array($result)){
                                    $tname = $row['Tname'];
                                    $tid = $row['Tid'];
                                    $nationalID = $row['NationalID'];
                                    $temail = $row['temail'];
                                    $contact = $row['PhoneNo'];
                                    $houseno = $row['houseno'];
                                    $sql = "SELECT * FROM housetb WHERE id='$houseno'";
                                    $newresult=mysqli_query($con,$sql);
                                    $newrow = mysqli_fetch_assoc($newresult);
                                    $housenum = $newrow['housenum'];
                                    $rent = $row['Rent'];
                                    $deposit = $row['Deposit'];
                                    $houseocc = $row['houseocc'];
                                
                                echo "<tr>
                                    <td>$tname</td>
                                    <td>$nationalID</td>
                                    <td>$temail</td>
                                    <td>0$contact</td>
                                    <td>$housenum</td>
                                    <td>$rent</td>
                                    <td>$deposit</td>
                                    <td>$houseocc</td>
                                    
                                    <td>
                                    <form action='caretaker-panel.php' method='post'>
                                        <input type='text' name='tntid' hidden value='$tid'>
                                        <input type='submit' name='dtenant' value='Delete' class='btn btn-danger' onClick='alert('Password Updated Successfully');'>
                                        </form>
                                    </td>
                                 
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>
                    </div>



                    <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                        <div class="row">


                            <div class="col-md-6">
                                <form class="form-group" action="caretakerhousesearch.php" method="post">
                                    <div class="row">
                                        <input type="text" hidden name="apartment" value="<?php echo $apartID?>">
                                        <div class="col-md-10"><input type="text" name="houseno"
                                                placeholder="Enter Houseno" class="form-control"></div>
                                        <div class="col-md-2"><input type="submit" name="house_search_submit"
                                                class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form class="form-group" action="caretakerhousesearchstatus.php" method="post">
                                    <div class="row">
                                        <input type="text" hidden name="apartment" value="<?php echo $apartID?>">
                                        <div class="col-md-10"><input type="text" name="status"
                                                placeholder="Search By Status" class="form-control"></div>
                                        <div class="col-md-2"><input type="submit" name="house_search_submit"
                                                class="btn btn-primary" value="Search"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">House No</th>
                                    <th scope="col">No of Rooms</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "SELECT * FROM housetb WHERE apartmentID = '$apartID'";                  
                    $result = mysqli_query($con,$query);              
                    while ($row = mysqli_fetch_array($result)){
                        $housenum = $row['housenum'];
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
                                    <td>$description</td>

                                    <td><button style='min-width: 130px; display: inline-block; ' class='btn btn-$color'>$status</button></td>

                                </tr>";

                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="list-payment" role="tabpanel" aria-labelledby="list-payment-list">
                        <div class="col-md-8">
                            <form class="form-group" action="caretakerpaymentsearch.php" method="post">
                                <div class="row">
                                    <input type="text" hidden name="apartment" value="<?php echo $apartID?>">
                                    <div class="col-md-10"><input type="text" name="emailID"
                                            placeholder="Enter Email ID" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="payment_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">House No</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;

                    $query = "SELECT * FROM paymenttb WHERE apartment = '$apartID'";                  
                    $result = mysqli_query($con,$query);              
                    while ($row = mysqli_fetch_array($result)){
                        $pid = $row['pid'];
                        $tid = $row['tid'];
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
                        $month = $row['month'];
                        $amount = $row['amount'];                                            
                                echo "<tr>
                                    <td>$pid</td>
                                    <td>$temail</td>
                                    <td>$housenum</td>
                                    <td>$month</td>
                                    <td>$amount</td>
                                    </tr>";

                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- View complaints -->

                    <div class="tab-pane fade" id="list-comp" role="tabpanel" aria-labelledby="list-comp-list">
                        <div class="col-md-8">
                            <form class="form-group" action="caretakersearchcomplaint.php" method="post">
                                <div class="row">
                                    <input type="text" name="apartID" hidden value="<?= $apartID?>">
                                    <div class="col-md-10"><input type="text" name="compID"
                                            placeholder="Enter Complaint ID" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="caretaker_comp_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Complaint ID</th>
                                    <th scope="col">Tenant ID</th>
                                    <th scope="col">House No</th>
                                    <th scope="col">Complaint</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM contact WHERE apartment='$apartID'";
                                $result = mysqli_query($con,$query);
                                while($row = mysqli_fetch_assoc($result)){                     
                                $cid = $row['id'];
                                $tid = $row['tid'];
                                $complaint = $row['message'];
                                $status = $row['status'];
                                $query5 ="SELECT * FROM tenanttb WHERE Tid='$tid'";
                                $result5= mysqli_query($con,$query5);
                                $row5 = mysqli_fetch_assoc($result5);
                                if($row5){
                                    $houseno = $row5['houseno'];
                                }
                                $query6 ="SELECT * FROM housetb WHERE id='$houseno'";
                                $result6= mysqli_query($con,$query6);
                                $row6 = mysqli_fetch_assoc($result6);
                                if($row6){
                                    $housenum = $row6['housenum'];
                                }
                                echo " <tr>
                                <td>$cid</td>
                                <td>$tid</td>
                                <td>$housenum</td>

                                <td>$complaint</td>";
                                
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






                    <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...
                    </div>
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