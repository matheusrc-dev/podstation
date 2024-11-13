<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $members = $_POST['members'];
    $description = $_POST['description'];

    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] == 0) {
        $audioData = file_get_contents($_FILES['audio_file']['tmp_name']);
        $audioData = $conn->real_escape_string($audioData);

        $sql = "UPDATE podcasts SET title='$title', members='$members', description='$description', audio_file='$audioData' WHERE id=$id";
    } else {
        $sql = "UPDATE podcasts SET title='$title', members='$members', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM podcasts WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Editar Podcast</title>
    <?php include './partials/head.php'; ?>
</head>

<body>
    <?php include './partials/header.php'; ?>
    <div class="px-5 pt-3">
        <h2>Editar Podcast</h2>

        <form action="update.php?id=<?php echo $id; ?>" method="post">
            <div class="mb-3">
                <label class="form-label" for="title">Título:</label>
                <input class="form-control" type="text" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="members">Integrantes:</label>
                <input class="form-control" type="text" name="members" value="<?php echo $row['members']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Descrição:</label>
                <textarea class="form-control" name="description" required><?php echo $row['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="audio_file">Enviar Novo Arquivo de Áudio:</label>
                <input class="form-control" type="file" name="audio_file" id="audio_file" accept="audio/*">
            </div>
            <?php if (!empty($row['audio_file'])): ?>
                <p>Áudio atual:
                    <audio controls class="w-100">
                        <source src="data:audio/mpeg;base64,<?php echo base64_encode($row['audio_file']); ?>" type="audio/mpeg">
                        Seu navegador não suporta a reprodução de áudio.
                    </audio>
                </p>
            <?php endif; ?>
            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
</body>

</html>