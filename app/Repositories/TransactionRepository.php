<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionRepository
{
    /**
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(
        int $paginateBy = 30,
        int $page = null
    ) : LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $transactions */
        $transactions = Transaction::query()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);

        return $transactions;
    }

    /**
     * @param Subscription $subscription
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getBySubscriptionPaginated(
        Subscription $subscription,
        int $paginateBy = 30,
        int $page = null
    ) : LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $transactions */
        $transactions = $subscription->transactions()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);

        return $transactions;
    }

    /**
     * @param Subscription $subscription
     * @param int $paginateBy
     * @param int|null $page
     * @return Collection|null
     */
    public function getBySubscription(
        Subscription $subscription,
        int $paginateBy = 30,
        int $page = null
    ) : ?Collection
    {
        /** @var Transaction $transactions */
        $transactions = $subscription->transactions()
            ->orderBy('created_at', 'desc')
            ->get();

        return $transactions;
    }

    /**
     * @param string $id
     * @return Transaction|null
     */
    public function findById(string $id) : ?Transaction
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::query()
            ->find($id);

        return $transaction;
    }

    /**
     * @param Subscription $subscription
     * @param bool $isSuccessful
     * @param string $externalId
     * @param int $amount
     * @param string $currency
     * @param string $cardType
     * @param string $cardLastDigits
     * @param int $cardExpMonth
     * @param int $cardExpYear
     * @param string $cardToken
     * @param int $statusCode
     * @param string $status
     * @param string $reason
     * @param string $message
     * @return Transaction
     */
    public function create(
        Subscription $subscription,
        bool $isSuccessful,
        string $externalId,
        int $amount,
        string $currency,
        string $cardType,
        string $cardLastDigits,
        int $cardExpMonth,
        int $cardExpYear,
        string $cardToken,
        int $statusCode,
        string $status,
        string $reason,
        string $message
    ) : Transaction
    {
        return Transaction::create([
            'subscription_id'   => $subscription->id,
            'is_successful'     => $isSuccessful,
            'ext_id'            => $externalId,
            'amount'            => $amount,
            'currency'          => $currency,
            'card_type'         => $cardType,
            'card_last_digits'  => $cardLastDigits,
            'card_exp_month'    => $cardExpMonth,
            'card_exp_year'     => $cardExpYear,
            'card_token'        => $cardToken,
            'status_code'       => $statusCode,
            'status'            => $status,
            'reason'            => $reason,
            'message'           => $message
        ]);
    }
}