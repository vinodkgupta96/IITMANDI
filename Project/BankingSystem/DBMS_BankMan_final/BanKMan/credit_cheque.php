<?php
require_once 'server_connect.inc.php';
require_once 'get_logged.inc.php';
if(@($_SESSION['emp_id']==null || $_SESSION['emp_id']=="") && (@($_SESSION['atm']==null ||$_SESSION['atm']=="") || @($_SESSION['pin']==null ||$_SESSION['pin']=="")))
{
die(header('Location:index.php'));
}
?>


<html>
<head><link rel="stylesheet" href="main.css"/></head>
<body>

	<form action="credit_cheque.php" method="POST" onsubmit="return validateForm()">
		 Amount*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" name="Amount"><br><br>
		 Account number*:&nbsp;&nbsp;<input type="text" value="" name="Acc_no1"><br><br>
 
		<input type="submit" value="Submit">
	</form>

	<script type="text/javascript">
		function validateForm() {
    			var amount = document.forms[0]["Amount"].value;
			var acc_no1 = document.forms[0]["Acc_no1"].value;
    
		        if ( amount == null || amount == "" || acc_no1== null || acc_no1=="" ) {
        			alert("Fields with * are compulsory");
			        return false;
        
    				} 
			}
	</script>

</body>
</html>

<?php

if(isset($_POST['Amount']) && !empty($_POST['Amount']) && isset($_POST['Acc_no1']) && !empty($_POST['Acc_no1']) ){

	$time=time();
	$date=date("Y/m/d",$time);
	$amount=$_POST['Amount'];
	
	if($amount>0){
		$acc_no_debit=$_POST['Acc_no1'];
		$acc_no=$_SESSION['acc_no'];
		$Emp_id=$_SESSION['emp_id'];
		$query3="SELECT * FROM CUSTOMERS WHERE Acc_no='$acc_no_debit'";
		$query3_data=mysql_query($query3);
		if(mysql_num_rows($query3_data)==1){
			$query3_row=mysql_fetch_assoc($query3_data);
			$a=$query3_row['Amount'];
			if($amount<=$a){
			$query7="SELECT Trans_count FROM Transaction_count";
$query7_data=mysql_query($query7);
$query7_row=mysql_fetch_assoc($query7_data);
		$Trans_id=$query7_row['Trans_count']+1;
				$query1="INSERT INTO Transactions(Trans_id,Date,Acc_no,Remark,Amount,Emp_id) VALUES('$Trans_id','$date','$acc_no','CREDIT_CHEQUE','$amount','$Emp_id')";
				$query6="INSERT INTO Transactions(Trans_id,Date,Acc_no,Remark,Amount,Emp_id) VALUES('$Trans_id','$date','$acc_no_debit','DEBIT_CHEQUE','$amount','$Emp_id')";
				$query4="UPDATE CUSTOMERS SET Amount=Amount-'$amount' WHERE Acc_no='$acc_no_debit'";
				$query2="UPDATE CUSTOMERS SET Amount=Amount+'$amount' WHERE Acc_no='$acc_no'";
				$query5="UPDATE Transaction_count SET Trans_count=Trans_count+1";

				if($query1_data=mysql_query($query1) && $query2_data=mysql_query($query2) && $query4_data=mysql_query($query4) && $query6_data=mysql_query($query6)){
					if($query5_data=mysql_query($query5)){
					echo 'successful'; //$query1_data;
					echo '<h4>Account Number :</h4>'.$acc_no.'<h4>Amount credited:</h4>'.$amount.'<h4>Cheque bearer:</h4>'.$acc_no_debit;
					}
				else { echo 'Cannot Credit';
					}
				}}
			else{ 
				echo '<h1>CHEQUE BOUNCED</h1>';
				}
			}
		else{
			echo 'Account number does not exist ';
			}
		}
	else{
		die('Amount entered is not valid'); }
		}
//<a href="index.php"><h1>home</h1></a>
//<a href="logout.php"><h1>logout</h1></a>


?>


