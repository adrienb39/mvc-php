<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste livres</title>
</head>
<body>
    <h1>Liste des livres</h1>
    <a href="index.php?route=livre-add">Ajouter un livre</a>
    <ul>
        <?php foreach ($livres as $livre) : ?>
            <li><?= $livre->getTitre() ?>   <a href="index.php?route=livre-details&livre=<?= $livre->getId() ?>">détails</a>    <a href="index.php?route=livre-edit&livre=<?= $livre->getId() ?>">Modifier</a>  <a href="index.php?route=livre-delete&livre=<?= $livre->getId() ?>">Supprimer</a></li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Accueil</a>
</body>
</html>