<?php
/**
 * Acts as the bridge between Composer and MODX.  This class handles doing things in MODX.
 */
namespace ModxInstaller;

use modx;

class Bridge
{

    public $modx;

    /**
     * @param $modx (optional existing modx instance)
     */
    public function __construct($modx = null)
    {
        if ($modx) {
            if (is_a($modx, '\\Modx')) {
                $this->modx =& $modx;
            } else {
                throw new \Exception('Passed argument must be instance of Modx class.');
            }
        } else {
            $this->modx = $this->getMODX();
        }
    }

    /**
     * Verify a directory, converting for any OS variants and convert
     * any relative paths to absolute .
     *
     * @param string $path path (or relative path) to package
     * @return string full path with trailing slash
     */
    public static function getDir($path)
    {
        if (!is_scalar($path)) throw new \Exception('Invalid input. $path must be a scalar.');
        $realpath = strtr(realpath($path), '\\', '/');
        if (!file_exists($realpath)) {
            throw new \Exception('Directory does not exist: ' . $path);
        } elseif (!is_dir($realpath)) {
            throw new \Exception('Path is not a directory: ' . $realpath);
        }
        return preg_replace('#/+$#', '', $realpath) . '/';
    }


    /**
     * Finds the MODX instance in the current working directory, instantiates it and returns it.
     * Only requirement is that this file exists somewhere inside of a MODX directory (e.g. webroot).
     * This will sniff out a valid MODX_CORE_PATH and force the MODX_CONFIG_KEY too.
     * Syntax {$config_key}.inc.php
     *
     * @param string $dir optional directory to look in. Default: current dir
     * @return object modx instance
     */
    public static function getMODX($dir = '')
    {
        $dir = ($dir) ? $dir : dirname(__FILE__);

        if (!defined('MODX_CORE_PATH') && !defined('MODX_CONFIG_KEY')) {

            while (true) {
                if ($dir == '/') {
                    throw new \Exception('Could not find a valid MODX config.core.php file.');
                }

                if (file_exists($dir . '/config.core.php')) {
                    include $dir . '/config.core.php';
                    break;
                }

                $dir = dirname($dir);
            }
        }

        if (!defined('MODX_CORE_PATH') || !defined('MODX_CONFIG_KEY')) {
            throw new \Exception('MODX_CORE_PATH or MODX_CONFIG_KEY undefined in ' . $dir . '/config.core.php');
        }

        if (!file_exists(MODX_CORE_PATH . 'model/modx/modx.class.php')) {
            throw new \Exception('modx.class.php not found at ' . MODX_CORE_PATH);
        }


        // fire up MODX
        require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
        require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

        $modx = new modx();
        $modx->initialize('mgr');
        $modx->setLogLevel(\modX::LOG_LEVEL_INFO);
        $modx->setLogTarget('ECHO');
        flush();
        return $modx;
    }
    /**
     * Import pkg elements (Snippets,Chunks,Plugins,Templates) into MODX from the filesystem.
     * They will be marked as static elements.
     *
     * @param string $pkg_root_dir path to local package root (w trailing slash)
     */
//    public function import($pkg_root_dir)
//    {
//        $pkg_root_dir = self::getDir($pkg_root_dir);
//
//        // Is installed?
//        $namespace = $this->get('namespace');
//        if (!$Setting = $this->modx->getObject('modSystemSetting', array('key' => $namespace . '.version'))) {
//            throw new Exception('Package is not installed. Run "install" instead.');
//        }
//
//        // The gratis Category
//        $Category = $this->modx->getObject('modCategory', array('category' => $this->get('category')));
//        if (!$Category) {
//            $this->modx->log(modX::LOG_LEVEL_DEBUG, "Creating new category: " . $this->get('category'));
//            $Category = $this->modx->newObject('modCategory');
//            $Category->set('category', $this->get('category'));
//        } else {
//            $this->modx->log(modX::LOG_LEVEL_INFO, "Using existing category: " . $this->get('category'));
//        }
//
//        // Import Elements
//        $chunks = self::_get_elements('modChunk', $pkg_root_dir);
//        $plugins = self::_get_elements('modPlugin', $pkg_root_dir);
//        $snippets = self::_get_elements('modSnippet', $pkg_root_dir);
//        $tvs = self::_get_elements('modTemplateVar', $pkg_root_dir);
//        $templates = self::_get_elements('modTemplate', $pkg_root_dir);
//
//        if ($chunks) $Category->addMany($chunks);
//        if ($plugins) $Category->addMany($plugins);
//        if ($snippets) $Category->addMany($snippets);
//        if ($templates) $Category->addMany($templates);
//        if ($tvs) $Category->addMany($tvs);
//
//        if (!$this->get('dry_run') && $Category->save()) {
//            $data = $this->get_criteria('modCategory', $Category->toArray());
//            $this->modx->cacheManager->set('modCategory/' . $this->get('category'), $data, 0, self::$cache_opts);
//            $this->modx->log(modX::LOG_LEVEL_INFO, "Category created/updated: " . $this->get('category'));
//        }
//
//        if ($this->get('dry_run')) {
//            $msg = "\n==================================\n";
//            $msg .= "    Dry Run Enqueued Elements:\n";
//            $msg .= "===================================\n";
//            foreach (Repoman::$queue as $classname => $list) {
//                $msg .= "\n" . $classname . "\n" . str_repeat('-', strlen($classname)) . "\n";
//                foreach ($list as $k => $def) {
//                    $msg .= "    " . $k . "\n";
//                }
//            }
//            $this->modx->log(modX::LOG_LEVEL_INFO, $msg);
//        }
//    }
    //}

}
/*EOF*/