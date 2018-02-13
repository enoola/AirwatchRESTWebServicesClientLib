<?php
/**
 * Created by PhpStorm.
 * User: enola
 * Date: 15/01/2018
 * Time: 14:09
 */

namespace PhPeteur\AirwatchWebservices\Services;


class AirwatchMAMAppsPlayStoreSearch extends AirwatchMAMApps
{
    const URI_MAM_APPS_PLAYSTORE_SEARCH = parent::URI_MAM_APPS . '/playstore/search';
    //possibleQueryParams for a search in apps

    public function Search( $appNameToSearch ){
        $uri = self::URI_MAM_APPS_PLAYSTORE_SEARCH;

        $this->addParamsToQuery(array('appname' => $appNameToSearch));
        $playstoreAppsFound = $this->query($uri);

        return ( $playstoreAppsFound );
    }
}