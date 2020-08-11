<?php

namespace App\Repositories;

use App\Models\Card;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

class CardRepository
{
    /**
     * @param Vendor $vendor
     * @return Collection
     */
    public function getAllByVendor(Vendor $vendor) : Collection
    {
        return $vendor->cards()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param string $id
     * @return Card|null
     */
    public function findById(string $id) : ?Card
    {
        /** @var Card|null $card */
        $card = Card::query()
            ->find($id);

        return $card;
    }

    /**
     * @param string $id
     * @param Vendor $vendor
     * @return Card|null
     */
    public function findByIdForVendor(string $id, Vendor $vendor) : ?Card
    {
        /** @var Card|null $card */
        $card = $vendor->cards()
            ->with('card')
            ->find($id);

        return $card;
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @param string $number
     * @param string $month
     * @param string $year
     * @param string $token
     * @return Card
     */
    public function create(
        Vendor $vendor,
        string $name,
        string $number,
        string $month,
        string $year,
        string $token
    ) : Card {

        return Card::create([
            'vendor_id'     => $vendor->id,
            'name'          => $name,
            'number'        => $number,
            'month'         => $month,
            'year'          => $year,
            'token'         => $token
        ]);
    }

    /**
     * @param Vendor $vendor
     * @param Card $card
     * @return Card
     */
    public function activateCard(
        Vendor $vendor,
        Card $card
    ) : Card
    {
        $result = $vendor->cards()
            ->update(['default' => false]);

        /** @var Card $card */
        $card->update([
            'default' => true
        ]);

        return $card;
    }

    /**
     * @param Card $card
     * @throws \Exception
     */
    public function delete(Card $card) : void
    {
        $card->delete();
    }
}
