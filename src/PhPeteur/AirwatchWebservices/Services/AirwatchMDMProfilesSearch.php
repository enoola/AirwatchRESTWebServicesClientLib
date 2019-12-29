<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/05/2019
 * Time: 15:53
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Profiles
 * Functionality – Gets List of profiles based on the search criteria.
 */
class AirwatchMDMProfilesSearch extends AirwatchServicesSearch
{
    const URI_MDM_PRODUCTS_SEARCH = AirwatchMDMProfiles::URI_MDM_PROFILES . '/search';
    const CLASS_SENTENCE_AIM = 'Gets List of profiles based on the search criteria.';

    public function __construct($cfg)
    {

        $arPossibleParams = [ 'organizationgroupid' => ' og id',
            'platform' => 'Platform Name',
            'profiletype' => 'Profile Type',
            'status' => 'Profile status (Active or Inactive)',
            'searchtext' => 'searchtext',
            'orderby' => 'Orderby parameter name.',
            'sortorder' => 'Sorting order. Values ASC or DESC. Defaults to ASC.',
            'includeandroidforwork' => 'It will include androidforwork profiles', //Boolean
            'page'=>'Page number',
            'pagesize'=>'Records per page'
        ];
        //'assignments'=>'???'KO
        //'Igid'=> '??' KO

        parent::__construct($cfg,'default_profile_fields_to_show', 'possible_profile_fields_to_show',$arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Profiles');

        $this->_uri = self::URI_MDM_PRODUCTS_SEARCH;

    }

}