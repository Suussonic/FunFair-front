<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/concours.css">
    <title>Concours de dessin</title>
</head>
<body>

<h2>Mettez en ligne une image ou dessinez</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/png">
    <input type="submit" name="upload" value="Upload">
</form>
<button id="openCanvasBtn">Dessiner</button>

<h2>Concours de dessin</h2>
<div class="gallery">
    <?php
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

    if (sizeof($result) > 0) {
        foreach($result as $row) {
            echo "<div class='gallery-item'>";
            echo "<h3>Image de " . htmlspecialchars($row['author']) . "</h3>";
            echo '<img src="data:image/png;base64,' . base64_encode($row['image_data']) . '" alt="' . htmlspecialchars($row['author']) . '" /><br>';
            echo "<p>Likes : " . $row['like_count'] . "</p>";

            // Vérifier si l'utilisateur a déjà liké cette image
            $stmt = $dbh->prepare("SELECT COUNT(*) FROM likes WHERE user_id = :user_id AND image_id = :image_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':image_id', $row['id']);
            $stmt->execute();
            $has_liked = $stmt->fetchColumn() > 0;

            // Afficher le bouton avec l'image appropriée (Like ou Un-like)
            echo "<form action='/controllers/concours/like_image.php' method='post' style='display: inline;'>";
            echo "<input type='hidden' name='image_id' value='" . $row['id'] . "'>";
            echo "<input type='hidden' name='action' value='" . ($has_liked ? 'unlike' : 'like') . "'>";
            echo "<button type='submit' style='border: none; background: none;'>";
            if ($has_liked) {
                echo "<img src='/public/assets/images/like.png' alt='Un-like' style='width: 64px; cursor: pointer;'>";
            } else {
                echo "<img src='/public/assets/images/unlike.png' alt='Like' style='width: 64px; cursor: pointer;'>";
            }
            echo "</button>";
            echo "</form>";

            echo "</div>";
        }
    } else {
        echo "<p>Aucune image de trouvée !</p>";
    }
    ?>
</div>

<form id="uploadCanvasForm" action="/controllers/concours/process_drawing.php" method="post">
    <input type="hidden" name="canvasData" id="canvasData">
    <input type="submit" name="upload" value="Upload" style="display:none;">
</form>

<div id="canvasPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h3>Créez votre dessin</h3>
        <label for="colorPicker">Choisissez une couleur : </label>
        <input type="color" id="colorPicker" value="#000000"><br><br>
        <canvas id="drawingCanvas" width="400" height="400" style="border:1px solid #000000;"></canvas><br>
        <button id="clearCanvasBtn">Effacer</button>
        <button id="saveCanvasBtn">Enregistrer</button>
    </div>
</div>

<script>
    var canvasPopup = document.getElementById("canvasPopup");
    var openCanvasBtn = document.getElementById("openCanvasBtn");
    var closeSpan = document.getElementsByClassName("close")[0];
    var colorPicker = document.getElementById("colorPicker");

    openCanvasBtn.onclick = function() {
        canvasPopup.style.display = "block";
    }

    closeSpan.onclick = function() {
        canvasPopup.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == canvasPopup) {
            canvasPopup.style.display = "none";
        }
    }

    var canvas = document.getElementById("drawingCanvas");
    var ctx = canvas.getContext("2d");
    var drawing = false;
    var currentColor = colorPicker.value;

    colorPicker.onchange = function() {
        currentColor = colorPicker.value;
    };

    function getMousePos(e) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top
        };
    }

    function getTouchPos(e) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: e.touches[0].clientX - rect.left,
            y: e.touches[0].clientY - rect.top
        };
    }

    function startDrawing(e) {
        drawing = true;
        ctx.strokeStyle = currentColor;
        ctx.beginPath();
        ctx.moveTo(getMousePos(e).x, getMousePos(e).y);
    }

    function endDrawing() {
        drawing = false;
        ctx.closePath();
    }

    function draw(e) {
        if (!drawing) return;
        e.preventDefault();  // Prévenir les comportements par défaut comme le scrolling lors du dessin sur mobile
        if (e.touches) {
            ctx.lineTo(getTouchPos(e).x, getTouchPos(e).y);
        } else {
            ctx.lineTo(getMousePos(e).x, getMousePos(e).y);
        }
        ctx.stroke();
    }

    // Événements souris
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mouseup", endDrawing);
    canvas.addEventListener("mousemove", draw);

    // Événements tactiles
    canvas.addEventListener("touchstart", startDrawing);
    canvas.addEventListener("touchend", endDrawing);
    canvas.addEventListener("touchmove", draw);

    document.getElementById("clearCanvasBtn").onclick = function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    document.getElementById("saveCanvasBtn").onclick = function() {
        var dataURL = canvas.toDataURL("image/png");
        document.getElementById("canvasData").value = dataURL;
        document.forms["uploadCanvasForm"].submit();
    }
</script>

</body>
</html>
