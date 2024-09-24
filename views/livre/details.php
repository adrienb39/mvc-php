<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détails livre</title>
</head>
<body>
    <p>ID du livre : <?php echo $livre->getId(); ?></p>
    <p>Titre du livre : <?php echo $livre->getTitre(); ?></p>
    <p>Auteur du livre : <?php echo $livre->getAuteur(); ?></p>
    <p>Nombres de pages du livre : <?php echo $livre->getNbPages(); ?></p>
</body>
</html>