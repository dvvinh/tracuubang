<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quản lý thông tin bằng</title>
</head>

<body>
<?php
include_once 'xulyexcel.php';
include_once 'mymodel.php';
    $md=new model();
	$target_dir="uploads/";
    $storagename=null;
    $uploadedStatus=0;
    if(isset($_POST["Import"]))
    {
        if(isset($_FILES["file"]))
        {
            if($_FILES["file"]["error"]>0)
            {
                echo "Return code:".$_FILES["file"]["error"]."<br />";
            }
            else{
                if(file_exists($_FILES["file"]["name"])){
                    unlink($_FILES["file"]["name"]);
                }
                $storagename=$target_dir . "luutam.xls";
                move_uploaded_file($_FILES["file"]["tmp_name"],$storagename);
                $uploadedStatus=1;
            }
        }
        else{
            echo "Chưa chọn file !";
        }
    }
    $dulieu=null;
    if($uploadedStatus==1){
        $xlexcel=new xuly_excel();
        $dulieu=$xlexcel->docfile($storagename);
		$DemDong=0;
        for($hang=4;$hang<count($dulieu);$hang++)  // Bắt đầu bằng hàng thứ 5 hàng 4 là tiêu đề
        {
			if($dulieu[$hang][3]=="") break; //Nếu cột tên(3) =rỗng thì không chạy nữa
            
			for($cot=0;$cot<count($dulieu[$hang]);$cot++)
            {
                switch ($cot){
                    case 2:
                        $hodem      =$dulieu[$hang][$cot];
                        break;
                    case 3:
                        $ten        =$dulieu[$hang][$cot];
                        break;
                    case 4:
                        $ngaysinh   = PHPExcel_Style_NumberFormat::toFormattedString($dulieu[$hang][$cot],'dd/MM/yyyy');
                        break;
                    case 5:
                        $gioitinh   =$dulieu[$hang][$cot];
                        break;
                    case 13:
                        $noisinh    =$dulieu[$hang][$cot];
                        break;
                    case 14:
                        $diemtb     =$dulieu[$hang][$cot];
                        break;
                    case 6:
                        $xeploai    =$dulieu[$hang][$cot];
                        break;
                    case 15:
                        $sohieubang =$dulieu[$hang][$cot];
                        break;
                    case 12:
                        $sovaoso    =$dulieu[$hang][$cot];
                        break;
                    case 9:
                        $nganh_vie  =$dulieu[$hang][$cot];
                        break;
                    case 10:
                        $nganh_eng  =$dulieu[$hang][$cot];
                        break;
                    case 11:
                        $ngaycap    =PHPExcel_Style_NumberFormat::toFormattedString($dulieu[$hang][$cot],'dd/MM/yyyy');
                        break;
                    case 7:
                        $hinhthucdaotao=$dulieu[$hang][$cot];
                        break;
                    case 16:
                        $bachoc     =$dulieu[$hang][$cot];
                        break;
                }
            }
            $md->themsocapbang($hodem, $ten, $ngaysinh, $gioitinh, $noisinh, $diemtb, $xeploai, $sohieubang, $sovaoso, 					$nganh_vie, $nganh_eng, $ngaycap, $hinhthucdaotao,$bachoc);
			$DemDong++;
        }
        echo "Đã cập nhật thành công ". $DemDong . " dòng dữ liệu ";
    }
?>
<script type="text/javascript">
    window.setTimeout(function() {
        window.location.href='./quanlythongtinbang.php';
    }, 1500);
</script>
</body>
</html>