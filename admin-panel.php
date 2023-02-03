<!DOCTYPE html>
<?php 
include('func.php');  
include('newfunc.php');
$con=mysqli_connect("localhost","root","","myhmsdb");



  $Tid = $_SESSION['Tid'];
  $tname = $_SESSION['Tname'];
  $nationalID = $_SESSION['NationalID'];
  $temail = $_SESSION['temail'];
  $contact = $_SESSION['PhoneNo'];


  $question = "SELECT * FROM tenanttb WHERE Tid='$Tid'";
  $newestresult = mysqli_query($con,$question);
  $newestrow = mysqli_fetch_assoc($newestresult);
  $ctemail = $newestrow['cemail'];
  $apartment = $newestrow['apartment'];
  $houseno = $newestrow['houseno'];
  $rent = $newestrow['Rent'];

  $aquery = "SELECT * FROM aparttb WHERE id='$apartment'";
  $aresult = mysqli_query($con,$aquery);
  $arow = mysqli_fetch_assoc($aresult);
  $apartmentname = $arow['apartment'];

  $hquery = "SELECT * FROM housetb WHERE id = '$houseno'";
  $hresult = mysqli_query($con,$hquery);
  $hrow = mysqli_fetch_assoc($hresult);
  $housename = $hrow['housenum'];

  
  $cquery = "SELECT * FROM doctb WHERE email ='$ctemail'";
  $cresult = mysqli_query($con,$cquery);
  $crow = mysqli_fetch_assoc($cresult);

  $psquery = "SELECT * FROM paymentstatustb where tid ='$Tid'";
  $psresult = mysqli_query($con,$psquery);
  $psrow = mysqli_fetch_assoc($psresult);
  $lastpaid = $psrow['lastpaid'];
 
 

$lastpaidtime = strtotime($lastpaid); 
$currenttime = date('H:i:s'); 
$currenttime = strtotime($currenttime); 
$difference = ($currenttime - $lastpaidtime)/60; 

if($difference>1){
   $psquery = "UPDATE paymentstatustb SET status='Not Paid' WHERE tid='$Tid'";
   $psresult = mysqli_query($con,$psquery);
}
  
  


if(isset($_POST['app-submit']))
{
  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $gender = $_SESSION['gender'];
  $contact = $_SESSION['contact'];
  $doctor=$_POST['doctor'];
  $email=$_SESSION['email'];
  # $fees=$_POST['fees'];
  $docFees=$_POST['docFees'];

  $appdate=$_POST['appdate'];
  $apptime=$_POST['apptime'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kolkata');
  $cur_time = date("H:i:s");
  $apptime1 = strtotime($apptime);
  $appdate1 = strtotime($appdate);
	
  if(date("Y-m-d",$appdate1)>=$cur_date){
    if((date("Y-m-d",$appdate1)==$cur_date and date("H:i:s",$apptime1)>$cur_time) or date("Y-m-d",$appdate1)>$cur_date) {
      $check_query = mysqli_query($con,"select apptime from appointmenttb where doctor='$doctor' and appdate='$appdate' and apptime='$apptime'");

        if(mysqli_num_rows($check_query)==0){
          $query=mysqli_query($con,"insert into appointmenttb(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime,userStatus,doctorStatus) values($pid,'$fname','$lname','$gender','$email','$contact','$doctor','$docFees','$appdate','$apptime','1','1')");

          if($query)
          {
            echo "<script>alert('Your appointment successfully booked');</script>";
          }
          else{
            echo "<script>alert('Unable to process your request. Please try again!');</script>";
          }
      }
      else{
        echo "<script>alert('We are sorry to inform that the doctor is not available in this time or date. Please choose different time or date!');</script>";
      }
    }
    else{
      echo "<script>alert('Select a time or date in the future!');</script>";
    }
  }
  else{
      echo "<script>alert('Select a time or date in the future!');</script>";
  }
  
}

if(isset($_GET['cancel']))
  {
    $query=mysqli_query($con,"update appointmenttb set userStatus='0' where ID = '".$_GET['ID']."'");
    if($query)
    {
      echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
  }


  function generate_payments(){
    $contents ='<table cellspacing="0">
    <thead>
    <tr>
    <th>Payment ID</th>
    <th>Payment Date</th>
    <th>Amount Paid</th>
    </tr>
    </thead><tbody>';
    $con=mysqli_connect("localhost","root","","myhmsdb");
    $Tid = $_SESSION['Tid'];
    $query1 = "SELECT * FROM paymenttb WHERE tid = '$Tid'";
    $result1 = mysqli_query($con,$query1);
    $sum = 0;
    while($row1=mysqli_fetch_assoc($result1)){
        $pid = $row1['pid'];
        $paydates = $row1['currentdate'];
        $paydate = date("jS M Y",strtotime($paydates));
        $amount = $row1['amount'];
        $sum = $sum + $amount;
        $contents .='<tr>
        <td>'.$pid.'</td>
        <td>'.$paydate.'</td>
        <td>'.$amount.'</td>
        </tr>';
    }
    $contents .='</tbody>
    </table>
    <br/><br/>
    <br/><br/>
    <label> <b>Total Payments</b> : </label>'.$sum.'<br/><br/>
    ';
     return $contents;
  }


function generate_bill(){
  $con=mysqli_connect("localhost","root","","myhmsdb");
  $Tid = $_SESSION['Tid'];
  $tname = $_SESSION['Tname'];
  $nationalID = $_SESSION['NationalID'];
  $temail = $_SESSION['temail'];
  $contact = $_SESSION['PhoneNo'];

  $question = "SELECT * FROM tenanttb WHERE Tid='$Tid'";
  $newestresult = mysqli_query($con,$question);
  $newestrow = mysqli_fetch_assoc($newestresult);
  $ctemail = $newestrow['cemail'];
  $apartment = $newestrow['apartment'];
  $houseno = $newestrow['houseno'];
  $rent = $newestrow['Rent'];

  $aquery = "SELECT * FROM aparttb WHERE id='$apartment'";
  $aresult = mysqli_query($con,$aquery);
  $arow = mysqli_fetch_assoc($aresult);
  $apartmentname = $arow['apartment'];

  $hquery = "SELECT * FROM housetb WHERE id = '$houseno'";
  $hresult = mysqli_query($con,$hquery);
  $hrow = mysqli_fetch_assoc($hresult);
  $housename = $hrow['housenum'];

  
  $cquery = "SELECT * FROM doctb WHERE email ='$ctemail'";
  $cresult = mysqli_query($con,$cquery);
  $crow = mysqli_fetch_assoc($cresult);

  $psquery = "SELECT * FROM paymentstatustb where tid ='$Tid'";
  $psresult = mysqli_query($con,$psquery);
  $psrow = mysqli_fetch_assoc($psresult);
  $lastpaid = $psrow['lastpaid'];
  $output='';
 // while($row = mysqli_fetch_array($query)){
    $output .= '

    
    <label> Tenant ID : </label>'.$Tid.'<br/><br/>
    <label> Tenant Name : </label>'.$tname.'<br/><br/>
    <label> Apartment ID : </label>'.$apartment.'<br/><br/>
    <label> Apartment Name : </label>'.$apartmentname.'<br/><br/>
    <label> House Number : </label>'.$housename.'<br/><br/>    
    <label> Amount Due : </label>Ksh. '.$rent.'<br/><br/>
    <label> Amount Paid : </label>Ksh. '.$rent.'<br/><br/>

    
    ';

 // }
  
  return $output;
}

if(isset($_POST["cpassw"])){
    $Tid = $_SESSION['Tid'];
    $password = $_POST['password'];

    $puquery = "UPDATE tenanttb SET password='$password' WHERE Tid='$Tid'";
    $puresult = mysqli_query($con,$puquery);
}


if(isset($_GET["generate_bill"])){
    $date=date("Y-m-d H:i:s");
    $month = date("M",strtotime($date));
    $query12 ="UPDATE paymentstatustb SET currentdate='$date',lastpaid='$date',status='Paid' WHERE tid='$Tid'";
    $result12 = mysqli_query($con,$query12);
    $Tid = $_SESSION['Tid'];
    $query = "INSERT INTO paymenttb (tid,apartment,month,houseno,currentdate,amount) VALUES('$Tid','$apartment','$month','$houseno','$date','$rent')";
    $result = mysqli_query($con,$query);
  require_once("TCPDF/tcpdf.php");
  $obj_pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
  $obj_pdf -> SetCreator(PDF_CREATOR);
  $obj_pdf -> SetTitle("Generate Bill");
  $obj_pdf -> SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
  $obj_pdf -> SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
  $obj_pdf -> SetFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
  $obj_pdf -> SetDefaultMonospacedFont('helvetica');
  $obj_pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
  $obj_pdf -> SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
  $obj_pdf -> SetPrintHeader(false);
  $obj_pdf -> SetPrintFooter(false);
  $obj_pdf -> SetAutoPageBreak(TRUE, 10);
  $obj_pdf -> SetFont('helvetica','',12);
  $obj_pdf -> AddPage();
  $content = '';
  $content .= '<br/><h2 align ="center">CK Homes</h2></br>
      <h3 align ="center">Receipt</h3>';
  $content .= generate_bill();
  $obj_pdf -> writeHTML($content);
  ob_end_clean();
  $obj_pdf -> Output("bill.pdf",'I');
}


  if(isset($_POST['print-payments'])){
    require_once("TCPDF/tcpdf.php");
    $obj_pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
    $obj_pdf -> SetCreator(PDF_CREATOR);
    $obj_pdf -> SetTitle("Generate Report");
    $obj_pdf -> SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
    $obj_pdf -> SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $obj_pdf -> SetFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    $obj_pdf -> SetDefaultMonospacedFont('helvetica');
    $obj_pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf -> SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
    $obj_pdf -> SetPrintHeader(false);
    $obj_pdf -> SetPrintFooter(false);
    $obj_pdf -> SetAutoPageBreak(TRUE, 10);
    $obj_pdf -> SetFont('helvetica','',12);
    $obj_pdf -> AddPage();
    $content = '';
    $content .= '<br/><h2 align ="center">CK Homes</h2></br>
        <h3 align ="center">Payments</h3>';
    $content .= generate_payments();
    $obj_pdf -> writeHTML($content);
    ob_end_clean();
    $obj_pdf -> Output("bill.pdf",'I');

  }

function get_specs(){
  $con=mysqli_connect("localhost","root","","myhmsdb");
  $query=mysqli_query($con,"select username,spec from doctb");
  $docarray = array();
    while($row =mysqli_fetch_assoc($query))
    {
        $docarray[] = $row;
    }
    return json_encode($docarray);
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
        <script>
        var check = function() {
            if (document.getElementById('dpassword').value ==
                document.getElementById('cdpassword').value) {
                document.getElementById('message').style.color = '#5dd05d';
                document.getElementById('message').innerHTML = 'Matched';
            } else {
                document.getElementById('message').style.color = '#f55252';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        };
        </script>
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

        .btn-primary {
            background-color: #3c50c1;
            border-color: #3c50c1;
        }
        </style>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
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
        <h3 style="margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome
            &nbsp<?php echo $tname?>
        </h3>
        <div class="row">
            <div class="col-md-4" style="max-width:25%; margin-top: 3%">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list"
                        href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
                    <a class="list-group-item list-group-item-action" id="list-tenant-list" data-toggle="list"
                        href="#list-tenant" role="tab" aria-controls="home">Profile</a>
                    <a class="list-group-item list-group-item-action" id="list-pres-list" data-toggle="list"
                        href="#list-pres" role="tab" aria-controls="home">Pay Rent</a>
                    <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab"
                        data-toggle="list" aria-controls="home">Payments</a>
                    <a class="list-group-item list-group-item-action" href="#list-cpass" id="list-cpass-list" role="tab"
                        data-toggle="list" aria-controls="home">Change Password</a>
                    <a class="list-group-item list-group-item-action" href="#list-home" id="list-home-list" role="tab"
                        data-toggle="list" aria-controls="home">Make a Complain</a>
                    <a class="list-group-item list-group-item-action" href="#list-comp" id="list-comp-list" role="tab"
                        data-toggle="list" aria-controls="home">View Complaints</a>

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
                                            <h4 class="StepTitle" style="margin-top: 5%;">Profile</h4>
                                            <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                            </script>
                                            <p class="links cl-effect-1">
                                                <a href="#list-tenant" onclick="clickDiv('#list-tenant-list')">
                                                    View profile
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
                                                    <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
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

                    <!-- Update Password -->
                    <div class="tab-pane fade" id="list-cpass" role="tabpanel" aria-labelledby="list-cpass-list">
                        <form class="form-group" method="post" action="admin-panel.php">
                            <div class="row">
                                <div class="col-md-4"><label>Password:</label></div>
                                <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();'
                                        name="password" id="dpassword" required></div><br><br>
                                <div class="col-md-4"><label>Confirm Password:</label></div>
                                <div class="col-md-8" id='cpass'><input type="password" class="form-control"
                                        onkeyup='check();' name="cpassword" id="cdpassword" required>&nbsp &nbsp<span
                                        id='message'></span> </div><br><br>

                            </div>
                            <input type="submit" name="cpassw" value="Submit"
                                onClick="alert('Password Updated Successfully');" class=" btn btn-primary">
                        </form>
                    </div>

                    <div class="tab-pane fade" id="list-tenant" role="tabpanel" aria-labelledby="list-tenant-list">
                        <div class="container-fluid">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4>My Profile</h4>
                                    </center><br>
                                    <form class="form-group" method="post" action="admin-panel.php">
                                        <div class="row">
                                            <div class="col-md-4"><label>Name</label></div>
                                            <div class="col-md-8">
                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $newestrow['Tname']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Email</label></div>
                                            <div class="col-md-8">
                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $newestrow['temail']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>National ID</label></div>
                                            <div class="col-md-8">
                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $newestrow['NationalID']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Phone Number</label></div>
                                            <div class="col-md-8">
                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn">0<?php echo $newestrow['PhoneNo']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Apartment</label></div>
                                            <div class="col-md-8">
                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $apartmentname?></div>
                                            </div><br><br>

                                            <div class="col-md-4"><label>House Number</label></div>
                                            <div class="col-md-8">

                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $housename?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Rent</label></div>
                                            <div class="col-md-8">

                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $newestrow['Rent']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Deposit</label></div>
                                            <div class="col-md-8">

                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $newestrow['Deposit']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Caretaker</label></div>
                                            <div class="col-md-8">

                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $crow['username']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Caretaker Email</label></div>
                                            <div class="col-md-8">

                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn"><?php echo $newestrow['cemail']?></div>
                                            </div><br><br>
                                            <div class="col-md-4"><label>Caretaker Contact</label></div>
                                            <div class="col-md-8">

                                                <div type="text" value="Create new entry" class="form-control"
                                                    id="inputbtn">0<?php echo $crow['docFees']?></div>
                                            </div><br><br>
                                            <!-- <div class="col-md-4">
                                                <input type="submit" name="app-submit" value="Create new entry"
                                                    class="btn btn-primary" id="inputbtn">
                                            </div> -->
                                            <div class="col-md-8"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><br>
                    </div>



                    <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="container contact-form" style="font-family: 'IBM Plex Sans', sans-serif;">
                            <form method="post" action="contact.php">
                                <h3 align="center">Make a complain</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="txtName" class="form-control"
                                                placeholder="Your Name *" value="<?= $tname ?>" readonly="readonly"
                                                onkeydown="return alphaOnly(event);" required />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="txtEmail" class="form-control"
                                                placeholder="Your Email *" value="<?= $temail?>" readonly="readonly"
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" name="txtPhone" class="form-control"
                                                placeholder="Your Phone Number *" value="0<?= $contact?>"
                                                readonly="readonly" minlength="10" maxlength="10" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *"
                                                style="width: 100%; height: 150px;" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <input type="submit" name="btnSubmit" class="btn btn-primary"
                                        value="Send Message" />
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">
                        <div class="col-md-8">
                            <form class="form-group" action="searchpayments.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="month" placeholder="Enter Month"
                                            class="form-control"></div>
                                    <input type="text" hidden name="ID" value="<?php echo $Tid?>">
                                    <div class="col-md-2"><input type="submit" name="payment_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Amount Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;
                    $query = "SELECT * FROM paymenttb WHERE tid = '$Tid'";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                        $pid =$row['pid'];
                        $currentdate = $row['currentdate'];
                        $currentmonth = date("M",strtotime($currentdate));
                        $amount = $row['amount'];
                  echo"
                                <tr>
                                <td>$pid</td>
                                <td>$currentmonth</td>
                                <td>$amount</td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="col-md-8">
                            <form class="form-group" action="admin-panel.php" method="post">
                                <input type="text" hidden name="ID" value="<?php echo $Tid?>">
                                <div class="col-md-2">
                                    <input type="submit" name="print-payments" class="btn btn-primary" value="Print">
                                </div>
                            </form>
                        </div>
                        <br>
                    </div>



                    <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tenant Name</th>
                                    <th scope="col">National ID</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Apartment</th>
                                    <th scope="col">House No</th>
                                    <th scope="col">Rent</th>
                                    <th scope="col">Rent Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                echo " <tr>
                                <td>$tname</td>
                                <td>$nationalID</td>        
                                <td>0$contact</td>
                                <td>$apartmentname</td>
                                <td>$housename</td>
                                <td>$rent</td>
                                ";
                                ?>
                                <?php
                                   $query = "SELECT * FROM paymentstatustb WHERE tid='$Tid'";
                                   $result = mysqli_query($con,$query);
                                   $row = mysqli_fetch_assoc($result);
                                   $status = $row['status'];
                                   if($status == "Not Paid"):?>
                                <form method="get">
                                    <td>
                                        <a href="admin-panel.php?ID=<?php echo $Tid?>">
                                            <input type="hidden" name="ID" value="<?php echo $Tid?>" />
                                            <input type="submit" onclick="alert('Bill Paid Successfully');"
                                                name="generate_bill" class="btn btn-success" value="Pay Rent" />
                                        </a>
                                    </td>
                                    </tr>
                                </form>
                                <?php elseif ($status == "Paid"):?>
                                <td>
                                    <input type="text" disabled name="generate_bill" class="btn btn-danger"
                                        value="Paid" />
                                </td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <br>
                    </div>

                    <!-- View complaints -->
                    <div class="tab-pane fade" id="list-comp" role="tabpanel" aria-labelledby="list-comp-list">
                        <div class="col-md-8">
                            <form class="form-group" action="searchcomplaint.php" method="post">
                                <div class="row">
                                    <div class="col-md-10"><input type="text" name="compID"
                                            placeholder="Enter Complaint ID" class="form-control"></div>
                                    <div class="col-md-2"><input type="submit" name="comp_search_submit"
                                            class="btn btn-primary" value="Search"></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Complaint ID</th>
                                    <th scope="col">Complaint</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM contact WHERE tid='$Tid'";
                                $result = mysqli_query($con,$query);
                                while($row = mysqli_fetch_assoc($result)){                     
                                $cid = $row['id'];
                                $tid = $row['tid'];
                                $complaint = $row['message'];
                                $status = $row['status'];
                                echo " <tr>
                                <td>$cid</td>
                                <td>$complaint</td>";
                                
                                if($status == "Not Addressed"):?>
                                <form method="post" action="contact.php">
                                    <td>
                                        <input type="hidden" name="ID" value="<?php echo $cid?>" />
                                        <input type="submit" name="addressed" class="btn btn-success"
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




                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                        ...</div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                        <form class="form-group" method="post" action="func.php">
                            <label>Doctors name: </label>
                            <input type="text" name="name" placeholder="Enter doctors name" class="form-control">
                            <br>
                            <input type="submit" name="doc_sub" value="Add Doctor" class="btn btn-primary">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="list-attend" role="tabpanel" aria-labelledby="list-attend-list">...
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js">
    </script>



</body>

</html>