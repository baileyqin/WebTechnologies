<style>
.hidden{
	display:none;
}
#container{
	text-align:center;
}
table{
	text-align:center;
	margin-left: auto;
	margin-right: auto;
}

a{
	text-decoration:underline;
	color: blue;
}
</style>   


<script type="text/javascript">
function unhide(){
	var e = document.getElementById("type");
	if (e.options[e.selectedIndex].value =="place"){
		document.getElementById("location").className = "nothidden";
	}
	else{
		document.getElementById("location").className = "hidden";
	}
}

function clearsearch(){
	document.getElementById('keyword').value = "";
	document.getElementById('loc').value = "";
	document.getElementById('dis').value = "";
	var e = document.getElementById('type');
	e.selectedIndex = 0;
	var tablea = document.getElementById('tablea');
	if (tablea){
		tablea.parentNode.removeChild(tablea);
	}
	var tableb = document.getElementById('tableb');
	if (tableb){
		tableb.parentNode.removeChild(tableb);
	}
	var tablec = document.getElementById('tablec');
	if (tablec){
		tablec.parentNode.removeChild(tablec);
	}
	var tablec = document.getElementById('tablec');
	if (tablec){
		tablec.parentNode.removeChild(tablec);
	}
	var tablec = document.getElementById('tablec');
	if (tablec){
		tablec.parentNode.removeChild(tablec);
	}
	var tablec = document.getElementById('tablec');
	if (tablec){
		tablec.parentNode.removeChild(tablec);
	}
	var tablec = document.getElementById('tablec');
	if (tablec){
		tablec.parentNode.removeChild(tablec);
	}
	var tabled = document.getElementById('tabled');
	if (tabled){
		tabled.parentNode.removeChild(tabled);
	}
	var tablee = document.getElementById('tablee');
	if (tablee){
		tablee.parentNode.removeChild(tablee);
	}	

	document.getElementById("location").className = "hidden";

}

function  clearTableA(){
	var tablea = document.getElementById('tablea');
	if (tablea){
		tablea.parentNode.removeChild(tablea);
	}
}

function expandalbums(){
	var f= document.getElementById("posts");
	var e= document.getElementById("albums");
	if (e.className=="hidden"){
		e.className="nothidden";
	}else {
		e.className="hidden";
	}
	if (f.className=="nothidden"){
		f.className="hidden";
	}
}

function expandposts(){
	var f= document.getElementById("posts");
	var e= document.getElementById("albums");
	if (f.className=="hidden"){
		f.className="nothidden";
	}else {
		f.className="hidden";
	}
	if (e.className=="nothidden"){
		e.className="hidden";
	}

}

function expand(e){
	var tbody = e.parentNode.parentNode.parentNode.getElementsByTagName("tbody")[0];
	if(tbody.className=="hidden"){
		tbody.className="nothidden";
	}else{
		tbody.className="hidden";
	}
}
</script>

<?php error_reporting(0);?>

<?php 
require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';

date_default_timezone_set("America/Los_Angeles");

$fb = new Facebook\Facebook([
'app_id' => 145535922634158,
'app_secret' => 'f304900b209ed397622d00468c9bbaaf',
'default_graph_version' => 'v2.8'
]);
$fbkey = 'EAACEXTj4fa4BAKkZBX5zLOIpo2n3ZBcQkvuiyuzrzKKNuLCHjouwFM22awb1pEysVHjjLiadqwZAXtlb13HMnPywwnmp6TAoLXfZBZBHNpZBtmAm4swIBavZCSXGfaj4g1wDPweXSGdjmkGpNCJYkUR';
$fb->setDefaultAccessToken(
'EAACEXTj4fa4BAKkZBX5zLOIpo2n3ZBcQkvuiyuzrzKKNuLCHjouwFM22awb1pEysVHjjLiadqwZAXtlb13HMnPywwnmp6TAoLXfZBZBHNpZBtmAm4swIBavZCSXGfaj4g1wDPweXSGdjmkGpNCJYkUR');
?>
<div id ="container">
<h1>Facebook Search</h1>	
    <form  method="get" id="searchform">
      <p> Keyword<input  type="text" name="keyword" id="keyword" required value="<?php if(isset($_GET['keyword'])):
	  echo $_GET['keyword'];
	  else:
	  echo'';
	  endif;?>"></p>
	  <p> Type
	  <select name="type" id="type" onload="unhide()" onchange="unhide()"  > 
		<option value="user" <?php if(isset($_GET['type'])):
		if($_GET['type']=='user'):
		echo 'selected';
		endif;
	endif;?>>Users</option>
		<option value="page"  <?php if(isset($_GET['type'])):
		if($_GET['type']=='page'):
		echo 'selected';
		endif;
	endif;?>>Pages</option>
		<option value="event" <?php if(isset($_GET['type'])):
		if($_GET['type']=='event'):
		echo 'selected';
		endif;
	endif;?>>Events</option>
		<option value="group" <?php if(isset($_GET['type'])):
		if($_GET['type']=='group'):
		echo 'selected';
		endif;
	endif;?>>Groups</option>
		<option value="place"  <?php if(isset($_GET['type'])):
		if($_GET['type']=='place'):
		echo 'selected';
		endif;
	endif;?> onselect="unhide()">Places</option>
	  </select>
	  </p>
	  <br>
		<p id="location" class="<?php if(isset($_GET['type'])):
	if($_GET['type']=='place'):
		echo 'un';
	endif;
endif;?>hidden" > Location <input id="loc"  type="text" name="location" value="<?php if(isset($_GET['location'])):
	  echo $_GET['location'];
	  else:
	  echo'';
	  endif;?>"> 
		Distance(meters) <input id="dis" type="text" name="distance" value="<?php if(isset($_GET['distance'])):
				echo $_GET['distance'];
				else:
				echo'';
				endif;?>"> </p>
	  <input  type="submit" name="search" value="search">
	  <button type="button" onclick="clearsearch()">Clear</button>
    </form>
	
	<?php if(isset($_GET["search"])):?>
		<?php
		$fbresponse = $fb->get('/search?q='.$_GET["keyword"].'&type='.$_GET["type"].'&fields=id,name,picture.width(700).height(700)');
		$fbresponse = $fbresponse->getGraphEdge()->asArray();
		$gkey = 'AIzaSyBo7PR3gOmwECWKWSJv4GQAM5W_kRcqBaU';
		?>
		<?php if(count($fbresponse)==0):?>
		<table id="tablea"><tr><th>	<h1>No Results Found</h1></th></tr></table>
		<?php else:?>
		
		<?php if($_GET["type"]=='user'||$_GET["type"]=='page'||$_GET["type"]=='group'):?>
			<table border = "2px" id="tablea">
				<thead>
					<tr>
						<th>Profile Photo</th>
						<th>Name</th>
						<th>Details</th>
					</tr>
				</thead>
			
			<?php foreach($fbresponse as $key):?>
				<?php $pic = $key['picture'];?>
				<tr>
					<td><a href="<?php echo $pic['url'];?>" target="_blank">
						<img src="<?php echo $pic['url'];?>" height = "40" width = "30">
						</a></td>
					<td><?php echo $key['name'];?></td>
					<td><a href = "search.php?keyword=<?php echo $_GET['keyword'];?>&type=<?php echo $_GET['type'];?>&location=<?php echo $_GET['location'];?>&distance=<?php echo $_GET['location'];?>&details=<?php echo $key['id'];?>" onclick="clearTableA()" name="Link"> Details</a></td>
				</tr>
			<?php endforeach;?>

		<?php elseif($_GET["type"]=='place'):
			$gresponse = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(" ","+",$_GET['location']).'&key='.$gkey.'');
			$gresponse = json_decode($gresponse, true);
			$gresponse = $gresponse['results'];
			$gresponse = $gresponse[0];
			$gresponse = $gresponse['geometry'];
			$gresponse = $gresponse['location'];
			$fbresponse = $fb->get('/search?q='.$_GET["keyword"].'&type='.$_GET["type"].'&center='.$gresponse['lat'].','.$gresponse['lng'].'&distance='.$_GET["distance"].'&fields=id,name,picture.width(700).height(700)');
			$fbresponse = $fbresponse->getGraphEdge()->asArray();?>
			<table border = "2px" id="tablea">
				<thead>
					<tr>
						<th>Profile Photo</th>
						<th>Name</th>
						<th>Details</th>
					</tr>
				</thead>
				
			<?php foreach($fbresponse as $key):?>
				<?php $pic = $key['picture'];?>
				<tr>
					<td><a href="<?php echo $pic['url'];?>" target="_blank">
						<img src="<?php echo $pic['url'];?>" height = "40" width = "30">
						</a></td>
					<td><?php echo $key['name'];?></td>
					<td><a href = "search.php?keyword=<?php echo $_GET['keyword'];?>&type=<?php echo $_GET['type'];?>&location=<?php echo $_GET['location'];?>&distance=<?php echo $_GET['location'];?>&details=<?php echo $key['id'];?>" onclick="clearTableA()" name="Link"> Details</a></td>
				</tr>
			<?php endforeach;?>		
		
		<?php elseif($_GET["type"]=='event'):
			$fbresponse = $fb->get('/search?q='.$_GET["keyword"].'&type='.$_GET["type"].'&fields=id,name,picture.width(700).height(700),place');
			$fbresponse = $fbresponse->getGraphEdge()->asArray();?>
			<table border = "2px" id="tablea">
				<thead>
					<tr>
						<th>Profile Photo</th>
						<th>Name</th>
						<th>Place</th>
					</tr>
				</thead>

			<?php foreach($fbresponse as $key):?>
				<?php $pic = $key['picture'];?>
				<?php $place=$key['place'];?>
				<tr>
					<td><a href="<?php echo $pic['url'];?>" target="_blank">
						<img src="<?php echo $pic['url'];?>" height = "40" width = "30">
						</a></td>
					<td><?php echo $key['name'];?></td>
					<td><?php echo $place['name'];?></td>
				</tr>
			<?php endforeach;?>	
		
		<?php endif;?>
			
		<?php endif;?>
			</table>
	<?php endif;?>
	
	<?php if(isset($_GET["details"])):
		$fbresponse2 = $fb->get($_GET["details"].'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name, picture}},posts.limit(5)');
		$fbresponse2 = $fbresponse2->getGraphNode()->asArray();?>
	
	<?php if($fbresponse2['albums']):?>
	
	<?php		
		$albums = $fbresponse2['albums'];
	?>
		
		<table id="tableb">
			<thead>
				<tr>
					<th> <a onclick="expandalbums()"> Albums</a> </th>
				</tr>
			</thead>
		</table>
	<div id="albums" class="hidden">
		<?php foreach($albums as $key):
			$pic=$key['photos'];?>
		<table id="tablec">
			<thead>
				<tr>
					<th onclick="expand(this)"> <?php echo $key['name'];?></th>
				</tr>
			</thead>
			<tbody class="hidden">
			<tr>
				<td>
					<?php foreach($pic as $key2):?>
						<?php 
						//$picid=$fb->get($key2['id'].'\/picture?');
						//$picid=$picid->getGraphNode()->asArray();
						?>
						<a href="https://graph.facebook.com/v2.8/<?php echo $key2['id'];?>/picture?access_token=<?php echo $fbkey;?>" target="_blank"> <img src="<?php echo $key2['picture'];?>" height="80" width="80"> </a>
					<?php endforeach;?>
				</td>
			</tr>
			</tbody>
		</table>	
		<?php endforeach;?>
	</div>
		<?php else:?>
		
		<table id="tableb">
			<thead>
				<tr>
					<th> No Albums Found</th>
				</tr>
			</thead>
		</table>	
		
	<?php endif;?>	
	
	<?php if($fbresponse2['posts']):?>
		
		<?php $posts = $fbresponse2['posts'];?>			
		<table id = "tabled">
			<thead>
				<tr>
					<th> <a onclick="expandposts()"> Posts</a> </th>
				</tr>
			</thead>
		</table>
	<div id="posts" class="hidden">	
		<table id="tablee" border = "2px">
			<?php foreach($posts as $key):?>
				<tr>
					<td> <?php echo $key['message'];?></td>
				</tr>
			<?php endforeach;?>
		</table>
	</div>
	<?php else:?>
		<table id="tabled">
			<thead>
				<tr>
					<th> No Posts Found</th>
				</tr>
			</thead>
		</table>
	
	<?php endif;?>	
	<?php endif;?>
	</div>