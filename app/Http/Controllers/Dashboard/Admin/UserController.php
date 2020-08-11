<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\Dashboard\User\CreateRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Http\Requests\Dashboard\Vendor\InviteUserRequest;
use App\Notifications\UserPassword;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use App\Services\UserService;

class UserController extends BaseController
{
    public function create(
        string $id,
        VendorRepository $vendorRepo
    )
    {
        $vendor = $vendorRepo->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        return view('dashboard.admin.vendors.users.invite', [
            'item' => $vendor
        ]);
    }

    public function invite(
        InviteUserRequest $request,
        VendorRepository $vendorRepo,
        UserRepository $userRepo,
        UserService $service
    ) {
        $vendor = $vendorRepo->findById(
            $request->input('vendor_id')
        );

        $user = $userRepo->findByEmail(
            $request->input('email')
        );

        if ($user === null) {

            if ($service->createAndInviteToVendor(
                    $vendor,
                    $request->input('email')
                ) === false) {
                return $this->error(
                    'Не удалось создать аккаунт для пользователя.',
                    route('dashboard.admin.vendors')
                );
            }
        } else {

            if ($userRepo->isAttachedToVendor(
                    $user,
                    $vendor
                ) === true) {
                return $this->warning(
                    'Приглашаемый пользователь уже привязан к компании.',
                    route('dashboard.admin.vendors.edit', $vendor->id)
                );
            }

            $userRepo->attachToVendor(
                $user,
                $vendor
            );
        }

        return $this->success(
            'Пользователь успешно приглашен к управлению компанией.',
            route('dashboard.admin.vendors.edit', $vendor->id)
        );
    }

    public function delete(
        string $id,
        string $uid,
        VendorRepository $vendorRepo,
        UserRepository $userRepository
    )
    {
        $user = $userRepository->findById($uid);
        if ($user === null) {
            return $this->error(
                'Пользователь не найден.',
                route('dashboard.admin.vendors.edit.vendors.edit', $id)
            );
        }

        $userRepository->delete($user);

        return $this->warning('Пользователь успешно удалён.', route('dashboard.admin.vendors.edit', $id));
    }
}
