<?php

class ZKAlgorithm {
    /**
     * Compression en utilisant l'algorithme ZK
     */
    public function compress($inputFilePath, $outputFilePath) {
        $data = file_get_contents($inputFilePath);

        // Algorithme ZK pour la compression
        $dictionary = [];
        $buffer = '';
        $compressedData = '';

        for ($i = 0; $i < strlen($data); $i++) {
            $buffer .= $data[$i];

            if (!isset($dictionary[$buffer])) {
                // Ajouter la séquence au dictionnaire
                if (count($dictionary) < 256) {
                    $dictionary[$buffer] = count($dictionary);
                }

                // Ajouter l'index ou le caractère précédent au résultat
                $compressedData .= isset($dictionary[substr($buffer, 0, -1)]) 
                    ? $dictionary[substr($buffer, 0, -1)] . '|'
                    : $data[$i];

                $buffer = '';
            }
        }

        // Ajouter les données restantes dans le buffer
        if ($buffer !== '') {
            $compressedData .= isset($dictionary[$buffer]) 
                ? $dictionary[$buffer] 
                : $buffer;
        }

        // Sauvegarder les données compressées dans le fichier de sortie
        return file_put_contents($outputFilePath, $compressedData) !== false;
    }

    /**
     * Décompression en utilisant l'algorithme ZK
     */
    public function decompress($inputFilePath, $outputFilePath) {
        $compressedData = file_get_contents($inputFilePath);
        $dictionary = [];
        $currentIndex = 0;
        $decompressedData = '';

        // Découper les données compressées par le séparateur
        $parts = explode('|', $compressedData);

        foreach ($parts as $part) {
            if (is_numeric($part)) {
                // Récupérer l'entrée correspondante dans le dictionnaire
                $entry = array_search($part, $dictionary);
                if ($entry !== false) {
                    $decompressedData .= $entry;
                }
            } else {
                // Ajouter le caractère ou la séquence directement
                $decompressedData .= $part;

                if (!isset($dictionary[$part]) && $currentIndex < 256) {
                    $dictionary[$part] = $currentIndex++;
                }
            }
        }

        // Sauvegarder les données décompressées dans le fichier de sortie
        return file_put_contents($outputFilePath, $decompressedData) !== false;
    }
}
?>
