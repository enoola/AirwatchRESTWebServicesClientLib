<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 04/02/2018
 * Time: 11:19
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Admin Application Details
 * Functionality – Retrieves admin applications details for the passed device ID.
 */
class AirwatchMDMDeviceAdminAppsSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_ADMINAPPS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES;
    const CLASS_SENTENCE_AIM = 'Retrieves admin applications details for the passed device ID.';


    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_deviceadminapp_fields_to_show','possible_deviceadminapp_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('DeviceAdminApps');

        $this->_uri = self::URI_MDM_DEVICES_ADMINAPPS_SEARCH ;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_DEVICES_ADMINAPPS_SEARCH .'/'.$id . '/adminapps';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}
