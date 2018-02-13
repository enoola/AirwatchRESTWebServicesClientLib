<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 30/01/2018
 * Time: 07:40
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * In documentation : Retrieve Application Details From the Device
 * Fonctionnality: Retrieves the details of the applications that are present on the device.
 */

class AirwatchMDMDeviceAppsSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_APP_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/apps';


    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
         'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)',
         'page' => 'Page number',
         'pagesize' => 'Maximum Records per page'
        ];

        parent::__construct($cfg, 'default_deviceapps_fields_to_show', 'possible_deviceapps_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceApps');

        $this->_uri = self::URI_MDM_DEVICES_APP_SEARCH;
    }


    public function Search( $arParams = null): array
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
                case "ImeiNumber" :
                    break;
                default :
                    die ("searchby should be 'Macaddress', 'Udid','Serialnumber', or 'ImeiNumber' .");

            }

        } else {         //if searchby isn't set it's an search by id : uri : https://host/api/mdm/devices/{id}/apps?searchb....
            $id = $arParams['id'];
            unset($arParams['id']);
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES .'/'.$id . '/apps';
        }

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
    //RetrieveAppsDetailsFromDevice
}