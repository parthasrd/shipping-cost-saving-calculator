<?php
class calculator
{
	function __construct() {
		$this->dbHost = "localhost";
		$this->dbUser = "root";
		$this->dbPass = "";
		$this->dbName = "calculator";
		$this->db = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
	}
	
	function getvolume($dimention_id,$catname)
	{
		$sql="select (outer_length*outer_width*outer_height)/1000 as outervolume, (inner_length*inner_width*inner_height)/1000 as innervolume, dimention_id, vlum_stocked_panel from dimention where 1=1 ";
		if($catname!='A'){ $sql.=" and category='".$catname."'"; }
		if($dimention_id!='A'){ $sql.=" and dimention_id='".$dimention_id."'"; }
		//echo $sql;
		$qry=mysqli_query($this->db,$sql);
		return $qry;
	}
	
	function query($qry_str)
	{
		return $query=mysqli_query($this->db,$qry_str);
	}
	
	function results($sql)
	{
		$result_array=array();
		$query=mysqli_query($this->db,$sql);
		while($row = mysqli_fetch_object($query)){ $result_array[]=$row; }
		return $result_array;
	}
	
	function getcost($kg)
	{
		$kgval = ceil($kg);
		$sql = "select * from cost_chart where kg ='".$kgval."' ";
		$qry=mysqli_query($this->db,$sql);
		$fetchdtls = mysqli_fetch_object($qry);
		return $fetchdtls->china_us_usd;
	}
	
	function test()
	{
		echo "welcome to calculator";	
	}
	
	
	
	
	
	
	
	
	
}
$calcobj= new calculator();
?>