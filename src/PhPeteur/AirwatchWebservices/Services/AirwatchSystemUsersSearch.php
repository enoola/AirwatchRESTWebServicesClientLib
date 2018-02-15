<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 18/01/2018
 * Time: 10:05
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Enrollment Users
 * Searches for the enrollment user details.
 */
class AirwatchSystemUsersSearch extends AirwatchServicesSearch
{
    const URI_SYSTEM_USERS_SEARCH = AirwatchSystemUsers::URI_SYSTEM_USERS . '/search';
    const CLASS_SENTENCE_AIM = 'Searches for the enrollment user details.';
    
    public function __construct( $cfg )
    {

        $arPossibleParams = [
            'firstname' => 'First name of the user (Partial search string allowed)',
            'lastname'  => 'Last name of the user (Partial search string allowed)',
            'email'     => 'Email address of the users (Partial search string allowed)',
            'locationgroupId'   => 'Unique identification of the Organization Group where the users are searched',
            'role'      => 'Role assigned to the user',
            'username'  => 'Username of the users (Partial search string allowed)',
            'page'      => 'Specifies the page number',
            'pagesize'  => 'Maximum records per page',
            'orderby'   => 'Orders the results based on this attribute',
            'sortorder' => 'Sorting order. Allowed values are ASC or DESC. Defaults to ASC if this attribute is not
specified',
        ];

        parent::__construct($cfg,'default_user_fields_to_show', 'possible_user_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Users');

        $this->_uri = self::URI_SYSTEM_USERS_SEARCH;
    }


}