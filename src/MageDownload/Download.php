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
 * Get a file
 *
 * @category  MageDownload
 * @package   MageDownload
 * @author    Steve Robbins <steve@steverobbins.com>
 * @copyright 2015 Steve Robbins
 * @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 * @link      https://github.com/steverobbins/magedownload
 */
class Download extends AbstractMageDownload
{
    /**
     * Get a file from the download api
     *
     * @param $file    string
     * @param $id      string
     * @param $token   string
     *
     * @return string
     */
    public function get($file, $id, $token)
    {
        $this->setId($id);
        $this->setToken($token);
        return $this->action('file', $file);
    }
}
