<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Jiris - l’application de gestion des vos jurys</title>
        <link rel="stylesheet"
              href="<?= public_path('css/app.css') ?>">
    </head>
    <?php
    partials('common_html_start');
    ?>
    <div class="mb-4">
        <h1 class="font-bold text-2xl mb-4">Jiri, l’application de gestion de vos jurys</h1>
        <p>Avec Jiri, planifiez des évaluations, ajoutez-y des évaluateurs et des évalués, listez les projets que
           doivent réaliser ces derniers, et monitorez la passation du jury en temps réel.</p>
    </div>
    <section class="bg-slate-50 rounded-md p-4 flex flex-col gap-8">
        <div>
            <h2 class="uppercase font-bold">
                Identifiez-vous !
            </h2>
            <p>Il est indispensable de vous identifier pour accéder à vos jurys, vos contacts et vos
               projets</p>
        </div>
        <?php
        component('forms.login.create'); ?>
        <a href="/register"
           class="block text-right underline">Je n'ai pas encore de compte</a>
    </section>
    <?php
    partials('common_html_end'); ?>
</html>