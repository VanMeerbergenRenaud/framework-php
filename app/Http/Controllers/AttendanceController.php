<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Core\Exceptions\FileNotFoundException;
use Core\Response;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class AttendanceController
{
    private Attendance $attendance;

    public function __construct()
    {
        try {
            $this->attendance = new Attendance(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            exit($exception->getMessage());
        }
    }

    #[NoReturn]
    public function update(): void
    {
        $data = Validator::check([
            'jiri_id' => 'required',
            'contact_id' => 'required',
            'role' => 'required',
        ]);

        $this->attendance->setRole($data);

        Response::redirect('/jiri/edit?id='.$data['jiri_id']);
    }

    #[NoReturn] public function store(): void
    {
        $data = Validator::check([
            'jiri_id' => 'required',
            'contacts' => 'required',
        ]);

        foreach ($data['contacts'] as $contact_id) {
            $role_key = 'role-' . $contact_id;
            $role = $data[$role_key];

            $this->attendance->create([
                'jiri_id' => $data['jiri_id'],
                'contact_id' => $contact_id,
                'role' => $role
            ]);
        }

        Response::redirect('/jiri?id=' . $data['jiri_id']);
    }

    #[NoReturn] public function destroy(): void
    {
        $data = Validator::check([
            'jiri_id' => 'required',
            'contact_id' => 'required',
        ]);

        $this->attendance->delete($data);

        Response::redirect('/jiri/edit?id='.$data['jiri_id']);
    }
}