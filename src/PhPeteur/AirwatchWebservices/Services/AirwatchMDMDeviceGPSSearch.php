<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 31/01/2018
 * Time: 13:34
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve GPS Co-ordinates of the Device
 * Functionality – Retrieves the GPS co-ordinates of the device.
 */
class AirwatchMDMDeviceGPSSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_GPS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/gps' ;
    const CLASS_SENTENCE_AIM = 'Retrieves the GPS co-ordinates of the device.';

    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)',
            'dayrange' => 'Day range to look in'
            //'page' => 'Page number',
            //'pagesize' => 'Maximum Records per page'
        ];


        parent::__construct($cfg, 'default_devicegps_fields_to_show', 'possible_devicegps_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_GPS_SEARCH;
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

        } else {         //if searchby isn't set it's an search by id : uri : https://host/api/mdm/devices/{id}/apps?searchb....
            $id = $arParams['id'];
            unset($arParams['id']);
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES .'/'.$id . '/gps';
        }

        $resquery = parent::Search($arParams, $szContentType);

        return ($resquery);
    }
}