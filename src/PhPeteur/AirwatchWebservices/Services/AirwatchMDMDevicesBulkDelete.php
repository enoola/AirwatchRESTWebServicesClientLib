<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/08/2018
 * Time: 11:27
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Delete devices in bulk
 * Functionality - Deletes multiple devices identified by device ID or alternate ID.
 */
class AirwatchMDMDevicesBulkDelete extends AirwatchServicesDelete
{
    const URI_MDM_DEVICE_BULK_DELETE = AirwatchMDMDevices::URI_MDM_DEVICES . '/bulk' ;
    const CLASS_SENTENCE_AIM = 'Delete the device identified by device ID.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Device Id',
            'searchby'=>'The alternate id type [Macaddress, Udid, Serialnumber, ImeiNumber]'] ;

        parent::__construct($cfg,'default_devicesecurity_fields_to_show','possible_devicesecurity_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICE_DELETE;
    }


    public function Delete( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }
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

        } else {

            //if searchby isn't set it's an search by id : uri : https://host/api/mdm/devices/{id}
            $id = $arParams['id'];
            unset($arParams['id']);

            $this->_uri = self::URI_MDM_DEVICE_DELETE . '/' . $id ;

        }
        $resquery = parent::Delete($arParams);

        return ($resquery);
    }
}