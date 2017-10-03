<?php
    session_start();
    $_title="Đăng nhập";
    $_DangNhap="Đăng nhập";
require_once 'mymodel.php';
$md=new model();
if(isset($_POST['ok']))
{
    $u=$p="";
    if($_POST['username'] == NULL)
    {
        echo "Please enter your username<br />";
    }
    else
    {
        $u=$_POST['username'];
    }
    if($_POST['password'] == NULL)
    {
        echo "Please enter your password<br />";
    }
    else
    {
        $p=$_POST['password'];
    }
    if($u && $p){
        $p=md5($p);
        $user=$md->get_taikhoan($u,$p);
        //echo mysql_num_rows($user);
        if(mysql_num_rows($user)==0){
            echo "Sai tên đăng nhập hoặc mật khẩu !";
        } else{
            $row=mysql_fetch_array($user);
            $_SESSION['username']=$row['username'];
            $_dadangnhap=true;
            $_DangNhap="";
            header('Location: quanlythongtinbang.php');
            exit();
        }
    }
}
    require_once "header.php";
?>
<div>
	<div class="modal-dialog">
		<div class="loginmodal-container">
			<h1>Đăng nhập vào hệ thống</h1><br>
		  <form enctype="multipart/form-data" method="post" role="form">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="ok" class="login loginmodal-submit" value="Đăng nhập">
		  </form>
		</div>
	</div>
</div>

<?php
if(!isset($_dadangnhap) or $_dadangnhap==false)
{
    echo "Vui lòng đăng nhập !";
}
else
{
    header('Location: quanlythongtinbang.php');
    exit();
}
require_once "footer.php"
?>