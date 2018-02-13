<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 19/01/2018
 * Time: 08:01
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchSystemAdmins extends Airwatch
{
    const URI_SYSTEM_ADMIN = 'api/system/admins';

    public function __construct($cfg)
    {
        parent::__construct($cfg);

    }

}