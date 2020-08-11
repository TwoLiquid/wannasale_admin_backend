<?php

namespace App\Http\Requests\Dashboard\Vendor;

use App\Http\Requests\Dashboard\BaseRequest;

class InviteUserRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'email'     => 'required|email',
            'vendor_id' => 'required|string|exists:main.vendors,id',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required'    => 'Необходимо ввести E-mail приглашаемого пользователя.',
            'email.email'       => 'Неверный формат адреса почты приглашаемого пользователя.',
            'rate_id.required'  => 'Необходимо выбрать компанию.',
            'rate_id.string'    => 'ID компании должен быть строкой.',
            'rate_id.exists'    => 'Выбранная компания не найдена.'
        ];
    }
}