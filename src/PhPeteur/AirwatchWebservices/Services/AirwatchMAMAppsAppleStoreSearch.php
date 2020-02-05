<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 14:09
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMAMAppsAppleStoreSearch extends AirwatchMAMApps
{
    const URI_MAM_APPS_APPLESTORE_SEARCH = parent::URI_MAM_APPS . '/applestore/search';
    const CLASS_SENTENCE_AIM = "search in Applestore.";
    //possibleQueryParams for a search in apps

    public function Search( $appNameToSearch, $szContentType = AirwatchServicesSearch::HTTP_DEFAULT_CONTENT_TYPE ){
        $uri = self::URI_MAM_APPS_APPLESTORE_SEARCH;

        $this->addParamsToQuery(array('appname' => $appNameToSearch));
        $playstoreAppsFound = $this->query($uri, $szContentType);

        return ( $playstoreAppsFound );
    }
}