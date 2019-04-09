<div class="right-desk-menu">
<ul>
<?php $k=1; foreach($menus as $key =>$menuitem){ ?>
<?php 
$pgky = $key+1;
if($key+1<$step){ $cls=' class="done-step"'; } 
else if($key+1==$step) { $cls=' class="active"';  }
else {$cls='';  }
if(count($menus) == $k){ 
	$pagelink ="result.php";
	$pageurllnk = SITE_URL."/".$pagelink;
}
else{
	$pagelink = "step-".$pgky.".php";
	$pageurllnk = SITE_URL."/".$pagelink;
}
?>
<li<?php echo $cls; ?>><a href="<?php echo $pageurllnk; ?>"><?php echo $menuitem; ?></a></li>
<?php $k++; } ?>                            
</ul>
</div>
