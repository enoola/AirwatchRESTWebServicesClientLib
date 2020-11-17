<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 28/04/2019
 * Time: 07:18
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Search Admin User
 * This endpoint is to get the details of APNs certificate Blob(.pem) uploaded to the AirWatch server.
 */

class AirwatchSystemGroupAPNSSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_APNS_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS ;
    const CLASS_SENTENCE_AIM = 'Searches for APNS information on a specific organization ID.';

    public function __construct($cfg)
    {

        $arPossibleParams = [ 'id'=> "organization group id",
            'page'=>'Page number',
            'pagesize'=>'Records per page',
        ] ;

        parent::__construct($cfg,'default_systemapnsid_fields_to_show','possible_systemapnsid_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('data');

        $this->_uri = self::URI_SYSTEM_APNS_SEARCH;
    }

    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);
        $this->_uri = self::URI_SYSTEM_APNS_SEARCH .'/'.$id . '/apns';

        //$resquery = parent::Search($arParams);
        $resquery = parent::Search( null, $szContentType );

        return ($resquery);
    }

}