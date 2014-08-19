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
     public static function postInstall(\Composer\Script\PackageEvent $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');
     }
     
     public static function postUpdate(\Composer\Script\PackageEvent $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');

        $vars = get_object_vars($event);
        error_log('Event vars: '. print_r($vars,true));
        $methods = get_class_methods($event);
        error_log('Event methods: '.print_r($methods,true));

        $composer = $event->getComposer();     
        
//        $installedPackage = $event->getOperation()->getPackage();
//        error_log(print_r($composer,true));
        $vars = get_object_vars($composer);
        error_log('Composer vars: '. print_r($vars,true));
        $methods = get_class_methods($composer);
        error_log('Composer methods: '.print_r($methods,true));
        
//        error_log(print_r($composer->getPackageBasePath(), true));
     }
     
     public static function preUninstall(\Composer\Script\PackageEvent $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');     
     }
}