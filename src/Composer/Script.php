<?php
/**
 * We need to use scripts to operate on the root package.  The Custom ModxInstaller will only
 * process any packages that are listed as dependencies, so if you are trying to install a 
 * MODX Package that in turn has MODX Packages as dependencies, then the scripts here handle the 
 * root package and the custom installer handles the packages that are listed in the required key.
 *
 * Composer methods: Array
(
[0] => setPackage
[1] => getPackage
[2] => setConfig
[3] => getConfig
[4] => setLocker
[5] => getLocker
[6] => setRepositoryManager
[7] => getRepositoryManager
[8] => setDownloadManager
[9] => getDownloadManager
[10] => setInstallationManager
[11] => getInstallationManager
[12] => setPluginManager
[13] => getPluginManager
[14] => setEventDispatcher
[15] => getEventDispatcher
[16] => setAutoloadGenerator
[17] => getAutoloadGenerator
)
 *
 * Event methods: Array
(
[0] => __construct
[1] => getOperation
[2] => getComposer
[3] => getIO
[4] => isDevMode
[5] => getName
[6] => getArguments
[7] => isPropagationStopped
[8] => stopPropagation
)
 *
 * Config methods: Array
(
[0] => __construct
[1] => setConfigSource
[2] => getConfigSource
[3] => setAuthConfigSource
[4] => getAuthConfigSource
[5] => merge
[6] => getRepositories
[7] => get
[8] => all
[9] => raw
[10] => has
)
 * See https://getcomposer.org/doc/articles/scripts.md
 */
namespace ModxInstaller\Composer;

class Script {

    /**
     * @return bool
     */
    public static function preInstall(\Composer\Script\PackageEvent $event) {
        $io = $event->getIO();
        if ($io->askConfirmation("Are you sure you want to proceed? ", false)) {
            // ok, continue on to composer install
            return true;
        }
    }

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
        
        $config = $composer->getConfig();
        
        $vars = get_object_vars($config);
        error_log('Config vars: '. print_r($vars,true));
        $methods = get_class_methods($config);
        error_log('Congif methods: '.print_r($methods,true));

         $src = $config->getConfigSource();
         error_log('Config contents: '.print_r($src, true));
        //error_log('Congig get: '.$config->get('type'));
//        error_log('Composer config '.print_r($config,true));        
//        error_log(print_r($composer->getPackageBasePath(), true));
     }
     
     public static function preUninstall(\Composer\Script\PackageEvent $event) {
        error_log(__CLASS__.'::'.__FUNCTION__.' called...');     
     }
}