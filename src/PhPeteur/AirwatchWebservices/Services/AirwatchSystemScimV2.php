<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 19/01/2018
 * Time: 08:01
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchSystemScimV2 extends Airwatch
{
    const URI_SYSTEM_SCIMV2 = 'api/system/scim/v2';

    public function __construct($cfg)
    {
        parent::__construct($cfg);

    }

}