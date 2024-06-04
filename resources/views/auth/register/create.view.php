<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Jiris - S’enregistrer</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <?php
    partials('common_html_start');
    ?>
    <h1 class="font-bold text-2xl">S’enregistrer</h1>
    <section class="bg-slate-50 rounded-md p-4 flex flex-col gap-8">
        <div>
            <h2 class="uppercase font-bold">
                Rejoingnez Jiri !
            </h2>
            <p>En vous créant un compte, vous pourrez tirer parti de toutes les fonctionnalités de Jiri. Vous pourrez
               créer de nouveaux jurys, ajouter des contacts et des projets et monitorer vos jurys en temps réel.</p>
        </div>
        <?php
        component('forms.register.create'); ?>
        <a href="/login"
           class="block text-right underline">J’ai déjà un compte</a>
    </section>
    <?php
    partials('common_html_end');
    ?>
</html>