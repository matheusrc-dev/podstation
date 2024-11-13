<?php
include 'db.php';

$sql = "SELECT * FROM podcasts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Lista de Podcasts</title>
    <?php include './partials/head.php'; ?>
</head>
<body>
    <?php include './partials/header.php'; ?>
    <div class="px-5 pt-3">
        <h2>Todos os episódios</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Podcast</th>
                    <th scope="col">Integrantes</th>
                    <th scope="col">Data</th>
                    <th scope="col">Áudio</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['members']; ?></td>
                <td><?php echo $row['insertion_date']; ?></td>
                <td>
                    <?php
                        if ($row['audio_file']) {
                            $audioBase64 = base64_encode($row['audio_file']);
                            
                            echo "<audio controls>";
                            echo "<source src='data:audio/mpeg;base64,$audioBase64' type='audio/mpeg'>";
                            echo "Seu navegador não suporta a tag de áudio.";
                            echo "</audio>";
                        } else {
                            echo "Áudio não disponível.";
                        }
                    ?>
                </td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="create.php" class="btn btn-success">Novo Podcast</a>
    </div>
</body>
</html>
