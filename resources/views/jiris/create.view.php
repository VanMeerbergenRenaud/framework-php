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
                    <a href="/jiris" class="underline text-blue-500">← Annuler</a>
                    <h1 class="text-3xl font-bold">Créer un nouveau jiri</h1>
                </div>
                <form action="/jiri" method="post" class="flex flex-col gap-4 items-start">
                    <?php csrf_token() ?>
                    <?php component('forms.controls.label-and-input',
                        [
                            'name' => 'name',
                            'label' => 'Nom du jiri',
                            'type' => 'text',
                            'value' => '',
                            'placeholder' => 'Mon examen de première année'
                        ]); ?>

                    <?php
                        $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
                        component('forms.controls.label-and-input',
                            [
                                'name' => 'starting_at',
                                'label' => "Date de début <small>au format {$date}</small>",
                                'type' => 'text',
                                'value' => '',
                                'placeholder' => '2022-02-02 08:00:00'
                            ]);
                    ?>

                    <?php component('forms.controls.button', ['text' => 'Créer ce jiri']) ?>

                    <?php
                        $_SESSION['errors'] = [];
                        $_SESSION['old'] = [];
                    ?>
                </form>
            </main>
            <?php component('navigations.main') ?>
        </div>
    </body>
</html>