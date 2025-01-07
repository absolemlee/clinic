<?php
	require_once "../includes/initiate.php";
	page_permission("introduce_therapy");	
	sns_header('New Therapy');
?>

<div id="new-therapy" class="container page">
<div class="panel panel-default">
<div class="panel-heading theme-therapies"><span class="inlineicon edit-mini">New Therapy</span></div>
<div class="panel-body">
<ol class="breadcrumb link-therapies">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../therapies/">Therapy Directory</a></li>
  <li class="active">New Therapy</li>
</ol>

<?php
if(isset($_POST['submit'])){
	
	$category=$_POST['category'];
	$code=friendly(strtoupper($_POST['code']));
	$name=friendly($_POST['name']);
	$price=friendly($_POST['price']);
	$price=preg_replace("/[^0-9\s]/", "", $price);
 	$added_by=$_SESSION['id'];

	if(introduce_therapy($category,$code,$name,$price,$added_by)==true){
	write_log("$_SESSION[id]","introduced new Therapy with the name of $name and code $code","therapy","30");
	echo"<div class='alert alert-success' role='alert'>$name has been successfully registered. (Code: $code)</div>";
	echo"<a class='btn btn-default formbutton theme-therapies' href=../therapies/>Show All</a>";
	}else{
	echo"<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>"; 
	echo"<a class='btn btn-default formbutton theme-therapies' href=../therapies/new.php>try again</a>";
	}
	
}else{

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group"><label>Category:</label><select class="form-control"  name='category'  id='category' size='1' tabindex='1'>
            <option value='Individual'>Individual</option>
            <option value='Group'>Group</option>
            <option value='Session'>Session</option>
    </select></div>
	<div class="form-group"><label>Therapy Code:</label><input class="form-control"  name="code" type="text" maxlength="10" /></div>
	<div class="form-group"><label>Therapy Name:</label><input class="form-control"  name="name" type="text" maxlength="30" /></div>
	<div class="form-group"><label>Price:</label><input class="form-control"  name="price" type="text" maxlength="10" /><i>e.g: $50 Per session</i></div>
	<input name="submit" class="btn btn-default formbutton theme-therapies" type="submit" value="Register">
</form>
<?php }?>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>
