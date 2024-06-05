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
    <!-- When you are on a contact's profile, you should see the list of jiris in which they participate -->
    <?php if(!empty($jiris)): ?>
        <section class="mt-2 mb-4 p-4 bg-slate-50">
            <h2 class="font-bold">Le(s) jury(s) auxquels participent le contact</h2>
            <ol class="flex flex-col gap-2">
                <?php foreach ($jiris as $jiri): ?>
                    <li class="flex gap-2">
                        <a href="/jiri?id=<?= $jiri->id ?>" class="text-blue-500 underline">
                            <?= $jiri->name ?> - <?= $jiri->starting_at ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </section>
    <?php endif; ?>
    <div>
        <a href="/contact/edit?id=<?= $contact->id ?>" class="bg-blue-500 font-bold text-white rounded-md p-2 px-4 tracking-wider uppercase">
            modifier ce contact
        </a>
    </div>
    <?php
    component('forms.contacts.delete', ['id' => $contact->id]) ?>
    <?php
    partials('common_html_end');
    ?>
</html>