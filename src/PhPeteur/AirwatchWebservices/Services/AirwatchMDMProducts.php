<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 18/01/2018
 * Time: 20:45
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMProducts extends Airwatch
{
    const URI_MDM_PRODUCTS = 'api/mdm/products';

    public function __construct($cfg)
    {
        parent::__construct($cfg);

    }
}