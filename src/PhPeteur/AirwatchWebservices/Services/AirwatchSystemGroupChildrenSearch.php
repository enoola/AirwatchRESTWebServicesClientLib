<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2018
 * Time: 12:15
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Fetch Child Organization Group's Details (*Refactored)
 * Functionality – Fetches the details of the given organization group as well as the details of all its child organizations
groups.
 */
class AirwatchSystemGroupChildrenSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUPCHILDREN_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS;
    const CLASS_SENTENCE_AIM = 'Fetches the details of the given organization group as well as the details of all its child organizations
groups.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_systemgroup_fields_to_show','possible_systemgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_SYSTEM_GROUPCHILDREN_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEM_GROUPCHILDREN_SEARCH.'/'.$id . '/children';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}