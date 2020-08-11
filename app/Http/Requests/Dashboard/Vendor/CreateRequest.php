<?php

namespace App\Http\Requests\Dashboard\Vendor;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'      => 'required|max:255',
            'slug'      => 'required|max:255|unique:main.vendors,slug|regex:/^[a-zA-Z0-9\-]*$/',
            'users'     => 'nullable|array|exists:main.users,id',
            'site_max'  => 'required|integer',
            'rate_id'   => 'required|string|exists:main.rates,id',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'         => 'Необходимо ввести название компании.',
            'name.max'              => 'Название должно содержать в себе не более 255 символов.',
            'slug.required'         => 'Необходимо ввести идентификатор компании.',
            'slug.max'              => 'Идентификатор компании должен содержать в себе не более 255 символов.',
            'slug.unique'           => 'Компания с таким идентификатором уже зарегистрирована.',
            'slug.regex'            => 'Идентификатор должен содержать только латинские буквы, цифры или дефис.',
            'users.array'           => 'Данные о пользователях должны быть массивом.',
            'users.exists'          => 'Один из выбранных пользователей не найден.',
            'site_max.required'     => 'Необходимо ввести максимальное количество сайтов.',
            'site_max.integer'      => 'Количество сайтов должно быть числом.',
            'rate_id.required'      => 'Необходимо выбрать тариф.',
            'rate_id.string'        => 'ID тарифа должен быть строкой.',
            'rate_id.exists'        => 'Выбранный тариф не найден.'
        ];
    }
}