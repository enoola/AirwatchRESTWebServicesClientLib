<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2020
 * Time: 08:12
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Search AD User leveraging scim v2 api
 * Functionality – Searches for ad users using the uuid provided.
 */

class AirwatchSystemScimV2Users extends AirwatchServicesSearch
{
    const URI_SYSTEM_SCIMV2_USERS = AirwatchSystemScimV2::URI_SYSTEM_SCIMV2 . '/Users';
    const CLASS_SENTENCE_AIM = 'Searches for AD user with UUID provided.';
    
    public function __construct($cfg)
    {

        $arPossibleParams = [ 'uuid'=> "uuid of the user"
        ] ;

        parent::__construct($cfg,'default_scimv2users_fields_to_show','possible_scimv2users_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Admins');

        $this->_uri = self::URI_SYSTEM_SCIMV2_USERS;
    }

    public function Search( $arParams = null, $szContentType=null): array
    {
        if (is_null($arParams) || !array_key_exists('uuid',$arParams)) {
            die ("Wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $uuid = $arParams['uuid'];
        unset($arParams['uuid']);
        $this->_uri = self::URI_SYSTEM_SCIMV2_USERS .'/'.$uuid ;

        $resquery = parent::Search([], 'application/scim+json;version=2');
        var_dump($resquery);exit;
        return ( $resquery );
    }

}