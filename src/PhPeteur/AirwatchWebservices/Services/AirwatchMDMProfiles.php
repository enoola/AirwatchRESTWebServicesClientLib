<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/05/2019
 * Time: 15:52
 */


namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMProfiles extends Airwatch
{
    const URI_MDM_PROFILES = 'api/mdm/profiles';

    public function __construct($cfg)
    {
        parent::__construct($cfg);

    }
}