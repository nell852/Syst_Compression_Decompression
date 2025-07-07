<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compression et Décompression</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="file"], select, input[type="text"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .output {
            text-align: center;
            margin-top: 20px;
        }
        .output p {
            font-weight: bold;
            color: #333;
        }
        .output a {
            color: #007bff;
            text-decoration: none;
        }
        .output a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Compression et Décompression</h2>

        <!-- Formulaire de compression -->
        <form id="compressForm">
            <h3>Compression</h3>
            <label for="fileToCompress">Choisir un fichier :</label>
            <input type="file" id="fileToCompress" name="fileToCompress" accept="*/*">

            <label for="compressionMethod">Méthode de compression :</label>
            <select id="compressionMethod" name="compressionMethod">
                <option value="normal">Normale</option>
                <option value="fast">Rapide</option>
                <option value="maximum">Maximum</option>
            </select>

            <label for="dictionarySize">Taille du dictionnaire (Mo) :</label>
            <input type="text" id="dictionarySize" name="dictionarySize" value="32">

            <button type="submit">Compresser</button>
        </form>
        <div id="compressStatus" class="output"></div>

        <hr>

        <!-- Formulaire de décompression -->
        <form id="decompressForm">
            <h3>Décompression</h3>
            <label for="fileToDecompress">Choisir un fichier .keyce :</label>
            <input type="file" id="fileToDecompress" name="fileToDecompress" accept=".keyce">

            <button type="submit">Décompresser</button>
        </form>
        <div id="decompressStatus" class="output"></div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
