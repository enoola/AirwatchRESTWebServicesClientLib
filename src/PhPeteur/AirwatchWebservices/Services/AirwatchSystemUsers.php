<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 10/01/2018
 * Time: 09:14
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchSystemUsers extends Airwatch
{
    const URI_SYSTEM_USERS = '/api/system/users';

    public function __construct( $cfg )
    {
        parent::__construct($cfg);


    }

}