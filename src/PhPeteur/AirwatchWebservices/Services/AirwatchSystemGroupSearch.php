<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2018
 * Time: 12:02
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Fetch Organization Group's Details
 * Functionality – Retrieves the details of the organization group.
 */
class AirwatchSystemGroupSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUP_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS ;


    public function __construct($cfg)
    {
        $arPossibleParams = ['id' => 'the organization group id'];

        parent::__construct($cfg, 'default_systemgroup_fields_to_show', 'possible_systemgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_SYSTEM_GROUP_SEARCH;
    }

    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEM_GROUP_SEARCH.'/'.$id ;

        $resquery = parent::Search($arParams);

        return ($resquery);
    }
}