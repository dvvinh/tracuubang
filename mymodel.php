<?php
class model{
    public $cauhinh =array();

	public function __construct()
	{
	    $this->cauhinh = parse_ini_file("config.ini",true) ;
	}
	public function dbconnect()
	{
        if(!isset($cauhinh))
        $this->cauhinh = parse_ini_file("config.ini",true) ;
        $db_host=$this->cauhinh["database"]["db_host"];
        $db_username=$this->cauhinh["database"]["db_username"];
        $db_pass=$this->cauhinh["database"]["db_pass"];
        $db_name=$this->cauhinh["database"]["db_name"];
	    static $connect = null;
	    if ($connect === null) {
            $connect = mysql_connect($db_host,$db_username,$db_pass);
            mysql_select_db($db_name);
        }
        return $connect;
    }
    public function getData( $limit = 10, $page = 1, $query_string )
    {
        if ($limit != 'all') {
            $query_string .= " LIMIT " . (($page - 1) * $limit) . ", $limit";
        }
        $rs = mysql_query($query_string,$this->dbconnect());
        return $rs;
    }
    public function get_bang_all()
    {
        $sql = mysql_query("SELECT * FROM vb_danhsachbang",$this->dbconnect());
        return $sql;
    }
    public function get_bang_all_paging($limit = 10, $page = 1)
    {
        $sql_string = "select * FROM vb_danhsachbang order by id ASC";
        return $this->getData($limit, $page ,$sql_string);
    }

    public function get_bang_by_id($id)
	{ 
        $sql = mysql_query("SELECT * FROM vb_danhsachbang WHERE id='$id'",$this->dbconnect());
        return mysql_fetch_array($sql);
	} 
	public function get_bang_by_sohieu($sohieu) 
	{ 
        $sql = mysql_query("SELECT * FROM vb_danhsachbang WHERE SoHieuBang='$sohieu'",$this->dbconnect());
        return mysql_fetch_array($sql);
	} 
	public function get_bang_by_sovaoso($sovaoso) 
	{ 
        $sql = mysql_query("SELECT * FROM vb_danhsachbang WHERE SoVaoSo='$sovaoso'",$this->dbconnect());
        return mysql_fetch_array($sql);
	} 
	public function themsocapbang($hodem, $ten, $ngaysinh, $gioitinh, $noisinh, $diemtb, $xeploai, $sohieubang, $sovaoso, $nganh_vie, $nganh_eng, $ngaycap, $hinhthucdaotao, $bac_hoc)
	{
		$sql=mysql_query("insert  into vb_danhsachbang(HoDem,Ten,NgaySinh,GioiTinh,NoiSinh,DiemTB,XepLoai,SoHieuBang,SoVaoSo,Nganh_Vie,Nganh_Eng,NgayCap,HinhThucDaoTao, BacHoc) values('$hodem','$ten','$ngaysinh','$gioitinh','$noisinh','$diemtb','$xeploai','$sohieubang','$sovaoso','$nganh_vie','$nganh_eng','$ngaycap','$hinhthucdaotao','$bac_hoc')",$this->dbconnect());
        //return mysql_num_rows($sql);
	}
    public function get_taikhoan($u, $p){
        $sql=mysql_query("select * from vb_user WHERE  username='".$u."' and password='".$p."'", $this->dbconnect());
        return $sql;
    }
    public  function get_taikhoan_by_username($username){
        $sql=mysql_query("select * from vb_user WHERE  username='".$username."'", $this->dbconnect());
        return $sql;
    }
    public  function update_password($username, $password){
        $sql=mysql_query("update user set password='".$password."' where username='".$username."'", $this->dbconnect());
        return $sql;
    }
    public function delete_bang_by_list($strid)
    {
        $sql=mysql_query("delete FROM vb_danhsachbang where id in('".$strid."')",$this->dbconnect());
        return $sql;
    }
}
?>