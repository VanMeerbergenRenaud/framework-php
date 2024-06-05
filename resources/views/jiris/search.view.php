<?php
    /** @var array $jiris */
    /** @var string $query */
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jiris</title>
    <link rel="stylesheet" href="<?= public_path('css/app.css') ?>">
</head>
    <?php partials('common_html_start'); ?>
    <h1 class="sr-only">Vos jiris recherchés</h1>

    <!-- Search query result -->
    <?php if (!empty($searchResults)): ?>
        <section class="mt-4 p-2">
            <!-- Résultats -->
            <h2 class="font-bold text-2xl mb-4">
                Résultats de la recherche : <?= $query; ?>
            </h2>
            <?php foreach ($searchResults as $jiri): ?>
                <div class="mb-4">
                    <a href="/jiri?id=<?= $jiri->id ?>" class="underline text-blue-500">
                        <?= $jiri->name ?>
                    </a>
                </div>
            <?php endforeach ?>
        </section>
    <?php else: ?>
        <section>
            <h2 class="font-bold text-2xl mb-4">
                Résultats de la recherche : <?= $query; ?>
            </h2>
            <p>Aucun résultat</p>
        </section>
    <?php endif ?>

    <?php partials('common_html_end'); ?>
</html>