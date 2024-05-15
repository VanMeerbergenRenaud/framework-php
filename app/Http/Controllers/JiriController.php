<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Jiri;
use Core\Auth;
use Core\Concerns\Request\HasIdentifier;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class JiriController
{
    private Jiri $jiri;
    private Contact $contact;
    private Attendance $attendance;

    use HasIdentifier;

    public function __construct()
    {
        try {
            $this->jiri = new Jiri(base_path('.env.local.ini'));
            $this->contact = new Contact(base_path('.env.local.ini'));
            $this->attendance = new Attendance(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            exit($exception->getMessage());
        }
    }

    #[NoReturn]
    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        $upcoming_jiris = $this->jiri->upcomingBelongingTo(Auth::id(), 'user');
        $past_jiris = $this->jiri->pastBelongingTo(Auth::id(), 'user');


        view('jiris.index', compact('upcoming_jiris', 'past_jiris'));
    }

    #[NoReturn]
    public function store(): void
    {
        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
        ]);

        $data['user_id'] = Auth::id();
        $filtered_data = array_filter(
            $data,
            fn($key) => $key !== 'contacts' && !str_starts_with($key, 'role-'),
            ARRAY_FILTER_USE_KEY
        );
        if ($this->jiri->create($filtered_data)) {
            $jiri_id = $this->jiri->lastInsertId();
            if (isset($_REQUEST['contacts'])) {
                foreach ($_REQUEST['contacts'] as $contact_id) {
                    $role = $_REQUEST['role-'.$contact_id];
                    $this->attendance->create(compact('jiri_id', 'contact_id', 'role'));
                }
            }
            Response::redirect('/jiri?id='.$jiri_id);
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function create(): void
    {
        $contacts = $this->contact->belongingTo(Auth::id(), 'user');

        view('jiris.create', compact('contacts'));
    }

    public function show(): void
    {
        $id = $this->checkValidId();

        $jiri = $this->jiri->findOrFail($id);

        $this->check_ownership($jiri);

        /** @noinspection NullPointerExceptionInspection */
        $jiri->students = $this->jiri->fetchStudents($jiri?->id);
        $jiri->evaluators = $this->jiri->fetchEvaluators($jiri?->id);

        view('jiris.show', compact('jiri'));
    }

    private function check_ownership(int|string|stdClass $jiri): void
    {
        if (is_numeric($jiri)) {
            $jiri = $this->jiri->findOrFail($jiri);
        }

        if (Auth::id() !== $jiri?->user_id) {
            Response::abort(Response::UNAUTHORIZED);
        }
    }

    public function edit(): void
    {
        $id = $this->checkValidId();

        $jiri = $this->jiri->findOrFail($id);

        $this->check_ownership($jiri);

        view('jiris.edit', compact('jiri'));
    }

    #[NoReturn]
    public function update(): void
    {
        $id = $this->checkValidId();

        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'starting_at' => 'required|datetime',
        ]);

        $this->check_ownership($id);

        $this->jiri->update($id, $data);

        Response::redirect('/jiri?id='.$id);
    }

    #[NoReturn]
    public function destroy(): void
    {
        $id = $this->checkValidId();

        $this->check_ownership($id);

        $this->jiri->delete($id);

        Response::redirect('/jiris');
    }
}
