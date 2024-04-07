<?php
    /** @var stdClass $jiri */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= public_path('css/app.css'); ?>">
        <title>Jiris</title>
    </head>
    <body>
        <div class="flex flex-col-reverse gap-4">
            <main class="flex flex-col gap-4 mx-auto max-w-screen-xl pt-5">
                <div class="flex items-center gap-10 mb-5 justify-between">
                    <a class="underline text-blue-500" href="/jiri?id=<?= $jiri->id ?>">← Annuler la modification</a>
                    <h1 class="text-3xl font-bold"><?= $jiri->name ?></h1>
                </div>
                <form action="/jiri" method="post" class="flex flex-col gap-4 items-start">
                    <?php method('patch'); ?>
                    <?php csrf_token() ?>

                    <input type="hidden" name="id" value="<?= $jiri->id ?>">

                    <?php component('forms.controls.label-and-input',
                        [
                            'label' => "Nom du jiri <small>au moins 3 caractères</small>:",
                            'name' => 'name',
                            'type' => 'text',
                            'value' => $jiri->name,
                            'placeholder' => 'Mon examen de première année'
                        ]
                    ) ?>

                    <?php
                        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
                        component('forms.controls.label-and-input',
                            [
                                'name' => 'starting_at',
                                'label' => "Date de début <small>au format {$date}</small>",
                                'type' => 'text',
                                'value' => Carbon\Carbon::parse($jiri->starting_at)->format('Y-m-d H:i:s'),
                                'placeholder' => '2022-02-02 08:00:00'
                            ]);
                    ?>

                    <?php component('forms.controls.button', ['text' => 'Modifier ce jiri']) ?>
                </form>
            </main>
            <?php component('navigations.main') ?>
        </div>
    </body>
</html>