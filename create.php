<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $members = $_POST['members'];
    $description = $_POST['description'];

    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] == 0) {
        $audioData = file_get_contents($_FILES['audio_file']['tmp_name']);
        $audioData = $conn->real_escape_string($audioData);
    
        $sql = "INSERT INTO podcasts (title, members, description, audio_file) VALUES ('$title', '$members', '$description', '$audioData')";
    } else {
        $sql = "INSERT INTO podcasts (title, members, description) VALUES ('$title', '$members', '$description')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Novo Podcasts</title>
    <?php include './partials/head.php'; ?>
</head>
<body>
    <?php include './partials/header.php'; ?>
    <div class="px-5 pt-3"> 
        <h2>Novo Podcasts</h2>
        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label" for="title">Título:</label>
                <input class="form-control" type="text" name="title" required>
            </div>    

            <div class="mb-3">
                <label class="form-label" for="members">Integrantes:</label>
                <input class="form-control" type="text" name="members" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="description">Descrição:</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="audio_file">Enviar Arquivo de Áudio:</label>
                <input class="form-control" type="file" name="audio_file" id="audio_file" accept="audio/*">
            </div>


            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</body>
</html>
