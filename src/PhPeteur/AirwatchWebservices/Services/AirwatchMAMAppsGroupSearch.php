<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 02/02/2018
 * Time: 14:52
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Application Group Details
 * Functionality – Retrieves the Application group details based on the application group id.
 */

class AirwatchMAMAppsGroupSearch extends AirwatchServicesSearch
{
    const URI_MAM_APPSGROUP_SEARCH = AirwatchMAMApps::URI_MAM_APPS . '/appgroups';
    const CLASS_SENTENCE_AIM = 'Searches for products using the query information provided.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_appgroup_fields_to_show','possible_appgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MAM_APPSGROUP_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_MAM_APPSGROUP_SEARCH.'/'.$id ;

        $resquery = parent::Search($arParams);
        //var_dump($resquery);
        return ($resquery);
    }

}