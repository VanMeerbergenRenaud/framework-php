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
    <h1 class="font-bold text-2xl"><?= $jiri->name ?></h1>
    <dl class="flex flex-col gap-4 bg-slate-50 p-4">
        <div>
            <dt class="font-bold">Nom du jiri</dt>
            <dd><?= $jiri->name ?></dd>
        </div>
        <div>
            <dt class="font-bold">Date et heure de début du jiri</dt>
            <dd><?= Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                    ->locale('fr')
                    ->diffForHumans() ?>
            </dd>
            <dd>
                <time datetime="<?= Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                    ->toDateTimeString() ?>">le <?= Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                        ->locale('fr')
                        ->format('d M Y') ?> à <?= Carbon::createFromFormat('Y-m-d H:i:s', $jiri->starting_at)
                        ->locale('fr')
                        ->format('H:i') ?></time>
            </dd>
        </div>
    </dl>
    <?php
    if (count($jiri->students)): ?>
        <section>
            <h2 class="font-bold">Les étudiants</h2>
            <ol class="flex flex-col gap-2">
                <?php
                foreach ($jiri->students as $student): ?>
                    <li class="flex gap-2">
                        <a href="/contact?id=<?= $student->id ?>"><?= $student->name ?>
                            - <?= $student->email ?></a>
                        <form action="/attendance"
                              method="post">
                            <?php
                            method('patch');
                            csrf_token() ?>
                            <input type="hidden"
                                   name="jiri_id"
                                   value="<?= $jiri->id ?>">
                            <input type="hidden"
                                   name="contact_id"
                                   value="<?= $student->id ?>">
                            <input type="hidden"
                                   name="role"
                                   value="evaluator">
                            <button type="submit"
                                    class="px-2 bg-red-500 text-white rounded">Changer en évaluateur
                            </button>
                        </form>
                    </li>
                <?php
                endforeach; ?>
            </ol>
        </section>
    <?php
    endif ?>

    <?php
    if (count($jiri->evaluators)): ?>
        <section>
            <h2 class="font-bold">Les évaluateurs</h2>
            <ol class="flex flex-col gap-2">
                <?php
                foreach ($jiri->evaluators as $evaluator): ?>
                    <li class="flex gap-2">
                        <a href="/contact?id=<?= $evaluator->id ?>"><?= $evaluator->name ?>
                            - <?= $evaluator->email ?></a>
                        <form action="/attendance"
                              method="post">
                            <?php
                            method('patch');
                            csrf_token() ?>
                            <input type="hidden"
                                   name="jiri_id"
                                   value="<?= $jiri->id ?>">
                            <input type="hidden"
                                   name="contact_id"
                                   value="<?= $evaluator->id ?>">
                            <input type="hidden"
                                   name="role"
                                   value="student">
                            <button type="submit"
                                    class="px-2 bg-red-500 text-white rounded">Changer en étudiant
                            </button>
                        </form>
                    </li>
                <?php
                endforeach; ?>
            </ol>
        </section>
    <?php
    endif ?>
    <div>
        <a href="/jiri/edit?id=<?= $jiri->id ?>"
           class="underline text-blue-500">modifier ce jiri</a>
    </div>
    <?php
    component('forms.jiris.delete', ['id' => $jiri->id]) ?>
    <?php
    partials('common_html_end');
    ?>
</html>