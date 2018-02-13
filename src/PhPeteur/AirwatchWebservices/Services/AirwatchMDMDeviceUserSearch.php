<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2018
 * Time: 09:50
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Retrieve Enrollment User Details of the Device
 * Functionality – Retrieves the details of the enrollment user associated to the device.
 */
class AirwatchMDMDeviceUserSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_USER_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/user';

    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)'
        ];


        parent::__construct($cfg, 'default_deviceuser_fields_to_show', 'possible_deviceuser_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceUser');

        $this->_uri = self::URI_MDM_DEVICES_USER_SEARCH;
    }


    public function Search($arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id', $arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }
        //if we have a search by it's an alternate id search
        if (array_key_exists('searchby', $arParams)) {
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
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES . '/' . $id . '/user';
        }

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}