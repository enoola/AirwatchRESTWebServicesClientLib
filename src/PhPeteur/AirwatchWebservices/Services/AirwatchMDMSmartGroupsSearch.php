<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 18/01/2018
 * Time: 08:14
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMDMSmartGroupsSearch extends AirwatchServicesSearch
{
    const URI_MDM_SMARTGROUPS_SEARCH = AirwatchMDMSmartGroups::URI_MDM_SMARTGROUPS . '/search';

    public function __construct($cfg)
    {


         $arPossibleParams = [ 'name'=> 'Smart Group name',
             'page'=>'Page number',
             'pagesize'=>'Records per page',
             ];

        parent::__construct($cfg, 'default_smartgroup_fields_to_show', 'possible_smartgroup_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('SmartGroups');

        $this->_uri = self::URI_MDM_SMARTGROUPS_SEARCH;
    }

    /*
    public function Search($arParams = null) : array
    {
        if (! is_null($arParams)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }
            $this->addParamsToQuery($arParams);
        }

        $res = $this->query( self::URI_MDM_SMARTGROUPS_SEARCH );

        return ( $res );
    }


    public function getPossibleParams()
    {
        return ($this->_arPossibleParams);
    }

    /* not sure, this shall be in the ui :/ *
    public function getDefaultFieldsToShow() {
        return ($this->_ar_default_smartgroup_fields_to_show);
    }

    public function getAllFieldsToShow() {
        return ( $this->_ar_possible_smartgroup_fields_to_show);
    }*/
}