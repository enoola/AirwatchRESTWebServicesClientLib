<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 06/02/2018
 * Time: 08:36
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Retrieve Relay Server Details
 * Functionality – Retrieves the details of the existing relay server.
 */
class AirwatchMDMRelayServersSearch extends AirwatchServicesSearch
{
    const URI_MDM_RELAYSERVERS_SEARCH = 'api/mdm/relayservers';
    const CLASS_SENTENCE_AIM = 'Retrieves the details of the existing relay server.';

    public function __construct($cfg)
    {
        $arPossibleParams = [ 'id'=> 'Application Group id'] ;

        parent::__construct($cfg,'default_smartgroup_fields_to_show','possible_mdmsmartgroupdetails_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse(null);

        $this->_uri = self::URI_MDM_RELAYSERVERS_SEARCH;
        throw new \Exception("Implementation not completed at all");
        exit;
    }

/*
    public function Search( $arParams = null): array
    {

       //  if (is_null($arParams) || !array_key_exists('id',$arParams)) {
       //     die ("wrong Parameters provided 'id' is mandatory" . PHP_EOL);
       //     return (null);
       // }

       // $id = $arParams['id'];
       // unset($arParams['id']);
       // $this->_uri = self::URI_MDM_SMARTGROUP_SEARCH.'/'.$id ;
        $resquery = parent::Search($arParams);

        return ($resquery);
    }
*/


}