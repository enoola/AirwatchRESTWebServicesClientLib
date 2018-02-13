<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2018
 * Time: 10:23
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMDeviceProfilesSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_PROFILES_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/profiles';

    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)'
        ];

        parent::__construct($cfg, 'default_deviceprofiles_fields_to_show', 'possible_deviceprofiles_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceProfiles');

        $this->_uri = self::URI_MDM_DEVICE_PROFILES_SEARCH;
    }


    public function Search($arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id', $arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
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
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES . '/' . $id . '/profiles';
        }

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}