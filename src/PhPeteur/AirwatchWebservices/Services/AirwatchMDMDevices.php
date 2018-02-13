<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 21:36
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMDevices extends Airwatch
{
    const URI_MDM_DEVICES = '/api/mdm/devices';

    public function __construct( $cfg )
    {
        parent::__construct( $cfg );
    }

}