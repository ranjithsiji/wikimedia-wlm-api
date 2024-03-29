<?php

require_once( dirname( dirname( __FILE__ ) ) . '/api/common.php' );

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Wiki Loves Monuments Toolbox</title>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/default_css.css" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <script src="js/jquery.js" type="text/javascript" />
    	
    </script>
        </head>
<body>
	<div id="wrapper">

		<div id="header">
	

				<a href="#"><img id="wlm-logo" src="img/logo-wiki-loves-monuments.png" width="80"  alt="Wiki loves monuments logo" /></a>
			  <h2>Wlm Toolbox</h2>
		<h1>A set of tools related to <span>Wiki Loves Monuments</span></span></h1>  	 
			  
		</div><!-- end header --> 

	<div id="maincontainer">


	  
<div id="leftnav">
  <ul class="first">
  	<li><a href="index.php">Home</a>
	    <ul>
	    	<li><a href="statistics.php">Statistics</a></li>
	    	<li><a href="search.php">Search Form</a></li>
	    </ul>
	   </li>
	  </ul>  
	  	 
</div><!-- end leftnav--> 

<div id="content">


<h2>Search Monuments</h2>
<form method="get" action="http://toolserver.org/~erfgoed/api/api.php">
			<input type="hidden" name="action" value="search" />
			<input type="hidden" name="limit" value="100" />

<table id="mainform">

	<!--tr>
		<td colspan="2" class="subtitle">
			This is a text line
		</td>
	</tr-->
	<tr>
		<th><label for="#">
Format		</label>
		</th>
		<td>
		<select id="format" name="format">
			<option value="html"> html </option>
			<option value="poi"> poi </option>
			<option value="gpx"> gpx </option>
			<option value="googlemaps"> googlemaps </option>
			<option value="kml"> kml </option>
			<option value="layar"> layar </option>
			<option value="json"> json </option>
			<option value="osm"> osm </option>
			<option value="xml"> xml</option>
			<option value="xmlfm"> xmlfm </option>
		</select>
		</td>
	</tr>
		<th><label for="stitems">
<?php echo _('db-field-country') ?>	</label>
		</th>
		<td>
		<select id="country-filler" multiple="multiple" size="5">
			<option value="">All</option>
<?php
	$db = Database::getDb();
	$rows = $db->query( "SELECT DISTINCT name FROM admin_tree WHERE level = 0 ORDER BY name" );

	foreach ( $rows as $row ) {
		$name = htmlspecialchars( $row->name );
		echo "			<option value=\"$name\">$name</option>\n";
	}
?>
		</select>
		<input type="hidden" name="srcountry" value="" id="srcountry" />
		
		</td>
	</tr>
		</td>
	</tr>
	<tr>
		<th>
			<label for="srname">
<?php echo _('db-field-name') ?><br />	 <small>use %term or term% or %term% for fuzzy search </small>
			</label>
		</th>
		<td>
		<input name="srname" type="text" id="srname" value="" />
		</td>
	</tr>
	<tr>
		<th>
			<label for="srid">
<?php echo _('db-field-id') ?>
			</label>
		</th>
		<td>
		<input name="srid" type="text" id="srid" value="" />
		</td>
	</tr>
	<tr>
		<th>
			<label for="sraddress">
<?php echo _('db-field-address') ?>
			</label>
		</th>
		<td>
		<input name="sraddress" type="text" id="sraddress" value="" />
		</td>
	</tr>
	<tr>
		<th>
			<label for="srmunicipality">
<?php echo _('db-field-municipality') ?>
			</label>
		</th>
		<td>
		<input name="srmunicipality" type="text" id="srmunicipality" value="" />
		</td>
	</tr>
		<tr>
		<th>
			<label for="srwithoutimage">
       show results without images
  						</label>
		</th>
		<td>
		<input name="srwithoutimage" type="checkbox" id="srwithoutimage" value="1"  /> yes
		</td>
	</tr>
		<tr>
		<th><label for="props">
Items		</label>
		</th>
		<td>
		<select id="props-filler" multiple="multiple" size="5">
			<option value="country" selected="selected"> <?php echo _('db-field-country') ?> </option>
			<option value="lang" selected="selected"> <?php echo _('db-field-lang') ?> </option>
			<option value="id" selected="selected"> <?php echo _('db-field-id') ?> </option>
			<option value="name" selected="selected"> <?php echo _('db-field-name') ?> </option>
			<option value="address" selected="selected"> <?php echo _('db-field-address') ?> </option>
			<option value="municipality" selected="selected"> <?php echo _('db-field-municipality') ?> </option>
			<option value="lat" selected="selected"> <?php echo _('db-field-lat') ?> </option>
			<option value="lon" selected="selected"> <?php echo _('db-field-lon') ?> </option>
			<option value="image" selected="selected"> <?php echo _('db-field-image') ?> </option>
			<option value="source" selected="selected"> <?php echo _('db-field-source') ?> </option>
			<option value="changed" selected="selected"> <?php echo _('db-field-changed') ?> </option>
		</select>
		<input type="hidden" name="props" value="" id="props" />
		</td>
	</tr>

		<tr>
		<th>
			<label for="#">
			</label>
		</th>
		<td>
		<input name="" type="submit" id="submit-search-output" value="Submit" />
		</td>
	</tr>
<tr>
		<td colspan="2">
			<label for="srname">
Output URL <small>for easy copy + paste</small>			</label><br/>
		<textarea name="#" id="url" rows="3" style="width:520px;"></textarea>
		</td>
	</tr>
	
</table>

</form>
<!-- props=lon&props=image  must be props=lon|image|... --> 


<script type="text/javascript">
     function displayVals() {
     /* get and convert values for on-the-fly query string */ 
      var format = "&format=" + $("#format").val();
      var props =  "&props="+ ($("#props-filler").val() || []).join('|');
       	var countries = ($("#country-filler").val() || []).join('|').toLowerCase(); 
      var srcountry = "&srcountry=" + countries;
      var srname = ($("#srname").val() != "") ? "&srname=" + $("#srname").val() : "";
      var srid = ($("#srid").val() != "") ? "&srid=" + $("#srid").val() : "";
      var sraddress = ($("#sraddress").val() != "") ? "&sraddress=" + $("#sraddress").val() : "";
      var srmunicipality = ($("#srmunicipality").val() != "") ? "&srmunicipality=" + $("#srmunicipality").val() : "";
      var srwithoutimage = ($("#srwithoutimage:checked").val() == 1) ?  "&srwithoutimage=" + $("#srwithoutimage:checked").val() : "";
      var url = encodeURI("http://toolserver.org/~erfgoed/api/api.php?action=search&limit=100" + format + srname + srid + sraddress + srmunicipality + srcountry + props + srwithoutimage);
	$('#url').val(url);
	
	 /* set hidden fields values for proper GET request */  
	 $('#props').val(($("#props-filler").val() || []).join('|'));
    $('#srcountry').val(countries);
    }

    $("select").change(displayVals);
    $("input").change(displayVals);
    displayVals();    
</script>
</div><!-- end content --> 
</div><!-- end maincontainer --> 		


<br style="clear:left;" />
				</div> <!-- end wrapper -->

</body>
</html>

