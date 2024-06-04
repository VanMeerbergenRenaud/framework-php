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
    <?php
    partials('common_html_start');
    ?>
    <h1 class="font-bold text-2xl">Modifier <?= $jiri->name ?></h1>
    <form action="/jiri"
          method="post"
          class="flex flex-col gap-6 bg-slate-50 rounded p-4">
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
                'label' => 'Nom du jury<span class="block font-normal">au moins 3 caractères, au plus 255</span>',
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
                'label' => "Date et heure de début du jury<span class='block font-normal'>au format {$date}</span>",
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
    <?php
    partials('common_html_end');
    ?>
</html>