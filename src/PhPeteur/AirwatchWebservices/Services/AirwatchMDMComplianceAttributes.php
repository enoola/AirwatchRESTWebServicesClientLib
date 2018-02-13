<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 31/01/2018
 * Time: 10:15
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMComplianceAttributes extends Airwatch
{
    const URI_MDM_COMPLIANCEATTRIBUTES = '/api/mdm/complianceattributes';

    public function __construct( $cfg )
    {
        parent::__construct( $cfg );
    }
}