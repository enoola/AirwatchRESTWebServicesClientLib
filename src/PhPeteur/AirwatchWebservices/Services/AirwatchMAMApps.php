<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 14/01/2018
 * Time: 17:13
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * MAM apps is so huge we will split it so here is the main entry point, and it will have a lot of children
 */
class AirwatchMAMApps extends Airwatch
{
    const URI_MAM_APPS = 'api/mam/apps';
    //possibleQueryParams

    public function __construct($cfg)
    {
        parent::__construct($cfg);
    }

}