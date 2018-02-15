<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 09:57
 */

namespace PhPeteur\AirwatchWebservices\Services;


/*
 * Search Applications
 * Functionality – Searches and retrieves the details for both internal and external applications.
 */
class AirwatchMAMAppsSearch extends AirwatchServicesSearch
{

    const URI_MAM_APPS_SEARCH = AirwatchMAMApps::URI_MAM_APPS . '/search';
    const CLASS_SENTENCE_AIM = 'Searches and retrieves the details for both internal and external applications.';
    
    //possibleQueryParams for a search in apps
    protected $_arPossibleParams;
    /*
     * search for apps (can be empty in which case it lists all apps)
     * /!\ need to check if it also create pages
     */
    /*
     search?type={type}&applicationtype={applicationtype}&applicationname=
    {applicationname}&category={category}&locationgroupid={locationgroupid}&bundleid={bundleid}&platform=
    {platform}&model={model}&status={status}&orderby={orderby}&page={page}&pagesize={pagesize}
    */

    public function __construct($cfg)
    {
        $arPossibleParams = [
            'type'              => 'The product type - app or book',
            'applicationtype'   => 'Type of the application - internal or public',
            'applicationname'   => 'Name of the application. Partial search string is allowed',
            'category'          => 'Category of the application. For example: Games',
            'locationgroupid'   => 'Unique numeric ID of the organization group where the application is
present',
            'bundleid'          => 'Bundle ID of the application',
            'platform'          => 'Application platform. For example: Android, iOS',
            'model'             => 'Application model. For example: iPad',
            'status'            => 'Returns the application status. All, Active, Inactive, Retired',
            'orderby'           => 'The order of the search result. Any of the column parameters
mentioned above can be sent as a parameter',
            'page'              => 'Page number of the retrieved response',
            'pagesize'          => 'Page Size of the retrieved response',
        ];

        parent::__construct($cfg,'default_app_fields_to_show','possible_app_fields_to_show', $arPossibleParams);

        /*
        foreach ($arExpectedFields as $keyexpected)
            if (!array_key_exists( $keyexpected, $cfg )) {
                throw new \Exception('missing information in configuration array passed :"'.$keyexpected.'""');
            }
*/
        parent::setFieldnameToPickInDataResultResponse('Application');

        $this->_uri = self::URI_MAM_APPS_SEARCH;
    }

    /*
    public function SearchApps($arParams = null){
        $uri = self::URI_MAM_APPS_SEARCH;

        if (! is_null($arParams)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }

            $this->addParamsToQuery($arParams);
        }

        $res = $this->query($uri);

        return ($res);
    }

    public function Search($arParams = null)
    {
        if (! is_null($arParams)) {
            foreach ($arParams as $k => $val) {
                if (!array_key_exists($k, $this->_arPossibleParams)) {
                    die ("wrong Parameters provided '" . $k . "' isn not accepted as a parameter" . PHP_EOL);
                }
            }
            $this->addParamsToQuery($arParams);
        }

        $res = $this->query( self::URI_MAM_APPS_SEARCH );

        return ( $res );
    }

    public function getPossibleParams()
    {
        return ($this->_arPossibleParams);
    }

    public function getDefaultFieldsToShow() {
        return ($this->_ar_default_app_fields_to_show);
    }

    public function getAllFieldsToShow() {
        return ( $this->_ar_possible_app_fields_to_show);
    }
*/

}