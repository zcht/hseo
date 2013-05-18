<?php
/**
 * name: hSEO
 * description: swiss knife for hotaru seo. with innovations from germany.
 * version: 0.4
 * folder: hseo
 * class: hSEO
 * type: toolbox
 * hooks: install_plugin, admin_sidebar_plugin_settings, admin_plugin_settings, admin_header_include_raw, header_meta, theme_index_top, admin_plugin_support
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

// security
if (!class_exists('hSEO')) {
	die();
}

class hSEO
{             
 


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
        
        if (!isset($hseo_settings['hseo_home_canonical'])) { $hseo_settings['hseo_home_canonical'] = 'checked'; }
        if (!isset($hseo_settings['hseo_home_cache'])) { $hseo_settings['hseo_home_cache'] = ''; }
        if (!isset($hseo_settings['hseo_home_index'])) { $hseo_settings['hseo_home_index'] = 'checked'; }
        if (!isset($hseo_settings['hseo_home_follow'])) { $hseo_settings['hseo_home_follow'] = 'checked'; }
        
        if (!isset($hseo_settings['hseo_post_title'])) { $hseo_settings['hseo_post_title'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_description'])) { $hseo_settings['hseo_post_description'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_keywords'])) { $hseo_settings['hseo_post_keywords'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_canonical'])) { $hseo_settings['hseo_post_canonical'] = 'checked'; }        
        if (!isset($hseo_settings['hseo_post_cache'])) { $hseo_settings['hseo_post_cache'] = ''; }
        if (!isset($hseo_settings['hseo_post_follow'])) { $hseo_settings['hseo_post_follow'] = 'checked'; }
        if (!isset($hseo_settings['hseo_post_index'])) { $hseo_settings['hseo_post_index'] = 'checked'; }        
        if (!isset($hseo_settings['hseo_post_opengraph'])) { $hseo_settings['hseo_post_opengraph'] = 'checked'; }
        
     
        $staticpages = $this->static_pages($h);
            
        foreach($staticpages as $currentKey ) {
            if (!isset($hseo_settings['hseo_staticpage_title_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }
            if (!isset($hseo_settings['hseo_staticpage_description_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }
            if (!isset($hseo_settings['hseo_staticpage_keywords_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }
            if (!isset($hseo_settings['hseo_staticpage_canonical_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }        
            if (!isset($hseo_settings['hseo_staticpage_cache_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = ''; }
            if (!isset($hseo_settings['hseo_staticpage_follow_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }
            if (!isset($hseo_settings['hseo_staticpage_index_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }        
            if (!isset($hseo_settings['hseo_staticpage_opengraph_'.$currentKey])) { $hseo_settings['hseo_staticpage_title_'.$currentKey] = 'checked'; }

            if (!$h->getSetting($hseo_settings['hseo_staticpage_title_data_'.$currentKey])) { $h->updateSetting($hseo_settings['hseo_staticpage_title_data_'.$currentKey], ''); }
            if (!$h->getSetting($hseo_settings['hseo_staticpage_description_data_'.$currentKey])) { $h->updateSetting($hseo_settings['hseo_staticpage_description_data_'.$currentKey], ''); }
            if (!$h->getSetting($hseo_settings['hseo_staticpage_keywords_data_'.$currentKey])) { $h->updateSetting($hseo_settings['hseo_staticpage_keywords_data_'.$currentKey], ''); }
           } 
        
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

        
    /**
    * 
    *
    * @param 
    * @param 
    * @return 
    */ 
    public function admin_header_include_raw($h)
    {
        if ($h->isSettingsPage('hseo')) {
            // bootstrap is now standard with core in v.1.5.0
            // you can remove line below after v.1.5.0 release
            echo '<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>'."\n";
            echo "<script type='text/javascript'>
                    $(document).ready(function () {
                    if ($(\"[rel=tooltip]\").length) {
                    $(\"[rel=tooltip]\").tooltip();
                    }
                  });
                 </script>";
        }
    }
   
//    public function admin_plugin_tabLabel_pre_first($h)
//    {            
//            echo '<li><a href="#settings" data-toggle="tab">Settings</a></li>';
//    }        
//
//    public function admin_plugin_tabContent_pre_first($h)
//    {                                    
//            $staticpages = $this->static_pages($h);
//            echo '<div class="tab-pane" id="settings">';     
//                include('templates/hseo_settings.php');
//            echo '</div>';
//    }

    /**
    * Admin support for plugin
    */
    public function admin_plugin_support($h)
    {
            echo "<p>You can see Example on <a href='http://www.trendkraft.de'>www.trendkraft.de</a></p>";
    }  
    
    
    public function static_pages($h){

        $themes = $h->getFiles(THEMES, array('404error.php'));
        if (is_array($themes)) {
            if (array_search(rtrim(THEME, '/'), $themes)) $dir = THEMES . THEME;
//                foreach ($themes as $theme) { 
//                        if ($theme == rtrim(THEME, '/')) {
//                                $dir = THEMES . THEME;
//                               // print_r($dir);
//                        }
//                }
        }

         //Das Ziel-Array
        $file_array = Array();
        $denied_staticpage = array( '404error', 'header', 'index', 'footer', 'sidebar', 'navigation', 'settings', 'support', 'bookmarking_sort_filter', 'all', 'popular', 'upcoming', 'latest', 'pluginsdisabled', 'tag-cloud', '', '', '');  
                
        //Wenn das Verzeichnis existiert...
        if(is_dir($dir))    {
            //...öffne das Verzeichnis
            $handle = opendir($dir);
            //Wenn das Verzeichnis geöffnet werden konnte...
            if(is_resource($handle))    {
                //...lese die enthaltenen Dateien aus,...
                while($file = readdir($handle))    {
                    //...prüfe ob es Directory-Verweise sind...
                    if($file != "." && $file != "..")
                        //...und schreibe sie in das Ziel-Array
                        $filename = pathinfo($dir."/" .$file);
                        if (@$filename['extension'] == "php") { // @ fehler unterdrücken
                            array_push($file_array, $filename['filename']);
                        }
                }
            }else{
                echo "Das &Ouml;ffnen des Verzeichnisses ist fehlgeschlagen";
            }
        }else{
            echo "Das Verzeichnis existiert nicht";
        }
        //Zum Schluss wird das Array ausgegeben
//        print_r($file_array);
        $file_array = array_diff($file_array, $denied_staticpage);
        return $file_array;
        
    }
    
    
}
?>