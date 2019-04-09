<?php include "include/config.php"; $pagename="step2"; $step=2; ?>
<?php
/* Receive date from step 1 page */
if(isset($_REQUEST['package_opt'])){
$package_opt = $_REQUEST['package_opt'];
$_SESSION['packageopt'] = $package_opt;
}
else{
$_SESSION['packageopt'] = $_SESSION['packageopt'];
}
?>

<?php
if($_SESSION['packageopt']=='REFRIGERATED'){ 
	$dpoption = $refg;
}
else if($_SESSION['packageopt']=='CRT'){ 
	$dpoption = $crt;
}
else{ 
	echo "<script>window.location='".SITE_URL."/step-1.php'</script>";	
}
?>
<?php
if(isset($_REQUEST['step2']) && $_REQUEST['step2']!='')
{
	$refg_payload=$_REQUEST['payload'];
	$refg_crntprcl=$_REQUEST['crntprcl'];
	
	$_SESSION['payload'] = $refg_payload;
	$_SESSION['crntprcl'] = $refg_crntprcl;
	
	if($refg_payload>0 && $refg_crntprcl>0){
	$cat_type=$package_opt;
	if($cat_type=='CRT'){ $category="CRT"; }
	else if($cat_type=='REFRIGERATED'){ $category="REFRIGERATED"; }
	else { $category="A"; }
	
	$getInfoQry = $calcobj->getvolume($refg_payload,$category);
	$infoFetch = mysqli_fetch_object($getInfoQry);
	
	$fetchrow = $calcobj->results("select * from dimention where dimention_id='".$infoFetch->dimention_id."' limit 0,1");
	
	$_SESSION['fetchrow'] = $fetchrow[0];
	
	$_SESSION['step-two']="Done";
	
	
	$thermal_vip = round($infoFetch->outervolume);  /*************/
	$currnet_prcl_weight = round($refg_crntprcl/6,1); /*************/
	$thermal_vip_weight = round($thermal_vip/6,1); /*************/
	$vlumtric_weight = round(($currnet_prcl_weight - $thermal_vip_weight),2);
	if($vlumtric_weight<0){ $vlumtric_weight=0; } else { $vlumtric_weight=$vlumtric_weight; }
	$vlumtric_weight; /*************/
	$vlumtric_percent = round(100-($thermal_vip_weight/$currnet_prcl_weight)*100);
	if($vlumtric_percent<0){ $vlumtric_percent=0; } else { $vlumtric_percent=$vlumtric_percent; }
	$vlumtric_percent;  /*************/
	$vlum_stocked_panel = round($infoFetch->vlum_stocked_panel,1);  /*************/
	$vlum_weight = round($infoFetch->vlum_stocked_panel/6,1);  /*************/
	
	$_SESSION['thrmvip'] = $thermal_vip;
	
	$_SESSION['curnt_prcl'] = $currnet_prcl_weight;
	$_SESSION['thrml_vip'] = $thermal_vip_weight;
	$_SESSION['saving_volwgt'] = $vlumtric_weight;
	$_SESSION['saving_volwgt_perc'] = $vlumtric_percent;
	
	$_SESSION['stock_panel'] = $vlum_stocked_panel;
	$_SESSION['volm_wegt'] = $vlum_weight;
	
	
	
	$save_vol_wegt_val = $_SESSION['curnt_prcl'] - $_SESSION['thrml_vip'];
	$_SESSION['save_vol_wegt_val'] = $save_vol_wegt_val;
	
	$save_vol_wegt_perc = round((100-(($_SESSION['thrml_vip']/$_SESSION['curnt_prcl'])*100)),2);
	$_SESSION['save_vol_wegt_perc'] = $save_vol_wegt_perc;
	
	
	echo "<script>window.location='".SITE_URL."/step-3.php'</script>";	
	
	}
	else{
			
	}	
}

if(isset($_SESSION['curnt_prcl'])){ $curnt_prcl_sh = $_SESSION['curnt_prcl']; } else { $curnt_prcl_sh = 0; }
if(isset($_SESSION['thrml_vip'])){ $thrml_vip_sh = $_SESSION['thrml_vip']; } else { $thrml_vip_sh = 0; }
if(isset($_SESSION['saving_volwgt'])){ $saving_volwgt_sh = $_SESSION['saving_volwgt']; } else { $saving_volwgt_sh = 0; }
if(isset($_SESSION['saving_volwgt_perc'])){ $saving_volwgt_perc_sh = $_SESSION['saving_volwgt_perc']; } else { $saving_volwgt_perc_sh = 0; }

if(isset($_SESSION['stock_panel'])){ $stock_panel_sh = $_SESSION['stock_panel']; } else { $stock_panel_sh = 0; }
if(isset($_SESSION['volm_wegt'])){ $volm_wegt_sh = $_SESSION['volm_wegt']; } else { $volm_wegt_sh = 0; }

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step2 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step2">
<meta name="description" content="Calculator - Step2" />
<?php include "top-script.php"; ?>
</head>

<body>
<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-1.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="Previous" /></a>
            
            <?php if(isset($_SESSION['payload']) && isset($_SESSION['crntprcl'])){ ?>
            <a href="<?php echo SITE_URL; ?>/step-3.php"><img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" /></a>
            <?php } else { ?>
            <a><img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" /></a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-2">
        	<div class="row row-rtl">
            	<div class="col-md-4 col-xs-12 col-ltr">
                	<div class="right-panel">
                    	<div class="image step-1-img"><img src="<?php echo BASE_URL; ?>/images/step-2-bg.png" alt="" /></div>
                    	<?php include "side-menu.php"; ?>
                        <div class="top-img">
                        <?php 
						if($_SESSION['packageopt']=='REFRIGERATED'){  $topimg=BASE_URL."/images/snap.png"; }
						else if($_SESSION['packageopt']=='CRT'){ $topimg=BASE_URL."/images/snap1.png";
						} else{$topimg=''; }
						?>
                        <?php if($topimg!=''){ ?>
                        <img src="<?php echo $topimg; ?>" alt="" title="<?php echo $_SESSION['packageopt']; ?>" />
                        <?php } ?>
                        </div>
                    </div>
                </div>
            	<div class="col-md-8 col-xs-12 col-ltr">
                	<div class="left-panel">
                		<form action="" method="post" id="form2">
                        <h2>Select the volume of your package</h2>
                        <div class="step-2">
                        <div class="row clearfix">
                        	<div class="col-md-5 col-xs-12">
                            	<div class="block">
                                    <select name="payload" id="payload" onChange="calcp()">
                                    <?php while($inr_ftch=mysqli_fetch_object($dpoption)){ ?>
                                    <option value="<?php echo $inr_ftch->dimention_id; ?>" <?php if($inr_ftch->dimention_id==$_SESSION['payload']){ ?> selected<?php } ?>><?php echo round($inr_ftch->innervolume);?></option>             
                                    <?php } ?>
                                    </select>
                                    <label>Payload volume <br />[L]</label>
                                </div>
                                
                                <div class="block">
                                    <div class="info">External volume should be bigger then payload volume</div>
                                    
                                    <input type="text" name="crntprcl" id="crntprcl" value="<?php if(isset($_SESSION['crntprcl'])){ echo $_SESSION['crntprcl']; } ?>" onKeyUp="calcp()" />
                                    <label>External volume of your current parcel same payload <br />[L]</label>
                                </div>
                            </div>
                            <div class="col-md-7 col-xs-12">
                            	<div class="row row-1">
                                	<div class="col-sm-4 col-xs-12">
                                    	<div class="step-2-Current_Parcel">
                                            <p>Current Parcel<br /> Volumetric Weight <br />[Kg]</p>
                                            <h3 id="curnt_prcl"><?php echo $curnt_prcl_sh; ?></h3>
                                        </div>
                                        <div class="step-2-Current_Parcel">
                                            <p>ThermaVIP<br /> Volumetric Weight <br />[Kg]</p>
                                            <h3 id="thrml_vip"><?php echo $thrml_vip_sh; ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-xs-12">
                                    	<table class="Volumetric_weight_saving_table">
                                            <tr><th colspan="2">Volumetric weight saving</th></tr>
                                            <tr>
                                                <td>
                                                <p>Saving in<br /> Volumetric Weight <br />[Kg]</p>
                                                <h3><span id="saving_volwgt"><?php echo $saving_volwgt_sh; ?></span></h3><img src="<?php echo BASE_URL; ?>/images/pig-sm.png" alt="" />
                                                <div class="bottom-line"></div>
                                                </td>
                                                <td>
                                                <p>Saving in<br /> Volumetric Weight <br />[%]</p>
                                                <h3><span id="saving_volwgt_perc"><?php echo $saving_volwgt_perc_sh; ?></span></h3><img src="<?php echo BASE_URL; ?>/images/pig-sm.png" alt="" />
                                                <div class="bottom-line"></div>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <table class="Return_shipping_ThermaVIP_table">
                                            <tr><th colspan="2">Return shipping of <br />ThermaVIP+ panels (closed loop)</th></tr>
                                            <tr>
                                                <td>
                                                <p>Volume of Stacked <br />Panels [L]</p>
                                                <h3><span id="stock_panel"><?php echo $stock_panel_sh; ?></span></h3>
                                                </td>
                                                <td>
                                                <p>Volumetric Weight <br />[Kg]</p>
                                                <h3><span id="volm_wegt"><?php echo $volm_wegt_sh; ?></span></h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <input class="next-step" value="NEXT STEP" id="stpBttn" name="step2" type="submit" onClick="return chekme()" />
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<footer class="footer"><?php include "footer.php"; ?></footer>

<?php include "footer-script.php"; ?>

<script>
function calcp(){
	
	
	var payload = $('#payload').val().trim();
	var crntprcl = $('#crntprcl').val().trim();
	var cat_type ='<?php echo $_SESSION['packageopt']; ?>';
	

	$.ajax({
		url: '<?php echo SITE_URL; ?>/calculation.php',
		data: { payload: payload, crntprcl: crntprcl, cat_type: cat_type },
		type: 'POST',
		success: function(result) {  
			
			
			if(result.trim()!='ERROR'){
			var arstrg = result.split("splrt");
			
			$('#curnt_prcl').html(arstrg[1]);
			$('#thrml_vip').html(arstrg[2]);
			$('#saving_volwgt').html(arstrg[3]);
			$('#saving_volwgt_perc').html(arstrg[4]);
			$('#stock_panel').html(arstrg[5]);
			$('#volm_wegt').html(arstrg[6]);
			
			}
			
		}
	});
}
</script>

<script>
$('#crntprcl').keyup(function(event) {
  if(event.which >= 37 && event.which <= 40) return;
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
</script>

<script>
function chekme()
{	
	var val1 = $('#crntprcl').val().trim();
	if(val1==''){ 
	$('#crntprcl').addClass("showerror");
	return false; }
	else { 
	$('#crntprcl').removeClass("showerror")
	return true; 
	}
}

</script>

<script>
$(document).ready(function(){
  var val1 = $('#crntprcl').val().trim();
  infoshow(val1);
});
$('#crntprcl').keyup(function(event) {
	var val1 = $('#crntprcl').val().trim();
	infoshow(val1);
});
function infoshow(val1)
{
	if(val1!=''){ 
	$('.info').addClass("shwmsg"); 
	$('#stpBttn').removeClass('not-done');
	}
	else{ 
	$('.info').removeClass("shwmsg");
	$('#stpBttn').addClass('not-done');
	}
}
</script>
</body>
</html>
