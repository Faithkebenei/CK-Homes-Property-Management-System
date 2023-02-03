<!DOCTYPE html>
<?php
  function generate_payments(){
    $contents ='<table cellspacing="0">
    <thead>
    <tr>
    <th style="width:30px">PID</th>
    <th style="width:120px">Email</th>
    <th style="width:100px">Apartment</th>
    <th style="width:30px">HNo</th>
    <th style="width:100px">Date</th>
    <th style="width:100px">Amount</th>
    </tr>
    </thead><tbody>';
    $con=mysqli_connect("localhost","root","","myhmsdb");
	$start = $_POST['start'];    
    $stop = $_POST['stop'];
    $query7 = "SELECT * FROM paymenttb WHERE currentdate>='$start' && currentdate<='$stop'";                 
    $result7 = mysqli_query($con,$query7);
    $sum = 0;             
    while ($row7 = mysqli_fetch_array($result7)){
        $pid = $row7['pid'];
        $tid = $row7['tid'];
        $month1 = $row7['currentdate'];
        $month = date("Y-m-d",strtotime($month1));
        $amount = $row7['amount'];
        $houseno = $row7['houseno'];
        $apartment = $row7['apartment'];
        $sum = $sum + $amount;
        $query8 = "SELECT * FROM tenanttb WHERE Tid='$tid'";
        $result8 = mysqli_query($con,$query8);
        if($row8 = mysqli_fetch_assoc($result8)){
            $temail = $row8['temail'];
        }
         
        $query9 = "SELECT * FROM housetb WHERE id='$houseno'";
        $result9 = mysqli_query($con,$query9);
        if($row9=mysqli_fetch_assoc($result9)){
            $housenum = $row9['housenum'];
        }
        $query10 = "SELECT * FROM aparttb WHERE id='$apartment'";
        $result10 = mysqli_query($con,$query10);
        if($row10=mysqli_fetch_assoc($result10)){
            $apartmentname = $row10['apartment'];
        }
        $contents .='<tr>
        <td style="width:30px;">'.$pid.'</td>
        <td style="width:120px;">'.$temail.'</td>
        <td style="width:100px;">'.$apartmentname.'</td>
        <td style="width:30px;">'.$housenum.'</td>
        <td style="width:100px;">'.$month.'</td>
        <td style="width:100px;">'.$amount.'</td>
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


  if(isset($_POST['print-payments-period'])){
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
?>
<html>

<head>
    <title>User Messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class='container-fluid' style='margin-top:50px;'>
        <div class='card'>
            <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
                <table class='table table-hover'>
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
include("newfunc.php");
if(isset($_POST['admin-payment-search-period']))
{
	$start = $_POST['start'];
    $stop = $_POST['stop'];
    $query7 = "SELECT * FROM paymenttb WHERE currentdate>='$start' && currentdate<='$stop'";                 
    $result7 = mysqli_query($con,$query7);
    $sum = 0;              
    while ($row7 = mysqli_fetch_array($result7)){
        $pid = $row7['pid'];
        $tid = $row7['tid'];
        $month1 = $row7['currentdate'];
        $month = date("Y-m-d",strtotime($month1));
        $amount = $row7['amount'];
        $houseno = $row7['houseno'];
        $apartment = $row7['apartment'];
        $sum = $sum + $amount;
        $query8 = "SELECT * FROM tenanttb WHERE Tid='$tid'";
        $result8 = mysqli_query($con,$query8);
        if($row8 = mysqli_fetch_assoc($result8)){
            $temail = $row8['temail'];
        }
         
        $query9 = "SELECT * FROM housetb WHERE id='$houseno'";
        $result9 = mysqli_query($con,$query9);
        if($row9=mysqli_fetch_assoc($result9)){
            $housenum = $row9['housenum'];
        }
        $query10 = "SELECT * FROM aparttb WHERE id='$apartment'";
        $result10 = mysqli_query($con,$query10);
        if($row10=mysqli_fetch_assoc($result10)){
            $apartmentname = $row10['apartment'];
        }
 
                        
                echo "<tr>
                <td>$pid</td>
                <td>$temail</td>
                <td>$apartmentname</td>
                <td>$housenum</td>
                <td>$month</td>
                <td>$amount</td>
                </tr>";

                }
          
    }   
    
	
?>
                    </tbody>
                </table>
                <center>
                    <div class="row">
                        <div class="col-md-6"><a href='admin-panel1.php' class='btn btn-light'>Back to your
                                Dashboard</a></div>
                        <div class="col-md-6">
                            <form class="form-group" action="admin-payment-search-period.php" method="post">
                                <input type="text" hidden name="start" value="<?php echo $start?>">
                                <input type="text" hidden name="stop" value="<?php echo $stop?>">
                                <button type="submit" name="print-payments-period" class="btn btn-primary"><i
                                        class="fa fa-print"></i>Print</button>

                            </form>
                        </div>
                    </div>
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