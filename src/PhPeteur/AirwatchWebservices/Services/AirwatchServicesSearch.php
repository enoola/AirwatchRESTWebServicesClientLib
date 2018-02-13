<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 19/01/2018
 * Time: 07:49
 */

namespace PhPeteur\AirwatchWebservices\Services;

/*
 * This class is to ease implementation of search function
 * indeed aw webservices are consistent and almost all the same
 * we have some specificity in regards to what's returned but not much
 * not enough to rewrite the whole fucking story each time
 */

abstract class AirwatchServicesSearch extends Airwatch
{
    protected $_arPossibleParams;
    protected $_arExpectedFieldsInConfigFile;

    protected $_ar_default_fields_to_show;
    protected $_ar_possible_fields_to_show;

    protected $_uri;

    /*
     * fieldnameToShowInDataResultResponse : we remarked in response from AW, we have a field name 'data'
     * this field contains page,pagesize... and a fieldname to pick data from
    */
    protected $_fieldnameToShowInDataResult;

    public function __construct($cfg,$szDefaultFieldsToShow,$szPossibleFieldsToShow, $arPossibleParams)
    {

        parent::__construct($cfg);
        //echo __CLASS__ . PHP_EOL;
        $this->_arPossibleParams = null;
        $this->_arExpectedFieldsInConfigFile = null;
        $this->_uri = null;

        self::setDefaultFieldsToShow( $cfg[ $szDefaultFieldsToShow ] );
        self::setPossibleFieldsToShow( $cfg[ $szPossibleFieldsToShow ] );

        // $this->setExpectedFieldsInConfigFile($arExpectedFieldsInConfig);
        self::setPossibleSearchParams( $arPossibleParams );
        self::setExpectedFieldsInConfigFile([$szDefaultFieldsToShow, $szPossibleFieldsToShow]);
        self::checkConfigFileFields( self::getExpectedFieldsInConfigFile() );

        $this->_fieldnameToShowInDataResult = null;

    }

    public function Search( $arParams = null): array
    {
        if (!is_null($arParams)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }
            $this->addParamsToQuery($arParams);
        }

        $res = $this->query($this->_uri);

        return ($res);
    }

    /*
     * Check the expected fields were provided in config file
     * for the class to run properly
     */
    protected function checkConfigFileFields( $arExpectedFieldsInConfig )
    {
        foreach ($arExpectedFieldsInConfig as $keyexpected)
            if (!array_key_exists($keyexpected, $this->_configfile)) {
                throw new \Exception('missing information in configuration array passed :"' . $keyexpected . '""');
            }
    }

    function setExpectedFieldsInConfigFile($arExpectedFieldsInConfigFile){
        $this->_arExpectedFieldsInConfigFile = $arExpectedFieldsInConfigFile;
    }

    function getExpectedFieldsInConfigFile() {
        return ( $this->_arExpectedFieldsInConfigFile );
    }

    function setPossibleSearchParams($arPossibleParams){
        $this->_arPossibleParams = $arPossibleParams;
    }

    public function getPossibleSearchParams()
    {
        return ($this->_arPossibleParams);
    }

    protected function setPossibleFieldsToShow($arPossibleFieldsToShow)
    {
        $this->_ar_possible_fields_to_show = $arPossibleFieldsToShow;
        return;
    }

    protected function setDefaultFieldsToShow($arDefaultFieldsToShow)
    {
        $this->_ar_default_fields_to_show = $arDefaultFieldsToShow;
        return;
    }

    /* not sure, this shall be in the ui :/ */
    public function getDefaultFieldsToShow()
    {
        return ($this->_ar_default_fields_to_show);
    }

    public function getAllFieldsToShow()
    {
        return ($this->_ar_possible_fields_to_show);
    }

    /*
     * Field to pick in data result set;get
     */
    public function getFieldnameToPickInDataResultResponse() {
        return ( $this->_fieldnameToShowInDataResult );
    }

    public function setFieldnameToPickInDataResultResponse ( $fieldnameToShowInDataResult ) {
        $this->_fieldnameToShowInDataResult = $fieldnameToShowInDataResult;
    }
}