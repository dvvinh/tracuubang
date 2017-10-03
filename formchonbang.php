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
            border: 2px solid #000000;
        }
        th{
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
?>
</p>
<div class="center-block">
<table align="center">
    <tr class="row-header" align="center">
        <th>ID</th>
        <th>Họ đệm</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Nơi sinh</th>
        <th>Điểm TB</th>
        <th>Xếp loại</th>
        <th>Số hiệu bằng</th>
        <th>Số vào sổ</th>
        <th>Tên ngành tiếng Việt</th>
        <th>Tên ngành tiếng Anh</th>
        <th>Ngày cấp</th>
        <th>Hình thức đào tạo</th>
        <th>Bậc học</th>
    </tr>
    <tr>
        <td nowrap="nowrap"><?php echo $ketqua['id'] ?> </td>
        <td nowrap="nowrap"><?php echo $ketqua['HoDem'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['Ten'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['NgaySinh'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['GioiTinh'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['NoiSinh'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['DiemTB'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['XepLoai'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['SoHieuBang'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['SoVaoSo'] ?></td>
        <td ><?php echo $ketqua['Nganh_Vie'] ?></td>
        <td ><?php echo $ketqua['Nganh_Eng'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['NgayCap'] ?></td>
        <td nowrap="nowrap"><?php echo $ketqua['HinhThucDaoTao'] ?></td>
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