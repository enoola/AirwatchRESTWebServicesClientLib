<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 01/02/2020
 * Time: 17:13
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * MAM apps is so huge we will split it so here is the main entry point
 */
class AirwatchMAMApps extends Airwatch
{
    const URI_MAM_APPS = 'api/mam/apps';
    const CLASS_SENTENCE_AIM = 'search in stores.';
    //possibleQueryParams

    public function __construct($cfg)
    {
        parent::__construct($cfg);
    }

}