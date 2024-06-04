<nav id="main-menu"
     class="font-bold">
    <h2 class="sr-only">Menu principal</h2>
    <ul class="flex flex-col sm:flex-row gap-4 sm:gap-8 sm:items-center">
        <?php

        use Core\Auth;

        if (Auth::check()) : ?>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/jiris">Jiris</a></li>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/contacts">Contacts</a></li>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/projects">Projets</a></li>
            <li class="mt-4 sm:mt-auto sm:ml-auto">
                <?php
                component('forms.logout.delete') ?>
            </li>
        <?php
        else : ?>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/register">S’enregister</a></li>
            <li><a class="underline text-white uppercase tracking-wider"
                   href="/login">S’identifier</a></li>
        <?php
        endif ?>
    </ul>
</nav>