<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 06/02/2018
 * Time: 09:07
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * Search Enrolled Device
 * Functionality – Retrieves enrolled device details for the query information provided in the request.
 */
class AirwatchSystemUsersEnrolledDevicesSearch extends AirwatchServicesSearch
{
    const URI_SYSTEMUSERS_ENROLLEDDEVICES_SEARCH = AirwatchSystemUsers::URI_SYSTEM_USERS . '/enrolleddevices/search' ;
    const CLASS_SENTENCE_AIM = 'Retrieves enrolled device details for the query information provided in the request.';
    
    public function __construct($cfg)
    {
        $arPossibleParams = ['organizationgroupid' => 'String OG id to sick in',
            'organizationgroup' => 'Organization group name search parameter in which device details are
retrieved',
            'platform' => 'Platform filter for the device details to be retrieved',
            'customattributes' => 'List of custom attribute names [separated by comma (,)] for which values should be returned',
            'serialnumber'=>'Device serial number for which values should be returned',
            'seensince' => 'SeenSince DateTime, devices seen after the seensince datetime will be returned if present',
            'seentill' => 'SeenTill DateTime, devices seen till the seentill datetime will be returned if present',
            'enrolledsince' => 'EnrolledSince DateTime, devices enrolled after the enrolledsince datetime will be returned if present',
            'enrolledtill' => 'EnrolledTill DateTime, devices enrolled till the enrolledtill datetime will be returned if present'
        ];


        parent::__construct($cfg, 'default_systemusersenrolleddevice_fields_to_show', 'possible_systemusersenrolleddevice_fields_to_show', $arPossibleParams);

        //null meansNoFields under ['data']
        parent::setFieldnameToPickInDataResultResponse('EnrolledDeviceInfoList');

        $this->_uri = self::URI_SYSTEMUSERS_ENROLLEDDEVICES_SEARCH;
    }

    public function Search( $arParams = null): array
    {

/*        if (is_null($arParams) || (!array_key_exists('organizationgroupid',$arParams) &&
                !array_key_exists('organizationgroup',$arParams))) {
            die ("Wrong Parameters provided at least 'organizationid' or 'organizationgroup' is mandatory" . PHP_EOL);
            return (null);
        }
*/

        $resquery = parent::Search($arParams);

        return ($resquery);

    }


}