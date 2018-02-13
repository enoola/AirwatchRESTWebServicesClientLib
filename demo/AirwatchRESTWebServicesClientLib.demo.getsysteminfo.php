<?php

/*
 * this demonstrate basic usage of the lib ;)
 * here we'll call AirwatchSystemInfo::getInfos, which makes a query to (host/api/system/info)
 * you shall have a file name config.yml in order for it to work
 */


require('../src/PhPeteur/AirwatchWebservices/Services/Airwatch.php');
require('../src/PhPeteur/AirwatchWebservices/Services/AirwatchSystemInfo.php');


require (__DIR__.'/../vendor/autoload.php');

use PhPeteur\AirwatchWebservices\Services;
use Symfony\Component\Yaml\Yaml;


$configfile = __DIR__.'/config.yml';
if (!file_exists($configfile) || !is_readable($configfile)) {
    die('Please copy config.yml.dist to config.yml'.PHP_EOL);
}
$cfg = Yaml::parseFile($configfile);

$oAWSysInfo = new Services\AirwatchSystemInfo($cfg);


print_r( $oAWSysInfo->getInfos() );

/*
 * output shall be something like this
Array
(
    [uri] => https://cn1007.awmdm.com/api/system/info
    [status] => 200 OK
    [data] => Array
        (
            [ProductName] => AirWatch Platform Service
            [ProductCopyright] => Copyright © AirWatch 2015
            [ProductVersion] => 9.1.x.x
            [Version] => 1
            [Resources] => Array
                (
                    [Collections] => Array
                        (
                        )

                    [Workspaces] => Array
                        (
                            [0] => Array
                                (
                                    [Name] => Mobile Device Management
                                    [Location] => https://cnXYZ.awmdm.com/API/mdm
                                )

                            [1] => Array
                                (
                                    [Name] => Mobile Application Management
                                    [Location] => https://cnXYZ.awmdm.com/API/mam
                                )

                            [2] => Array
                                (
                                    [Name] => Mobile Content Management
                                    [Location] => https://cnXYZ.awmdm.com/API/mcm
                                )

                            [3] => Array
                                (
                                    [Name] => Mobile Email Management
                                    [Location] => https://cnXYZ.awmdm.com/API/mem
                                )

                            [4] => Array
                                (
                                    [Name] => System Administration
                                    [Location] => https://cnXYZ.awmdm.com/API/system
                                )

                        )

                )

        )

)
 */