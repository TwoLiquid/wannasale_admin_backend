<?php

namespace App\Http\Requests\Dashboard\User;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email,' . $this->route('id')
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'     => 'Необходимо ввести имя пользователя.',
            'name.max'          => 'Имя пользователя должно содержать в себе не более 255 символов.',
            'email.required'    => 'Необходимо ввести E-mail пользователя.',
            'email.email'       => 'Необходимо ввести валидный E-mail.',
            'email.unique'      => 'Пользователь с таким E-mail уже зарегистрирован.'
        ];
    }
}