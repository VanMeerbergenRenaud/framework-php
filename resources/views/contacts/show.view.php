<?php
/** @var stdClass $contact */

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Contacts : <?= $contact->name ?></title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <?php
    partials('common_html_start');
    ?>
    <h1 class="font-bold text-2xl"><?= $contact->name ?></h1>
    <dl class="bg-slate-50 p-4 flex flex-col gap-4">
        <div>
            <dt class="font-bold">Nom du contact</dt>
            <dd><?= $contact->name ?></dd>
        </div>
        <div>
            <dt class="font-bold">Adresse email du contact</dt>
            <dd><?= $contact->email ?></dd>
        </div>
    </dl>
    <div>
        <a href="/contact/edit?id=<?= $contact->id ?>"
           class="underline text-blue-500">modifier ce contact</a>
    </div>
    <?php
    component('forms.contacts.delete', ['id' => $contact->id]) ?>
    <?php
    partials('common_html_end');
    ?>
</html>