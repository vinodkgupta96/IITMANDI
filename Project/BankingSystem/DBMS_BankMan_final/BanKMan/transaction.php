<?php
require_once 'server_connect.inc.php';
require_once 'get_logged.inc.php';
?>

<!DOCTYPE html>	
<html>
	<head>
	<link rel="stylesheet" href="main.css"/>
		<title>TRANSACTION</title>
	</head>

	<body>
		<br><br>
		<form action="transaction.php" method="POST" onsubmit="return validateForm()">
		
			 Account_Number*:&nbsp;&nbsp;<input type="text" value="" name="Acc_no"><br>
			 First name*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" name="First_name"><br> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit">
		</form>

		<script type="text/javascript">
			function validateForm() {
				var first_name = document.forms[0]["First_name"].value;
				var acc_no = document.forms[0]["Acc_no"].value;
    				if (first_name == null || first_name == "" || acc_no == null || acc_no == "") {
        				alert("Fields with * are compulsory");
        				return false;
        					} 
					}	
		</script>

      </body>

</html>

<?php

if(isset($_POST['First_name']) && !empty($_POST['First_name']) && isset($_POST['Acc_no']) && !empty($_POST['Acc_no'])){

	/*variable from form*/
	$first_name=$_POST['First_name'];
	$acc_no=$_POST['Acc_no'];
	$_SESSION['acc_no']=$acc_no;

	$query1="SELECT * FROM CUSTOMERS WHERE First_name='$first_name' AND Acc_no='$acc_no'";
	$query1_data=mysql_query($query1);
	
	if(mysql_num_rows($query1_data)==1){
		//echo 'successful'.$query1_data;
		header('Location:transaction_base.php');
		}
	else {
		echo 'Combination of account number/name doesnot exist';}
		}

	//<a href="index.php"><h1>home</h1></a>
        //<a href="logout.php"><h1>logout</h1></a>
?>



