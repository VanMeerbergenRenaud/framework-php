<nav id="main-menu">
    <h2 class="sr-only">Menu principal</h2>
    <ul class="flex gap-4">
        <?php

        use Core\Auth;

        if (Auth::check()) { ?>
            <li><a class="underline text-blue-500"
                   href="/jiris">Jiris</a></li>
            <li><a class="underline text-blue-500"
                   href="/contacts">Contacts</a></li>
            <li><a class="underline text-blue-500"
                   href="/projects">Projets</a></li>
            <li>
                <?php
                component('forms.logout.delete') ?>
            </li>
            <?php
        } else { ?>
            <li><a class="underline text-blue-500"
                   href="/register">S’enregister</a></li>
            <li><a class="underline text-blue-500"
                   href="/login">S’identifier</a></li>
            <?php
        } ?>
    </ul>
</nav>