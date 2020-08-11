<?php

namespace App\Repositories;

use App\Models\Site;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

class SiteRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Site::query()
            ->orderBy('created_at', 'desc')
            ->with('widget')
            ->get();
    }

    /**
     * @param Vendor $vendor
     * @return Collection|null
     */
    public function getForVendor(Vendor $vendor) : ?Collection
    {
        /** @var Collection $sites */
        $sites = $vendor->sites()
            ->orderBy('created_at', 'asc')
            ->get();

        return $sites;
    }

    /**
     * @param string $id
     * @param Vendor $vendor
     * @return Site|null
     */
    public function findByIdForVendor(string $id, Vendor $vendor) : ?Site
    {
        /** @var Site|null $site */
        $site = $vendor->sites()
            ->with('widget')
            ->find($id);
        return $site;
    }

    /**
     * @param string $id
     * @param Vendor $vendor
     * @return bool
     */
    public function existsByIdForVendor(string $id, Vendor $vendor) : bool
    {
        return $vendor->sites()
            ->where('id', $id)
            ->exists();
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @param string $url
     * @return Site
     */
    public function createForVendor(
        Vendor $vendor,
        string $name,
        string $url
    ) : Site {

        /** @var Site $site */
        $site = $vendor->sites()
            ->create([
                'name' => $name,
                'urls' => [$url]
            ]);

        return $site;
    }

    /**
     * @param Site $site
     * @param string $name
     * @param string $url
     * @return Site
     */
    public function update(
        Site $site,
        string $name,
        string $url
    ) : Site {

        /** @var Site $site */
        $site->update([
            'name' => $name,
            'urls' => [$url]
        ]);

        return $site;
    }

    /**
     * @param Site $site
     * @throws \Exception
     */
    public function delete(Site $site) : void
    {
        $site->delete();
    }

    /**
     * @param Vendor $vendor
     * @return int
     */
    public function getCountForVendor(Vendor $vendor) : int
    {
        return $vendor->sites()->count();
    }

    /**
     * @param Vendor $vendor
     * @return Site|null
     */
    public function findLatestForVendor(Vendor $vendor) : ?Site
    {
        return $vendor->sites()
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
