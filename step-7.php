<?php include "include/config.php"; $pagename="step7"; $step=7; ?>

<?php
if(!isset($_SESSION['step-six'])){
	echo "<script>window.location='".SITE_URL."/step-6.php'</script>";		
}
?>

<?php
if(isset($_REQUEST['step7']) && $_REQUEST['step7']!='')
{
	
	$_SESSION['step-seven'] ="Done";
	$thrml_parcel_cost=$_REQUEST['thrml_parcel_cost'];
	$_SESSION['thrml_parcel_cost']=$thrml_parcel_cost;  /*********/
	
	echo "<script>window.location='".SITE_URL."/result.php'</script>";	
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step7 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step7">
<meta name="description" content="Calculator - Step7" />
<?php include "top-script.php"; ?>  
</head>

<body>
<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-6.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="Previous" /></a>
            <?php if(isset($_SESSION['thrml_parcel_cost'])){ ?>
            <a href="<?php echo SITE_URL; ?>/result.php"><img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" /></a>
            <?php } else { ?>
            <a><img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" /></a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-7">
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
                    	<form name="form7" id="form7" action="" method="post">
                		<h2>Enter ThermaVIP+</h2>
                        <div class="step-2">
                            <div class="block">
                                <input type="text" name="thrml_parcel_cost" id="thrml_parcel_cost" value="<?php if(isset($_SESSION['thrml_parcel_cost'])){ echo $_SESSION['thrml_parcel_cost']; } ?>" />
                                <label>Enter ThermaVIP+ <br />parcel cost <br />[$]</label>
                            </div>
                        </div>
                        <input class="next-step" id="stpBttn" name="step7" value="NEXT STEP" type="submit" onClick="return chekme()" />
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
$('#thrml_parcel_cost').keyup(function(event) {
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
	var val1 = $('#thrml_parcel_cost').val().trim();
	if(val1==''){ 
	$('#thrml_parcel_cost').addClass("showerror");
	return false; }
	else { 
	$('#thrml_parcel_cost').removeClass("showerror")
	return true; 
	}
}
</script>

<script>
$(document).ready(function(){
	var thrml_parcel_cost = $('#thrml_parcel_cost').val().trim();
	actvshow(thrml_parcel_cost);
});
$('#thrml_parcel_cost').keyup(function(event) {
	var thrml_parcel_cost = $('#thrml_parcel_cost').val().trim();
	actvshow(thrml_parcel_cost);
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