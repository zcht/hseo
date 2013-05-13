<?php
/**
 * File: /plugins/hseo/hseo_settings.php
 * Purpose: Admin settings for the hseo plugin
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
 * @author    shibuya246 <admin@hotarucms.org>
 * @copyright Copyright (c) 2009, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://www.hotarucms.org/
 */
 
class hSEOSettings
{
     /**
     * Admin settings for hseo
     */
    public function settings($h)
    {
        // If the form has been submitted, go and save the data...
        if ($h->cage->post->getAlpha('submitted') == 'true') { 
            $this->saveSettings($h); 
        }
        
        //echo "<h1>" . $h->lang["hseo_settings_header"] . "</h1>\n";
        
        // Get settings from database if they exist...
        $hseo_settings = $h->getSerializedSettings();
        
        $hseo_post_title = $hseo_settings['hseo_post_title'];
        $hseo_post_description = $hseo_settings['hseo_post_description'];
        $hseo_post_keywords = $hseo_settings['hseo_post_keywords'];
        $hseo_post_canonical = $hseo_settings['hseo_post_canonical'];
        $hseo_post_cache = $hseo_settings['hseo_post_cache'];
        $hseo_post_follow = $hseo_settings['hseo_post_follow'];
        $hseo_post_index = $hseo_settings['hseo_post_index'];
        $hseo_post_opengraph = $hseo_settings['hseo_post_opengraph'];        

        $h->pluginHook('hseo_settings_get_values');
        
        
        //...otherwise set to blank:
        if (!$hseo_post_title) { $hseo_post_title = ''; } 
        if (!$hseo_post_description) { $hseo_post_description = ''; }
        if (!$hseo_post_keywords) { $hseo_post_keywords = ''; }
        if (!$hseo_post_canonical) { $hseo_post_canonical = ''; } 
        if (!$hseo_post_cache) { $hseo_post_cache = ''; }
        if (!$hseo_post_follow) { $hseo_post_follow = ''; }
        if (!$hseo_post_index) { $hseo_post_index = ''; } 
        if (!$hseo_post_opengraph) { $hseo_post_opengraph = ''; }

            
        echo "<form name='hseo_settings_form' action='" . BASEURL . "admin_index.php?page=plugin_settings&amp;plugin=hseo' method='post'>\n";
        
        echo "<hr><p>" . $h->lang["hseo_settings_instructions"] . "</p>";
        
        echo "<h3>Posts Einstellungen</h3>";
        
        echo "<p><input type='checkbox' name='hseo_post_title' value='hseo_post_title' " . $hseo_post_title . " >&nbsp;&nbsp;" . $h->lang["hseo_post_title"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_description' value='hseo_post_description' " . $hseo_post_description . " >&nbsp;&nbsp;" . $h->lang["hseo_post_description"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_keywords' value='hseo_post_keywords' " . $hseo_post_keywords . " >&nbsp;&nbsp;" . $h->lang["hseo_post_keywords"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_canonical' value='hseo_post_canonical' " . $hseo_post_canonical . " >&nbsp;&nbsp;" . $h->lang["hseo_post_canonical"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_cache' value='hseo_post_cache' " . $hseo_post_cache . " >&nbsp;&nbsp;" . $h->lang["hseo_post_cache"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_follow' value='hseo_post_follow' " . $hseo_post_follow . " >&nbsp;&nbsp;" . $h->lang["hseo_post_follow"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_index' value='hseo_post_index' " . $hseo_post_index . " >&nbsp;&nbsp;" . $h->lang["hseo_post_index"] . "</p>\n";
        echo "<p><input type='checkbox' name='hseo_post_opengraph' value='hseo_post_opengraph' " . $hseo_post_opengraph . " >&nbsp;&nbsp;" . $h->lang["hseo_post_opengraph"] . "</p>\n";

        $h->pluginHook('hseo_settings_form');
                
        echo "<br />\n";    
        echo "<input type='hidden' name='submitted' value='true' />\n";
        echo "<input type='submit' value='" . $h->lang["main_form_save"] . "' />\n";
        echo "<input type='hidden' name='csrf' value='" . $h->csrfToken . "' />\n";
        echo "</form>\n";
    }
    
    
     /**
     * Save admin settings for hseo
     *
     * @return true
     */
    public function saveSettings($h)
    {
        $error = 0;      
        
        // test post cache robot
        if ($h->cage->post->keyExists('hseo_post_title')) { 
            $hseo_post_title = 'checked';
        } else {
            $hseo_post_title = '';
        }

        if ($h->cage->post->keyExists('hseo_post_description')) { 
            $hseo_post_description = 'checked';
        } else {
            $hseo_post_description = '';
        }

         if ($h->cage->post->keyExists('hseo_post_keywords')) { 
            $hseo_post_keywords = 'checked';
        } else {
            $hseo_post_keywords = '';
        }
        
        if ($h->cage->post->keyExists('hseo_post_canonical')) { 
            $hseo_post_canonical = 'checked';
        } else {
            $hseo_post_canonical = '';
        }
        
        if ($h->cage->post->keyExists('hseo_post_cache')) { 
            $hseo_post_cache = 'checked';
        } else {
            $hseo_post_cache = '';
        }
        
        if ($h->cage->post->keyExists('hseo_post_follow')) { 
            $hseo_post_follow = 'checked';
        } else {
            $hseo_post_follow = '';
        }
        
        if ($h->cage->post->keyExists('hseo_post_index')) { 
            $hseo_post_index = 'checked';
        } else {
            $hseo_post_index = '';
        }
        
        if ($h->cage->post->keyExists('hseo_post_opengraph')) { 
            $hseo_post_opengraph = 'checked';
        } else {
            $hseo_post_opengraph = '';
        }
        
        
        $h->pluginHook('hseo_save_settings');
        
        if ($error == 0) {
            // save settings
            $hseo_settings['hseo_post_title'] = $hseo_post_title;
            $hseo_settings['hseo_post_description'] = $hseo_post_description;
            $hseo_settings['hseo_post_keywords'] = $hseo_post_keywords;
            $hseo_settings['hseo_post_canonical'] = $hseo_post_canonical;
            $hseo_settings['hseo_post_cache'] = $hseo_post_cache;
            $hseo_settings['hseo_post_follow'] = $hseo_post_follow;
            $hseo_settings['hseo_post_index'] = $hseo_post_index;
            $hseo_settings['hseo_post_opengraph'] = $hseo_post_opengraph;
            
            $h->updateSetting('hseo_settings', serialize($hseo_settings));
            
            $h->message = $h->lang["main_settings_saved"];
            $h->messageType = "green alert-success";
        }
        $h->showMessage();
        
        return true;    
    }
    
}
?>