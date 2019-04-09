<?php include "include/config.php"; $pagename="step5"; $step=5; ?>
<?php
if(!isset($_SESSION['step-four'])){
	echo "<script>window.location='".SITE_URL."/step-4.php'</script>";		
}
?>
<?php
if(isset($_REQUEST['step5']) && $_REQUEST['step5']!='')
{
	$_SESSION['step-five'] ="Done";
	
	$thrml_ship_cost=$_REQUEST['thrml_ship_cost'];
	$_SESSION['thrml_ship_cost']=$thrml_ship_cost;  /*********/
	
	$ship_save_cost= $_SESSION['curr_ship_cost'] - $_SESSION['thrml_ship_cost'];
	
	$_SESSION['ship_save_cost']=$ship_save_cost;  /*********/
	
	echo "<script>window.location='".SITE_URL."/step-6.php'</script>";		
}

if(isset($_SESSION['thrml_ship_cost'])){
	$ship_save_cost= $_SESSION['curr_ship_cost'] - $_SESSION['thrml_ship_cost'];
}
else{
	$ship_save_cost = 0;
}
?>
<?php if(isset($_SESSION['thrml_vip'])){ $thrml_vip_sh = $_SESSION['thrml_vip']; } else { $thrml_vip_sh = 0; } ?>
<?php
$thermal_iv = $_SESSION['fetchrow']->thermal_iv;
$pcm = $_SESSION['fetchrow']->pcm;
$thrmlvip_total_weigth_without_payload = $thermal_iv + $pcm;
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step5 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step5">
<meta name="description" content="Calculator - Step5" />
<?php include "top-script.php"; ?>  
</head>

<body>
<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-4.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="Previous" /></a>
            <?php if(isset($_SESSION['thrml_ship_cost'])){ ?>
            <a href="<?php echo SITE_URL; ?>/step-6.php"><img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" /></a>
            <?php } else { ?>
            <a><img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" /></a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-5">
        	<div class="row row-rtl">
            	<div class="col-md-4 col-xs-12 col-ltr">
                	<div class="right-panel">
                    	<div class="image step-3-img"><img src="<?php echo BASE_URL; ?>/images/step-4-bg.png" alt="" /></div>
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
                		<form action="" name="form5" id="form5" method="post" >
                        <h2>Enter ThermaVIP+ shipping cost</h2>
                        <div class="step-2">
                        	<div class="row clearfix">
                            	<div class="col-md-5 col-xs-12">
                                	<div class="block">
                                        <input type="text" name="thrml_ship_cost" id="thrml_ship_cost" value="<?php if(isset($_SESSION['thrml_ship_cost'])){ echo $_SESSION['thrml_ship_cost']; } ?>"  onKeyUp="calc_save()" />
                                        <label>Enter ThermaVIP+ <br />shipping cost <br />[$]</label>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-12">
                                	<div class="row row-1">
                                        <div class="col-sm-4 col-xs-12">
                                            <div class="step-2-Current_Parcel">
                                                <p>ThermaVIP Weight<br />Without PAYLOAD <br />Weight [kg]</p>
                                                <h3><?php echo $thrmlvip_total_weigth_without_payload; ?></h3>
                                            </div>
                                            <div class="step-2-Current_Parcel">
                                                <p>ThermaVIP <br />Volumetric Weight <br />[Kg]</p>
                                                <h3><?php echo $thrml_vip_sh; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <table class="Volumetric_weight_saving_table">
                                                <tr><th colspan="2">Shipping Cost saving</th></tr>
                                                <tr>
                                                    <td>
                                                    <h3><span id="ship_save_cost"><?php echo $ship_save_cost; ?></span>$</h3><img src="<?php echo BASE_URL; ?>/images/pig-sm.png" alt="" />
                                                    <div class="bottom-line"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        
                            
                        </div>
                        <input class="next-step" id="stpBttn" name="step5" value="NEXT STEP" type="submit" onClick="return chekme()" />
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
function calc_save()
{
	var curr_ship_cost = '<?php echo $_SESSION['curr_ship_cost']; ?>';
	var thrml_ship_cost = $('#thrml_ship_cost').val().trim();
	if(thrml_ship_cost<1){ var thrml_ship_cost = 0; }
	var ship_save_cost = eval(curr_ship_cost)-eval(thrml_ship_cost);
	$('#ship_save_cost').html(ship_save_cost);
}
</script>

<script>
$('#thrml_ship_cost').keyup(function(event) {
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
	var val1 = $('#thrml_ship_cost').val().trim();
	if(val1==''){ 
	$('#thrml_ship_cost').addClass("showerror");
	return false; }
	else { 
	$('#thrml_ship_cost').removeClass("showerror")
	return true; 
	}
}
</script>

<script>
$(document).ready(function(){
	var thrml_ship_cost = $('#thrml_ship_cost').val().trim();
	actvshow(thrml_ship_cost);
});
$('#thrml_ship_cost').keyup(function(event) {
	var thrml_ship_cost = $('#thrml_ship_cost').val().trim();
	actvshow(thrml_ship_cost);
});
function actvshow(val1)
{
	if(val1!=''){ 
		$('#stpBttn').removeClass('not-done');
	}
	else{ 
		$('#stpBttn').addClass('not-done');
	}
}
</script>
</body>
</html>
