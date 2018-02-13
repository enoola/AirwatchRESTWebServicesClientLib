<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 31/01/2018
 * Time: 10:18
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMComplianceAttributesOrgGroupsComplianceAttributesSearch extends AirwatchServicesSearch
{
    const URI_MDM_COMPLIANCEATTRIBUTES_OGCOMPLIANCEATTR_SEARCH = AirwatchMDMComplianceAttributes::URI_MDM_COMPLIANCEATTRIBUTES. '/organizationgroupcomplianceattributes' ;


    public function __construct($cfg)
    {
        $arPossibleParams = ['vendorname' => 'Name of the vendor.'];


        parent::__construct($cfg, 'default_complianceattr_fields_to_show', 'possible_complianceattr_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse('ComplianceAttributes"');

        $this->_uri = self::URI_MDM_COMPLIANCEATTRIBUTES_OGCOMPLIANCEATTR_SEARCH;
    }


    public function Search( $arParams = null): array
    {
        if (is_null($arParams) || !array_key_exists('vendorname',$arParams)) {
            die ("wrong Parameters provided 'vendorname' is mandatory" . PHP_EOL);
            return (null);
        }

        $resquery = parent::Search($arParams);

        return ($resquery);
    }

}