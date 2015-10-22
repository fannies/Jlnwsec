<?PHP
	session_start();	
	$conn = oci_connect("system", "Dom546275", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>

Change Password
<hr>

<form action='ChangePass.php' method='post'>
	Password <br>
	<input name='password' type='password'><br><br>
	New Password<br>
	<input name='newpassword' type='password'><br>
	Confirm Password<br>
	<input name='confpassword' type='password'><br><br>
	<input name='submit' type='submit' value='Confirm'>
</form>

<?PHP
	if(isset($_POST['submit'])){
		$password = trim($_POST['password']);
		$newpass = trim($_POST['newpassword']);
		$confpass = trim($_POST['confpassword']);
		$query = "SELECT * FROM LOGIN WHERE password='$password'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($password == $query){
			echo "Successful.";
			if($newpass == $confpass){
				echo "Successful.";		
			}
			else{
				echo "Password error please try again.";
			}
		}
		else{
			echo "Password error please try again.";
		}
	};
	oci_close($conn);
?>
