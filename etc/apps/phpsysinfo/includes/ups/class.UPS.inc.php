<?php 
/**
 * Basic UPS Class
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PSI_UPS
 * @author    Michael Cramer <BigMichi1@users.sourceforge.net>
 * @copyright 2009 phpSysInfo
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   SVN: $Id: class.UPS.inc.php 333 2009-09-12 09:22:20Z bigmichi1 $
 * @link      http://phpsysinfo.sourceforge.net
 */
 /**
 * Basic UPS functions for all UPS classes
 *
 * @category  PHP
 * @package   PSI_UPS
 * @author    Michael Cramer <BigMichi1@users.sourceforge.net>
 * @copyright 2009 phpSysInfo
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   Release: 3.0
 * @link      http://phpsysinfo.sourceforge.net
 */
abstract class UPS implements PSI_Interface_UPS
{
    /**
     * object for error handling
     *
     * @var Error
     */
    protected $error;
    
    /**
     * main object for ups information
     *
     * @var UPSInfo
     */
    protected $upsinfo;
    
    /**
     * build the global Error object
     */
    public function __construct()
    {
        $this->error = Error::singleton();
        $this->upsinfo = new UPSInfo();
    }
    
    /**
     * build and return the ups information
     *
     * @see PSI_Interface_UPS::getUPSInfo()
     *
     * @return UPSInfo
     */
    public final function getUPSInfo()
    {
        $this->build();
        return $this->upsinfo;
    }
}
?>
