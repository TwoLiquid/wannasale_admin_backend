<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\Dashboard\Vendor\CreateRequest;
use App\Http\Requests\Dashboard\Vendor\InviteUserRequest;
use App\Http\Requests\Dashboard\Vendor\UpdateRequest;
use App\Repositories\RateRepository;
use App\Repositories\SiteRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use App\Services\UserService;

class VendorController extends BaseController
{
    public function index(
        VendorRepository $vendorRepo
    )
    {
        $vendors = $vendorRepo->getAllPaginated();

        return view('dashboard.admin.vendors.index', [
            'items' => $vendors
        ]);
    }

    public function create(
        RateRepository $rateRepo
    )
    {
        $rates = $rateRepo->getAll();

        return view('dashboard.admin.vendors.create', [
            'rates' => $rates
        ]);
    }

    public function store(
        CreateRequest $request,
        VendorRepository $vendorRepo,
        RateRepository $rateRepo,
        SubscriptionRepository $subscriptionRepo
    )
    {
        $vendor = $vendorRepo->create(
            $request->input('name'),
            $request->input('slug'),
            $request->input('active') !== null,
            $request->input('site_max')
        );

        $rate = $rateRepo->findById(
            $request->input('rate_id')
        );

        $vendorSubscription = $subscriptionRepo->create(
            $vendor,
            $rate,
            null,
            true
        );

        return $this->success(
            'Компания успешно добавлена.',
            route('dashboard.admin.vendors.edit', $vendor->id)
        );
    }

    public function edit(
        string $id,
        VendorRepository $vendorRepo,
        UserRepository $userRepo,
        SubscriptionRepository $subscriptionRepo,
        RateRepository $rateRepo,
        SiteRepository $siteRepo,
        TransactionRepository $transactionRepo
    )
    {
        $vendor = $vendorRepo->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        $vendorUsers = $userRepo->getAllForVendor(
            $vendor
        );

        $vendorSubscription = $subscriptionRepo->getFirstByVendor(
            $vendor
        );

        $vendorTransactions = $transactionRepo->getBySubscription(
            $vendorSubscription
        );

        $vendorSites = $siteRepo->getForVendor(
            $vendor
        );

        return view('dashboard.admin.vendors.edit', [
            'item'          => $vendor,
            'users'         => $vendorUsers,
            'sites'         => $vendorSites,
            'subscription'  => $vendorSubscription,
            'transactions'  => $vendorTransactions
        ]);
    }

    public function update(
        string $id,
        UpdateRequest $request,
        VendorRepository $vendorRepo
    )
    {
        $vendor = $vendorRepo->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        $vendorRepo->update(
            $vendor,
            $request->input('name'),
            $request->input('slug'),
            $request->input('active') !== null,
            $request->input('site_max')
        );

        /* $vendorRepository->syncUsers(
            $vendor,
            $request->input('users', [])
        ); */

        return $this->success(
            'Компания успешно обновлена.',
            route('dashboard.admin.vendors.edit', $vendor->id)
        );
    }

    /**
     * @param string $id
     * @param VendorRepository $vendorRepository
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function delete(string $id, VendorRepository $vendorRepository)
    {
        $vendor = $vendorRepository->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        $vendorRepository->delete($vendor);

        return $this->success('Компания успешно удалена.', route('dashboard.admin.vendors'));
    }
}
