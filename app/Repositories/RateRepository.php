<?php

namespace App\Repositories;

use App\Models\Rate;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RateRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Rate::query()
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
        return Rate::query()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param string $id
     * @return Rate|null
     */
    public function findById(string $id) : ?Rate
    {
        /** @var Rate|null $item */
        $item = Rate::query()
            ->find($id);

        return $item;
    }

    /**
     * @return Rate|null
     */
    public function getDefault() : ?Rate
    {
        /** @var Rate|null $item */
        $item = Rate::query()->where('default', '=', 1)
            ->first();

        return $item;
    }

    /**
     * @param Rate $rate
     * @return bool
     */
    public function hasSubscriptions(
        Rate $rate
    ) : bool
    {
        return $rate->subscriptions()
            ->where('active', '=', 1)
            ->exists();
    }

    /**
     * @param string $name
     * @param int $price
     * @param bool $default
     * @return Rate
     */
    public function create(
        string $name,
        int $price,
        bool $default
    ) : Rate {

        return Rate::create([
            'name'      => $name,
            'price'     => $price,
            'default'   => $default
        ]);
    }

    /**
     * @param Rate $rate
     * @param string $name
     * @param int $price
     * @param bool $default
     * @return Rate
     */
    public function update(
        Rate $rate,
        string $name,
        int $price,
        bool $default
    ) : Rate {

        /** @var Rate $rate */
        $rate->update([
            'name'      => $name,
            'price'     => $price,
            'default'   => $default
        ]);

        return $rate;
    }

    /**
     * @param Rate $rate
     * @throws \Exception
     */
    public function delete(Rate $rate) : void
    {
        $rate->delete();
    }
}
