<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/02/2018
 * Time: 09:28
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Security Information
 * Functionality – Searches for device security information.
 */
class AirwatchMDMDevicesSecurityInformationsSearch extends AirwatchServicesSearch
{

    const URI_MDM_DEVICES_SECURITYINFOS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/securityinfosearch';

    public function __construct( $cfg )
    {
        $arPossibleParams = [
            'organizationgroupid'   => 'Organization group to be searched, user\'s OG is considered if not sent',
            'user'                  => 'Enrolled username',
            'platform'              => 'Device platform',
            'model'                 => 'Device model',
            'lastseen'              => 'Last seen date string',
            'ownership'             => 'Ownership type of the device',
            'compliantstatus'       => 'Compliance status (true | false)',
            'seensince'             =>  'Specifies the date filter for device search, which retrieves the devices that are seen after this date',
            'page'                  => 'Page number',
            'pagesize'              => 'Records per page'
        ];

        parent::__construct( $cfg,'default_devicesecurityinfos_fields_to_show','possible_devicesecurityinfos_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('SecurityInfo');

        $this->_uri = self::URI_MDM_DEVICES_SECURITYINFOS_SEARCH;
    }


}