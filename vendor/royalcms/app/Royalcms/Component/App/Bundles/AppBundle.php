<?php

namespace Royalcms\Component\App\Bundles;

use Royalcms\Component\App\Contracts\BundlePackage;
use Royalcms\Component\App\BundleAbstract;

class AppBundle extends BundleAbstract implements BundlePackage
{
    
    public function __construct($app_floder, $app_alias = null)
    {
        $this->directory = $app_floder;
        
        if (is_null($app_alias)) {
            $this->alias = $app_floder;
        } else {
            $this->alias = $app_alias;
        }
        
        $this->package = $this->appPackage();
        
        $this->identifier = $this->package['identifier'];
        
        $this->namespace = $this->package['namespace'];
        
        $this->site = defined('RC_SITE') ? RC_SITE : 'default';
        
        $this->makeControllerPath();
    }
    
    
    protected function makeControllerPath()
    {
        $this->controllerPath = $this->getAbsolutePath();
    }
    
    
    /**
     * 获取目录的绝对路径
     *
     * @param string $name
     */
    public function getAbsolutePath()
    {
        if ($this->site == 'default') {
            $path = RC_APP_PATH . $this->directory . DIRECTORY_SEPARATOR;
        }
        else {
            $path = SITE_APP_PATH . $this->directory . DIRECTORY_SEPARATOR;
            if (! file_exists($path)) {
                $path = RC_APP_PATH . $this->directory . DIRECTORY_SEPARATOR;
            }
        }
        
        return $path;
    }
    
    
    public function getNamespace()
    {
        return 'app-'.$this->directory;
    }
    
}

// end