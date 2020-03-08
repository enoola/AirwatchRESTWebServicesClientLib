<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 03/02/2020
 * Time: 08:12
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Search AD User leveraging scim v2 user get api
 * Functionality – Searches for ad users using the uuid provided.
 */

class AirwatchSystemScimV2Groups extends AirwatchServicesSearch
{
    const URI_SYSTEM_SCIMV2_GROUPS = AirwatchSystemScimV2::URI_SYSTEM_SCIMV2 . '/Groups';
    const CLASS_SENTENCE_AIM = 'Searches for AD groups with filter.';
    
    public function __construct($cfg)
    {
        $arPossibleParams = [ 'filter'=> 'The filter string used to request a subset of resources.',
            'attributes' => 'A comma separated list of strings indicating the names of resource attributes to return in the response.',
            'excludedAttributes' => 'A comma separated list of strings indicating the names of resource attributes to be removed from the default set of attributes to return.',
            'sortBy' => 'A string indicating the attribute to be used to order the returned responses.',
            'sortOrder' => 'A string indicating the order in which the \'sortBy\' ASC,DESC parameter is applied.',
            'startIndex' => 'A 1-based integer indicating the index of the first query result.',
            'count' => 'An integer indicating the maximum number of query results per page.'
            ] ;

        parent::__construct($cfg,'default_scimv2groups_fields_to_show','possible_scimv2groups_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Resources' );

        $this->_uri = self::URI_SYSTEM_SCIMV2_GROUPS;
    }


    public function Search( $arParams = null, $szContentType = 'application/scim+json;version=2'): array
    {
        if (is_null($arParams) || !array_key_exists('filter',$arParams)) {
            die ("Wrong Parameters at least a filter is mandatory" . PHP_EOL);
            return (null);
        }

        $this->_uri = self::URI_SYSTEM_SCIMV2_GROUPS ;

        $resquery = parent::Search($arParams, $szContentType);

        return ( $resquery );
    }


}