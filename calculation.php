<?php include "calculator.php"; ?>
<?php 
$refg_payload=$_REQUEST['payload'];
$refg_crntprcl=$_REQUEST['crntprcl'];

if($refg_payload>0 && $refg_crntprcl>0){
$cat_type=$_REQUEST['cat_type'];
if($cat_type=='CRT'){ $category="CRT"; }
else if($cat_type=='REFRIGERATED'){ $category="REFRIGERATED"; }
else { $category="A"; }

$getInfoQry = $calcobj->getvolume($refg_payload,$category);
$infoFetch = mysqli_fetch_object($getInfoQry);

echo $thermal_vip = round($infoFetch->outervolume);
echo "splrt";
echo $currnet_prcl_weight = round($refg_crntprcl/6,1);
echo "splrt";
echo $thermal_vip_weight = round($thermal_vip/6,1);
echo "splrt";
$vlumtric_weight = round(($currnet_prcl_weight - $thermal_vip_weight),2);
if($vlumtric_weight<0){ $vlumtric_weight=0; } else { $vlumtric_weight=$vlumtric_weight; }
echo $vlumtric_weight;
echo "splrt";
$vlumtric_percent = round(100-($thermal_vip_weight/$currnet_prcl_weight)*100);
if($vlumtric_percent<0){ $vlumtric_percent=0; } else { $vlumtric_percent=$vlumtric_percent; }
echo $vlumtric_percent;
echo "splrt";
echo $vlum_stocked_panel = round($infoFetch->vlum_stocked_panel,1);
echo "splrt";
echo $vlum_weight = round($infoFetch->vlum_stocked_panel/6,1);
}
else{
echo "ERROR";	
}
?>