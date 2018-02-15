<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 09/01/2018
 * Time: 11:27
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve AirWatch Version and API URLs
 * Retrieves information about AirWatch version and API URLs.
 */
class AirwatchSystemInfo extends Airwatch
{
    const URI_SYSTEMINFO = '/api/system/info';
    const CLASS_SENTENCE_AIM = 'Retrieves information about AirWatch version and API URLs.';

    function getInfos(){
        $response = $this->query(self::URI_SYSTEMINFO);
        return ( $response );
    }

}