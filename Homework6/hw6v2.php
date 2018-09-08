
<?php

?>


<!doctype  html>
<html>
  <head>
    <title>Facebook Search</title>
	<style>
		.warning{color:red;}
		p.hidden{display:none;}
	</style>
	<script type="text/javascript">
		function unhide(){
			var type document.getElementById(type);
			var location document.getElementById(location);
			
			if type.
			location.classList.remove(hidden);
			
		}
	</script>
	
  </head>
  
  <body>
    <h1>Facebook Search</h1>
	
    <form  method="get" id="searchform">
      <p> Keyword<input  type="text" name="search" required></p>
	  <p> Type
	  <select name="type" id="type" <!--onchange="unhide()"--> > 
		<option value="user" selected>Users</option>
		<option value="page">Pages</option>
		<option value="event">Events</option>
		<option value="group">Groups</option>
		<option value="place" onselect="unhide()">Places</option>
	  </select>
	  </p>
	  <br>
		<p id="location" > <!--class="hidden"--> Location <input  type="text" name="center"> 
		Distance(meters) <input  type="text" name="distance"> </p>
	  <input  type="submit" name="search" value="search">
	  <button type="button">Clear</button>
    </form>
	
	<?php if(isset($_GET["search"])):?>
	
		<?php 
			$json = file_get_contents('https://graph.facebook.com/v2.8/search?q='.$_GET["search"].'&type='.$_GET["type"].'&fields=id,name,picture.width(700).height(700)&access_token=EAACEXTj4fa4BAKkZBX5zLOIpo2n3ZBcQkvuiyuzrzKKNuLCHjouwFM22awb1pEysVHjjLiadqwZAXtlb13HMnPywwnmp6TAoLXfZBZBHNpZBtmAm4swIBavZCSXGfaj4g1wDPweXSGdjmkGpNCJYkUR');
			$json = json_decode($json,true);
		?>
		
		<?php if($_GET["type"]==user||page||group||place):?>
		<table border = "2px" id="tablea">
		<thead>
			<tr>
				<th>Profile Photo</th>
				<th>Name</th>
				<th>Details</th>
			</tr>
		</thead>
		
		</table>
			<?php foreach($json->data->)?>
			
		<?php elseif($_GET["type"]==group):?>
		<table border = "2px" id="tablea">
		<thead>
			<tr>
				<th>Profile Photo</th>
				<th>Name</th>
				<th>Place</th>
			</tr>
		</thead>
		</table>
		<?php endif;?>
		
	<?php else : ?>
		<table id="emptytable" border="2px" align = "center">
			<tr>
				<td> No Results </td>
			</tr>
		</table>
	<?php endif;?>
	
  </body>
</html>


<!--http://www-scf.usc.edu/~baileyqi/My8lCL6SaD.php -->