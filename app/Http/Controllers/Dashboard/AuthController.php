<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Auth\ConfirmEmailRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('dashboard.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        if (
            auth(GUARD_DASHBOARD)->attempt(
                $request->only('email', 'password'),
                $request->has('remember')
            ) === false
        ) {
            return $this->error('Неверный логин или пароль.');
        }

        if (auth(GUARD_DASHBOARD)->user()->is_super === true) {
            return redirect()->intended(route('dashboard.admin.vendors'));
        }

        return redirect()->intended(route('dashboard.partner.vendors'));
    }

    public function logout()
    {
        auth(GUARD_DASHBOARD)->logout();
        return redirect()->route('dashboard.login');
    }

    public function confirmEmail(
        ConfirmEmailRequest $request,
        AdminRepository $adminRepo
    )
    {
        $admin = $adminRepo->findByEmail(
            $request->input('email')
        );

        if ($admin === null) {
            return $this->error(
                'Партнер не найден',
                route('dashboard.login')
            );
        }

        if ($admin->email_confirmation_code != $request->input('code')) {
            return $this->error(
                'Код подтверждения не соответствует партнеру.',
                route('dashboard.login')
            );
        }

        $adminRepo->approve(
            $admin
        );

        return $this->success(
            'Аккаунт партнера успешно подтвержден.',
            route('dashboard.login')
        );
    }
}
