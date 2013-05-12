<?php
/**
 * name: hSEO
 * description: swiss knife for hotaru seo. with innovations from germany.
 * version: 0.2
 * folder: hseo
 * class: hSEO
 * extends: tags
 * type: toolbox
 * hooks: install_plugin, admin_sidebar_plugin_settings, admin_plugin_settings, header_meta, theme_index_top
 * author: Andreas Votteler
 * authorurl: http://www.trendkraft.de
 *
 * PHP version 5
 *
 * LICENSE: Hotaru CMS is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License as 
 * published by the Free Software Foundation, either version 3 of 
 * the License, or (at your option) any later version. 
 *
 * Hotaru CMS is distributed in the hope that it will be useful, but WITHOUT 
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE. 
 *
 * You should have received a copy of the GNU General Public License along 
 * with Hotaru CMS. If not, see http://www.gnu.org/licenses/.
 * 
 * @category  Content Management System
 * @package   HotaruCMS
 * @author    Nick Ramsay <admin@hotarucms.org>
 * @copyright Copyright (c) 2013, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://www.hotarucms.org/
 */

class hSEO extends Tags
{    
        
    private $settings = false;
    private $succesm = false;
    
    public $seofuncs;
       
    /**
    * 
    *
    * @param 
    * @param 
    * @return 
    */ 
        function __construct() {
            
//        require_once(PLUGINS . 'hseo/libs/hSEOFunctions.php');
//        $seofuncs = new hSEO_Functions($h);
//        $seofuncs->hseo_post_redirect($h);
        
    }
    
    /**
    * 
    *
    * @param 
    * @param 
    * @return 
    */ 
    public function install_plugin($h)
    {
        
        $hseo_settings = $h->getSerializedSettings();
        
        if (!isset($hseo_settings['hseo_post_title'])) { $hseo_settings['hseo_post_title'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_description'])) { $hseo_settings['hseo_post_description'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_keywords'])) { $hseo_settings['hseo_post_keywords'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_canonical'])) { $hseo_settings['hseo_post_canonical'] = 'checked'; }
        
        if (!isset($hseo_settings['hseo_post_cache'])) { $hseo_settings['hseo_post_cache'] = ''; }
        if (!isset($hseo_settings['hseo_post_follow'])) { $hseo_settings['hseo_post_follow'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_index'])) { $hseo_settings['hseo_post_index'] = 'checked'; }
        
        if (!isset($hseo_settings['hseo_post_opengraph'])) { $hseo_settings['hseo_post_opengraph'] = 'checked'; }
        
        $this->settings = $hseo_settings;
        $h->updateSetting('hseo_settings', serialize($hseo_settings));

    }
    
    
    /**
    * 
    *
    * @param 
    * @param 
    * @return 
    */ 
    public function theme_index_top($h)
    {
            require_once(PLUGINS . 'hseo/libs/hSEOFunctions.php');
            $f = new hSEO_Functions($h);
            $f->hseo_leverage_browser_caching($h);
    }

        
    /**
    * 
    *
    * @param 
    * @param 
    * @return 
    */ 
    public function header_meta($h)
        {    
            require_once(PLUGINS . 'hseo/libs/hSEOFunctions.php');
            $f = new hSEO_Functions($h);
            
            $f->hseo_post_redirect($h);
            $f->getmeta($h);
           
        }

}

?>