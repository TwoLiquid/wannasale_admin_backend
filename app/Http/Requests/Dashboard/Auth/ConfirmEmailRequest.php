<?php

namespace App\Http\Requests\Dashboard\Auth;

use App\Http\Requests\Dashboard\BaseRequest;

class ConfirmEmailRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'email'     => 'required|email||exists:admins,email',
            'code'      => 'required|string|exists:admins,email_confirmation_code'
        ];
    }

    public function messages() : array
    {
        return [
            'email.required'    => 'Необходим e-mail для подтверждения регистрации.',
            'email.email'       => 'Неверный формат e-mail.',
            'email.exists'      => 'Данный e-mail не найден.',
            'code.required'     => 'Необходим код кодтверждения.',
            'code.string'       => 'Код кодтверждения должен быть строкой.',
            'code.exists'       => 'Данный код подтверждения не найден.'
        ];
    }
}