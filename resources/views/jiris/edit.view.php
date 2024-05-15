<?php
/** @var stdClass $jiri */

use Carbon\Carbon;

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Jiris</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <body>
        <a class="sr-only"
           href="#main-menu">Aller au menu principal</a>
        <div class="container mx-auto flex flex-col-reverse gap-6">
            <main class="flex flex-col gap-4">
                <h1 class="font-bold text-2xl">Modifier <?= $jiri->name ?></h1>
                <form action="/jiri"
                      method="post"
                      class="flex flex-col gap-6">
                    <?php
                    method('patch') ?>
                    <?php
                    csrf_token() ?>
                    <input type="hidden"
                           name="id"
                           value="<?= $jiri->id ?>">
                    <div class="flex flex-col gap-2">
                        <?php
                        component('forms.controls.label-and-input', [
                            'name' => 'name',
                            'label' => 'Nom <small>au moins 3 caractères, au plus 255</small>',
                            'type' => 'text',
                            'value' => $jiri->name,
                            'placeholder' => 'Mon examen de première session',
                        ]);
                        ?>
                    </div>
                    <div class="flex flex-col gap-2">
                        <?php
                        $date = Carbon::now()->format('Y-m-d H:i');
                        component('forms.controls.label-and-input', [
                            'name' => 'starting_at',
                            'label' => "Date et heure de début <small>au format {$date}</small>",
                            'type' => 'text',
                            'value' => Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                                ->format('Y-m-d H:i'),
                            'placeholder' => $date,
                        ]);
                        ?>
                    </div>
                    <div>
                        <?php
                        component('forms.controls.button', ['text' => 'Modifier ce jiri']);
                        ?>
                    </div>
                </form>
                <?php
                component('forms.jiris.delete', ['id' => $jiri->id]) ?>
            </main>
            <?php
            component('navigations.main'); ?>
        </div>
    </body>
</html>