<?php
	require_once "../includes/initiate.php";
	page_permission("therapy_directory");	
	sns_header('Therapy Directory');
?>

<div id="therapy-directory" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-therapies"><span class="inlineicon therapy-mini">Therapy Directory</span></div>
<div class="panel-body">
<ol class="breadcrumb link-therapies">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li class="active">Therapy Directory</li>
</ol>

	<?php if(isset($_GET['deleted'])){$deleted=$_GET['deleted'];?>
    <div class='alert alert-success' role='alert'>Successfully deleted!</div>
	<?php }?>


<?php if(display_permission("therapy_profile")==true){?>

		<?php 
		$sql=mysqli_query($con, "select * from p_therapy_dir where category='Individual' order by code asc limit 9000")or die(mysqli_error());
		while($therapies=mysqli_fetch_array($sql)){
		?>
	    <a class="nohover" href="profile.php?id=<?php echo $therapies['id']?>">
		<div class="panel panel-default profile-card profile-therapies">
		  <div class="panel-heading _theme-therapies"><?php echo $therapies['code']?></div>
		  <div class="panel-body">
		  	<p><?php echo $therapies['name']?></p>
		  	<strong><?php echo $therapies['category']?></strong> | <?php echo $therapies['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
	    </a>
		<?php } ?>

<?php }else{ ?>

		<?php 
		$sql=mysqli_query($con, "select * from p_therapy_dir where category='Individual' order by code asc limit 9000")or die(mysqli_error());
		while($therapies=mysqli_fetch_array($sql)){
		?>
		<div class="panel panel-default profile-card profile-therapies">
		  <div class="panel-heading _theme-therapies"><?php echo $therapies['code']?></div>
		  <div class="panel-body">
		  	<strong><?php echo $therapies['category']?></strong> | <?php echo $therapies['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
		<?php } ?>

<?php } ?>

    <hr/>

	<?php if(display_permission("therapy_profile")==true){?>

		<?php 
		$sql=mysqli_query($con, "select * from p_therapy_dir where category='Group' order by code asc limit 9000")or die(mysqli_error());
		while($therapies=mysqli_fetch_array($sql)){
		?>
	    <a class="nohover" href="profile.php?id=<?php echo $therapies['id']?>">
		<div class="panel panel-default profile-card profile-therapies">
		  <div class="panel-heading _theme-therapies"><?php echo $therapies['code']?></div>
		  <div class="panel-body">
		  	<p><?php echo $therapies['name']?></p>
		  	<strong><?php echo $therapies['category']?></strong> | <?php echo $therapies['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
	    </a>
		<?php } ?>

	<?php }else{ ?>

		<?php 
		$sql=mysqli_query($con, "select * from p_therapy_dir where category='Group' order by code asc limit 9000")or die(mysqli_error());
		while($therapies=mysqli_fetch_array($sql)){
		?>
		<div class="panel panel-default profile-card profile-therapies">
		  <div class="panel-heading _theme-therapies"><?php echo $therapies['code']?></div>
		  <div class="panel-body">
		  	<strong><?php echo $therapies['category']?></strong> | <?php echo $therapies['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
		<?php } ?>

	<?php } ?>
    <hr/>
	<?php if(display_permission("therapy_profile")==true){?>

		<?php 
		$sql=mysqli_query($con, "select * from p_therapy_dir where category='Session' order by code asc limit 9000")or die(mysqli_error());
		while($therapies=mysqli_fetch_array($sql)){
		?>
	    <a class="nohover" href="profile.php?id=<?php echo $therapies['id']?>">
		<div class="panel panel-default profile-card profile-therapies">
		  <div class="panel-heading _theme-therapies"><?php echo $therapies['code']?></div>
		  <div class="panel-body">
		  	<p><?php echo $therapies['name']?></p>
		  	<strong><?php echo $therapies['category']?></strong> | <?php echo $therapies['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
	    </a>
		<?php } ?>

	<?php }else{ ?>

		<?php 
		$sql=mysqli_query($con, "select * from p_therapy_dir where category='Session' order by code asc limit 9000")or die(mysqli_error());
		while($therapies=mysqli_fetch_array($sql)){
		?>
		<div class="panel panel-default profile-card profile-therapies">
		  <div class="panel-heading _theme-therapies"><?php echo $therapies['code']?></div>
		  <div class="panel-body">
		  	<strong><?php echo $therapies['category']?></strong> | <?php echo $therapies['price']?> <?php echo "$global_permission->currency"?>
		  </div>
		</div>
		<?php } ?>

	<?php } ?>
	<br><br>
</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>
