<?php

namespace App\Traits;

use App\Services\LocationService;

trait UpdateCoordinates
{
    public function save(array $options = [])
    {
        $changed = false;
        $locationService = new LocationService();
        $updatedAttributes = $this->getDirty();

        foreach ($updatedAttributes as $attribute) {
            if (in_array($attribute, $this->updateCoordinates)) {
                $changed = true;
            }
        }

        if ($changed) {
            $coordinates = $locationService->getCoordinates($updatedAttributes['zip_code'], $updatedAttributes['house_number']);
            $this->latitude = optional($coordinates)->getLatitude();
            $this->longitude = optional($coordinates)->getLongitude();
            $this->zip_code = str_replace(' ', '', $this->zip_code);
        }

        return parent::save($options);
    }
}
