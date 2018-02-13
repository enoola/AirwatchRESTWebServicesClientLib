<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 22/01/2018
 * Time: 13:50
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Application Group (*Refactored)
 * Functionality – Searches for the Application Groups based on the query information provided.
 */
class AirwatchMAMAppsGroupsSearch extends AirwatchServicesSearch
{
    const URI_MAM_APPGROUPS_SEARCH = AirwatchMAMApps::URI_MAM_APPS . '/appgroups/search';


    public function __construct($cfg)
    {
        $arPossibleParams = [ 'appgroupname'=> 'Application Group name',
            'organizationgroupid'=>'Id of the Organization group',
            'platform'=>'Platform of the application group',
            'appgrouptype'=>'Application group type. "Whitelisted", "Blacklisted", "Required"',
            'orderby'=>'The column by which the results will be ordered.',
            'sortorder'=>'Sorting order. Values ASC or DESC. Defaults to ASC',
            'page'=>'Page number',
            'pagesize'=>'Records per page',
        ] ;

        parent::__construct($cfg,'default_appgroup_fields_to_show','possible_appgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('AppGroups');

        $this->_uri = self::URI_MAM_APPGROUPS_SEARCH;
    }



}