<?php
require_once 'server_connect.inc.php';
require_once 'get_logged.inc.php';
?>

<html>
<head></head>
<body>
	<form action="update_info.php" method="POST">
		First Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" name="fname"><br><br>
		Last Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" name="lname"><br><br>
 		Contact Number: &nbsp;&nbsp;<input type="text" value="" name="contactno"><br><br>
 		Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" name="address"><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit">
	</form>
</body>
</html>

<?php

	$acc_no=$_SESSION['acc_no'];
	//echo $acc_no;	

	if(isset($_POST['fname']) && !empty($_POST['fname']))
		{	$fname=$_POST['fname'];	
			echo $fname;
			$query="UPDATE CUSTOMERS set First_name='$fname' where Acc_no='$acc_no'";
			$query_=mysql_query($query);
			echo 'First Name changed'.'<br>';

		}
	
	if(isset($_POST['lname']) && !empty($_POST['lname']))
		{	$lname=$_POST['lname'];	
			$query="UPDATE CUSTOMERS set Last_name='$lname' where Acc_no='$acc_no'";
			$query_=mysql_query($query);
			echo 'Last Name changed'.'<br>';

		}
	
	if(isset($_POST['contactno']) && !empty($_POST['contactno']))
		{	$contact_no=$_POST['contactno'];	
			$query="UPDATE CUSTOMERS set Contact_No='$contact_no' where Acc_no='$acc_no'";
			$query_=mysql_query($query);
			echo 'Contact Number changed'.'<br>';

		}


	if(isset($_POST['address']) && !empty($_POST['address']))
		{	$address=$_POST['address'];	
			$query="UPDATE CUSTOMERS set Address='$address' where Acc_no='$acc_no'";
			$query_=mysql_query($query);
			echo 'Address changed'.'<br>';

		}

?>