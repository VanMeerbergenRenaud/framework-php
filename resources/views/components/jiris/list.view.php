<?php
/** @var array $jiris */

?>

<?php
if (count($jiris) > 0) { ?>
    <ol>
        <?php
        foreach ($jiris as $jiri) { ?>
            <li><a class="underline text-blue-500"
                   href="/jiri?id=<?= $jiri->id ?>"><?= $jiri->name ?></a></li>
            <?php
        } ?>
    </ol>
    <?php
} ?>