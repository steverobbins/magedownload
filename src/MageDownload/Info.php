<?php
/**
 * Magedownload
 *
 * PHP version 5
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload
 */

namespace MageDownload;

/**
 * Get download info
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload
 */
class Info extends AbstractMageDownload
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
