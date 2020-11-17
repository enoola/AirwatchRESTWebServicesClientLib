<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 21:36
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMDEPProfilesSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEP_PROFILES_SEARCH = '/api/mdm/dep/profiles/search';
    const CLASS_SENTENCE_AIM = 'Retrieves DEP Profile for searchText at least.';


    public function __construct($cfg)
    {
        $arPossibleParams = ['OrganizationGroupUuid' => 'Organization UUID e.g: FFD1521E-70D7-4673-A0EF-62938079C0E8',
            'SearchText' => 'Profile name (Required).',
            'Page' => 'Specific page number to get. 0 based index',
            'PageSize' => 'Maximum records per page. Default 50',
            'OrderBy' => 'Order By. Default Asc (Example:Asc,Dsc)',
            'SortBy' => 'Sort Order. Default DeviceProfileName (Example:DeviceProfileName,RootLocationGroupName)'

        ];

        parent::__construct($cfg,'default_depprofilesearch_fields_to_show','possible_depprofilesearch_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('ProfileList');

        $this->_uri = self::URI_MDM_DEP_PROFILES_SEARCH ;
    }


    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE ): array
    {
        if (is_null($arParams) || !array_key_exists('SearchText',$arParams)) {
            die ("Wrong Parameters provided 'SearchText' is mandatory" . PHP_EOL);
            return (null);
        }

        //$id = $arParams['id'];
        //unset($arParams['id']);
        $this->_uri = self::URI_MDM_DEP_PROFILES_SEARCH;

        $resquery = parent::Search($arParams, $szContentType);

        return ($resquery);
    }

}