<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music Player</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Kenia&display=swap');
  * {
    margin:0;
    padding:0;
  }
  
  h1 {
    margin-top:5vh;
    margin-bottom:5vh;
    font-family: 'Kenia', cursive;
    font-size: 8vh;
  }
  h3 {
    color:white;
    font-family: 'Kenia', cursive;
  }

  a {
    color:black;
  text-decoration: none;
  font-family: 'Trebuchet MS', sans-serif;
}

  audio {
    margin-top:2.3vh;
    height:5vh;
    width:80%;
  }
  audio::-webkit-media-controls-panel {
    background-color:black;
  }
  audio::-webkit-media-controls-mute-button {
    background-color:white;
    border-radius:50%;
  }
  audio::-webkit-media-controls-play-button {
    background-color:white;
    border-radius:50%;
  }

audio::-webkit-media-controls-current-time-display {
  color:white;
}

audio::-webkit-media-controls-time-remaining-display {
  color:lightblue;
}

audio::-webkit-media-controls-timeline {
  background-color:lightblue;
  border-radius:2vh;
  margin-left:7vh;
  margin-right:7vh;
}

audio::-webkit-media-controls-volume-slider-container {
  background-color:white;
  border-radius:2vh;
}

audio::-webkit-media-controls-volume-slider {
  background-color:white;
  border-radius:2vh;
  padding-left:2vh;
  padding-right:2vh;
}

audio::-webkit-media-controls-seek-back-button {
  background-color:white;
  border-radius:2vh;
}

audio::-webkit-media-controls-seek-forward-button {
  background-color:white;
  border-radius:2vh;
}

audio::-webkit-media-controls-fullscreen-button {
  background-color:white;
  border-radius:2vh;
}

audio::-webkit-media-controls-rewind-button {
  background-color:white;
  border-radius:2vh;
}

audio::-webkit-media-controls-return-to-realtime-button {
  background-color:white;
  border-radius:2vh;
}

audio::-webkit-media-controls-toggle-closed-captions-button {
  background-color:white;
  border-radius:2vh;
}
</style>
<body>
  <center>
  <h1>Music Player</h1>
</center>
<!-- container -->
<div style="display:flex;flex-direction:row;justify-content:center;flex-wrap:wrap">
<!-- music player -->
<div style="background-color:black;width:80%;height:10vh;border-radius: 15px 50px 30px;box-shadow: 1vh 1vh 5vh lightblue;">
<center>
<audio src='<?php if(isset($playing['music'])): if (!file_exists($playing['music'])): $src = $playing['music']; $fsrc = str_replace('_',' ',$src); echo $fsrc; else: echo $playing['music']; endif; endif; ?>' controls>
</audio>
</center>
</div>
<!-- end -->

<!-- Playlists -->
<div style="background-color:rgb(179, 179, 179);width:30%;padding:3vh;border-radius:1vh;margin-left:5%">
<center>
  <div style="background-color:rgb(89, 89, 89);border-radius:1.5vh;width:30%;margin-bottom:3vh;box-shadow: inset 3px 4px 10px black;padding:.5vh">
  <h3>Playlists</h3>
</div>
</center>  

<div style="background-color:white;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;">
<center>
<table style="width:95%">
    <?php foreach($list as $pl):?>
      <tr>
      <td style="width:80%;font-weight:bold"><a href="/playlist/<?= str_replace('C:\laragon\www\Laboratory_2\public/uploads/','',$pl) ?>/null"><?= str_replace('C:\laragon\www\Laboratory_2\public/uploads/','',$pl) ?></a></td>
      <td><a href="/delete_p/<?= str_replace('C:\laragon\www\Laboratory_2\public/uploads/','',$pl) ?>">Delete</a></td>
      <tr>
      <?php endforeach; ?>
</table>
        </center>
</div>
    </div>
<!-- end -->

<!-- Song List -->
<div style="width:30%;box-shadow: 1vh 1vh 5vh lightblue;padding:3vh;border-radius:1vh;margin-right:5%">
<form action="/search" method="get" style="margin-bottom:3vh">
  <input style="border:solid gray .1vh;border-radius:1vh;font-size:2.5vh;padding:.5vh" type="text" name="music" placeholder="Search Songs" required>
  <input style="border:none;border-radius:1vh;font-size:2.5vh;padding:.6vh;box-shadow: inset 1px 1px 15px gray;rgb(179, 179, 179);width:40%" type="submit" placeholder="Submit">
</form>

<div style="background-color:#ccffff;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;">
<center>
<table style="width:95%">
    <?php if(isset($plist)): ?>
      <?php foreach($songs as $s): ?>
      <tr>
      <th style="width:70%;font-weight:bold;background-color:white;padding:1vh;border-radius:1vh"><a href="/playlist/<?= $plist ?>/<?= $s['musicID'] ?>"><?= $s['title'] ?></a></th>
      <td style="background-color:black;border-radius:1vh;padding-left:1vh;padding-right:1vh;text-align:center"><a style="color:white;" href="/delete/<?= $plist ?>/<?= $s['musicID'] ?>">Delete</a></td>
      <tr>
      <?php endforeach; ?>
    <?php endif; ?>
</table>
      </center>
</div>
</div>
<!-- end -->

<!-- Create & Remove PlayList -->
<div style="width:30%;box-shadow: 1vh 1vh 5vh lightblue;padding:3vh;border-radius:1vh;margin-left:5%;">
<form action="/save_p" method="post" style="margin-bottom:3vh">
  <input style="border:solid gray .1vh;border-radius:1vh;font-size:2.5vh;padding:.5vh" type="text" name="playlist" placeholder="Create Playlist" required>
  <input style="border:none;border-radius:1vh;font-size:2.5vh;padding:.6vh;box-shadow: inset 1px 1px 15px gray;rgb(179, 179, 179);width:40%" type="submit" name="submit" placeholder="Submit">
</form>
<?php if(isset($m)): ?>
<?php if($m == 1): ?>
<div style="background-color:#ccffff;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;padding-left:5vh;padding-right:5vh;">
  <center>
    <pre>
      Playlist created
      sucessfully!
</pre>
</center>
</div>
<?php elseif($m == 0): ?>
  <div style="background-color:#ccffff;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;padding-left:5vh;padding-right:5vh;">
  <center>
    <pre>
      Duplicate Playlist!
</pre>
</center>
</div>
<?php endif; ?>
<?php endif; ?>
</div>
<!-- end -->

<!--Add Music -->
<div style="background-color:rgb(179, 179, 179);width:30%;padding:3vh;border-radius:1vh;margin-right:5%">
<center>
  <div style="background-color:rgb(89, 89, 89);border-radius:1.5vh;width:30%;margin-bottom:3vh;box-shadow: inset 3px 4px 10px black;padding:.5vh">
  <h3>Add Music <?php if(isset($plist)): echo 'to '.$plist; endif; ?>
  </h3>
</div>
</center>  

<div style="background-color:white;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;padding-left:5vh;padding-right:5vh;">
<form action="/save" method="post" enctype="multipart/form-data">
<input type='hidden' name='id' value='<?php if(isset($playing['musicID'])): ?><?= $playing['musicID']; endif; ?>' required>
  <input type='hidden' name='playlist' value='<?php if(isset($plist)): ?><?= $plist; endif; ?>' required>
  <input style="border:solid gray .1vh;border-radius:1vh;font-size:2.5vh;width:55%" type="file" name="song" placeholder="Add Songs" required>
  <input style="border:none;border-radius:1vh;font-size:2.5vh;padding:.6vh;box-shadow: inset 1px 1px 15px gray;rgb(179, 179, 179);width:40%" type="submit" placeholder="Submit">
</form>
</div>
    </div>
<!-- end -->

</div>
<!-- end -->
</body>
</html>