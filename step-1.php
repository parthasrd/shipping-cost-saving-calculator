<?php include "include/config.php"; $pagename="step1"; $step=1; ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step1 | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Calculator - Step1">
<meta name="description" content="Calculator - Step1" />
<?php include "top-script.php"; ?>
</head>

<body>

<header><?php include "header.php"; ?></header>

<section>
	<div class="panel-1">
    	<div class="container">
    		<?php include "header-txt.php"; ?>
            <div class="text-right">
            <?php if($_SESSION['packageopt']==''){ ?>
            <a>
            <img src="<?php echo BASE_URL; ?>/images/icon-3.png" alt="" title="Next" />
            </a>
            <?php } else { ?>            
            <a href="<?php echo SITE_URL; ?>/step-2.php">
            <img src="<?php echo BASE_URL; ?>/images/icon-5.png" alt="" title="Next" />
            </a>
            <?php } ?>
            </div>
        </div>
    </div>
</section>

<section>
	<div class="container">
		<div class="calculator-panel calculator-panel-1">
        	<div class="row row-rtl">
            	<div class="col-md-4 col-xs-12 col-ltr">
                	<div class="right-panel">
                    	<div class="image step-1-img"><img src="<?php echo BASE_URL; ?>/images/step-1-bg.png" alt="" /></div>
                    	<?php include "side-menu.php"; ?>
                    </div>
                </div>
            	<div class="col-md-8 col-xs-12 col-ltr">
                	<div class="left-panel">
                		<h2>Choose refrigeration temperature of your package</h2>
                        <form action="<?php echo SITE_URL; ?>/step-2.php" method="post">
                        <div class="step-1">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="block">
                                    	<input type="radio" name="package_opt" <?php if($_SESSION['packageopt']=='REFRIGERATED'){ ?> checked="checked"<?php } ?> value="REFRIGERATED" onClick="ischeck()" />
                                        <label>
                                        	<span class="img-outer"><span class="image">
                                            <img class="normal" src="<?php echo BASE_URL; ?>/images/icon-1.png" alt="" title="" />
                                            <img class="hover" src="<?php echo BASE_URL; ?>/images/icon-1-hover.png" alt="" title="" /></span></span>
                                            <span class="txt">Refrigerated 2-8°C <br />(Duration: 96+ hours)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="block">
                                    	<input type="radio" name="package_opt" value="CRT" <?php if($_SESSION['packageopt']=='CRT'){ ?> checked="checked"<?php } ?> onClick="ischeck()" />
                                        <label>
                                        	<span class="img-outer"><span class="image">
                                            <img class="normal" src="<?php echo BASE_URL; ?>/images/icon-2.png" alt="" title="" />
                                            <img class="hover" src="<?php echo BASE_URL; ?>/images/icon-2-hover.png" alt="" title="" />
                                            </span></span>
                                            <span class="txt">Controlled room temperature 15-25°C <br />(Duration: 120+ hours)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="next-step<?php if($_SESSION['packageopt']==''){ ?> not-done<?php } ?>" id="stpBttn" value="NEXT STEP" type="submit" /><!--class="not-done" for disable button-->
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
function ischeck()
{
	if($('input:radio[name^="package_opt"]').is(':checked')) { $('#stpBttn').removeClass('not-done'); }	
}
</script>
</body>
</html>
