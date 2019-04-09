<?php include "include/config.php"; $pagename="result"; $step=8; ?>
<?php
if(!isset($_SESSION['step-seven'])){
	echo "<script>window.location='".SITE_URL."/step-7.php'</script>";		
}
?>

<?php

if(isset($_REQUEST['newCalc']) && $_REQUEST['newCalc']!='')
{
	session_destroy();
	echo "<script>window.location='step-1.php'</script>";
}


if(isset($_SESSION['volumn_weight'])){
$final_yrtotal_ship_cost = $calcobj->getcost($_SESSION['volumn_weight']);
} else { $final_yrtotal_ship_cost = 0; }

if(isset($_SESSION['thrmlmax_weight'])){
$final_thrml_ship_cost = $calcobj->getcost($_SESSION['thrmlmax_weight']);
} else { $final_thrml_ship_cost = 0; }


$fincal_cuunt_total_ship_cost = $final_yrtotal_ship_cost + $_SESSION['curnt_parcel_cost'];

$fincal_thrml_total_ship_cost = $final_thrml_ship_cost + $_SESSION['thrml_parcel_cost'];

if(isset($_SESSION['curr_ship_cost'])){ $curr_ship_cost = $_SESSION['curr_ship_cost']; } else { $curr_ship_cost = 0; }
if(isset($_SESSION['thrml_ship_cost'])){ $thrml_ship_cost = $_SESSION['thrml_ship_cost']; } else { $thrml_ship_cost = 0; }

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Result">
<meta name="description" content="Calculator - Result" />
<?php include "top-script.php"; ?>  
</head>

<body>
<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <a href="<?php echo SITE_URL; ?>/step-7.php"><img src="<?php echo BASE_URL; ?>/images/icon-4.png" alt="" title="" /></a>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-result">
        	<div class="row row-rtl">
            	<div class="col-md-4 col-xs-12 col-ltr">
                	<div class="right-panel">
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
                	<div class="result-panel">
                		<h2>Your savings with ThermaVIP+</h2>
                        <div class="result-table-1">
                        	<div class="row align-items-center justify-content-center">
                            	<div class="col-sm-6 col-6">
                                	<h4>Your current total cost <br />(package + shipment)</h4>
                                    <h3>$<?php echo $curr_ship_cost; ?></h3>
                                    <div class="image-btm">
                                        <img src="<?php echo BASE_URL; ?>/images/dollar.png" alt="dollar" title="dollar" />
                                    </div>
                                </div>
                                <div class="col-sm-6 col-6">
                                	<h4>ThermaVIP+ total cost <br />(package + shipment)</h4>
                                    <h3>$<?php echo $thrml_ship_cost; ?></h3>
                                    <div class="image-btm">
                                    	<img src="<?php echo BASE_URL; ?>/images/pig-sm.png" alt="piggy" title="piggy" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="result-table-2">
                        	<table>
                            	<tr>
                                	<th colspan="4">Simulation of shipping cost CHINA <img style="margin-top:-3px;" src="<?php echo BASE_URL; ?>/images/arrow.png" alt="arrow" title="arrow" /> U.S.A</th>
                                </tr>
                                <tr>
                                	<td>
                                    	<p>Your current <br />shipping cost <br />[$]</p>
                                    	<h3>$<?php echo $final_yrtotal_ship_cost; ?></h3>
                                    	<div class="image-btm">
                                            <img src="<?php echo BASE_URL; ?>/images/dollar.png" alt="dollar" title="dollar" />
                                        </div>
                                        <div class="bottom-line"></div>
                                    </td>
                                    <td>
                                    	<p>ThermaVIP+ <br />shipping cost <br />[$]</p>
                                    	<h3>$<?php echo $final_thrml_ship_cost; ?></h3>
                                    	<div class="image-btm">
                                            <img src="<?php echo BASE_URL; ?>/images/pig-sm.png" alt="piggy" title="piggy" />
                                        </div>
                                        <div class="bottom-line"></div>
                                    </td>
                                    <td>
                                    	<p>Your current total cost <br />(package + shipment) <br />[$]</p>
                                    	<h3>$<?php echo $fincal_cuunt_total_ship_cost; ?></h3>
                                    	<div class="image-btm">
                                            <img src="<?php echo BASE_URL; ?>/images/dollar.png" alt="dollar" title="dollar" />
                                        </div>
                                        <div class="bottom-line"></div>
                                    </td>
                                    <td>
                                    	<p>ThermaVIP+ total cost <br />(package + shipment) <br />[$]</p>
                                    	<h3>$<?php echo $fincal_thrml_total_ship_cost; ?></h3>
                                    	<div class="image-btm">
                                            <img src="<?php echo BASE_URL; ?>/images/pig-sm.png" alt="piggy" title="piggy" />
                                        </div>
                                        <div class="bottom-line"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <form name="newsess" id="newsess" action="" method="post" >
                        <input class="new-cal" name="newCalc" value="NEW CALCULATION" type="submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 

?>

<footer class="footer"><?php include "footer.php"; ?></footer>

<?php include "footer-script.php"; ?>
</body>
</html>