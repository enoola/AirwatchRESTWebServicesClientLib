<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 06/02/2018
 * Time: 08:50
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Enrollment User's Details
 * Functionality – Retrieves enrollment user's details identified by the enrollment user Id.
 */
class AirwatchSystemUserSearch extends AirwatchServicesSearch
{

    const URI_MDM_SYSTEMUSER_SEARCH = AirwatchSystemUsers::URI_SYSTEM_USERS ;

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Enrollment user id'] ;

        parent::__construct($cfg,'default_user_fields_to_show','possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_SYSTEMUSER_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MDM_SYSTEMUSER_SEARCH.'/'.$id ;

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}