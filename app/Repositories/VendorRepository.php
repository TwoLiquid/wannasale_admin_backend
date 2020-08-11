<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\AdminVendor;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VendorRepository
{
    protected $partner;

    /**
     * @param Admin $partner
     * @return Admin
     */
    public function setPartner(
        Admin $partner
    ) : Admin
    {
        $this->partner = $partner;

        return $this->partner;
    }

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
        return Vendor::query()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param Admin $admin
     * @return array
     */
    public function getConnectedVendorsIds(
        Admin $admin
    ) : array
    {
        return $admin->vendors()
            ->pluck('vendor_id')
            ->toArray();
    }

    /**
     * @param Admin $admin
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator|null
     */
    public function getByPartnerPaginated(
        Admin $admin,
        int $paginateBy = 30,
        int $page = null
    ) : ?LengthAwarePaginator
    {
        $partnerVendorsIds = $this->getConnectedVendorsIds($admin);

        return Vendor::query()
            ->whereIn('id', [$partnerVendorsIds])
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param string $id
     * @return Vendor|null
     */
    public function findById(string $id) : ?Vendor
    {
        /** @var Vendor|null $vendor */
        $vendor = Vendor::query()
            ->with('users')
            ->find($id);

        return $vendor;
    }

    /**
     * @param Vendor $vendor
     * @param Admin $admin
     */
    public function attachToAdmin(
        Vendor $vendor,
        Admin $admin
    ) : void
    {
        if (AdminVendor::query()
                ->where('admin_id', '=', $admin->id)
                ->where('vendor_id', '=', $vendor->id)
                ->exists() === false) {

            AdminVendor::query()->create([
                'admin_id' => $admin->id,
                'vendor_id' => $vendor->id
            ]);
        }
    }

    /**
     * @param Vendor $vendor
     * @param Admin $admin
     */
    public function detachFromAdmin(
        Vendor $vendor,
        Admin $admin
    ) : void
    {
        DB::table('admins_vendors')
            ->where('admin_id', '=', $admin->id)
            ->where('vendor_id', '=', $vendor->id)
            ->delete();
    }

    /**
     * @param string $name
     * @param string $slug
     * @param bool $active
     * @param int $site_max
     * @return Vendor
     */
    public function create(
        string $name,
        string $slug,
        bool $active = true,
        int $site_max
    ) : Vendor
    {
        return Vendor::create([
            'name'   => $name,
            'slug'   => $slug,
            'active' => $active,
            'site_max' => $site_max
        ]);
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @param string $slug
     * @param bool $active
     * @param int $site_max
     * @return Vendor
     */
    public function update(
        Vendor $vendor,
        string $name,
        string $slug,
        bool $active = true,
        int $site_max
    ) : Vendor
    {
        $vendor->update([
            'name'   => $name,
            'slug'   => $slug,
            'active' => $active,
            'site_max' => $site_max
        ]);

        return $vendor;
    }

    /**
     * @param Vendor $vendor
     * @throws \Exception
     */
    public function delete(Vendor $vendor) : void
    {
        $vendor->delete();
    }
}
