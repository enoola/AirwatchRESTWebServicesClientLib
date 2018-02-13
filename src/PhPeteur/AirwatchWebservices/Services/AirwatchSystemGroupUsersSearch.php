<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 04/02/2018
 * Time: 10:23
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchSystemGroupUsersSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUPUSERS_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS;


    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_user_fields_to_show','possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_SYSTEM_GROUPUSERS_SEARCH ;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEM_GROUPUSERS_SEARCH .'/'.$id . '/users';

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}