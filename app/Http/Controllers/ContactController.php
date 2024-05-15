<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Core\Auth;
use Core\Concerns\Request\HasIdentifier;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class ContactController
{
    private Contact $contact;

    use HasIdentifier;

    public function __construct()
    {
        try {
            $this->contact = new Contact(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            exit($exception->getMessage());
        }
    }

    #[NoReturn]
    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        $contacts = $this->contact->belongingTo(Auth::id(), 'user');

        view('contacts.index', compact('contacts'));
    }

    #[NoReturn]
    public function store(): void
    {
        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
        ]);

        $data['user_id'] = Auth::id();

        if ($this->contact->create($data)) {
            Response::redirect('/contacts');
        } else {
            Response::abort(Response::SERVER_ERROR);
        }
    }

    public function create(): void
    {
        view('contacts.create');
    }

    public function show(): void
    {
        $id = $this->checkValidId();

        $contact = $this->contact->findOrFail($id);

        $this->check_ownership($contact);

        view('contacts.show', compact('contact'));
    }

    private function check_ownership(int|string|stdClass $contact): void
    {
        if (is_numeric($contact)) {
            $contact = $this->contact->findOrFail($contact);
        }

        if (Auth::id() !== $contact?->user_id) {
            Response::abort(Response::UNAUTHORIZED);
        }
    }

    public function edit(): void
    {
        $id = $this->checkValidId();

        $contact = $this->contact->findOrFail($id);

        $this->check_ownership($contact);

        view('contacts.edit', compact('contact'));
    }

    #[NoReturn]
    public function update(): void
    {
        $id = $this->checkValidId();

        $data = Validator::check([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
        ]);

        $this->check_ownership($id);

        $this->contact->update($id, $data);

        Response::redirect('/contact?id='.$id);
    }

    #[NoReturn]
    public function destroy(): void
    {
        $id = $this->checkValidId();

        $this->check_ownership($id);

        $this->contact->delete($id);

        Response::redirect('/contacts');
    }
}