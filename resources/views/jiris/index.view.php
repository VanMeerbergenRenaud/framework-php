<?php
    /** @var array $upcoming_jiris */
    /** @var array $passed_jiris */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= public_path('css/app.css') ?>">
        <title>Jiris</title>
    </head>
    <body>
        <div class="flex flex-col-reverse gap-4">
            <main class="flex flex-col gap-4 mx-auto max-w-screen-xl pt-5">
                <div class="flex items-center gap-10 mb-5 justify-between">
                    <h1 class="text-3xl font-bold">Les Jiris</h1>
                    <?php component('forms.search') ?>
                </div>
                <div class="flex gap-5 justify-between mb-5">
                    <section class="border rounded-md min-w-96 p-6">
                        <h2 class="text-xl font-bold mb-2">Jiri à venir</h2>
                        <?php if (count($upcoming_jiris) > 0): ?>
                            <ol>
                                <?php foreach ($upcoming_jiris as $jiri): ?>
                                    <li class="mb-1">
                                        <a class="text-blue-500 underline" href="/jiri?id=<?= $jiri->id ?>"><?= $jiri->name ?></a>
                                        <p class="text-sm"><?= date('j F o', strtotime($jiri->starting_at)) ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php else: ?>
                            <p>Il n'y a pas de jiri à venir</p>
                        <?php endif; ?>
                    </section>
                    <section class="border rounded-md min-w-96 p-6">
                        <h2 class="text-xl font-bold mb-2">Jiri passés</h2>
                        <?php if (count($passed_jiris) > 0): ?>
                            <ol>
                                <?php foreach ($passed_jiris as $jiri): ?>
                                    <li class="mb-1">
                                        <a class="text-blue-500 underline" href="/jiri?id=<?= $jiri->id ?>"><?= $jiri->name ?></a>
                                        <p class="text-sm"><?= date('j F o', strtotime($jiri->starting_at)) ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php else: ?>
                            <p>Il n'y a pas de jiri archivés</p>
                        <?php endif; ?>
                    </section>
                </div>
                <div>
                    <a href="/jiri/create" class="underline text-blue-500">+ Créer un nouveau Jiri</a>
                </div>
            </main>
            <?php component('navigations.main') ?>
        </div>
    </body>
</html>