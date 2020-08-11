<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vendor;
use App\Notifications\UserEmailConfirmWithCredentials;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;

class UserService
{
    public function createAndInviteToVendor(
        Vendor $vendor,
        string $email
    )
    {
        $userRepo = app(UserRepository::class);

        $generatedName = $this->getGeneratedNameFromEmail($email);
        $generatedPassword = $this->generatePassword();

        $user = $userRepo->create(
            $generatedName,
            $email,
            $generatedPassword,
            false
        );

        if ($user !== null) {
            $userRepo->attachToVendor(
                $user,
                $vendor
            );

            $user->notify(new UserEmailConfirmWithCredentials(
                $vendor,
                $generatedPassword
            ));

        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function generatePassword() : string
    {
        $generatedPassword = str_random(8);
        return $generatedPassword;
    }

    /**
     * @param string $email
     * @return string
     */
    public function getGeneratedNameFromEmail(
        string $email
    ) : string
    {
        $emailPatterns = explode('@', $email);

        return isset($emailPatterns[0])
            ? $emailPatterns[0]
            : 'Новый пользователь';
    }
}