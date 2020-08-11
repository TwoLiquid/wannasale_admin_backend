<?php

namespace App\Repositories;

use App\Models\Card;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionRepository
{
    /**
     * @param Vendor $vendor
     * @return Collection
     */
    public function getAllByVendor(Vendor $vendor) : Collection
    {
        return $vendor->subscriptions()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param Vendor $vendor
     * @return Subscription|null
     */
    public function getActiveByVendor(
        Vendor $vendor
    ) : ?Subscription
    {
        return $vendor->subscriptions()
            ->where('active', '=', true)
            ->first();
    }

    /**
     * @param Vendor $vendor
     * @return Subscription|null
     */
    public function getFirstByVendor(
        Vendor $vendor
    ) : ?Subscription
    {
        return $vendor->subscriptions()
            ->orderBy('created_at', 'asc')
            ->where('active', '=', true)
            ->first();
    }

    /**
     * @return Collection|null
     */
    public function getOutOfPayment() : ?Collection
    {
        return Subscription::query()
            ->where('next_transaction_at', '<=', Carbon::now()->toDateString())
            ->get();
    }

    /**
     * @param Vendor $vendor
     * @param Card $card
     * @return Subscription
     */
    public function setCardForActive(
        Vendor $vendor,
        Card $card
    ) : Subscription
    {
        $subscription = $this->getActiveByVendor($vendor);

        $subscription->update([
            'card_id' => $card->id
        ]);

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @return bool
     */
    public function isOutOfPayment(
        Subscription $subscription
    ) : bool
    {
        if ($subscription->finish_at !== null &&
            $subscription->finish_at->lt(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Vendor $vendor
     * @return Collection|null
     */
    public function getAllForVendor(
        Vendor $vendor
    ) : ?Collection
    {
        return $vendor->subscriptions()
            ->get();
    }

    /**
     * @param Vendor $vendor
     * @param Rate $rate
     * @param Card|null $card
     * @param bool $active
     * @return Subscription
     */
    public function create(
        Vendor $vendor,
        Rate $rate,
        ?Card $card,
        bool $active
    ) : Subscription {

        return Subscription::create([
            'vendor_id'             => $vendor->id,
            'rate_id'               => $rate->id,
            'card_id'               => $card !== null ? $card->id : null,
            'price'                 => $rate->price,
            'currency'              => config('currency.default.code'),
            'active'                => $active,
            'started_at'            => Carbon::now()->toDateString(),
            'trial'                 => true,
            'next_transaction_at'   => Carbon::now()->addDay(config('subscription.trial.days'))->toDateString(),
            'finish_at'             => Carbon::now()->addDay(config('subscription.trial.days'))->toDateString()
        ]);
    }

    /**
     * @param Subscription $subscription
     * @return Subscription
     */
    public function updateDateOfPayment(
        Subscription $subscription
    ) : Subscription
    {
        $subscription->update([
            'finish_at'             => Carbon::now()->addMonth(1)->toDateString(),
            'next_transaction_at'   => Carbon::now()->addMonth(1)->toDateString()
        ]);

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @param Rate $rate
     * @param Card|null $card
     * @return Subscription
     */
    public function update(
        Subscription $subscription,
        Rate $rate,
        ?Card $card
    ) : Subscription {

        /** @var Subscription $subscription */
        $subscription->update([
            'rate_id'          => $rate->id,
            'card_id'          => isset($card) ? $card->id : null
        ]);

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @throws \Exception
     */
    public function delete(Subscription $subscription) : void
    {
        $subscription->delete();
    }
}
