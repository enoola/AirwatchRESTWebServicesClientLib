<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 23/02/2018
 * Time: 07:51
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Get Device Details in the Smart Group
 * Functionality – Retrieves the device details in the smart group.
 */
class AirwatchMDMSmartGroupDevicesSearch extends AirwatchServicesSearch
{
    const URI_MDM_SMARTGROUPDEVICES_SEARCH = AirwatchMDMSmartGroups::URI_MDM_SMARTGROUPS;
    const CLASS_SENTENCE_AIM = 'Functionality – Retrieves the device details in the smart group.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Smart Group id'] ;

        parent::__construct($cfg,'default_mdmsmartgroupdevices_fields_to_show','possible_mdmsmartgroupdevices_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_SMARTGROUPDEVICES_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_SMARTGROUPDEVICES_SEARCH.'/'.$id . '/devices' ;

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}