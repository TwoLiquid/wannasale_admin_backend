<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:admins,email'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'     => 'Необходимо ввести имя партнера.',
            'name.max'          => 'Имя партнера должно содержать в себе не более 255 символов.',
            'email.required'    => 'Необходимо ввести E-mail партнера.',
            'email.email'       => 'Необходимо ввести валидный E-mail.',
            'email.unique'      => 'Партнер с таким E-mail уже зарегистрирован.'
        ];
    }
}