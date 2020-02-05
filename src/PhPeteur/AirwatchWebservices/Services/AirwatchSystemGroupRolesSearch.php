<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 04/02/2018
 * Time: 10:40
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Fetch Admin User Roles From an Organization Group
 * Functionality – Retrieves the list of roles in an organization group that could be assigned to an AirWatch Console user.
 */
class AirwatchSystemGroupRolesSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUPROLES_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS;
    const CLASS_SENTENCE_AIM = 'Retrieves the list of roles in an organization group that could be assigned to an AirWatch Console user.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_systemrole_fields_to_show','possible_systemrole_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_SYSTEM_GROUPROLES_SEARCH ;
    }


    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEM_GROUPROLES_SEARCH .'/'.$id . '/roles';

        $resquery = parent::Search($arParams, $szContentType);
        //var_dump($resquery);

        return ($resquery);
    }

}