<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music Player</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Kenia&display=swap');
  * {
    margin:0;
    padding:0;
  }
  
  body {
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
}

  h1 {
    margin-top:5vh;
    margin-bottom:5vh;
    font-family: 'Kenia', cursive;
    font-size: 8vh;
    text-shadow: lightblue 1px 0 10px;
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

.modal {
  z-index: 3;
  flex-direction: column;
  justify-content: center;
  gap: 0.4rem;
  width: 450px;
  padding: 1.3rem;
  min-height: 250px;
  position: absolute;
  top: 20%;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 15px;
}

.modal .flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.modal input {
  padding: 0.7rem 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 0.9em;
}

.modal p {
  font-size: 0.9rem;
  color: #777;
  margin: 0.4rem 0 0.2rem;
}

button {
  cursor: pointer;
  border: none;
  font-weight: 600;
}

.btn {
  display: inline-block;
  padding: 0.8rem 1.4rem;
  font-weight: 700;
  background-color: black;
  color: white;
  border-radius: 5px;
  text-align: center;
  font-size: 1em;
}

.btn-open {
  position: relative;
  color:white;
  background: rgb(184,243,255);
  background: linear-gradient(90deg, rgba(184,243,255,0.865983893557423) 0%, rgba(17,145,179,0.9192051820728291) 46%, rgba(0,46,68,1) 74%, rgba(0,0,0,0.9472163865546218) 95%);
  border-radius:1vh;
  border:1px solid white;
  font-family: 'Bebas Neue', sans-serif;
  font-size:10vh;
}

.btn-close {
  transform: translate(10px, -20px);
  padding: 0.5rem 0.7rem;
  background: #eee;
  border-radius: 50%;
}

.overlay {
  z-index: 2;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(3px);
  z-index: 1;
}
.hidden {
  display: none;
}

input[type=file]::file-selector-button {
  border: none;
  background: lightblue;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: black;
}

input[type=submit] {
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
<body style="background-image:url('https://img.freepik.com/free-vector/abstract-watercolor-pastel-background_87374-139.jpg?w=740&t=st=1695649849~exp=1695650449~hmac=b1ab5e540466aad24245ee8550dfa358f4186dfaa356e7f890abba66c3e099b6');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
  <center>
  <h1>Music Player</h1>
</center>
<!-- container -->
<div style="display:flex;flex-direction:row;justify-content:center;flex-wrap:wrap">
<!-- music player -->
  <div style="background-color:black;width:80%;height:10vh;border-radius: 15px 50px 30px;box-shadow: 1vh 1vh 5vh lightblue;">
    <center>
      <audio src='<?php if(isset($playing['music'])): if (!file_exists($playing['music'])): $src = $playing['music']; $fsrc = str_replace('_',' ',$src); echo $fsrc; else: echo $playing['music']; endif; endif; ?>' autoplay controls>
      </audio>
    </center>
  </div>
<!-- end -->

<!-- overlay -->
<div class="overlay hidden"></div>
<!-- end -->

<!-- Playlists Modal -->
<section class="modal hidden" id="PlaylistModal">
  <div class="flex">
    <!-- Playlists' header -->
      <center>
        <div style="background-color:rgb(89, 89, 89);border-radius:1.5vh;width:100%;margin-bottom:3vh;box-shadow: inset 3px 4px 10px black;padding:.5vh">
          <h3>Playlists</h3>
        </div>
      </center>  
      <button class="btn-close" id='a'>⨉</button>
    <!-- end -->
  </div>

<!-- Playlists' list -->
  <div>
    <div style="background-color:white;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;">
      <center>
        <table style="width:95%">
          <?php foreach($list as $pl):?>
            <tr>
              <td style="background-color:lightblue;width:70%;font-weight:bold;padding:1vh;border-radius:1vh"><a href="/playlist/<?= str_replace('C:\laragon\www\Laboratory_2\public/uploads/','',$pl) ?>/null"><?= str_replace('C:\laragon\www\Laboratory_2\public/uploads/','',$pl) ?></a></td>
              <td style="background-color:black;border-radius:1vh;text-align:center;"><a style="color:white;" href="/delete_p/<?= str_replace('C:\laragon\www\Laboratory_2\public/uploads/','',$pl) ?>">Delete</a></td>
              <tr>
              <?php endforeach; ?>
        </table>
      </center>
    </div>
  </div>
  <!-- end -->

  <!-- Create Playlists-->
  <center>
    <hr>
    <br>
    <form action="/save_p" method="post" style="margin-bottom:3vh">
      <input style="border:solid gray .1vh;border-radius:1vh;font-size:2.5vh;padding:.5vh" type="text" name="playlist" placeholder="Create Playlist" required>
      <input style="border:none;border-radius:1vh;font-size:2vh;padding:.7vh;box-shadow: inset 1px 1px 15px lightblue;background-color:black;width:40%;float:right;color:white" type="submit" name="submit" placeholder="Submit">
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
  </center>
  <br>
  <hr>
  <br>
  <center>
  <a href="https://www.flaticon.com/free-icons/music-note" title="music note icons">Music note icons created by yaicon - Flaticon</a>
  </center>
<!-- end -->
</section>
<!-- END -->

<!-- Add songs modal -->
<section class="modal hidden" id="AddSongs">
  <div class="flex">
    <!-- Add Songs Header -->
      <center>
        <div style="background-color:rgb(89, 89, 89);border-radius:1.5vh;width:100%;margin-bottom:3vh;box-shadow: inset 3px 4px 10px black;padding:.5vh">
          <h3>Add Music <?php if(isset($plist)): echo 'to '.$plist; endif; ?>
          </h3>
        </div>
      </center> 
      <button class="btn-close" id='b'>⨉</button>
    <!-- end -->
  </div>
  <!-- Input -->
  <div>
    <div style="background-color:white;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;padding-left:5vh;padding-right:5vh;">
      <center>
        <form action="/save" method="post" enctype="multipart/form-data">
          <input type='hidden' name='playlist' value='<?php if(isset($plist)): ?><?= $plist; endif; ?>' required>
          <label><h3 style='color:black;font-size:5vh'> Upload a music file: </h3></label>
          <input style="border:solid gray .1vh;border-radius:1vh;font-size:2.5vh;width:80%" type="file" name="song" placeholder="Add Songs" required>
          <br>
          <br>
          <?php if(isset($plist)): ?>
          <input style="border:none;border-radius:1vh;font-size:3vh;padding:.7vh;box-shadow: inset 1px 1px 15px lightblue;background-color:black;width:50%;color:white" type="submit" placeholder="Submit">
          <?php else: ?>
          <pre> Note: You must select a Playlist First.
          </pre>
          <?php endif; ?>
        </form>
      </center>
    </div>
  </div>
<!-- end -->
<hr>
<br>
<center>
<a href="https://www.flaticon.com/free-icons/music-note" title="music note icons">Music note icons created by alimasykurm - Flaticon</a>
</center>
</section>
<!-- END -->
<!-- end -->

<!-- Playlists -->
<div style="box-shadow: 1vh 1vh 5vh lightblue;background-color:rgba(255,255,255,100%);width:35%;padding:0vh;border-radius:1vh;margin-left:5%">
  <img src='/images/playlist.png' width='6%' height='20%' style='z-index:1;position:absolute;margin:1%;'>
  <button id='pl-open' class='btn-open' style="width:100%;height:50%;text-align:right">Playlists &nbsp</button>
  <img src='/images/add.png' width='5%' height='18%' style='z-index:1;position:absolute;margin-top:1%;margin-bottom:1%;margin-right:1%;margin-left:1.3%;'>
  <button id='song-open' class='btn-open' style="width:100%;height:50%;text-align:right">Add Song &nbsp</button>
</div>


<!-- Song List -->
<div style="width:35%;box-shadow: 1vh 1vh 5vh lightblue;padding:3vh;border-radius:1vh;margin-right:5%;background-color:rgba(255,255,255,70%)">
<form action="/search" method="get" style="margin-bottom:3vh">
  <input style="border:solid gray .1vh;border-radius:1vh;font-size:2.2vh;padding:.5vh;width:50%" type="text" name="music" placeholder="Search Songs" required>
  <input style="border:none;border-radius:1vh;font-size:2vh;padding:.7vh;box-shadow: inset 1px 1px 15px lightblue;background-color:black;width:40%;float:right;color:white" type="submit" placeholder="Submit">
</form>

<div style="background-color:#ccffff;border-radius:1vh;padding-top:2vh;padding-bottom:2vh;">
<center>
  <h3 style='color:black'>Current Playlist: <?php if(isset($plist)): echo $plist; else: echo 'No selected playlist'; endif; ?></h3>
<table style="width:95%">
    <?php if(isset($plist) && !isset($setter['title'])): ?>
      <?php foreach($songs as $s): ?>
      <tr>
      <th style="width:70%;font-weight:bold;background-color:white;padding:1vh;border-radius:1vh"><a href="/playlist/<?= $plist ?>/<?= $s['musicID'] ?>"><?= $s['title'] ?></a></th>
      <td style="background-color:black;border-radius:1vh;padding-left:1vh;padding-right:1vh;text-align:center"><a style="color:white;" href="/delete/<?= $plist ?>/<?= $s['musicID'] ?>">Delete</a></td>
      <tr>
      <?php endforeach; ?>
    <?php elseif(isset($setter['title'])): ?>
      <?php foreach($search as $look): ?>
      <tr>
      <th style="width:70%;font-weight:bold;background-color:white;padding:1vh;border-radius:1vh"><a href="/playlist/<?= $look['playlist'] ?>/<?= $look['musicID'] ?>"><?= $look['title'] ?></a></th>
      <td style="background-color:black;border-radius:1vh;padding-left:1vh;padding-right:1vh;text-align:center"><a style="color:white;" href="/delete/<?= $look['playlist'] ?>/<?= $look['musicID'] ?>">Delete</a></td>
      <tr>
      <?php endforeach; ?>
      <?php endif; ?>
</table>
      </center>
</div>
</div>
<!-- end -->
</div>
<!-- end -->




<!-- Modal Scripts -->
<script>
  const plmodal = document.getElementById("PlaylistModal");
  const smodal = document.getElementById("AddSongs");
  const closeModalBtn = document.getElementById("a");
  const closeModalBtn_s = document.getElementById("b");
  const overlay = document.querySelector(".overlay");
  const plbtn = document.getElementById("pl-open");
  const sbtn = document.getElementById("song-open");
  
const openModal_p = function () {
  plmodal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

plbtn.addEventListener("click", openModal_p);

const openModal_s = function () {
  smodal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

sbtn.addEventListener("click", openModal_s);

const closeModal = function () {
  plmodal.classList.add("hidden");
  overlay.classList.add("hidden");
};

const closeModal_s = function () {
  smodal.classList.add("hidden");
  overlay.classList.add("hidden");
};

closeModalBtn.addEventListener("click", closeModal);
closeModalBtn_s.addEventListener("click", closeModal_s);


</script>
</body>
</html>