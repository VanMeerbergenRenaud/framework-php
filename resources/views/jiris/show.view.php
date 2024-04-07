<?php
/** @var stdClass $jiri */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= public_path('css/app.css'); ?>">
    <title>Jiris</title>
</head>
<body>
<div class="flex flex-col-reverse gap-4">
    <main class="flex flex-col gap-4 mx-auto max-w-screen-xl pt-5">
        <div class="flex items-center gap-10 mb-5 justify-between">
            <a class="underline text-blue-500" href="/jiris">← Retour aux Jiris</a>
            <h1 class="text-3xl font-bold"><?= $jiri->name ?></h1>
        </div>
        <dl class="mb-5">
            <div class="mb-3">
                <dt class="font-bold">Nom :</dt>
                <dd><?= $jiri->name ?></dd>
            </div>
            <div>
                <dt class="font-bold">Date de début :</dt>
                <dd>
                    <?= Carbon\Carbon::parse($jiri->starting_at)
                        ->format('Y-m-d H:i');
                    ?>
                </dd>
                <div>
                    <dd>
                        <?= Carbon\Carbon::parse($jiri->starting_at)
                            ->diffForHumans(Carbon\Carbon::now());
                        ?>
                    </dd>
                </div>
            </div>
        </dl>
        <div class="flex gap-10 items-center">
            <a href="/jiri/edit?id=<?= $jiri->id ?>" class="underline text-blue-500">
                Modifier ce jiri
            </a>
            <form action="/jiri" method="post">
                <?php csrf_token(); ?>
                <?php method('delete'); ?>
                <input type="hidden" name="id" value="<?= $jiri->id ?>">
                <?php component('forms.controls.button', ['text' => 'Supprimer ce jiri']); ?>
            </form>
        </div>
    </main>
    <?php component('navigations.main') ?>
</div>
</body>
</html>