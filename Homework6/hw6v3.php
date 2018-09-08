<style>
.hidden{
	display:none;
}
</style>   
    <h1>Facebook Search</h1>

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
	var e = document.getElementById('type');
	e.selectedIndex = 0;
	var tablea = document.getElementById('tablea');
	if (tablea){
		tablea.parentNode.removeChild(tablea);
	}
}

function  clearTableA(){
	var tablea = document.getElementById('tablea');
	if (tablea){
		tablea.parentNode.removeChild(tablea);
	}
}

function expandalbums(){}

function expandposts(){}

function expand(e){}
</script>

<?php 
require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';

date_default_timezone_set("America/Los_Angeles");

$fb = new Facebook\Facebook([
'app_id' => 145535922634158,
'app_secret' => 'f304900b209ed397622d00468c9bbaaf',
'default_graph_version' => 'v2.8'
]);

$fb->setDefaultAccessToken(
'EAACEXTj4fa4BAKkZBX5zLOIpo2n3ZBcQkvuiyuzrzKKNuLCHjouwFM22awb1pEysVHjjLiadqwZAXtlb13HMnPywwnmp6TAoLXfZBZBHNpZBtmAm4swIBavZCSXGfaj4g1wDPweXSGdjmkGpNCJYkUR');
?>
	
    <form  method="get" id="searchform">
      <p> Keyword<input  type="text" name="keyword" id="keyword" required></p>
	  <p> Type
	  <select name="type" id="type" onchange="unhide()" > 
		<option value="user" selected>Users</option>
		<option value="page">Pages</option>
		<option value="event">Events</option>
		<option value="group">Groups</option>
		<option value="place" onselect="unhide()">Places</option>
	  </select>
	  </p>
	  <br>
		<p id="location" class="hidden" > Location <input  type="text" name="location"> 
		Distance(meters) <input  type="text" name="distance"> </p>
	  <input  type="submit" name="search" value="search">
	  <button type="button" onclick="clearsearch()">Clear</button>
    </form>
	
	<?php if(isset($_GET["keyword"])):?>
		<?php
		$fbresponse = $fb->get('/search?q='.$_GET["keyword"].'&type='.$_GET["type"].'&fields=id,name,picture.width(700).height(700)');
		$fbresponse = $fbresponse->getGraphEdge()->asArray();
		$gkey = 'AIzaSyBo7PR3gOmwECWKWSJv4GQAM5W_kRcqBaU';
		?>
		
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
					<td><a href = "search.php?details=<?php echo $key['id'];?>" onclick="clearTableA()" name="Link"> Details</a></td>
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
					<td><a href = "search.php?details=<?php echo $key['id'];?>" onclick="clearTableA()" name="Link"> Details</a></td>
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
		
		<?php else:?>
		<h1>No Results Found</h1>
			
		<?php endif;?>
			</table>
	<?php endif;?>
	
	<?php if(isset($_GET["details"])):
		$fbresponse2 = $fb->get($_GET["details"].'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name, picture}},posts.limit(5)');
		$fbresponse2 = $fbresponse2->getGraphNode()->asArray();
		$albums = $fbresponse2['albums'];
		$posts = $fbresponse2['posts'];
	?>
		
		<table>
			<thead>
				<tr>
					<th> <a onclick="expandalbums()"> Albums</a> </th>
				</tr>
			</thead>
		</table>	
		<?php foreach($albums as $key):
			$pic=$key['photos'];?>
		<table>
			<thead>
				<tr>
					<td> <?php echo $key['name'];?></td>
				</tr>
			</thead>
			<tr>
				<td>
					<?php foreach($pic as $key2):?>
						<a href="<?php echo $key2['picture'];?>" target="_blank"> <img src="<?php echo $key2['picture'];?>" height="80" width="80"> </a>
					<?php endforeach;?>
				</td>
			</tr>
		</table>	
		<?php endforeach;?>
			
		<table>
			<thead>
				<tr>
					<th> <a onclick="expandposts()"> Posts</a> </th>
				</tr>
			</thead>
		</table>
		<table>
			<?php foreach($posts as $key):?>
				<tr>
					<td> <?php echo $key['message'];?></td>
				</tr>
			<?php endforeach;?>
		</table>
	<?php endif;?>
	