    <h1>Facebook Search</h1>
	
    <form  method="get" id="searchform">
      <p> Keyword<input  type="text" name="keyword" required></p>
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
	
	<?php
	echo $_GET["keyword"].'<br>';
	echo $_GET["type"];
	
	?>
	
	<?php if(isset($_GET['type'])):
		if($_GET['type']=='user'):
		echo 'selected';
		endif;
	endif;?>
	
search.php?keyword=<?php echo $_GET['keyword'];?>&type=<?php echo $_GET['type'];?>&location=<?php echo $_GET['location'];?>&distance=<?php echo $_GET['location'];?>&details=<?php echo $key['id'];?>

<?php if(isset($_GET['type'])):
	if($_GET['type']=='place'):
		echo 'un';
	endif;
endif;?>

submit -user csci571 -tag hw6 search.php