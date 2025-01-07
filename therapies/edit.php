<?php
	require_once "../includes/initiate.php";
	page_permission("introduce_therapy");	
	if(isset($_GET['id'])){$id=$_GET['id'];}
	sns_header('Edit Therapy');
?>

<div id="edit-therapy" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-therapies"><span class="inlineicon edit-mini">Edit Therapy</span></div>
<div class="panel-body">
<ol class="breadcrumb link-therapies">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../therapies/">Therapy Directory</a></li>
  <li class="active">Edit Therapy</li>
</ol>

<?php
if(isset($_POST['submit'])){
	
	$id=$_POST['id'];
	$category=$_POST['category'];
	$code=friendly(strtoupper($_POST['code']));
	$name=friendly($_POST['name']);
	$price=friendly($_POST['price']);
	$price=preg_replace("/[^0-9\s]/", "", $price);
 	$added_by=staff_info('id');

	if(edit_therapy($id,$category,$code,$name,$price,$added_by)==true){
	write_log(staff_info('id'),"edit profile for Therapy $name with code $code","therapy","30");
	echo"<div class='alert alert-success' role='alert'>Profile Updated Successfully. The code given to this therapy is $code.</div>";
	echo"<a class='btn btn-default formbutton theme-therapies' href=../therapies/>Show All</a>";
	}else{
	echo"<div class='alert alert-danger' role='alert'>Please try different code.</div>";
	echo"<a class='btn btn-default formbutton theme-therapies' href=../therapies/new.php>try again</a>";
	}
	
}else{
	
	$therapy=mysqli_fetch_object(mysqli_query($con, "select * from p_therapy_dir where id='$id' "));?>

<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Category:</label><select class="form-control"  name='category'  id='category' size='1' tabindex='1'>
            <option value='<?php echo $therapy->category;?>'><?php echo $therapy->category;?> (Current)</option>
            <option value='Individual'>Individual</option>
            <option value='Group'>Group</option>
            <option value='Session'>Session</option>
    </select></div>
	<div class="form-group"><label>Therapy Code:</label><input  class="form-control" name="code" type="text" maxlength="10" value="<?php echo $therapy->code;?>" /></div>
	<div class="form-group"><label>Therapy Name:</label><input  class="form-control" name="name" type="text" maxlength="30" value="<?php echo $therapy->name;?>" /></div>
	<div class="form-group"><label>Price:</label><input  class="form-control" name="price" type="text" maxlength="10" value="<?php echo $therapy->price;?>" /><i>e.g: $50 Per session</i></div>
    <input type="hidden" name="id" value="<?php echo $id;?>"/>
	<input name="submit" class="btn btn-default formbutton theme-therapies" type="submit" value="Update">
</form>
<?php }?>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->
<?php sns_footer();?>
