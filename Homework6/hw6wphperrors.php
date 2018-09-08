
<!--
<?php 
//	foreach($_POST as $key => $value){
//		$value = is_array($value) ? $value : trim($value);
//		
//		if (empty($value)&& in_array($key, $required)){
//			$missing[]=$key;
//			$$key = '';
//		};
		
//		elseif( in_array($key,$expected)){
//			$$key = $value;
//		};
//	};
?>
-->

<?php 
$errors = [];
$missing = [];
if (isset($_POST['send'])){
	$expected = ['search','type']
	$required = ['search', 'type']
	require '';
}
?>


<!doctype  html>
<html>
  <head>
    <title>Facebook Search</title>
	<style>
		.warning{color:red;}
	</style>
  </head>
  <body>
    <h1>Facebook Search</h1>
	
<!--	<?php if ($errors || $missing):?>
	<p class="warning"> Please fix the item(s) indicated </p>
	<?php endif; ?> 
-->
    <form  method="post" action="<?php $_SERVER['PHP_SELF'];?>"  id="searchform">
      <p> Keyword<input  type="text" name="search" required></p>
<!--	  
	  <?php if ($missing && in_array('name',$missing)): ?>
		<span class='warning'> Please enter something </span>
	  <?php endif; ?>
-->
	  <p> Type
	  <select name="type" id="type"> 
		<option value="user" selected>Users</option>
		<option value="page">Pages</option>
		<option value="event">Events</option>
		<option value="group">Groups</option>
		<option value="place">Places</option>
	  </select>
	  </p>
	  <br>
	  <input  type="submit" name="send" value="send">
	  <button type="button">Clear</button>
    </form>
  </body>
</html>

<!--http://www-scf.usc.edu/~baileyqi/My8lCL6SaD.php -->