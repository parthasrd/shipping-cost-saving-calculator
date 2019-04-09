<?php include "include/config.php"; $pagename="step3"; $step=3; ?>
<?php

if(!isset($_SESSION['step-two'])){
	echo "<script>window.location='".SITE_URL."/step-2.php'</script>";		
}

if(isset($_REQUEST['step3']) && $_REQUEST['step3']!='')
{
	$_SESSION['step-three'] = "Done";
	
	$payload_weight=$_REQUEST['payload_weight'];
	$pcm_weight=$_REQUEST['pcm_weight'];
	$parcel_weight=$_REQUEST['parcel_weight'];	
	
	$_SESSION['payload_weight']=$payload_weight;
	$_SESSION['pcm_weight']=$pcm_weight;
	$_SESSION['parcel_weight']=$parcel_weight;
	
	$toal_weight = $payload_weight+$pcm_weight+$parcel_weight; /*********/
	$_SESSION['toal_weight']=$toal_weight;
	
	$volumn_weight = max($_SESSION['curnt_prcl'],$toal_weight);  /*********/
	
	$_SESSION['volumn_weight'] = $volumn_weight;
	
	$thermal_iv = $_SESSION['fetchrow']->thermal_iv;
	$pcm = $_SESSION['fetchrow']->pcm;
	
	$thrmlvip_total_weigth_without_payload = $thermal_iv + $pcm;   /*********/
	
	$thrmlvip_total_weigth = $thrmlvip_total_weigth_without_payload + $_SESSION['payload_weight'];   /*********/
	
	$thrmlmax_weight = max($_SESSION['thrml_vip'],$thrmlvip_total_weigth);  /*********/
	
	$_SESSION['thrmlmax_weight'] = $thrmlmax_weight;
	
	echo "<script>window.location='".SITE_URL."/step-4.php'</script>";		
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step3 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step3">
<meta name="description" content="Calculator - Step3" />
<?php include "top-script.php"; ?> 
</head>

<body>
<header><?php include "header.php"; ?></header>
<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-2.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="Previous" /></a>
            
            <?php if(isset($_SESSION['payload_weight']) && isset($_SESSION['pcm_weight'])  && isset($_SESSION['parcel_weight'])){ ?>
            <a href="<?php echo SITE_URL; ?>/step-4.php"><img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" /></a>
            <?php } else { ?>
            <a><img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" /></a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-3">
        	<div class="row row-rtl">
            	<div class="col-md-4 col-xs-12 col-ltr">
                	<div class="right-panel">
                    	<div class="image step-3-img"><img src="<?php echo BASE_URL; ?>/images/step-3-bg.png" alt="" /></div>
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
                		<form action="" method="post" name="form3" id="form3">
                        <h2>Enter your weight</h2>
                        <div class="step-2 step-3">
                            <div class="block">
                                <input type="text" name="payload_weight" id="payload_weight" value="<?php if(isset($_SESSION['payload_weight'])){ echo $_SESSION['payload_weight']; } ?>" />
                                <label>Enter your<br /> payload weight<br />[kg]</label>
                            </div>
                            <div class="block">
                                <input type="text" name="pcm_weight" id="pcm_weight" value="<?php if(isset($_SESSION['pcm_weight'])){ echo $_SESSION['pcm_weight']; } ?>" />
                                <label>Enter your PCM weight <br />required for 96 hr <br />[kg]</label>
                            </div>
                            <div class="block">
                                <input type="text" name="parcel_weight" id="parcel_weight" value="<?php if(isset($_SESSION['parcel_weight'])){ echo $_SESSION['parcel_weight']; } ?>" />
                                <label>Enter your current <br />empty parcel weight <br />[kg]</label>
                            </div>
                        </div>
                        <input class="next-step" id="stpBttn"  name="step3" value="NEXT STEP" type="submit" onClick="return chekme()" />
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
$('#payload_weight').keyup(function(event) {
  if(event.which >= 37 && event.which <= 40) return;
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
$('#pcm_weight').keyup(function(event) {
  if(event.which >= 37 && event.which <= 40) return;
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
$('#parcel_weight').keyup(function(event) {
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
	var payload_weight = $('#payload_weight').val().trim();
	var pcm_weight = $('#pcm_weight').val().trim();
	var parcel_weight = $('#parcel_weight').val().trim();
	
	var flg1= false;
	var flg2= false;
	var flg3= false;
	
	if(payload_weight==''){ 
	$('#payload_weight').addClass("showerror");
	var flg1= false;
	}
	else { 
	$('#payload_weight').removeClass("showerror")
	var flg1= true;
	}
	
	if(pcm_weight==''){ 
	$('#pcm_weight').addClass("showerror");
	var flg2= false;
	}
	else { 
	$('#pcm_weight').removeClass("showerror")
	var flg2= true;
	}
	
	if(parcel_weight==''){ 
	$('#parcel_weight').addClass("showerror");
	var flg3= false;
	}
	else { 
	$('#parcel_weight').removeClass("showerror")
	var flg3= true;
	}
	
	if(flg1 && flg2 && flg3){ return true; } else { return false; }
}
</script>

<script>

$(document).ready(function(){
	var payload_weight = $('#payload_weight').val().trim();
	var pcm_weight = $('#pcm_weight').val().trim();
	var parcel_weight = $('#parcel_weight').val().trim();
	actvshow(payload_weight,pcm_weight,parcel_weight);
});
$('#payload_weight').keyup(function(event) {
	var payload_weight = $('#payload_weight').val().trim();
	var pcm_weight = $('#pcm_weight').val().trim();
	var parcel_weight = $('#parcel_weight').val().trim();
	actvshow(payload_weight,pcm_weight,parcel_weight);
});

$('#pcm_weight').keyup(function(event) {
	var payload_weight = $('#payload_weight').val().trim();
	var pcm_weight = $('#pcm_weight').val().trim();
	var parcel_weight = $('#parcel_weight').val().trim();
	actvshow(payload_weight,pcm_weight,parcel_weight);
});

$('#parcel_weight').keyup(function(event) {
	var payload_weight = $('#payload_weight').val().trim();
	var pcm_weight = $('#pcm_weight').val().trim();
	var parcel_weight = $('#parcel_weight').val().trim();
	actvshow(payload_weight,pcm_weight,parcel_weight);
});


function actvshow(val1,val2,val3)
{
	if(val1!='' && val2!='' && val3!=''){ 
		$('#stpBttn').removeClass('not-done');
	}
	else{ 
		$('#stpBttn').addClass('not-done');
	}
}
</script>
</body>
</html>
