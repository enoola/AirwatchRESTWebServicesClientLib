<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 02/02/2018
 * Time: 15:58
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Retrieve Smart Group details
 * Functionality – Retrieves the smart group details created in an organization group.
 */
class AirwatchMDMSmartGroupSearch extends AirwatchServicesSearch
{
    const URI_MDM_SMARTGROUP_SEARCH = AirwatchMDMSmartGroups::URI_MDM_SMARTGROUPS;


    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_smartgroup_fields_to_show','possible_mdmsmartgroupdetails_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_SMARTGROUP_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_SMARTGROUP_SEARCH.'/'.$id ;

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}
