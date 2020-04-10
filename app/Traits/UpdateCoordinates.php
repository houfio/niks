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
            $coordinates = $locationService->getCoordinates($this->updateCoordinates['zipCode'], $this->updateCoordinates['houseNumber']);
            $this->latitude = optional($coordinates)->getLatitude();
            $this->longitude = optional($coordinates)->getLongitude();
        }

        return parent::save($options);
    }
}
