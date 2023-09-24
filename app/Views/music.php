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

audio::-webkit-media-controls-timeline-container {

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
}

audio::-webkit-media-controls-volume-slider

audio::-webkit-media-controls-seek-back-button

audio::-webkit-media-controls-seek-forward-button

audio::-webkit-media-controls-fullscreen-button

audio::-webkit-media-controls-rewind-button

audio::-webkit-media-controls-return-to-realtime-button

audio::-webkit-media-controls-toggle-closed-captions-button
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
<audio controls></audio>
</center>
</div>
<!-- end -->

<!-- Playlists -->
<div style="background-color:rgb(179, 179, 179);width:30%;padding:3vh;border-radius:1vh">
<center>
  <div style="background-color:rgb(89, 89, 89);border-radius:1.5vh;width:30%;margin-bottom:3vh;box-shadow: inset 3px 4px 10px black;padding:.5vh">
  <h3>Playlists</h3>
</div>
</center>  

<div style="background-color:white;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;padding-left:5vh;padding-right:5vh;">
<ul>
    <?php foreach($list as $pl): ?>
      <li><a href="/playlist/<?= $pl['playlist'] ?>"><?= $pl['playlist'] ?></a></li>
      <?php endforeach; ?>
</ul>
</div>
    </div>
<!-- end -->

<!-- Song List -->
<div style="width:30%;box-shadow: 1vh 1vh 5vh lightblue;padding:3vh;border-radius:1vh">
<form action="/search" method="get" style="margin-bottom:3vh">
  <input style="border:solid black .5px;border-radius:1vh;font-size:2.5vh;padding:.5vh" type="text" name="music" placeholder="Search Songs" required>
  <input style="border:none;border-radius:1vh;font-size:2.5vh;padding:.6vh;box-shadow: inset 1px 1px 15px gray;rgb(179, 179, 179);width:40%" type="submit" placeholder="Submit">
</form>

<div style="background-color:#ccffff;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;padding-left:5vh;padding-right:5vh;">
<ul>
    <?php foreach($list as $pl): ?>
      <li><a href="/playlist/.<?= $pl['playlist'] ?>."><?= $pl['playlist'] ?></a></li>
      <?php endforeach; ?>
</ul>
</div>
</div>
<!-- end -->

</div>
<!-- end -->
</body>
</html>