<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 18/01/2018
 * Time: 08:09
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Called Assignment groups in the console
 */

class AirwatchMDMSmartGroups extends Airwatch
{
    const URI_MDM_SMARTGROUPS = '/api/mdm/smartgroups';

    public function __construct($cfg)
    {
        parent::__construct($cfg);

    }

}