// Gestionnaire pour le formulaire de compression
document.getElementById('compressForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêcher la soumission par défaut
    const formData = new FormData(this); // Récupérer les données du formulaire

    // Afficher un message pendant la compression
    document.getElementById('compressStatus').innerHTML = '<p>Compression en cours...</p>';

    // Effectuer la requête fetch
    fetch('compress.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            // Afficher le résultat
            document.getElementById('compressStatus').innerHTML = data.status === 'success'
                ? `<p>${data.message}</p><a href="${data.downloadLink}" download>Télécharger</a>`
                : `<p style="color: red;">${data.message}</p>`;
        })
        .catch(error => {
            // En cas d'erreur
            document.getElementById('compressStatus').innerHTML = `<p style="color: red;">Erreur : ${error.message}</p>`;
        });
});

// Gestionnaire pour le formulaire de décompression
document.getElementById('decompressForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêcher la soumission par défaut
    const formData = new FormData(this); // Récupérer les données du formulaire

    // Afficher un message pendant la décompression
    document.getElementById('decompressStatus').innerHTML = '<p>Décompression en cours...</p>';

    // Effectuer la requête fetch
    fetch('decompress.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            // Afficher le résultat
            document.getElementById('decompressStatus').innerHTML = data.status === 'success'
                ? `<p>${data.message}</p><a href="${data.downloadLink}" download>Télécharger</a>`
                : `<p style="color: red;">${data.message}</p>`;
        })
        .catch(error => {
            // En cas d'erreur
            document.getElementById('decompressStatus').innerHTML = `<p style="color: red;">Erreur : ${error.message}</p>`;
        });
});
