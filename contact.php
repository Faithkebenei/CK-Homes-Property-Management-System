<?php 
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
$Tid = $_SESSION['Tid'];
$tname = $_SESSION['Tname'];
$nationalID = $_SESSION['NationalID'];
$temail = $_SESSION['temail'];
$contact = $_SESSION['PhoneNo'];
$query = "SELECT apartment FROM tenanttb WHERE Tid='$Tid'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result); 
$apartment = $row['apartment'];
if(isset($_POST['btnSubmit']))
{$message = $_POST['txtMsg'];
	$query="insert into contact(tid,apartment,name,email,contact,message,status) values('$Tid','$apartment','$tname','$temail','$contact','$message','Not Addressed');";
	$result = mysqli_query($con,$query);
	if($result){
    	echo '<script type="text/javascript">'; 
		echo 'alert("Message sent successfully!");'; 
		echo 'window.location.href = "admin-panel.php";';
		echo '</script>';}}

if(isset($_POST['addressed']))
{$cid = $_POST['ID'];
	$status = 'Addressed';
	$query = "UPDATE contact SET status = '$status' WHERE id='$cid' and tid='$Tid'";
	$result = mysqli_query($con,$query);
	if($result){
		header("Location:admin-panel.php");
	}else{
		echo "Could not update";}}