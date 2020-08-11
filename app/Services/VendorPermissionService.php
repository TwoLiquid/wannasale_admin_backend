<?php

namespace App\Services;

use App\Models\Vendor;
use App\Repositories\SiteRepository;

class VendorPermissionService
{
    /**
     * @param Vendor $vendor
     * @return bool
     */
    public function canAddSite(Vendor $vendor) : bool
    {
        /** @var SiteRepository $siteRepo */
        $siteRepo = app(SiteRepository::class);

        return $siteRepo->getCountForVendor($vendor) < $vendor->site_max;
    }
}
