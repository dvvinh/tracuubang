<?php
//define('PHPEXCEL_ROOT', dirname(__FILE__));
include_once('PHPExcel/IOFactory.php');
class xuly_excel{
	public function xuly_excel()
	{
	
	}
	public function docfile($inputFileName)
	{
        $kq[]=null;
		$ex_IO=new PHPExcel_IOFactory;
		try
		{
			$inputFileType=$ex_IO->identify($inputFileName);
            $objReader=$ex_IO->createReader($inputFileType);
            $objPHPExcel=$objReader->load($inputFileName);
		}
        catch(Exception $e) {
            die('Error loading file"' . pathinfo($inputFileType, PATHINFO_BASENAME) . '":' . $e->getMessage());
        }
        $sheet=$objPHPExcel->getSheet(0);
        $hightestRow=$sheet->getHighestRow();
        $hightestColumn=$sheet->getHighestColumn();
        $kq=$sheet->rangeToArray('A0:'.$hightestColumn.$hightestRow,null,true,false);

        return $kq;
	}
}
?>