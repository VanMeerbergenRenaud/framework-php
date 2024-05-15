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
    <body>
        <a class="sr-only"
           href="#main-menu">Aller au menu principal</a>
        <div class="container mx-auto flex flex-col-reverse gap-6">
            <main class="flex flex-col gap-4">
                <h1 class="font-bold text-2xl">Contacts</h1>
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

                <div>
                    <a href="/contact/create"
                       class="underline text-blue-500">Créer un nouveau contact</a>
                </div>
            </main>
            <?php
            component('navigations.main'); ?>
        </div>
    </body>
</html>