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
    <h1 class="font-bold text-2xl">Modifier : '<?= $jiri->name ?>'</h1>
    <form action="/jiri"
          method="post"
          class="flex flex-col gap-6 bg-slate-50 rounded p-4">
        <?php method('patch') ?>
        <?php csrf_token() ?>
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
            <?php component('forms.controls.button', ['text' => 'Sauvegarder les modifications']); ?>
        </div>
    </form>

    <!-- If no attendances -->
    <!-- Form to add attendances -->
    <form action="/attendance" method="post" class="flex flex-col gap-6 bg-slate-50 rounded p-4">

        <?php csrf_token() ?>
        <input type="hidden" name="jiri_id" value="<?= $jiri->id ?>">

        <!-- No attendances-->
        <?php if (empty($jiri->students) && empty($jiri->evaluators)): ?>
            <legend>NB : Aucun participant pour le moment</legend>
        <?php endif; ?>

        <div>
            <!-- If there is no one attendance or just the contacts not already added as an attendance -->
            <?php if (!empty($distinctsContacts)): ?>
                <fieldset>
                    <legend class="font-bold mb-2 uppercase">Les participants</legend>
                    <div class="flex flex-col gap-2">
                        <?php
                        /** @var array $distinctsContacts */
                        foreach ($distinctsContacts as $contact): ?>
                            <div>
                                <input id="c-<?= $contact->id ?>"
                                       type="checkbox"
                                       name="contacts[]"
                                       class="h-4 w-4"
                                       value="<?= $contact->id ?>"
                                >
                                <label for="c-<?= $contact->id ?>"><?= $contact->name ?></label>
                                <select name="role-<?= $contact->id ?>"
                                        id="role-<?= $contact->id ?>"
                                        class="mx-2 p-2 rounded">
                                    <option value="student">Étudiant</option>
                                    <option value="evaluator">Évaluateur</option>
                                </select>
                                <label for="role-<?= $contact->id ?>"
                                       class="font-bold sr-only">Rôle</label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            <?php endif; ?>
        </div>
        <!-- Button to add attendances to the jiri -->
        <div>
            <?php component('forms.controls.button', ['text' => 'Ajouter ces contacts au jiri']) ?>
        </div>
    </form>


    <!-- Attendances -->
    <div>
        <?php if (count($jiri->students)): ?>
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
                            <!-- form to delete the attendance -->
                            <form action="/attendance" method="post">
                                <?php method('delete'); ?>
                                <?php csrf_token() ?>

                                <input type="hidden"
                                       name="jiri_id"
                                       value="<?= $jiri->id ?>">
                                <input type="hidden"
                                       name="contact_id"
                                       value="<?= $student->id ?>">
                                <button type="submit"
                                        class="px-2 bg-red-500 text-white rounded">Supprimer
                                </button>
                            </form>
                        </li>
                    <?php
                    endforeach; ?>
                </ol>
            </section>
        <?php endif ?>

        <?php if (count($jiri->evaluators)): ?>
            <section class="mt-4">
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
                            <!-- form to delete the attendance -->
                            <form action="/attendance" method="post">
                                <?php method('delete'); ?>
                                <?php csrf_token() ?>

                                <input type="hidden"
                                       name="jiri_id"
                                       value="<?= $jiri->id ?>">
                                <input type="hidden"
                                       name="contact_id"
                                       value="<?= $evaluator->id ?>">
                                <button type="submit"
                                        class="px-2 bg-red-500 text-white rounded">Supprimer
                                </button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </section>
        <?php endif ?>
    </div>
    <?php component('forms.jiris.delete', ['id' => $jiri->id]) ?>
    <?php partials('common_html_end'); ?>
</html>