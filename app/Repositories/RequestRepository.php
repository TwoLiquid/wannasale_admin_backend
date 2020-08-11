<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\AdminVendor;
use App\Models\Client;
use App\Models\Item;
use App\Models\Request;
use App\Models\Site;
use App\Models\Vendor;
use App\Models\Widget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RequestRepository
{
    /**
     * @param Vendor $vendor
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getByVendorPaginated(
        Vendor $vendor,
        int $paginateBy = 30,
        int $page = null
    ) : LengthAwarePaginator
    {
        return $vendor->requests()
            ->with('site', 'item')
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param Vendor $vendor
     * @param string $id
     * @return Request|null
     */
    public function findByIdForVendor(string $id, Vendor $vendor) : ?Request
    {
        /** @var Request|null $request */
        $request = $vendor->requests()
            ->with('site', 'item', 'client')
            ->find($id);

        return $request;
    }

    public function getByPartner(
        Admin $admin,
        int $paginateBy = 30,
        int $page = null
    ) : ?Collection
    {
        $adminVendors = AdminVendor::query()
            ->where('admin_id', '=', $admin->id)
            ->get();

        $vendors = Vendor::query()
            ->whereIn('id', $adminVendors->pluck('vendor_id')->toArray())
            ->get();

        $requests = new Collection();
        foreach ($vendors as $vendor) {
            $requests = $requests->merge($vendor->requests);
        }

        return $requests;
    }

    /**
     * @param Site $site
     * @return Collection|null
     */
    public function getBySite(
        Site $site
    ) : ?Collection
    {
        /** @var Collection $requests */
        $requests = $site->requests()
            ->get();

        return $requests;
    }

    /**
     * @param Site $site
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getBySitePaginated(Site $site, int $paginateBy = 30, int $page = null) : LengthAwarePaginator
    {
        return $site->requests()
            ->with('site', 'item')
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @return Collection|null
     */
    public function getOpened() : ?Collection
    {
        $requests = Request::query()
            ->where('status', '<', 3)
            ->orderBy('created_at', 'asc')
            ->get();

        return $requests;
    }

    /**
     * @param $clientEmail
     * @return Request|null
     */
    public function getRequestByClientEmail($clientEmail) : ?Request
    {
        $request = Request::query()
            ->with('client')
            ->where('email', '=', $clientEmail)
            ->first();

        return $request;
    }

    /**
     * @param Item $item
     * @return Collection|null
     */
    public function getClientOffersInfo(
        Item $item
    ) : ?Collection
    {
        $requests = Request::query()
            ->orderBy('created_at', 'asc')
            ->where('item_id', '=', $item->id)
            ->get();

        return $requests;
    }

    /**
     * @param Request $request
     * @param int $status
     * @return Request
     */
    public function setStatus(Request $request, int $status) : Request
    {
        $request->update([
            'status' => $status
        ]);

        return $request;
    }

    /**
     * @param Request $request
     * @param int $status
     * @return Request
     */
    public function improveStatus(Request $request, int $status)
    {
        if ($request->status < $status) {
            $request->update([
                'status' => $status
            ]);
        }

        return $request;
    }

    /**
     * @param Request $request
     * @param int $totalPrice
     * @return Request
     */
    public function setTotalPrice(Request $request, ?int $totalPrice) : Request
    {
        $request->update([
            'total_price' => $totalPrice
        ]);

        return $request;
    }

    /**
     * @param Request $request
     */
    public function setProposalsHistory(Request $request) : void
    {
        $proposalsHistory = new Collection();
        $proposalsHistory->add([
            'offered_price' => $request->offered_price,
            'author'        => true,
            'date'          => $request->created_at->timestamp
        ]);

        $requestMessages = $request->messages()
                                ->orderBy('created_at', 'asc')
                                ->where('offered_price', '!=', null)
                                ->get(['offered_price', 'author', 'created_at']);

        foreach ($requestMessages as $requestMessage) {

            $proposalsHistory->add([
                'offered_price' => $requestMessage->offered_price,
                'author'        => $requestMessage->author,
                'date'          => $requestMessage->created_at->timestamp
            ]);
        }

        $proposalsHistory->add([
            'offered_price' => $request->total_price,
            'author'        => false,
            'date'          => $request->created_at->timestamp
        ]);

        $request->update([
            'proposals_history' => $proposalsHistory
        ]);
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return Request
     */
    public function setClient(Request $request, Client $client) : Request
    {
        $request->client_id = $client->id;
        $request->save();

        return $request;
    }

    /**
     * @param Client $newClient
     * @param Client $oldClient
     */
    public function replaceClient(
        Client $newClient,
        Client $oldClient
    ) : void
    {
        $requests = Request::query()->where('client_id', '=', $oldClient->id)
                                    ->update(['client_id' => $newClient->id]);
    }

    /**
     * @param Widget|null $widget
     * @param Item|null $item
     * @param Client|null $client
     * @param string $name
     * @param null|string $itemName
     * @param string $email
     * @param null|string $phone
     * @param null|string $url
     * @param null|string $ip
     * @param null|string $cookies
     * @param null|string $user_agent
     * @param string $offeredPrice
     * @param string $currency
     * @param null|string $country
     * @param null|string $city
     * @return Request
     */
    public function createForWidget(
        ?Widget $widget,
        ?Item $item,
        ?Client $client,
        string $name,
        ?string $itemName,
        string $email,
        ?string $phone,
        ?string $url,
        ?string $ip,
        ?string $cookies,
        ?string $user_agent,
        string $offeredPrice,
        string $currency,
        ?string $country,
        ?string $city
    ) : Request {
        /** @var Request $item */
        $item = Request::create([
            'vendor_id' => $widget->site->vendor_id,
            'widget_id' => $widget->id,
            'site_id' => $widget->site->id,
            'item_id' => isset($item->id) ? $item->id : null,
            'client_id' => isset($client->id) ? $client->id : null,
            'name' => $name,
            'item_name' => isset($item->name) ? $item->name : $itemName,
            'email' => $email,
            'phone' => $phone,
            'url' => $url,
            'ip' => $ip,
            'cookies' => $cookies,
            'user_agent' => $user_agent,
            'offered_price' => $offeredPrice,
            'currency' => $currency,
            'country' => $country,
            'city' => $city
        ]);

        return $item;
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public function delete(Request $request) : void
    {
        $request->delete();
    }
}
