<?php

namespace Ups\Entity\Pickup;

class SearchCriteria
{
    /**
     * Search Request range. Valied values: 1 to 200 Default: 200
     * @var string
     */
    private $SearchRadius;

    /**
     * Unit of Measure
     * Required if ProximitySearchIndicator is present. Example: MI or KM
     * @var string
     */
    private $DistanceUnitOfMeasure;

    /**
     * Maximum Number of locations. Valied values: 1 to 100 Default: 100
     * @var string
     */
    private $MaximumLocation;

    /**
     * Set search Request range. Valied values: 1 to 200 Default: 200
     *
     * @param  string  $SearchRadius  Search Request range. Valied values: 1 to 200 Default: 200
     *
     * @return  self
     */ 
    public function setSearchRadius(string $SearchRadius)
    {
        $this->SearchRadius = $SearchRadius;

        return $this;
    }

    /**
     * Set required if ProximitySearchIndicator is present. Example: MI or KM
     *
     * @param  string  $DistanceUnitOfMeasure  Required if ProximitySearchIndicator is present. Example: MI or KM
     *
     * @return  self
     */ 
    public function setDistanceUnitOfMeasure(string $DistanceUnitOfMeasure)
    {
        $this->DistanceUnitOfMeasure = $DistanceUnitOfMeasure;

        return $this;
    }

    /**
     * Set maximum Number of locations. Valied values: 1 to 100 Default: 100
     *
     * @param  string  $MaximumLocation  Maximum Number of locations. Valied values: 1 to 100 Default: 100
     *
     * @return  self
     */ 
    public function setMaximumLocation(string $MaximumLocation)
    {
        $this->MaximumLocation = $MaximumLocation;

        return $this;
    }
}
