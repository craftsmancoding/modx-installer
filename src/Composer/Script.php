<?php
/**
 * We need to use scripts to operate on the root package.  The Custom ModxInstaller will only
 * process any packages that are listed as dependencies, so if you are trying to install a
 * MODX Package that in turn has MODX Packages as dependencies, then the scripts here handle the
 * root package and the custom installer handles the packages that are listed in the required key.
 *
 * Composer methods: Array
 * (
 * [0] => setPackage
 * [1] => getPackage
 * [2] => setConfig
 * [3] => getConfig
 * [4] => setLocker
 * [5] => getLocker
 * [6] => setRepositoryManager
 * [7] => getRepositoryManager
 * [8] => setDownloadManager
 * [9] => getDownloadManager
 * [10] => setInstallationManager
 * [11] => getInstallationManager
 * [12] => setPluginManager
 * [13] => getPluginManager
 * [14] => setEventDispatcher
 * [15] => getEventDispatcher
 * [16] => setAutoloadGenerator
 * [17] => getAutoloadGenerator
 * )
 *
 * Event methods: Array
 * (
 * [0] => __construct
 * [1] => getOperation
 * [2] => getComposer
 * [3] => getIO
 * [4] => isDevMode
 * [5] => getName
 * [6] => getArguments
 * [7] => isPropagationStopped
 * [8] => stopPropagation
 * )
 *
 * Config methods: Array
 * (
 * [0] => __construct
 * [1] => setConfigSource
 * [2] => getConfigSource
 * [3] => setAuthConfigSource
 * [4] => getAuthConfigSource
 * [5] => merge
 * [6] => getRepositories
 * [7] => get
 * [8] => all
 * [9] => raw
 * [10] => has
 * )
 * See https://getcomposer.org/doc/articles/scripts.md
 */
namespace ModxInstaller\Composer;

class Script
{

    /**
     * @return bool
     */
    public static function preInstall(\Composer\Script\PackageEvent $event)
    {
        $package = $event->getComposer()->getPackage();
        if ($package->getType() !== 'modx-package') {
            return true;
        }
        // Does the package have any prompts?
        //$io = $event->getIO();
        //if ($io->askConfirmation("Are you sure you want to proceed? ", false)) {
        // ok, continue on to composer install
        return true;
        //}
    }

    public static function postInstall(\Composer\Script\PackageEvent $event)
    {
        $package = $event->getComposer()->getPackage();
        if ($package->getType() !== 'modx-package') {
            return;
        }
    }

    public static function postUpdate(\Composer\Script\PackageEvent $event)
    {
        $package = $event->getComposer()->getPackage();
        if ($package->getType() !== 'modx-package') {
            return;
        }
    }

    public static function preUninstall(\Composer\Script\PackageEvent $event)
    {
        $package = $event->getComposer()->getPackage();
        if ($package->getType() !== 'modx-package') {
            return;
        }
    }
}