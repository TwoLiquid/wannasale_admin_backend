<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Events\SiteCreated;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\Dashboard\Partner\Site\CreateRequest;
use App\Repositories\RequestRepository;
use App\Repositories\SiteRepository;
use App\Repositories\VendorRepository;
use App\Services\VendorPermissionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends BaseController
{
    public function create(
        string $id,
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

        return view('dashboard.admin.vendors.sites.create', [
            'item' => $vendor
        ]);
    }

    public function store(
        string $id,
        CreateRequest $request,
        SiteRepository $siteRepo,
        VendorRepository $vendorRepo,
        VendorPermissionService $permissionService
    )
    {
        $vendor = $vendorRepo->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        if ($permissionService->canAddSite($vendor) === false) {
            return $this->error('Вы уже добавили максимальное количество сайтов.');
        }

        $parsedDomain = parse_domain($request->input('url'));

        if ($parsedDomain === null) {
            return $this->error('Неверный формат домена.');
        }

        $site = $siteRepo->createForVendor(
            $vendor,
            $request->input('name'),
            $parsedDomain
        );

        if ($site === null) {
            return $this->error('Не удалось добавить сайт.');
        }

        event(new SiteCreated($site));

        return $this->success(
            'Сайт успешно добавлен.',
            route('dashboard.admin.vendors.edit', $id)
        );
    }

    public function requests(
        string $id,
        Request $request,
        VendorRepository $vendorRepo,
        SiteRepository $siteRepo,
        RequestRepository $requestRepo
    )
    {
        $vendor = $vendorRepo->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        $site = $siteRepo->findByIdForVendor(
            $request->input('siteId'),
            $vendor
        );

        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.admin.vendors.edit', $id)
            );
        }

        $requests = $requestRepo->getBySitePaginated(
            $site
        );

        return view('dashboard.admin.vendors.sites.requests.index', [
            'vendor'    => $vendor,
            'site'      => $site,
            'items'     => $requests
        ]);
    }

    public function delete(
        string $id,
        Request $request,
        VendorRepository $vendorRepo,
        SiteRepository $siteRepo
    )
    {
        $vendor = $vendorRepo->findById($id);
        if ($vendor === null) {
            return $this->error(
                'Компания не найдена.',
                route('dashboard.admin.vendors')
            );
        }

        $site = $siteRepo->findByIdForVendor(
            $request->input('siteId'),
            $vendor
        );

        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.admin.vendors.edit', $id)
            );
        }

        $siteRepo->delete($site);

        return $this->warning(
            'Сайт успешно удалён.',
            route('dashboard.admin.vendors.edit', $id)
        );
    }
}
