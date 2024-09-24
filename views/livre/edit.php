<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mettre à jour un livre</title>
</head>
<body>
    <h1>Mettre à jour un livre</h1>
    <form action="index.php?route=livre-edit&livre=<?= $livre->getId() ?>" method="post">
        <label for="titre_livre">Titre :</label>
        <input type="text" id="titre_livre" name="titre_livre" value="<?= $livre->getTitre() ?>" required>
        <?php if (!empty($errors['titre_livre'])): ?>
            <span><?= $errors['titre_livre'] ?></span>
        <?php endif; ?>

        <label for="auteur_livre">Auteur :</label>
        <input type="text" id="auteur_livre" name="auteur_livre" value="<?= $livre->getAuteur() ?>" required>
        <?php if (!empty($errors['auteur_livre'])): ?>
            <span><?= $errors['auteur_livre'] ?></span>
        <?php endif; ?>

        <label for="nombre_pages_livre">Nombre de pages :</label>
        <input type="number" id="nombre_pages_livre" name="nombre_pages_livre" value="<?= $livre->getNbPages() ?>" required>
        <?php if (!empty($errors['nombre_pages_livre'])): ?>
            <span><?= $errors['nombre_pages_livre'] ?></span>
        <?php endif; ?>

        <button type="submit">Mettre à jour</button>
    </form>
    <a href="index.php?route=livre-list">Retour à la liste</a>
</body>
</html>
