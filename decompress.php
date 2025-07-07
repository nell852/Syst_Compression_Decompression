<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToDecompress'])) {
    $uploadedFile = $_FILES['fileToDecompress']['tmp_name'];
    $originalName = $_FILES['fileToDecompress']['name'];
    $outputDir = "outputs/";

    // Création du nom du fichier de sortie
    $decompressedFile = $outputDir . pathinfo($originalName, PATHINFO_FILENAME) . ".decompressed";

    // Lecture des données compressées
    $compressedData = file_get_contents($uploadedFile);

    // Décompression en utilisant l'algorithme ZK
    function zk_decompress($data) {
        $dictionary = [];
        $result = '';
        $i = 0;

        while ($i < strlen($data)) {
            $currentChar = $data[$i];

            if (isset($dictionary[$currentChar])) {
                // Si le caractère est dans le dictionnaire, on récupère sa valeur
                $result .= $dictionary[$currentChar];
            } else {
                // Sinon, on l'ajoute directement au résultat
                $result .= $currentChar;
                $dictionary[$currentChar] = $currentChar; // Ajout au dictionnaire
            }

            // Extension du dictionnaire avec des séquences
            if ($i > 0 && $i < strlen($data) - 1) {
                $nextChar = $data[$i + 1];
                $dictionary[$currentChar . $nextChar] = $currentChar . $nextChar;
            }

            $i++;
        }

        return $result;
    }

    // Appel de l'algorithme ZK pour décompresser les données
    $data = zk_decompress($compressedData);

    // Sauvegarde du fichier décompressé
    file_put_contents($decompressedFile, $data);

    // Vérification de l'existence du fichier décompressé et réponse au client
    if (file_exists($decompressedFile)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Décompression réussie !',
            'downloadLink' => $decompressedFile
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la décompression.'
        ]);
    }
    exit;
}
?>
