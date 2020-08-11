<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Admin::query()
            ->orderBy('created_at', 'desc')
            ->where('is_super', '=', false)
            ->get();
    }

    /**
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $paginateBy = 30, int $page = null) : LengthAwarePaginator
    {
        return Admin::query()
            ->orderBy('created_at', 'desc')
            ->where('is_super', '=', false)
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param string $id
     * @return Admin|null
     */
    public function findById(string $id) : ?Admin
    {
        /** @var Admin|null $admin */
        $admin = Admin::query()
            ->find($id);

        return $admin;
    }

    /**
     * @param string $email
     * @return Admin|null
     */
    public function findByEmail(string $email) : ?Admin
    {
        /** @var Admin|null $admin */
        $admin = Admin::query()
            ->where('email', '=', $email)
            ->first();

        return $admin;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return Admin
     */
    public function create(
        string $name,
        string $email,
        string $password
    ) : Admin {
        return Admin::create([
            'name'                      => $name,
            'email'                     => $email,
            'password'                  => Hash::make($password),
            'email_confirmation_code'   => str_random(16),
            'approved'                  => false,
            'is_super'                  => false
        ]);
    }

    /**
     * @param Admin $admin
     * @param string $name
     * @param string $email
     * @return Admin
     */
    public function update(
        Admin $admin,
        string $name,
        string $email
    ) : Admin {
        $admin->update([
            'name'      => $name,
            'email'     => $email
        ]);

        return $admin;
    }

    /**
     * @param Admin $admin
     * @return bool
     */
    public function approve(
        Admin $admin
    )
    {
        return $admin->update([
            'approved'                  => true,
            'email_confirmation_code'   => null
        ]);
    }

    /**
     * @param Admin $admin
     * @throws \Exception
     */
    public function delete(Admin $admin) : void
    {
        $admin->delete();
    }

    /**
     * @return string
     */
    public function generatePassword() : string
    {
        return str_random(8);
    }
}
