<?php include "include/config.php"; $pagename="step6"; $step=6; ?>

<?php
if(!isset($_SESSION['step-five'])){
	echo "<script>window.location='".SITE_URL."/step-5.php'</script>";		
}
?>

<?php
if(isset($_REQUEST['step6']) && $_REQUEST['step6']!='')
{
	$_SESSION['step-six'] ="Done";
	$curnt_parcel_cost=$_REQUEST['curnt_parcel_cost'];
	$_SESSION['curnt_parcel_cost']=$curnt_parcel_cost;  /*********/
	
	echo "<script>window.location='".SITE_URL."/step-7.php'</script>";	
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step6 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step6">
<meta name="description" content="Calculator - Step6" />
<?php include "top-script.php"; ?>  
</head>

<body>
<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-5.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="Previous" /></a>
            <?php if(isset($_SESSION['curnt_parcel_cost'])){ ?>
            <a href="<?php echo SITE_URL; ?>/step-7.php"><img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" /></a>
            <?php } else { ?>
            <a><img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" /></a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-6">
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
                		<form name="form6" id="form6" action="" method="post">
                        <?php /*?><h2>Enter ThermaVIP+ shipping cost</h2><?php */?>
                        <h2>Enter current parcel cost</h2>
                        <div class="step-2">
                        	<div class="block">
                                <input type="text" name="curnt_parcel_cost" id="curnt_parcel_cost" value="<?php if(isset($_SESSION['curnt_parcel_cost'])){ echo $_SESSION['curnt_parcel_cost']; } ?>" />
                                <label>Enter your current <br />parcel cost <br />[$]</label>
                            </div>
                        	
                            
                        </div>
                        <input class="next-step" id="stpBttn" name="step6" value="NEXT STEP" type="submit" onClick="return chekme()" />
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
$('#curnt_parcel_cost').keyup(function(event) {
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
	var val1 = $('#curnt_parcel_cost').val().trim();
	if(val1==''){ 
	$('#curnt_parcel_cost').addClass("showerror");
	return false; }
	else { 
	$('#curnt_parcel_cost').removeClass("showerror")
	return true; 
	}
}
</script>

<script>
$(document).ready(function(){
	var curnt_parcel_cost = $('#curnt_parcel_cost').val().trim();
	actvshow(curnt_parcel_cost);
});
$('#curnt_parcel_cost').keyup(function(event) {
	var curnt_parcel_cost = $('#curnt_parcel_cost').val().trim();
	actvshow(curnt_parcel_cost);
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