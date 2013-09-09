<?php
# vimeoApi
# Get Vimeo Videos of a User
# Use it like this: [!vimeoApi? &user=`user976539`!]
# www.jens-wittmann.de
$curl = curl_init('http://vimeo.com/api/v2/'.$user.'/videos.xml');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$xml = curl_exec($curl);
curl_close($curl);
$videos = simplexml_load_string($xml);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = $videos->video[0]->id;
}
?>
<iframe src="http://player.vimeo.com/video/<?=$id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="930" height="523" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<ul>';
foreach ($videos->video as $video) {
    echo '<li><a href="/[~[*id*]~]?id='.$video->id.'" title="'.$video->title.'"><img src="'.$video->thumbnail_small.'" alt="'.$video->title.'" /></a></li>';
}
echo '</ul>';
?>