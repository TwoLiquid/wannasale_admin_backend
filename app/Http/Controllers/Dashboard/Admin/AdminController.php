<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\Dashboard\Admin\CreateRequest;
use App\Http\Requests\Dashboard\Admin\UpdateRequest;
use App\Models\Admin;
use App\Notifications\AdminEmailConfirmWithCredentials;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminController extends BaseController
{
    public function index(AdminRepository $adminRepo)
    {
        $admins = $adminRepo->getAllPaginated();

        return view('dashboard.admin.partners.index', [
            'partners' => $admins
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.partners.create');
    }

    public function store(
        CreateRequest $request,
        AdminRepository $adminRepo
    )
    {
        $generatedPassword = $adminRepo->generatePassword();

        $admin = $adminRepo->create(
            $request->input('name'),
            $request->input('email'),
            $generatedPassword
        );

        if ($admin === null) {
            return $this->error(
                'Не удалось добавить партнера.',
                route('dashboard.admin.partners')
            );
        }

        $admin->notify(new AdminEmailConfirmWithCredentials(
            $generatedPassword
        ));

        return $this->success(
            'Партнер успешно создан. Письмо с подтверждением его регистрации выслано на указанную почту.',
            route('dashboard.admin.partners.edit', $admin->id)
        );
    }

    public function edit(
        string $id,
        AdminRepository $adminRepo
    )
    {
        $admin = $adminRepo->findById($id);
        if ($admin === null) {
            return $this->error(
                'Партнер не найден',
                route('dashboard.admin.partners')
            );
        }

        return view('dashboard.admin.partners.edit', [
            'admin' => $admin
        ]);
    }

    public function update(
        string $id,
        UpdateRequest $request,
        AdminRepository $adminRepo
    )
    {
        $admin = $adminRepo->findById($id);
        if ($admin === null) {
            return $this->error(
                'Партнер не найден',
                route('dashboard.admin.partners')
            );
        }

        $adminRepo->update(
            $admin,
            $request->input('name'),
            $request->input('email')
        );

        return $this->success(
            'Партнер успешно изменен.',
            route('dashboard.admin.partners.edit', $admin->id)
        );
    }

    public function delete(
        string $id,
        AdminRepository $adminRepo
    )
    {
        $admin = $adminRepo->findById($id);
        if ($admin === null) {
            return $this->error(
                'Партнер не найден.',
                route('dashboard.admin.partners')
            );
        }

        $adminRepo->delete(
            $admin
        );

        return $this->success(
            'Партнера успешно удалена.',
            route('dashboard.admin.partners')
        );
    }
}
