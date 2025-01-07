<?php
  require_once "../includes/initiate.php";
  page_permission("therapy_profile");	

	if(isset($_GET['id'])){$id=$_GET['id'];}
	if(isset($_GET['delete'])){ therapy_delete($id); 	
  	print "<script>";
  	print "self.location='../therapies/?deleted';"; 
    print "</script>";
 	}

  sns_header('Therapy Profile');
  $therapy=mysqli_fetch_object(mysqli_query($con, "select * from p_therapy_dir where id='$id' "));
?>

<div id="therapy-profile" class="container page">
<div class="panel panel-default">
  <div class="panel-heading theme-therapies"><span class="inlineicon therapy-mini"><?php echo $therapy->code;?></span></div>
<div class="panel-body">
<ol class="breadcrumb link-therapies">
  <li><a href="../dashboard"><i class="glyphicon glyphicon-home"></i>Home</a></li>
  <li><a href="../therapies/">Therapy Directory</a></li>
  <li class="active">Profile</li>
</ol>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['-', '<?php echo $therapy->code;?> Usage'],
          <?php $get_diff = get_global('recent_hours')/24;  for ($k = 0 ; $k < get_global('recent_hours'); $k++){ $k = $k+$get_diff;?>
          ['-',  <?php echo session_count($therapy->code,$k);?>],
          <?php } ?>
        ]);

        var options = {
      curveType: 'function',
      fontSize: 12,
      fontName: 'Source Sans Pro',
      colors: ['#D667CE'],
    hAxis: {
      textStyle: {
          fontSize: 13,
        color: 'transparent',
      },
    },
    vAxis: {
      format: '0',
      baselineColor: '#fafafa',
      textStyle: {
        color: 'transparent',
      },
        gridlines: {
            color: 'transparent'
        }
    },
      legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
  //var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));


        chart.draw(data, options);
      }
    </script>
    <div id="curve_chart" style="width: 100%; height: 300px;" class="center-chart"></div>
    <div class="chart-note">*last <?php echo show_recent_hours();?></div>
    <br>


<table class="table table-striped"><tbody>

    <tr><td>Database ID:</td><td><?php echo $therapy->id;?></td></tr>
    <tr><td>Therapy Code:</td><td><?php echo $therapy->code;?></td></tr>
    <tr><td>Category:</td><td><?php echo $therapy->category;?></td></tr>
    <tr><td>Name:</td><td><?php echo $therapy->name;?></td></tr>
    <tr><td>Price:</td><td><?php echo $therapy->price.' '.get_global('currency');?></td></tr>
    <tr><td>Scheduled:</td><td><?php echo session_count($therapy->code,get_global('recent_hours'));?> session(s) in last <?php echo show_recent_hours();?></td></tr>

</tbody></table><br>

	<div class="edit-button"><a class="btn btn-default formbutton theme-therapies" href="edit.php?id=<?php echo $therapy->id;?>">Edit Profile</a></div>
  <div id="page-clear" align="center"><div id="deleteButton"><a  class="delete-me" href="?id=<?php echo $therapy->id;?>&delete=1">Delete Therapy</a></div></div>

</div>
</div> <!-- panel panel-default -->
</div> <!-- container -->

<?php sns_footer();?>
