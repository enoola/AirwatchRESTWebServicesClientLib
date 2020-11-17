<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 21:36
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * New - Gets all Apple Device Enrollment Program devices at organization group.
 */
class AirwatchMDMDEPDevicesSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEP_DEVICES_SEARCH = '/api/mdm/dep/groups';
    const CLASS_SENTENCE_AIM = 'Retrieves DEP devices for an organization group defined by uuid.';


    public function __construct($cfg)
    {
        $arPossibleParams = ['OrganizationGroupUuid' => 'Organization UUID e.g: FFD1521E-70D7-4673-A0EF-62938079C0E8'
        ];

        parent::__construct($cfg,'default_depdevicessearch_fields_to_show','possible_depdevicessearch_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('data');

        $this->_uri = self::URI_MDM_DEP_DEVICES_SEARCH ;
    }


    public function Search( $arParams = null, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE): array
    {
        if (is_null($arParams) || !array_key_exists('OrganizationGroupUuid',$arParams)) {
            die ("Wrong Parameters provided 'SearchText' is mandatory" . PHP_EOL);
            return (null);
        }


        $oguuid = $arParams['OrganizationGroupUuid'];

        $this->_uri = self::URI_MDM_DEP_DEVICES_SEARCH . '/' . $oguuid .'/devices';

        $resquery = parent::Search(null, $szContentType);

        return ($resquery);
    }

}