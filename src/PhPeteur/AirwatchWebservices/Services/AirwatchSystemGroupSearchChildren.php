<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/10/2019
 * Time: 20:45
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchSystemGroupSearchChildren  extends AirwatchServicesSearch
{
    const URI_SYSTEM_GROUP_SEARCH_CHILDREN = AirwatchSystemGroups::URI_SYSTEM_GROUPS ;
    const CLASS_SENTENCE_AIM = 'Searches for Organization Group Details based on the parameters provided in the URL.';

    public function __construct($cfg)
    {
        $arPossibleParams = [
            'id' => 'The organization group identifier[Activation code] to search for.[Exact match is performed for this attribute]'
            //'orderby' => 'Orders the results based on this attribute-value[Valid values are: Id/Name/GroupId/LocationGroupType]',
            //'sortorder' => 'Sorting order. Values ASC or DESC. Default to ASC',
            //'page' => 'Page number',
            //'pagesize' => 'Maximum Records per page',
        ];

        parent::__construct($cfg, 'default_systemgroup_fields_to_show', 'possible_systemgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('LocationGroups');

    }

    public function Search($arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('id', $arParams)) {
            die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
            return (null);
        }

        $id = $arParams['id'];
        unset($arParams['id']);

        $this->_uri = self::URI_SYSTEM_GROUP_SEARCH_CHILDREN . '/' . $id . '/children';

        $resquery = parent::Search($arParams, $szContentType);

        return ($resquery);
    }

}
