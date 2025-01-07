<?php
	require_once "../includes/initiate.php";
	

	if(isset($_GET['id'])){
		$id=$_GET['id'];
	}else{
		$id=staff_info('branch');
	}

	if(isset($_GET['delete'])&&display_permission("update_therapy")==true){ 
		delete_single_therapy($_GET['delete']); 	
    	print "<script>";
    	print "self.location='?deleted';"; 
        print "</script>";
 	}

	sns_header('Therapy Available');
?>

<div id="local-stock" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-therapies"><span class="inlineicon local-stock-mini">Available Therapy</span></div>
<div class="panel-body">
<ol class="breadcrumb link-therapies">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../therapies/">Therapy Directory</a></li>
  <li class="active">Available Therapy</li>
</ol>

	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class="alert alert-success" role="alert">Therapy deleted!</div>
	<?php }?>


	<?php if(display_permission("consumed_therapy_global")==true){?>
	<p class="pull-right">
	    <?php 
		$sql=mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000")or die(mysqli_error());
		while($branches_dir=mysqli_fetch_array($sql)){
		?>
	    <a class="btn btn-link btn-sm <?php if($id==$branches_dir['id']) echo "theme-therapies";?>" role="button" href="?id=<?php echo $branches_dir['id'];?>"><?php echo substr($branches_dir['name'],0,30);?></a>
	    <?php }?>
	</p>
	<br><br>
	<?php }?>


	<h3 class="subtitle">Available therapy at <?php echo branch_info("name","$id");?>:</h3>
	<?php $therapy_count=0;
	$sql=mysqli_query($con, "select * from p_therapy where branch='$id' order by code asc limit 20000")or die(mysqli_error());
	while($stocks=mysqli_fetch_array($sql)){ $therapy_count++;
	?>

	<div class="panel panel-default profile-card profile-therapies profile-stock">
	  <div class="panel-heading _theme-therapies"><?php echo $stocks['code']?></div>
	  <div class="panel-body">
		<div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo percentage("$stocks[remaining]","$stocks[total]")?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo percentage("$stocks[remaining]","$stocks[total]")?>%;">
		    <span class="sr-only"><?php echo percentage("$stocks[remaining]","$stocks[total]")?>% Stock Available</span>
		  </div>
		</div>
	  	<p class="stock-avilable"><?php echo $stocks['remaining']?><span>/<?php echo $stocks['total']?></p>
	  	<p class="last-refill"><span class="gray">Last update:</span> <br><?php echo display_time($stocks['last_update']);?></p>
	  	<?php if(display_permission("update_therapy")==true){?><a class="delete-stock" href="?delete=<?php echo $stocks['id']?>">Delete Therapy</a><?php } ?>
	  </div>
	</div>

	<?php }?>

    <?php if($therapy_count==0){ echo "<h3 class='subtitle text-center'>No therapy available at this branch!</h3>"; }?>


</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>
