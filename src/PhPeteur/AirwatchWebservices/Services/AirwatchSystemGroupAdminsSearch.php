<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2018
 * Time: 17:19
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Fetch Admin User Details in an Organization Group (*Refactored)
 * Functionality – Retrieves the details of all the console admin users in an organization group.
 */
class AirwatchSystemGroupAdminsSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUPADMINS_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS;
    const CLASS_SENTENCE_AIM = 'Retrieves the details of all the console admin users in an organization group.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_admin_fields_to_show','possible_admin_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_SYSTEM_GROUPADMINS_SEARCH ;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEM_GROUPADMINS_SEARCH .'/'.$id . '/getadmins';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}