<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\Dashboard\Rate\CreateRequest;
use App\Http\Requests\Dashboard\Rate\UpdateRequest;
use App\Repositories\RateRepository;

class RateController extends BaseController
{
    public function index(
        RateRepository $rateRepo
    )
    {
        $rates = $rateRepo->getAllPaginated();

        return view('dashboard.admin.rates.index', [
            'rates' => $rates
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.rates.create');
    }

    public function store(
        CreateRequest $request,
        RateRepository $rateRepo
    )
    {
        $rate = $rateRepo->create(
            $request->input('name'),
            $request->input('price'),
            $request->input('default') !== null
        );

        if ($rate === null) {
            return $this->error(
                'Не удалось добавить новый тариф.',
                route('dashboard.admin.rates')
            );
        }

        return $this->success(
            'Новый тариф успешно добавлен.',
            route('dashboard.admin.rates.edit', $rate->id)
        );
    }
    public function edit(
        string $id,
        RateRepository $rateRepo
    )
    {
        $rate = $rateRepo->findById($id);
        if ($rate === null) {
            return $this->error(
                'Тариф не найден.',
                route('dashboard.admin.rates')
            );
        }

        return view('dashboard.admin.rates.edit', [
            'item'  => $rate
        ]);
    }

    public function update(
        string $id,
        UpdateRequest $request,
        RateRepository $rateRepo
    )
    {
        $rate = $rateRepo->findById($id);
        if ($rate === null) {
            return $this->error(
                'Тариф не найден.',
                route('dashboard.admin.rates')
            );
        }

        $rateRepo->update(
            $rate,
            $request->input('name'),
            $request->input('price'),
            $request->input('default') !== null
        );

        return $this->success(
            'Тариф успешно обновлен.',
            route('dashboard.admin.rates.edit', $rate->id)
        );
    }

    public function delete(
        string $id,
        RateRepository $rateRepo
    )
    {
        $rate = $rateRepo->findById($id);
        if ($rate === null) {
            return $this->error(
                'Тариф не найден.',
                route('dashboard.admin.rates')
            );
        }

        if ($rateRepo->hasSubscriptions(
            $rate
        ) === true ) {
            return $this->error(
                'Нельзя удалить тариф на который есть активные подписки.',
                route('dashboard.admin.rates')
            );
        }

        $rateRepo->delete(
            $rate
        );

        return $this->success('Тариф успешно удален.', route('dashboard.admin.rates'));
    }
}
