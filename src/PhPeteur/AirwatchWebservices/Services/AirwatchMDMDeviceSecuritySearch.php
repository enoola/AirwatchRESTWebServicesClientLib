<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 02/02/2018
 * Time: 19:43
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Security Information
 * Functionality – Retrieves the security information of the device identified by device ID.
 */
class AirwatchMDMDeviceSecuritySearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_SECURITY_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES;
    const CLASS_SENTENCE_AIM = 'Retrieves the security information of the device identified by device ID.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Device Id',
            'searchby'=>'The alternate id type [Macaddress, Udid, Serialnumber, ImeiNumber]'] ;

        parent::__construct($cfg,'default_devicesecurity_fields_to_show','possible_devicesecurity_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_DEVICES_SECURITY_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_DEVICES_SECURITY_SEARCH.'/'.$id . '/security';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}