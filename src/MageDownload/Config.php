<?php
/**
 * Magedownload CLI
 *
 * PHP version 5
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload-cli
 */

namespace MageDownload;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Yaml;

/**
 * Config loader
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload-cli
 */
class Config
{
    const CONFIG_FILE_NAME   = 'config.yaml';
    const CONFIG_FOLDER_NAME = 'magedownload';

    /**
     * Config cache
     *
     * @var array|boolean|null
     */
    protected $config;

    /**
     * Is windows cache
     *
     * @var boolean
     */
    protected $isWindows;

    /**
     * Path to home directory
     *
     * @var string
     */
    protected $homeDirectory;

    /**
     * Full path to config fule
     *
     * @var string
     */
    protected $configFile;

    /**
     * Check for a config file and load it
     *
     * @return array
     */
    public function getConfig()
    {
        if ($this->config === null) {
            $configFile = $this->getConfigFile();
            if (file_exists($configFile)) {
                $this->config = Yaml::parse(file_get_contents($configFile));
            } else {
                $this->config = false;
            }
        }
        return $this->config;
    }

    /**
     * Save an updated user config
     *
     * @param array $config
     *
     * @return boolean
     */
    public function saveConfig(array $config)
    {
        $dumper = new Dumper();
        $oldConfig = $this->getConfig();
        if ($oldConfig !== false) {
            $config = array_merge($oldConfig, $config);
        }
        $this->config = null;
        if (!is_dir($dir = $this->getConfigDirectory())) {
            mkdir($dir, 750, true);
        }
        return file_put_contents($this->getConfigFile(), $dumper->dump($config, 2)) !== 0;
    }

    /**
     * Get the path to the config file
     *
     * @return string
     */
    protected function getConfigFile()
    {
        if ($this->configFile === null) {
            $this->configFile = $this->getConfigDirectory() . DIRECTORY_SEPARATOR . self::CONFIG_FILE_NAME;
        }
        return $this->configFile;
    }

    /**
     * Get the configuration storage directory
     *
     * @return string
     */
    protected function getConfigDirectory()
    {
        return $this->getHomeDirectory() . DIRECTORY_SEPARATOR
            . (!$this->isWindows() ? '.' : '') . self::CONFIG_FOLDER_NAME;
    }

    /**
     * Is this a windows env?
     *
     * @return boolean
     */
    protected function isWindows()
    {
        if ($this->isWindows === null) {
            $this->isWindows = strtolower(substr(PHP_OS, 0, 3)) === 'win';
        }
        return $this->isWindows;
    }

    /**
     * Get the home directory
     *
     * @return string
     */
    protected function getHomeDirectory()
    {
        if ($this->homeDirectory === null) {
            if ($this->isWindows()) {
                $this->homeDirectory = getenv('USERPROFILE');
            } else {
                $this->homeDirectory = getenv('HOME');
            }
        }
        return $this->homeDirectory;
    }

    /**
     * Get the account id from config file
     *
     * @return string|boolean
     */
    public function getAccountId()
    {
        $config = $this->getConfig();
        if (!$config || !isset($config['user']) || !isset($config['user']['id'])) {
            return false;
        }
        return $config['user']['id'];
    }

    /**
     * Get the access token from config file
     *
     * @return string|boolean
     */
    public function getAccessToken()
    {
        $config = $this->getConfig();
        if (!$config || !isset($config['user']) || !isset($config['user']['token'])) {
            return false;
        }
        return $config['user']['token'];
    }
}
