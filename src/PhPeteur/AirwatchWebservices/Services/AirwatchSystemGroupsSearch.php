<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 23/01/2018
 * Time: 17:41
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Organization Group
 * Searches for Organization Group Details based on the parameters provided in the URL.
 */
class AirwatchSystemGroupsSearch  extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUP_SEARCH = AirwatchSystemGroups::URI_SYSTEM_GROUPS . '/search';
    const CLASS_SENTENCE_AIM = 'Searches for Organization Group Details based on the parameters provided in the URL.';

    public function __construct($cfg)
    {
        $arPossibleParams = ['name' => 'The organization group name to search for',
            'type' => 'The organization group type to search for',
            'groupid' => 'The organization group identifier[Activation code] to search for.[Exact match is performed for this attribute]',
            'orderby' => 'Orders the results based on this attribute-value[Valid values are: Id/Name/GroupId/LocationGroupType]',
            'sortorder' => 'Sorting order. Values ASC or DESC. Default to ASC',
            'page' => 'Page number',
            'pagesize' => 'Maximum Records per page',
        ];

        parent::__construct($cfg, 'default_systemgroup_fields_to_show', 'possible_systemgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('LocationGroups');

        $this->_uri = self::URI_SYSTEM_GROUP_SEARCH;
    }




}