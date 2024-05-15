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
        <title>Modifier le contact : <?= $contact->name ?> </title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <body>
        <a class="sr-only"
           href="#main-menu">Aller au menu principal</a>
        <div class="container mx-auto flex flex-col-reverse gap-6">
            <main class="flex flex-col gap-4">
                <h1 class="font-bold text-2xl">Modifier <?= $contact->name ?></h1>
                <form action="/contact"
                      method="post"
                      class="flex flex-col gap-6">
                    <?php
                    method('patch') ?>
                    <?php
                    csrf_token() ?>
                    <input type="hidden"
                           name="id"
                           value="<?= $contact->id ?>">
                    <div class="flex flex-col gap-2">
                        <?php
                        component('forms.controls.label-and-input', [
                            'name' => 'name',
                            'label' => 'Nom <small>au moins 3 caractères, au plus 255</small>',
                            'type' => 'text',
                            'value' => $contact->name,
                            'placeholder' => 'Ms. Dollie Smith',
                        ]);
                        ?>
                    </div>
                    <div class="flex flex-col gap-2">
                        <?php
                        component('forms.controls.label-and-input', [
                            'name' => 'email',
                            'label' => 'Email <small>doit être valide</small>',
                            'type' => 'text',
                            'value' => $contact->email,
                            'placeholder' => 'santo.schulist@yahoo.com',
                        ]);
                        ?>
                    </div>
                    <div>
                        <?php
                        component('forms.controls.button', ['text' => 'Modifier ce contact']);
                        ?>
                    </div>
                </form>
                <?php
                component('forms.contacts.delete', ['id' => $contact->id]) ?>
            </main>
            <?php
            component('navigations.main'); ?>
        </div>
    </body>
</html>