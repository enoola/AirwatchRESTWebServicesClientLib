<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 30/01/2018
 * Time: 06:35
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search and Retrieve Removal Logs for Internal Applications
 * Functionality – Searches and retrieves removal logs for internal applications.
If the number of remove application commands queued in a set time interval exceeds the configured threshold, the
commands are put in locked state. This API method returns the details of the commands that are put in locked state.
 */
class AirwatchMAMAppsRemovalLogsSearch extends AirwatchServicesSearch
{
    const URI_MAM_APPS_REMOVALLOGS_SEARCH = AirwatchMAMApps::URI_MAM_APPS . '/removallogs';
    const CLASS_SENTENCE_AIM = 'Searches and retrieves removal logs for internal applications.';


    public function __construct($cfg)
    {
        $arPossibleParams = ['bundleid' => 'Bundle ID or package ID of the app',
            'status' => 'Status of the command',
            'organizationgroupid' => 'The organization group identifier[Activation code] to search for.[Exact match is performed for this attribute]',
            'orderby' => 'Orders the results based on this attribute-value[Valid values are: Id/Name/GroupId/LocationGroupType]',
            //'sortorder' => 'Sorting order. Values ASC or DESC. Default to ASC',
            'page' => 'Page number',
            'pagesize' => 'Maximum Records per page',
        ];

        parent::__construct($cfg, 'default_appremovallogs_fields_to_show', 'possible_appremovallogs_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('ResultSet');

        $this->_uri = self::URI_MAM_APPS_REMOVALLOGS_SEARCH;
    }


}