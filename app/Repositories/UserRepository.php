<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return User::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $paginateBy = 30, int $page = null) : LengthAwarePaginator
    {
        return User::query()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param string $id
     * @return User|null
     */
    public function findById(string $id) : ?User
    {
        /** @var User|null $user */
        $user = User::query()
            ->find($id);
        return $user;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email) : ?User
    {
        /** @var User|null $user */
        $user = User::query()
            ->where('email', '=', $email)
            ->first();

        return $user;
    }

    /**
     * @param Vendor $vendor
     * @return Collection|null
     */
    public function getAllForVendor(
        Vendor $vendor
    ) : ?Collection
    {
        return $vendor->users()
            ->get();
    }

    /**
     * @param User $user
     * @param Vendor $vendor
     * @return User
     */
    public function attachToVendor(
        User $user,
        Vendor $vendor
    ) : User
    {
        $user->vendors()->attach($vendor->id);

        return $user;
    }

    /**
     * @param User $user
     * @param Vendor $vendor
     * @return bool
     */
    public function isAttachedToVendor(
        User $user,
        Vendor $vendor
    ) : bool
    {
        return $vendor->users()
            ->exists($user->id);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param bool $approved
     * @return User
     */
    public function create(
        string $name,
        string $email,
        string $password,
        bool $approved = false
    ) : User
    {
        return User::create([
            'name'                      => $name,
            'email'                     => $email,
            'password'                  => $password,
            'approved'                  => $approved,
            'email_confirmation_code'   => str_random(16)
        ]);
    }

    /**
     * @param User $user
     * @param string $name
     * @param string $email
     * @param bool $approved
     * @return User
     */
    public function update(
        User $user,
        string $name,
        string $email,
        bool $approved
    ) : User
    {
        $user->update([
            'name'     => $name,
            'email'    => $email,
            'approved' => $approved
        ]);

        return $user;
    }

    /**
     * @param User $user
     * @param string $password
     * @return User
     */
    public function updatePassword(
        User $user,
        string $password
    ) : User
    {
        $user->update([
            'password' => $password
        ]);

        return $user;
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function checkPassword(
        User $user,
        string $password
    ) : bool
    {
        if (Hash::check($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param User $user
     * @return User
     */
    public function makeApprove(
        User $user
    ) : User
    {
        $user->update([
            'approved' => 1
        ]);

        return $user;
    }

    /**
     * @param Vendor $vendor
     * @return Collection
     */
    public function getNotifiableForVendor(Vendor $vendor) : Collection
    {
        return $vendor->users()
            ->get();
    }

    /**
     * @param Vendor $vendor
     * @return User|null
     */
    public function getFirstRegisteredUserForVendor(Vendor $vendor) : ?User
    {
        return $vendor->users()
            ->orderBy('created_at', 'asc')
            ->first();
    }

    /**
     * @param User $user
     * @throws \Exception
     */
    public function delete(User $user) : void
    {
        $user->delete();
    }
}
