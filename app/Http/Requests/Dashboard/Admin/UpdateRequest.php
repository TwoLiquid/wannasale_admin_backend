<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:admins,email,' . $this->route('id')
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'     => 'Необходимо ввести имя партнера.',
            'name.max'          => 'Имя партнера должно содержать в себе не более 255 символов.',
            'email.required'    => 'Необходимо ввести E-mail партнера.',
            'email.email'       => 'Необходимо ввести валидный E-mail.',
            'email.unique'      => 'Данный партнер уже зарегистрирован с таким E-mail.'
        ];
    }
}