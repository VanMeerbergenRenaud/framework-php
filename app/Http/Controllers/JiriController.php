<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;

class JiriController
{
    private Jiri $jiri;

    public function __construct()
    {
        try {
            $this->jiri = new Jiri(BASE_PATH . '/.env.local.ini');
        } catch (FileNotFoundException $exception) {
            die($exception->getMessage());
        }
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? '';
        $statement = $this->jiri->query(<<<SQL
            SELECT * FROM `jiris`
            WHERE starting_at > CURRENT_TIMESTAMP 
            AND name LIKE '%$search%';
        SQL
        );
        $upcoming_jiris = $statement->fetchAll();

        $statement = $this->jiri->query(<<<SQL
            SELECT * FROM `jiris`
            WHERE starting_at < CURRENT_TIMESTAMP
            AND name LIKE '%$search%';
        SQL
        );
        $passed_jiris = $statement->fetchAll();

        view('jiris.index', compact('upcoming_jiris', 'passed_jiris'));
    }

    public function create(): void
    {
        $_SESSION['csrf_token'] = get_csrf_token();

        view('jiris.create');
    }

    public function store(): void
    {
        $data = Validator::check([
            'name'=> 'required|min:3|max:255',
            'starting_at'=> 'required|datetime',
        ]);

        if ($this->jiri->create($data)) {
            Response::redirect('/jiris');
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function show(): void
    {
        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) { // !ctype_digit — Check si l'id n'est pas de type numérique
            Response::abort(Response::BAD_REQUEST);
        }

        $id = $_GET['id'];

        $jiri = $this->jiri->findOrFail($id);

        view('jiris.show', compact('jiri'));
    }

    public function edit(): void
    {
        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        $id = $_GET['id'];

        $jiri = $this->jiri->findOrFail($id);

        view('jiris.edit', compact('jiri'));
    }

    public function update(): void
    {
        $success = $this->jiri->update(
            $_POST['id'],
            [
                'name' => $_POST['name'],
                'starting_at' => $_POST['starting_at'],
            ],
        );

        if ($success) {
            Response::redirect("/jiri?id={$_POST['id']}");

        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function destroy(): void
    {
        if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        $id = $_POST['id'];

        $this->jiri->delete($id);

        Response::redirect('/jiris');
    }
}