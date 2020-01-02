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

class AirwatchSystemGroupAPNSUUIdSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_APNS_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS ;
    const CLASS_SENTENCE_AIM = 'Searches for APNS information on a specific organization UUId.';

    public function __construct($cfg)
    {

        $arPossibleParams = [ 'uuid'=> "organization group uuid",
            'page'=>'Page number',
            'pagesize'=>'Records per page',
        ] ;

        parent::__construct($cfg,'default_systemapnsuuid_fields_to_show','possible_systemapnsuuid_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('data');

        $this->_uri = self::URI_SYSTEM_APNS_SEARCH;
    }

    public function SearchV2( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('uuid',$arParams)) {
            die ("Wrong Parameters provided 'uuid' is mandatory" . PHP_EOL);
            return (null);
        }

        $uuid = $arParams['uuid'];
        unset($arParams['uuid']);
        $this->_uri = self::URI_SYSTEM_APNS_SEARCH .'/'.$uuid . '/apns';

        //$resquery = parent::Search($arParams);
        $resquery = parent::SearchV2( );

        return ($resquery);
    }

}