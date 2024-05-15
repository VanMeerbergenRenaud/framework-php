<?php

namespace App\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;

class PagesController
{
    #[NoReturn]
    public function home(): void
    {
        view('pages.home');
    }
}
