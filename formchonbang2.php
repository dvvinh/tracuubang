<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
<title>Tra cứu bằng</title>
    <style>
        table, td, tr, th{
            border: 1px solid #000000;
        }
        td.td_header{
            text-align: center;
            color:mediumvioletred;
            background-color: lightgreen;
        }
        td{
            padding: 4px;
        }
        .h1{
            color:mediumvioletred;
        }
    </style>
</head>

<body>
<div class="h1" align="center">TRA CỨU VĂN BẰNG CHỨNG CHỈ</div>

<div class="text-center">
<form id="form1" name="form1" method="post" action="">
  <p>
      <label for="cachtra">Tra cứu theo</label>
    <select name="cachtra" size="1" id="cachtra" accesskey="c" tabindex="1">
      <option value="id">id</option>
      <option value="sovaoso">Số vào sổ</option>
      <option value="sohieubang">Số hiệu bằng</option>
    </select>
    Giá trị
    <input type="text" name="giatri" id="giatri" accesskey="i" tabindex="1" />
    <input type="submit" name="xemtheoid" id="xemtheoid" value="Xem" />
  </p>
</form>
</div>
<p>
<?php 
	require ('mymodel.php'); 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{ 
		$md = new model();
		if($_POST['cachtra']=="sovaoso")
		{
			$ketqua=$md->get_bang_by_sovaoso($_POST['giatri']);
		}
		else if($_POST['cachtra']=="sohieubang")
		{
			$ketqua=$md->get_bang_by_sohieu($_POST['giatri']);
		}
		else if($_POST['cachtra']=="id")
		{
			$ketqua = $md->get_bang_by_id($_POST['giatri']);
		}
        if (!isset($ketqua) or !is_array($ketqua))
        {
            echo '<h2 align="center">Không tìm thấy thông tin</h2>';
            exit();
        }
?>
</p>
<div class="center-block">
    <h2 align="center">KẾT QUẢ TÌM KIẾM</h2>
<table align="center">
    <tr class="row-header">
        <td class="td_header" align="center">ID</td>
        <td nowrap="nowrap"><?php echo $ketqua['id'] ?> </td>
    </tr>
    <tr>
        <td class="td_header">Họ đệm</td>
        <td nowrap="nowrap"><?php echo $ketqua['HoDem'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Tên</td>
        <td nowrap="nowrap"><?php echo $ketqua['Ten'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Ngày sinh</td>
        <td nowrap="nowrap"><?php echo $ketqua['NgaySinh'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Giới tính</td>
        <td nowrap="nowrap"><?php echo $ketqua['GioiTinh'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Nơi sinh</td>
        <td nowrap="nowrap"><?php echo $ketqua['NoiSinh'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Điểm TB</td>
        <td nowrap="nowrap"><?php echo $ketqua['DiemTB'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Xếp loại</td>
        <td nowrap="nowrap"><?php echo $ketqua['XepLoai'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Số hiệu bằng</td>
        <td nowrap="nowrap"><?php echo $ketqua['SoHieuBang'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Số vào sổ</td>
        <td nowrap="nowrap"><?php echo $ketqua['SoVaoSo'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Tên ngành tiếng Việt</td>
        <td  nowrap="nowrap"><?php echo $ketqua['Nganh_Vie'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Tên ngành tiếng Anh</td>
        <td  nowrap="nowrap"><?php echo $ketqua['Nganh_Eng'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Ngày cấp</td>
        <td nowrap="nowrap"><?php echo $ketqua['NgayCap'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Hình thức đào tạo</td>
        <td nowrap="nowrap"><?php echo $ketqua['HinhThucDaoTao'] ?></td>
    </tr>
    <tr>
        <td class="td_header">Bậc học</td>
        <td nowrap="nowrap"><?php echo $ketqua['BacHoc'] ?></td>
    </tr>
</table>
<?php
	}
?>
</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>