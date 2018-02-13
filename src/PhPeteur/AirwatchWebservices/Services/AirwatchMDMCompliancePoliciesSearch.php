<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 05/02/2018
 * Time: 13:22
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Compliance Policy
 * Functionality – Searches for the compliance policies on OG with the search parameters passed.
 */
class AirwatchMDMCompliancePoliciesSearch extends AirwatchServicesSearch
{
    const URI_MDM_COMPLIANCEPOLICIES_SEARCH = '/api/mdm/compliancepolicy/search' ;

    public function __construct($cfg)
    {
        $arPossibleParams = ['organizationgroupid' => 'Organization group id which is similar to selected organization group selected in console.',
            'page' => 'Page number',
            'pagesize' => 'Maximum Records per page'
        ];


        parent::__construct($cfg, 'default_devicecompliancepolicy_fields_to_show', 'possible_devicecompliancepolicy_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('CompliancePolicy');

        $this->_uri = self::URI_MDM_COMPLIANCEPOLICIES_SEARCH;
    }

}