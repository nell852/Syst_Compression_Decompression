<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['fileToCompress']) || $_FILES['fileToCompress']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors du téléchargement du fichier.']);
        exit;
    }

    $uploadedFile = $_FILES['fileToCompress']['tmp_name'];
    $originalName = $_FILES['fileToCompress']['name'];
    $compressionMethod = $_POST['compressionMethod'] ?? 'normal';
    $dictionarySize = (int)($_POST['dictionarySize'] ?? 32);

    // Vérification de la taille du fichier
    if (filesize($uploadedFile) === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Le fichier est vide.']);
        exit;
    }

    // Nom du fichier compressé
    $compressedFileName = pathinfo($originalName, PATHINFO_FILENAME) . '.keyce';
    $compressedFilePath = __DIR__ . '/uploads/' . $compressedFileName;

    try {
        // Lecture du contenu du fichier original
        $fileContent = file_get_contents($uploadedFile);

        // Fonction de compression ZK
        function zk_compress($data, $dictionarySize) {
            $dictionary = [];
            $result = '';
            $buffer = '';

            for ($i = 0; $i < strlen($data); $i++) {
                $buffer .= $data[$i];

                if (!isset($dictionary[$buffer])) {
                    // Si le buffer n'est pas dans le dictionnaire, on l'ajoute
                    if (count($dictionary) < $dictionarySize) {
                        $dictionary[$buffer] = count($dictionary);
                    }

                    // On ajoute l'index ou le caractère précédent au résultat
                    $result .= isset($dictionary[substr($buffer, 0, -1)])
                        ? $dictionary[substr($buffer, 0, -1)] . '|' . $data[$i]
                        : $data[$i];

                    $buffer = '';
                }
            }

            // Si un buffer reste à la fin, on l'ajoute
            if ($buffer !== '') {
                $result .= isset($dictionary[$buffer]) ? $dictionary[$buffer] : $buffer;
            }

            return $result;
        }

        // Compression des données avec l'algorithme ZK
        $compressedData = zk_compress($fileContent, $dictionarySize);

        // Vérification si la compression est efficace
        if (strlen($compressedData) >= strlen($fileContent)) {
            echo json_encode([
                'status' => 'error',
                'message' => "La compression n'est pas efficace pour ce fichier. La taille aurait augmenté."
            ]);
            exit;
        }

        // Enregistrement du fichier compressé
        file_put_contents($compressedFilePath, $compressedData);

        echo json_encode([
            'status' => 'success',
            'message' => "Fichier compressé avec succès : $compressedFileName",
            'downloadLink' => 'uploads/' . $compressedFileName
        ]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la compression : ' . $e->getMessage()]);
    }
}
