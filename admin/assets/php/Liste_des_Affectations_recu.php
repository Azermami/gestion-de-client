<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sourd');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Fetch data from the SQL table
$sql = "SELECT * FROM affectation";
$result = mysqli_query($conn, $sql);

// Output the data as an HTML table
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        if ($row['etat'] == 'received') {
            echo "<th scope='row'><a href='#'>#" . $row['id_demande'] . "</a></th>";
            echo "<td>" . $row['id_interpret'] . "</td>";
            echo "<td>" . $row['video_recu'] . "</td>";
            echo "<td>" . $row['date_affectation'] . "</td>";
            echo "<td><span class='badge bg-success'>" . $row['etat'] . "</span></td>";
            echo "<td><button class='btn btn-danger' onclick='deleteRow(".$row['id_demande'].")'>Supprimer</button></td>";
            echo "<td><button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#videoModal' onclick='setVideo(\"" . $row['video_recu'] . "\")'>Visualiser</button></td>";
            echo '<td><button type="button" class="btn btn-primary" onclick="validateRow('.$row['id_demande'].')">Valider</button></a></td>';

        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Aucune demande trouvée.</td></tr>";
}

// Close the database connection
mysqli_close($conn);

?>
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="videoModalLabel" style="text-align: center !important;">Vidéo de démonstration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="embed-responsive embed-responsive-4by3">
          <video id="videoPlayer" class="embed-responsive-item" controls  width="770" height="400" autoplay >
            <source id="videoSource" src="" type="video/mp4" >
            Your browser does not support the video tag.
          </video>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
  const videoPlayer = document.getElementById('videoPlayer');
  videoPlayer.pause();
});
function setVideo(videoUrl) {
  const videoSource = document.getElementById('videoSource');
  videoSource.src = videoUrl;

  const videoPlayer = document.getElementById('videoPlayer');
  videoPlayer.load();
}

function deleteRow(id) {
  if (confirm("Voulez-vous vraiment supprimer cette ligne?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var row = document.getElementById("row-" + id);
        row.parentNode.removeChild(row);
      }
    };
    xhttp.open("POST", "assets/php/delete.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("delete_id=" + id);
  }
}

function validateRow(id) {
  if (confirm("Voulez-vous vraiment valider cette ligne?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var badge = document.getElementById("badge-" + id);
        badge.innerHTML = "validate";
        badge.classList.remove("bg-success");
        badge.classList.add("bg-primary");
      }
    };
    xhttp.open("POST", "assets/php/valider.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("validate_id=" + id);
  }
}
</script>