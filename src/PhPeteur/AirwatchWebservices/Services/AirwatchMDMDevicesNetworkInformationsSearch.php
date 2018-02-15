<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/02/2018
 * Time: 09:50
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Network Information
 * Functionality – Returns device network information along with corresponding device ID.
*/
class AirwatchMDMDevicesNetworkInformationsSearch extends AirwatchServicesSearch
{

    const URI_MDM_DEVICES_NETWORKINFOS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/networkinfosearch';
    const CLASS_SENTENCE_AIM = 'Returns device network information along with corresponding device ID.';

    public function __construct( $cfg )
    {
        $arPossibleParams = [
            'lgid'                  => 'Unique numeric Identifier of the Organization Group',
            'user'                  => 'Enrolled username',
            'platform'              => 'Device platform',
            'model'                 => 'Device model',
            'lastseen'              => 'Last seen date string',
            'ownership'             => 'Ownership type of the device',
            'compliantstatus'       => 'Compliance status (true | false)',
            'seensince'             =>  'Specifies the date filter for device search, which retrieves the devices that are seen after this date',
            'page'                  => 'Page number',
            'pagesize'              => 'Records per page',
            'sortorder'              => 'Soring order. Value (ASC | DESC) default ASC.'
        ];

        parent::__construct( $cfg,'default_devicenetworkinfos_fields_to_show','possible_devicenetworkinfos_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceNetworkDetails');

        $this->_uri = self::URI_MDM_DEVICES_NETWORKINFOS_SEARCH;
    }
}