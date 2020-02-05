<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 31/01/2018
 * Time: 11:14
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Device Application Status
 * Functionality – Retrieves the application status for a combination of input elements.
 */
class AirwatchMDMDevicesAppStatusSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_APPSTATUS = AirwatchMDMDevices::URI_MDM_DEVICES . '/appstatus';
    const CLASS_SENTENCE_AIM = 'Retrieves the application status for a combination of input elements.';
    
    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)',
            'page' => 'Page number',
            'groupid' => "GroupId is location group's customer code",
            'bundleid' =>'Bundle id of the application',
            'version' => 'version of the application',
            'deviceType' => 'Type of the device'
        ];


        parent::__construct($cfg, 'default_deviceapps_fields_to_show', 'possible_deviceapps_fields_to_show', $arPossibleParams);

        //parent::setFieldnameToPickInDataResultResponse('DeviceApps');
        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICES_APPSTATUS;
    }

    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id', $arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }
        if (is_null($arParams) || !array_key_exists('groupid', $arParams)) {
            die ("wrong Parameters provided 'groupid' is mandatory" . PHP_EOL);
            return (null);
        }
        if (is_null($arParams) || !array_key_exists('version', $arParams)) {
            die ("wrong Parameters provided 'version' is mandatory" . PHP_EOL);
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
//            $id = $arParams['id'];
//            unset($arParams['id']);
//            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES . '/' . $id . '/appstatus';
        }
        $resquery = parent::Search($arParams, $szContentType);

        return ( $resquery );
    }
}