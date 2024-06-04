<?php
/** @var array $contacts */

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Contacts</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <?php
    partials('common_html_start');
    ?>
    <h1 class="font-bold text-2xl">Vos contacts</h1>
    <?php
    if (!empty($contacts)) : ?>
        <?php
        component('forms.search', ['label' => 'Nom du contact']); ?>

        <section>
            <h2 class="font-bold">Mes contacts</h2>
            <?php
            component('contacts.list', [
                'title' => 'Mes Contacts',
                'contacts' => $contacts,
            ]) ?>
        </section>
    <?php
    endif ?>
    <div>
        <a href="/contact/create"
           class="underline text-blue-500 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="currentColor"
                 class="w-6 h-6">
                <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
            </svg>
            <span>Créer un nouveau contact</span></a>
    </div>
    <?php
    partials('common_html_end');
    ?>
</html>