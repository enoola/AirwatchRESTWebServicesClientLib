<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 31/01/2018
 * Time: 13:11
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Event Logs From the Device
 * Functionality – Retrieves the event log details of the device.
 */

class AirwatchMDMDeviceEventLogSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_EVENTLOG_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/eventlog';
    const CLASS_SENTENCE_AIM = 'Retrieves the event log details of the device.';
    
    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)',
            'severity' => 'Log severity to gather',
            'dayrange' => 'day range to gather logs from',
            'pagesize' => 'Entries per page',
            'page' => 'Page number'
        ];


        parent::__construct($cfg, 'default_deviceeventlog_fields_to_show', 'possible_deviceeventlog_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceEventLogEntries');

        $this->_uri = self::URI_MDM_DEVICES_EVENTLOG_SEARCH;
    }

    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        //if we have a search by it's an alternate id search
        if (array_key_exists('searchby',$arParams)) {
            switch ($arParams['searchby']) {
                case "Macaddress" :
                    break;
                case "Udid" :
                    break;
                case "Serialnumber" :
                    break;
                case "EasId" :
                    break;
                default :
                    die ("searchby should be 'Macaddress', 'Udid','Serialnumber', or 'ImeiNumber' .");

            }

        } else {        //if searchby isn't set it's an search by id : uri : https://host/api/mdm/devices/{id}/apps?searchb....
            $id = $arParams['id'];
            unset($arParams['id']);
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES . '/' . $id . '/eventlog';
        }


        $resquery = parent::Search($arParams, $szContentType);

        return ($resquery);
    }
}