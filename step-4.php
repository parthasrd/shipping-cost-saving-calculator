<?php include "include/config.php"; $pagename="step4"; $step=4; ?>
<?php
if(!isset($_SESSION['step-three'])){
	echo "<script>window.location='".SITE_URL."/step-3.php'</script>";		
}
?>
<?php
if(isset($_REQUEST['step4']) && $_REQUEST['step4']!='')
{
	$_SESSION['step-four'] ="Done";
	
	$curr_ship_cost=$_REQUEST['curr_ship_cost'];
	$_SESSION['curr_ship_cost']=$curr_ship_cost;  /*********/
	
	echo "<script>window.location='".SITE_URL."/step-5.php'</script>";		
}
?>
<?php if(isset($_SESSION['curnt_prcl'])){ $curnt_prcl_sh = $_SESSION['curnt_prcl']; } else { $curnt_prcl_sh = 0; } ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step4 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step4">
<meta name="description" content="Calculator - Step4" />
<?php include "top-script.php"; ?>  
</head>

<body>
<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-3.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="Previous" /></a>
            <?php if(isset($_SESSION['curr_ship_cost'])){ ?>
            <a href="<?php echo SITE_URL; ?>/step-5.php"><img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" /></a>
            <?php } else { ?>
            <a><img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" /></a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-4">
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
                		<form action="" name="form4" id="form4" method="post" >
                        <h2>Enter your shipping cost</h2>
                        <div class="step-2">
                        	<div class="row">
                            	<div class="col-md-4 col-xs-12">
                                	<div class="block">
                                        <input type="text" name="curr_ship_cost" id="curr_ship_cost" value="<?php if(isset($_SESSION['curr_ship_cost'])){ echo $_SESSION['curr_ship_cost']; } ?>" />
                                        <label>Enter your current <br />shipping cost <br />[$]</label>
                                    </div>
                                </div>
                                <div class="col-md-8 col-xs-12">
                                	<div class="step-2-Current_Parcel">
                                        <p>Current Parcel<br /> Volumetric Weight <br />[Kg]</p>
                                        <h3 id="curnt_prcl"><?php echo $curnt_prcl_sh; ?></h3>
                                    </div>
                                    <div class="step-2-Current_Parcel">
                                        <p>Your total Weight <br />[Kg]</p>
                                        <h3><?php if(isset($_SESSION['toal_weight'])){ echo $_SESSION['toal_weight']; } else { echo "N/A"; } ?></h3>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <input class="next-step" id="stpBttn" name="step4" value="NEXT STEP" type="submit" onClick="return chekme()" />
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
$('#curr_ship_cost').keyup(function(event) {
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
	var val1 = $('#curr_ship_cost').val().trim();
	if(val1==''){ 
	$('#curr_ship_cost').addClass("showerror");
	return false; }
	else { 
	$('#curr_ship_cost').removeClass("showerror")
	return true; 
	}
}
</script>


<script>
$(document).ready(function(){
	var curr_ship_cost = $('#curr_ship_cost').val().trim();
	actvshow(curr_ship_cost);
});
$('#curr_ship_cost').keyup(function(event) {
	var curr_ship_cost = $('#curr_ship_cost').val().trim();
	actvshow(curr_ship_cost);
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