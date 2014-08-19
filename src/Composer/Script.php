<?php
/**
 * We need to use scripts to operate on the root package.  The Custom ModxInstaller will only
 * process any packages that are listed as dependencies, so if you are trying to install a 
 * MODX Package that in turn has MODX Packages as dependencies, then the scripts here handle the 
 * root package and the custom installer handles the packages that are listed in the required key.
 *
 * See https://getcomposer.org/doc/articles/scripts.md
 */
namespace ModxInstaller\Composer;

class Script {
     public static function postInstall(Event $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');
     }
     
     public static function postUpdate(Event $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');
        $composer = $event->getComposer();     
        $installedPackage = $event->getOperation()->getPackage();
        error_log(print_r($installedPackage,true));
     }
     
     public static function preUninstall(Event $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');     
     }
}