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
 
class hSEOSettings extends hSEO
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
        
        // Get settings from database if they exist...
        $hseo_settings = $h->getSerializedSettings();

        $hseo_home_canonical = $hseo_settings['hseo_home_canonical'];
        $hseo_home_cache = $hseo_settings['hseo_home_cache'];
        $hseo_home_index = $hseo_settings['hseo_home_index'];
        $hseo_home_follow = $hseo_settings['hseo_home_follow'];
        
        $hseo_post_title = $hseo_settings['hseo_post_title'];
        $hseo_post_description = $hseo_settings['hseo_post_description'];
        $hseo_post_keywords = $hseo_settings['hseo_post_keywords'];
        $hseo_post_canonical = $hseo_settings['hseo_post_canonical'];
        $hseo_post_cache = $hseo_settings['hseo_post_cache'];
        $hseo_post_follow = $hseo_settings['hseo_post_follow'];
        $hseo_post_index = $hseo_settings['hseo_post_index'];
        $hseo_post_opengraph = $hseo_settings['hseo_post_opengraph'];        

         //  array of static pages
        $staticpages = $this->static_pages($h);
        //print_r($staticpages);
        
        foreach($staticpages as $currentKey ) { 
            $hseo_staticpage_title[$currentKey] = isset($hseo_settings['hseo_staticpage_title_'.$currentKey]) ? $hseo_settings['hseo_staticpage_title_'.$currentKey] : '';
            $hseo_staticpage_description[$currentKey] = isset($hseo_settings['hseo_staticpage_description_'.$currentKey]) ? $hseo_settings['hseo_staticpage_description_'.$currentKey] : '';
            $hseo_staticpage_keywords[$currentKey] = isset($hseo_settings['hseo_staticpage_keywords_'.$currentKey]) ? $hseo_settings['hseo_staticpage_keywords_'.$currentKey] : '';
            $hseo_staticpage_canonical[$currentKey] = isset($hseo_settings['hseo_staticpage_canonical_'.$currentKey]) ? $hseo_settings['hseo_staticpage_canonical_'.$currentKey] : '';
            $hseo_staticpage_cache[$currentKey] = isset($hseo_settings['hseo_staticpage_cache_'.$currentKey]) ? $hseo_settings['hseo_staticpage_cache_'.$currentKey] : '';
            $hseo_staticpage_follow[$currentKey] = isset($hseo_settings['hseo_staticpage_follow_'.$currentKey]) ? $hseo_settings['hseo_staticpage_follow_'.$currentKey] : '';
            $hseo_staticpage_index[$currentKey] = isset($hseo_settings['hseo_staticpage_index_'.$currentKey]) ? $hseo_settings['hseo_staticpage_index_'.$currentKey] : '';
            $hseo_staticpage_opengraph[$currentKey] = isset($hseo_settings['hseo_staticpage_opengraph_'.$currentKey]) ? $hseo_settings['hseo_staticpage_opengraph_'.$currentKey] : '';
            
            $hseo_staticpage_title_data[$currentKey] = isset($hseo_settings['hseo_staticpage_title_data_'.$currentKey]) ? $hseo_settings['hseo_staticpage_title_data_'.$currentKey] : '';
       
        } 
        
        $h->pluginHook('hseo_settings_get_values');
        
        
        //...otherwise set to blank:
        if (!$hseo_home_canonical) { $hseo_home_canonical = ''; } 
        if (!$hseo_home_cache) { $hseo_home_cache = ''; } 
        if (!$hseo_home_index) { $hseo_home_index = ''; } 
        if (!$hseo_home_follow) { $hseo_home_follow = ''; }
        
        if (!$hseo_post_title) { $hseo_post_title = ''; } 
        if (!$hseo_post_description) { $hseo_post_description = ''; }
        if (!$hseo_post_keywords) { $hseo_post_keywords = ''; }
        if (!$hseo_post_canonical) { $hseo_post_canonical = ''; } 
        if (!$hseo_post_cache) { $hseo_post_cache = ''; }
        if (!$hseo_post_follow) { $hseo_post_follow = ''; }
        if (!$hseo_post_index) { $hseo_post_index = ''; } 
        if (!$hseo_post_opengraph) { $hseo_post_opengraph = ''; }
        
        foreach($staticpages as $currentKey ) {
             if (!$hseo_staticpage_title[$currentKey]) { $hseo_staticpage_title[$currentKey] = ''; }
             if (!$hseo_staticpage_description[$currentKey]) { $hseo_staticpage_description[$currentKey] = ''; }
             if (!$hseo_staticpage_keywords[$currentKey]) { $hseo_staticpage_keywords[$currentKey] = ''; }
             if (!$hseo_staticpage_canonical[$currentKey]) { $hseo_staticpage_canonical[$currentKey] = ''; }
             if (!$hseo_staticpage_cache[$currentKey]) { $hseo_staticpage_cache[$currentKey] = ''; }
             if (!$hseo_staticpage_follow[$currentKey]) { $hseo_staticpage_follow[$currentKey] = ''; }
             if (!$hseo_staticpage_index[$currentKey]) { $hseo_staticpage_index[$currentKey] = ''; }
             if (!$hseo_staticpage_opengraph[$currentKey]) { $hseo_staticpage_opengraph[$currentKey] = ''; }  
             
             if (!$hseo_staticpage_title_data[$currentKey]) { $hseo_staticpage_title_data[$currentKey] = ''; } 
             
        } 
        
        echo "<form name='hseo_settings_form' action='" . BASEURL . "admin_index.php?page=plugin_settings&amp;plugin=hseo' method='post'>\n";
        
        include('templates/hseo_settings.php');
        
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
        
        // home
        if ($h->cage->post->keyExists('hseo_home_canonical')) { 
            $hseo_home_canonical = 'checked';
        } else {
            $hseo_home_canonical = '';
        }

        if ($h->cage->post->keyExists('hseo_home_cache')) { 
            $hseo_home_cache = 'checked';
        } else {
            $hseo_home_cache = '';
        }
        
        if ($h->cage->post->keyExists('hseo_home_index')) { 
            $hseo_home_index = 'checked';
        } else {
            $hseo_home_index = '';
        }
        
        if ($h->cage->post->keyExists('hseo_home_follow')) { 
            $hseo_home_follow = 'checked';
        } else {
            $hseo_home_follow = '';
        }
        
        // post
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
        
        
        
        // static pages
        $staticpages = $this->static_pages($h);
        foreach($staticpages as $currentKey ) {
        
        if ($h->cage->post->keyExists('hseo_staticpage_title_'.$currentKey)) { 
            $hseo_staticpage_title[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_title[$currentKey] = '';
        }

        if ($h->cage->post->keyExists('hseo_staticpage_description_'.$currentKey)) { 
            $hseo_staticpage_description[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_description[$currentKey] = '';
        }

         if ($h->cage->post->keyExists('hseo_staticpage_keywords_'.$currentKey)) { 
            $hseo_staticpage_keywords[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_keywords[$currentKey] = '';
        }
        
        if ($h->cage->post->keyExists('hseo_staticpage_canonical_'.$currentKey)) { 
            $hseo_staticpage_canonical[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_canonical[$currentKey] = '';
        }
        
        if ($h->cage->post->keyExists('hseo_staticpage_cache_'.$currentKey)) { 
            $hseo_staticpage_cache[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_cache[$currentKey] = '';
        }
        
        if ($h->cage->post->keyExists('hseo_staticpage_follow_'.$currentKey)) { 
            $hseo_staticpage_follow[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_follow[$currentKey] = '';
        }
        
        if ($h->cage->post->keyExists('hseo_staticpage_index_'.$currentKey)) { 
            $hseo_staticpage_index[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_index[$currentKey] = '';
        }
        
        if ($h->cage->post->keyExists('hseo_staticpage_opengraph_'.$currentKey)) { 
            $hseo_staticpage_opengraph[$currentKey] = 'checked';
        } else {
            $hseo_staticpage_opengraph[$currentKey] = '';
        }
        
        // static pages title, description and keywords input
        // http://localhost/tkdev/admin_index.php?page=plugin_settings&plugin=hseo
       // print_r($hseo_staticpage_title_data[$currentKey]);
       if ($h->cage->post->keyExists('hseo_staticpage_title_data_'.$currentKey)) { 
             $hseo_staticpage_title_data[$currentKey] = $h->cage->post->testAlnumLines('hseo_staticpage_title_data_'.$currentKey);
        } else {
            $hseo_staticpage_title_data[$currentKey] = '';
        }
        
        
        
        }
                
        $h->pluginHook('hseo_save_settings');
        
        if ($error == 0) {
            // save settings
            $hseo_settings['hseo_home_canonical'] = $hseo_home_canonical;
            $hseo_settings['hseo_home_cache'] = $hseo_home_cache;
            $hseo_settings['hseo_home_index'] = $hseo_home_index;
            $hseo_settings['hseo_home_follow'] = $hseo_home_follow;

            $hseo_settings['hseo_post_title'] = $hseo_post_title;
            $hseo_settings['hseo_post_description'] = $hseo_post_description;
            $hseo_settings['hseo_post_keywords'] = $hseo_post_keywords;
            $hseo_settings['hseo_post_canonical'] = $hseo_post_canonical;
            $hseo_settings['hseo_post_cache'] = $hseo_post_cache;
            $hseo_settings['hseo_post_follow'] = $hseo_post_follow;
            $hseo_settings['hseo_post_index'] = $hseo_post_index;
            $hseo_settings['hseo_post_opengraph'] = $hseo_post_opengraph;
            
        foreach($staticpages as $currentKey ) {
            $hseo_settings['hseo_staticpage_title_'.$currentKey] = $hseo_staticpage_title[$currentKey];
            $hseo_settings['hseo_staticpage_description_'.$currentKey] = $hseo_staticpage_description[$currentKey];
            $hseo_settings['hseo_staticpage_keywords_'.$currentKey] = $hseo_staticpage_keywords[$currentKey];
            $hseo_settings['hseo_staticpage_canonical_'.$currentKey] = $hseo_staticpage_canonical[$currentKey];
            $hseo_settings['hseo_staticpage_cache_'.$currentKey] = $hseo_staticpage_cache[$currentKey];
            $hseo_settings['hseo_staticpage_follow_'.$currentKey] = $hseo_staticpage_follow[$currentKey];
            $hseo_settings['hseo_staticpage_index_'.$currentKey] = $hseo_staticpage_index[$currentKey];
            $hseo_settings['hseo_staticpage_opengraph_'.$currentKey] = $hseo_staticpage_opengraph[$currentKey];
            
          //  $h->updateSetting('hseo_staticpage_title_'.$currentKey, $hseo_staticpage_title_data[$currentKey]);
            $hseo_settings['hseo_staticpage_title_data_'.$currentKey] = $hseo_staticpage_title_data[$currentKey];
        }

        
            $h->updateSetting('hseo_settings', serialize($hseo_settings));
            
            $h->message = $h->lang["main_settings_saved"];
            $h->messageType = "green alert-success";
        }
        $h->showMessage();
        
        return true;    
    }
    
    
    
}
?>