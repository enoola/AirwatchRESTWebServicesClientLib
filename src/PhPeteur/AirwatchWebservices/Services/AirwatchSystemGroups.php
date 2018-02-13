<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 23/01/2018
 * Time: 17:46
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchSystemGroups extends Airwatch
{
    const URI_SYSTEM_GROUPS = '/api/system/groups';

    //possibleQueryParams

    public function __construct($cfg)
    {
        parent::__construct($cfg);
    }
}