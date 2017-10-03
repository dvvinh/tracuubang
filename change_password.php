<?php
session_start();
require_once 'mymodel.php';
$md=new model();
//$_SESSION["userId"] = "24";
?>
<html><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="styles_changepassword.css" />
<?php
//if(!isset($_SESSION["username"])) exit("Vui lòng đăng nhập !");
if(count($_POST)>0) {
    echo $username;
    $username=$_SESSION["username"];
    $currentPassword=md5($_POST["currentPassword"]);
    $newPassword=md5($_POST["newPassword"]);

    $result=$md->get_taikhoan_by_username($username);
    $row=mysql_fetch_array($result);

    if($currentPassword == $row["password"]) {
        //mysql_query("UPDATE users set password='" . $_POST["newPassword"] . "' WHERE userId='" . $_SESSION["userId"] . "'");
        $md->update_password($username,$newPassword);
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
?>
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>
</head>
<body>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2">Change Password</td>
</tr>
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>