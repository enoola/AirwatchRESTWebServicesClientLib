<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 21:38
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * API URI – https://host/api/mdm/devices/search?user={user}&model={model}&platform={platform}&lastseen=
{lastseen}&ownership={ownership}&Igid={Igid}&compliantstatus={compliantstatus}&seensince={seensince}&page=
{page}&pagesize={pagesize}&orderby={orderby}&sortorder={sortorder}
 */
use PhPeteur\AirwatchWebservices\Exception\AirwatchCmdException;

class AirwatchMDMDevicesSearch extends AirwatchServicesSearch
{
    const URI_MDM_DEVICES_SEARCH = AirwatchMDMDevices::URI_MDM_DEVICES . '/search';
    //possibleQueryParams for a search in apps
    //private $_arPossibleParams;


    public function __construct( $cfg )
    {

        $szWarningNOTCumulative = 'and doesnot cumulate with other params you may have put.';
        $arPossibleParams = [
            'user'=>'Enrolled username',
            'model'=>'Device model',
            'platform'=>'Device platform',
            'lastseen'=>'Last seen date string',
            'ownership'=>'Device ownership',
            //regardless of the doc it is LG as in Location Group (Not Ig as in nothing)
            'Lgid'=> "Organization group to be searched, user\'s OG is considered if not sent",
            'compliantstatus'=>'Compliant status',
            'seensince'=>'Specifies the date filter for device search, which retrieves the devices
that are seen after this date',
            'page'=>'Page number',
            'pagesize'=>'Records per page',
            'orderby'=>'Order by column name',
            'sortorder'=>'Sorting order. Values ASC or DESC. Defaults to ASC.',
            'serialnumber'=>'[not generic] will seek for devices containing the serial number or partofit /!\ this will fetch ALL devices in order to find your SN... '.$szWarningNOTCumulative,
            'imei' => '[not generic] will seek for devices containing the serial number or partofit /!\ this will fetch ALL devices in order to find you IMEI... '.$szWarningNOTCumulative,
            'easid' => '[not generic] will seek for devices containing the serial number or partofit /!\ this will fetch ALL devices in order to find you ActiveSyncID... '.$szWarningNOTCumulative,
        ];
        //name, type (can be possible values too), description
        /*
        $this->_arPossibleParams = [
            ['user', Airwatch::PARAM_STRING, 'Enrolled username'],
            ['model', Airwatch::PARAM_STRING, 'Device model'],
            ['platform', Airwatch::PARAM_STRING, 'Device platform'],
            ['lastseen', 'Datetime', 'Last seen date string'],
            ['ownership', Airwatch::PARAM_STRING,'Device ownership'],
            ['Igid',Airwatch::PARAM_INTEGER, "Organization group to be searched, user\'s OG is considered if not sent"],
            ['compliantstatus',Airwatch::PARAM_BOOL, 'Compliant status'],
            ['seensince',Airwatch::PARAM_DATETIME,'Specifies the date filter for device search, which retrieves the devices
that are seen after this date'],
            ['page',Airwatch::PARAM_NUMERIC,'Page number'],
            ['pagesize',Airwatch::PARAM_NUMERIC,'Records per page'],
            ['orderby',Airwatch::PARAM_NUMERIC,'Order by column name'],
            ['sortorder',['ASC','DESC'],'Sorting order. Values ASC or DESC. Defaults to ASC.'],
        ]; */

        parent::__construct( $cfg,'default_device_fields_to_show','possible_device_fields_to_show', $arPossibleParams);

        parent::setFieldnameToPickInDataResultResponse('Devices');

        $this->_uri = self::URI_MDM_DEVICES_SEARCH;
    }

    /*
    public function Search($arParams = null) : array
    {
        //print_r($arParams);
        //exit;
        if (! is_null($arParams)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }
          $this->addParamsToQuery($arParams);
        }

        $res = $this->query( self::URI_MDM_DEVICES_SEARCH );

        return ( $res );
    }

*/


    /*
     * AW doesn't yet (v9.2x) provide a method to seek for iccid,sn,or imei
     * param $seekSpecialFieldname : is the key we are seeking for (case unsensitive, since it's basically an option from command line)
     * param $szValueOf : is the value we are looking for this special..
     */
    public function searchForSpecifics($seekSpecialFieldname, $szValueOf){
        $arParams = ['page'=>'0','pagesize'=>'500'];
        $result = $this->Search($arParams);

        //var_dump( $result['data']['Devices'][0] );
        //exit;
        $curPage = (int)$result['data']['Page'];
        $curPageSize = (int)$result['data']['PageSize'];
        $totalResult = (int)$result['data']['Total'];
        $resultsWithExpectedSerialNumbers = [];
        $resultsWithExpectedSerialNumbers['uri'] = $result['uri'];
        $resultsWithExpectedSerialNumbers['status'] = $result['status'];
        $resultsWithExpectedSerialNumbers['data']= [parent::getFieldnameToPickInDataResultResponse()=> array()];

        $ctResult = 0;

        do {
            if (!is_null($result['data'][parent::getFieldnameToPickInDataResultResponse()] ))
                foreach ($result['data'][parent::getFieldnameToPickInDataResultResponse()] as $numKey => $oneDevice) {
                    $keyInRightCase = Airwatch::array_ikey_exists($seekSpecialFieldname, $oneDevice);
                    if ($keyInRightCase !== false) {

                        if ( stripos($oneDevice[$keyInRightCase], $szValueOf) !== FALSE ) {
                            $resultsWithExpectedSerialNumbers['data'][ parent::getFieldnameToPickInDataResultResponse() ][] = $oneDevice;
                            $ctResult++;
                        }
                    }
                //else {throw new \Exception('a device without a serial number interesting..');}
                }
            //if we have more pages....
            if ($totalResult == $curPageSize) {
                $arParams['page'] = ((int)$curPage) + 1;
                $result = $this->Search($arParams);
                if (count($result['data']['Devices']) > 0) {
                    $curPage = (int)$result['data']['Page'];
                    $curPageSize = (int)$result['data']['PageSize'];
                    $totalResult = (int)$result['data']['Total'];
                    $resultsWithExpectedSerialNumbers = [];
                    $resultsWithExpectedSerialNumbers['uri'] = $result['uri'];
                    $resultsWithExpectedSerialNumbers['status'] = $result['status'];
                    $resultsWithExpectedSerialNumbers['data'] = [parent::getFieldnameToPickInDataResultResponse() => array()];
                } else {
                    break;
                }
            }
            //echo "One More round...".$ctResult."<".PHP_EOL;

        } while ((int)$curPage < round($totalResult/$curPageSize));




        //now we want the returned table to be "generic" for display :)
        $resultsWithExpectedSerialNumbers['data']['Total'] = count($resultsWithExpectedSerialNumbers['data'][parent::getFieldnameToPickInDataResultResponse()]); //a bit false shall we GET ALL ????
        $resultsWithExpectedSerialNumbers['data']['PageSize'] = $curPageSize;
        $resultsWithExpectedSerialNumbers['data']['Page'] = '0';

        //var_dump( $resultsWithExpectedSerialNumbers['data']['Devices'][0] );
        //exit;

        return ( $resultsWithExpectedSerialNumbers);
    }



    /*
     * seek for a serial number
     * there is 2 cases (one with args the other one without)
     *
    public function SearchForSerialNumber($serialNumber, $arParams) : array
    {
        $result = $this->Search($arParams);
        $curPage = $result['Page'];
        $curPageSize = $result['PageSize'];
        $totalResult = $result['Total'];
        $resultsWithExpectedSerialNumbers = [];
        $resultsWithExpectedSerialNumbers['uri'] = $result['uri'];
        $resultsWithExpectedSerialNumbers['status'] = $result['status'];
        $resultsWithExpectedSerialNumbers['data']= ['Devices'=> array()];

        $ctResult = 0;

        do {
            foreach ($result as $numKey => $oneDevice) {
                if (array_key_exists('SerialNumber', $oneDevice)) {
                    if (strpos($oneDevice['SerialNumber'],$serialNumber) !== FALSE ) {
                        $resultsWithExpectedSerialNumbers['data']['Devices'][] = $oneDevice;
                        $ctResult++;
                    }
                } else {
                    throw new \Exception('a device without a serial number interesting..'));
                }
            }
        } while (($ctResult < $curPageSize) || ($ctfetched >= $totalResult) || ($curPageSize > 0));
        //now we want the returned table to be "generic" for display :)
        $resultsWithExpectedSerialNumbers['data']['Page'] = $curPage; //a bit false shall we GET ALL ????
        $resultsWithExpectedSerialNumbers['data']['Page'] = $curPageSize;

        //if (! $)
        return ( $resultsWithExpectedSerialNumbers);
    }*/

    /*
    public function getPossibleParams()
    {
        return ($this->_arPossibleParams);
    }

    /* not sure, this shall be in the ui :/ */
    /*
     *
     *public function getDefaultFieldsToShow() {
        return ($this->_ar_default_device_fields_to_show);
    }

    public function getAllFieldsToShow() {
        return ( $this->_ar_default_device_fields_to_show);
    }*/
}