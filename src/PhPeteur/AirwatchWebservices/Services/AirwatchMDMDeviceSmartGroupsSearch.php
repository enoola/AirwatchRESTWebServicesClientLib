<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 02/02/2018
 * Time: 16:28
 */

namespace PhPeteur\AirwatchWebservices\Services;



class AirwatchMDMDeviceSmartGroupsSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICE_SMARTGROUPS_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES;


    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_devicesmartgroups_fields_to_show','possible_devicesmartgroups_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('SmartGroup');

        $this->_uri = self::URI_MDM_DEVICE_SMARTGROUPS_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_DEVICE_SMARTGROUPS_SEARCH.'/'.$id . '/smartgroups';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}