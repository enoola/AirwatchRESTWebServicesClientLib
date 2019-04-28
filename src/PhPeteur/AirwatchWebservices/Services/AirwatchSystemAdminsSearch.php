<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 19/01/2018
 * Time: 08:12
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Search Admin User
 * Functionality – Searches for admin users using the query information provided.
 *
 * I don't intend to use Trait, so no multiple inheritance :/
 * AirwatchSystemAdminSearch would need to extends AirwatchServicesSearch and AirwatchSystemAdmin :/
 * so after some 5min though it will inheritate AirwatchServicesSearch which have a lot more value than the
 * AirwatchSystemAdmins only here for conceptual stuff....
 */

class AirwatchSystemAdminsSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_ADMIN_SEARCH = AirwatchSystemAdmins::URI_SYSTEM_ADMIN . '/search';
    const CLASS_SENTENCE_AIM = 'Searches for admin users using the query information provided.';
    
    public function __construct($cfg)
    {

        $arPossibleParams = [ 'firstname'=> "admin's first name",
            'lastname'=> "admin's last name",
            'email'=> "admin's email",
            'organizationgroupid'=> "ogid admin is in",
            'role'=> "admin role",
            'username'=> "admin's username",
            'page'=>'Page number',
            'pagesize'=>'Records per page',
        ] ;

        parent::__construct($cfg,'default_admin_fields_to_show','possible_admin_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Admins');

        $this->_uri = self::URI_SYSTEM_ADMIN_SEARCH;
    }



}