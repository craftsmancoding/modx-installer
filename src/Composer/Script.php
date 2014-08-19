<?php
/**
 * We need to use scripts to operate on the root package.  The Custom ModxInstaller will only
 * process any packages that are listed as dependencies, so if you are trying to install a 
 * MODX Package that in turn has MODX Packages as dependencies, then the scripts here handle the 
 * root package and the custom installer handles the packages that are listed in the required key.
 */
namespace ModxInstaller\Composer;

class Script {
     public static function postInstall() {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');
     }
     
     public static function postUpdate() {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');     
     }
     
     public static function preUninstall() {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');     
     }
}