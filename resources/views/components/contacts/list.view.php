<?php

/** @var array $contacts */
if (count($contacts) > 0) : ?>
    <ol>
        <?php
        foreach ($contacts as $contact) : ?>
            <li><a class="underline text-blue-500"
                   href="/contact?id=<?= $contact->id ?>"><?= $contact->name ?> - <?= $contact->email ?></a></li>
        <?php
        endforeach ?>
    </ol>
<?php
endif ?>