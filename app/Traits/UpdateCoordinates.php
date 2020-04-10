<?php

namespace App\Traits;

use App\Services\LocationService;

trait UpdateCoordinates
{
    private LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function save(array $options = [])
    {
        $changed = false;
        $updatedAttributes = $this->isDirty();

        foreach ($updatedAttributes as $attribute) {
            if (in_array($attribute, $this->updateCoordinates)) {
                $changed = true;
            }
        }

        if ($changed) {
            $coordinates = $this->locationService->getCoordinates($updatedAttributes['zipCode'], $updatedAttributes['houseNumber']);
            $this->latitude = optional($coordinates)->getLatitude();
            $this->longitude = optional($coordinates)->getLongitude();
        }

        return parent::save($options);
    }
}
