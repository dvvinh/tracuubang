<?php
session_start();
if(!isset($_SESSION["username"])) 
{
?>
	<script>
		window.location.replace("login.php");
	</script>
<?php
	exit("Vui lòng đăng nhập !");
}
require_once 'mymodel.php';
require_once 'tienich.php';
require_once 'paging.php';
$md=new model();
$dulieu=$md->get_bang_all();

if( isset($_POST["chon"]) ){
    $chklist=str_replace(",","','",$_POST["chon"]);
    $kq_xoa=$md->delete_bang_by_list($chklist);
	?>
		<script>
			window.location.replace("quanlythongtinbang.php");
		</script>
	<?php
}
//Đoạn phân trang
 $config = array(
    'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
    'total_record'  => mysql_num_rows($dulieu), // Tổng số record
    'limit'         => 1000,// limit
    'link_full'     => 'quanlythongtinbang.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
    'link_first'    => 'quanlythongtinbang.php',// Link trang đầu tiên
);
$paging = new Pagination();
$paging->init($config);
$dulieu_trang=$md->get_bang_all_paging($config["limit"],$config["current_page"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles_quanlythongtinbang.css" />
<title>Quản lý thông tin bằng</title>
</head>
<body>
<script>
	window.onload = function(){
		//calculatechon();
	}
    function calculatechon()
    {
        var strchon="";
        var alen=36;//document.frmChiTiet.elements.length;
		var buttons=1
        //alen=(alen>buttons)?document.frmChiTiet.chk_list.length:0;
		alen=document.frmChiTiet.chk_list.length;
        for(var i=0; i < alen; i++){
            if(document.frmChiTiet.chk_list[i].checked==true)
                strchon+=document.frmChiTiet.chk_list[i].value+",";
        }
        //confirm("Gia tri:" + strchon);
        document.frmChiTiet.chon.value=strchon;
        return isok();
    }
    function isok()
    {
        return  confirm("Bạn có chắc chắn muốn xóa ?");
    }
	function toggle(source) {
		checkboxes = document.getElementsByName('chk_list');
  		for(var i=0, n=checkboxes.length;i<n;i++) {
    		checkboxes[i].checked = source.checked;
  		}	
  	}
</script>
</script>
<div class="UploadFile">
    <form action="upload.php" method="post" enctype="multipart/form-data" role="form">
      <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
      </div>
      <button type="submit" class="btn btn-default" name="Import" value="Import">Upload</button>
    </form>
<br />
</div>
<div id="TongDong">
<?php
echo "Tổng dòng dữ liệu hiện có: " . mysql_num_rows($dulieu);
?>
</div>
<form id="frmChiTiet" name="frmChiTiet" method="post" onsubmit="return calculatechon();">
<table class="table" width="800" border="0" cellspacing="0" cellpadding="1">
    <input type="hidden" name="chon" value="">
    &nbsp; &nbsp;
	<input type="checkbox" onClick="toggle(this)" />&nbsp; Tất cả &nbsp; &nbsp; &nbsp;
    <input type="submit" value="Delete" > <br /><br />

<tr class="tableheader" align="center" valign="middle">
    <th scope="col">Chọn</th>
    <th scope="col">STT</th>
    <th scope="col">Họ đệm</th>
    <th scope="col">Tên</th>
    <th scope="col">Ngày sinh</th>
    <th scope="col">Giới tính</th>
    <th scope="col">Nơi sinh</th>
    <th scope="col">Điểm TB</th>
    <th scope="col">Xếp loại</th>
    <th scope="col">Số hiệu bằng</th>
    <th scope="col">Số vào sổ</th>
    <th scope="col">Tên ngành tiếng Việt</th>
    <!--<th scope="col">Tên ngành tiếng Anh</th>-->
    <th scope="col">Ngày cấp</th>
    <th scope="col">Hình thức đào tạo</th>
    <th scope="col">Bậc học</th>
    <th scope="col">Thời gian cập nhật</th>
  </tr>
      <?php
        $demSoLuong=0;
      while ($row=mysql_fetch_array($dulieu_trang)){
            $demSoLuong++;
            if($demSoLuong % 2==0){
              echo "<tr class='row_chan'>";
            }else{
              echo "<tr class='row_le'>";
            }

            echo "<td align='center' valign='middle'><input name='chk_list' value='".$row["id"]."' type='checkbox'></td>";
            echo tienich::GhiDuLieuVaoBang(($config["current_page"]-1)*$config["limit"]+$demSoLuong," nowrap='nowrap' align='center'");
            echo tienich::GhiDuLieuVaoBang($row["HoDem"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["Ten"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["NgaySinh"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["GioiTinh"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["NoiSinh"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["DiemTB"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["XepLoai"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["SoHieuBang"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["SoVaoSo"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["Nganh_Vie"]," nowrap='nowrap'");
//            echo tienich::GhiDuLieuVaoBang($row["Nganh_Eng"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["NgayCap"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["HinhThucDaoTao"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["BacHoc"]," nowrap='nowrap'");
            echo tienich::GhiDuLieuVaoBang($row["ThoiGianCapNhat"]," nowrap='nowrap'");
            echo "</tr>";
        }
      ?>
</table>
</form>
<?php //Đoạn phân trang
echo $paging->html();
?>
</body>
</html>