
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


<?php 
		$id ='134972803193847' ;
		$fbresponse2 = $fb->get($id.'?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name, picture}},posts.limit(5)');
		$fbresponse2 = $fbresponse2->getGraphNode()->asArray();
		$albums = $fbresponse2['albums'];
		$posts = $fbresponse2['posts'];
	?>

<?php
	$i=1;
	foreach($albums as $key):
		echo $i.'name '.$key['name'].'<br>';
		$pic = $key['photos'];
		?>
		<pre>
		<?php
		foreach($pic as $key2):
			$picid=$fb->get($key2['id'].'/picture');
			$picid = $picid->getGraphNode()->asArray();
			var_dump($picid);
		endforeach;?>
		</pre>
		<?php
	$i=$i+1;
	endforeach;
?>
