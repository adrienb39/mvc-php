<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter livre</title>
</head>
<body>
    <form action="" method="post">
        <label for="titre_livre">Titre du livre</label>
        <input type="text" id="titre_livre" name="titre_livre" placeholder="Titre du livre">
        <?php if (!empty($errors['titre_livre'])): ?>
            <span><?= $errors['titre_livre'] ?></span>
        <?php endif; ?>

        <label for="auteur_livre">Auteur du livre</label>
        <input type="text" id="auteur_livre" name="auteur_livre" placeholder="Auteur du livre">
        <?php if (!empty($errors['auteur_livre'])): ?>
            <span><?= $errors['auteur_livre'] ?></span>
        <?php endif; ?>

        <label for="nombre_pages_livre">Nombre de pages du livre</label>
        <input type="number" id="nombre_pages_livre" name="nombre_pages_livre" placeholder="Nombre de pages du livre">
        <?php if (!empty($errors['nombre_pages_livre'])): ?>
            <span><?= $errors['nombre_pages_livre'] ?></span>
        <?php endif; ?>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>