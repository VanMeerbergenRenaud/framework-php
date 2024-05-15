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
    <body>
        <a class="sr-only"
           href="#main-menu">Aller au menu principal</a>
        <div class="container mx-auto flex flex-col-reverse gap-6">
            <main class="flex flex-col gap-4">
                <h1 class="font-bold text-2xl"><?= $contact->name ?></h1>
                <dl>
                    <div>
                        <dt class="font-bold">Nom</dt>
                        <dd><?= $contact->name ?></dd>
                    </div>
                    <div>
                        <dt class="font-bold">Email</dt>
                        <dd><?= $contact->email ?></dd>
                    </div>
                </dl>
                <div>
                    <a href="/contact/edit?id=<?= $contact->id ?>"
                       class="underline text-blue-500">modifier ce contact</a>
                </div>
                <?php
                component('forms.contacts.delete', ['id' => $contact->id]) ?>
            </main>
            <?php
            component('navigations.main'); ?>
        </div>
    </body>
</html>