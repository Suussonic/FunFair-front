document.addEventListener("DOMContentLoaded", function() {
    // Séquence du Konami Code
    const konamiCode = [
        "ArrowUp", "ArrowUp", "ArrowDown", "ArrowDown",
        "ArrowLeft", "ArrowRight", "ArrowLeft", "ArrowRight",
        "b", "a", "Enter"
    ];

    let konamiCodePosition = 0;

    // Fonction pour télécharger l'image
    function downloadImage(url) {
        console.log("Konami Code entered! Downloading image...");
        let a = document.createElement("a");
        a.href = url;
        a.download = "konami_image.jpg";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // Écouteur d'événements pour les touches du clavier
    document.addEventListener("keydown", function(event) {
        if (event.key === konamiCode[konamiCodePosition]) {
            konamiCodePosition++;
            if (konamiCodePosition === konamiCode.length) {
                // URL de l'image à télécharger
                const imageUrl = "public/assets/images/LOGONVMAX.png";
                new Audio('public/assets/images/SONICRING.mp3').play();
                downloadImage(imageUrl);
                downloadImage(imageUrl2);
                konamiCodePosition = 0;
            }
        } else {
            konamiCodePosition = 0;
        }
    });
});
