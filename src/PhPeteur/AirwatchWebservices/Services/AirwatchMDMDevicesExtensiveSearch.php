<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 04/02/2018
 * Time: 22:51
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Device Extensive Search
 * Functionality – Search results containing the devices and their product assignment information.
 *
 * API URI – https://host/api/mdm/devices/extensivesearch?organizationgroupid={organizationgroupid}&platform=
{platform}&startdatetime={startdatetime}&enddatetime={enddatetime}&deviceid={deviceid}&customattributes=
{customattributeslist}&enrollmentstatus={enrollmentstatus}&enrollmentstatuschangefrom=
{statuschangestarttime}&enrollmentstatuschangeto={statuschangeendtime}&page={page}&pagesize={pagesize}
 */
class AirwatchMDMDevicesExtensiveSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICESEXTENSIVE_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/extensivesearch';
    const CLASS_SENTENCE_AIM = 'Search results containing the devices and their product assignment information.';
    
    public function __construct( $cfg )
    {


        $arPossibleParams = [
            'organizationgroupid'   => 'Organization group to be searched, user\'s OG is considered if not sent',
            'customattributeslist'  => 'Custom attribute names',
            'platform'              => 'Device platform',
            'startdatetime'         => 'Filters devices such that devices with last seen after this date will be
returned',
            'enddatetime'           => 'Filters devices such that devices with last seen till this date will be
returned',
            'deviceid'              => 'device identifier',
            'model'                 => 'Device model',
'enrollmentstatus'                  => 'Filters devices based on their EnrollmentStatus',
            'statuschangestarttime' => 'Filters the devices for which EnrollmentStatus has changed from
enrollmentstatuschangefrom datetime [Valid only in case of
enrollmentStatus filter = enrolled or unenrolled]',
            'statuschangeendtime'   => 'Filters the devices for which EnrollmentStatus has changed till
enrollmentstatuschangeto datetime [Valid only in case of
enrollmentStatus filter = enrolled or unenrolled]',
            'page'                  => 'Page number',
            'pagesize'              => 'Records per page'
        ];

        parent::__construct( $cfg,'default_deviceextensive_fields_to_show','possible_deviceextensive_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_DEVICESEXTENSIVE_SEARCH;
    }


}