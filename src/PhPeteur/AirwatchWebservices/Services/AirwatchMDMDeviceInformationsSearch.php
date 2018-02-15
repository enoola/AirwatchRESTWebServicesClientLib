<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 30/01/2018
 * Time: 11:30
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Device Information
 * Functionality – Retrieves details of the device identified by device ID.
 */
class AirwatchMDMDeviceInformationsSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_INFOS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES ;
    const CLASS_SENTENCE_AIM = 'Retrieves details of the device identified by device ID.';

    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'Device alternate id',
            'searchby' => 'The alternate id type (Macaddress, Udid, Serialnumber, ImeiNumber)'
            //'page' => 'Page number',
            //'pagesize' => 'Maximum Records per page'
        ];


        parent::__construct($cfg, 'default_device_fields_to_show', 'possible_device_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_INFOS_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        //unset ($arParams['id']);

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
            $this->_uri = AirwatchMDMDevices::URI_MDM_DEVICES .'/'.$id;
        }


        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}