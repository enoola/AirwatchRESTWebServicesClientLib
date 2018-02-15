<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/02/2018
 * Time: 08:46
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Device Extensive Search (Lite)
 * Functionality – Search results containing the devices and their product assignment information (Lite Version).
 */
class AirwatchMDMDevicesLiteSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICESLITE_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/litesearch';
    const CLASS_SENTENCE_AIM = 'Search results containing the devices and their product assignment information (Lite Version).';
    
    public function __construct( $cfg )
    {
        $arPossibleParams = [
            'organizationgroupid'   => 'Organization group to be searched, user\'s OG is considered if not sent',
            'customattributeslist'  => 'Custom attribute names',
            'platform'              => 'Device platform',
            'startdatetime'         => 'Filters devices such that devices with last seen after this date will be
returned',
            'enddatetime'           => 'Filters devices such that devices with last seen till this date will be
returned',
            'deviceid'              => 'device identifier',
            'page'                  => 'Page number',
            'pagesize'              => 'Records per page'
        ];

        parent::__construct( $cfg,'default_devicelite_fields_to_show','possible_devicelite_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_DEVICESLITE_SEARCH;
    }

}