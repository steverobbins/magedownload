<?php
/**
 * Magento Download
 *
 * PHP version 5
 *
 * @category  MagentoDownload
 * @package   MagentoDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magento-download
 */

namespace MagentoDownload;

/**
 * Get download info
 *
 * @category  MagentoDownload
 * @package   MagentoDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magento-download
 */
class Info extends AbstractMagentoDownload
{
    /**
     * Send a command to the info api
     *
     * @param $command string
     * @param $id      string
     * @param $token   string
     *
     * @return string
     */
    public function sendCommand($command, $id, $token)
    {
        $this->setId($id);
        $this->setToken($token);
        return $this->action('info', $command);
    }
}
