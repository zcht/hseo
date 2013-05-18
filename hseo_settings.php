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
    
    // home, post   
    private $checkedItems = array('hseo_home_canonical', 'hseo_home_cache', 'hseo_home_index', 'hseo_home_follow',
                                'hseo_post_title', 'hseo_post_description', 'hseo_post_keywords', 'hseo_post_canonical',
                                'hseo_post_cache', 'hseo_post_follow', 'hseo_post_index', 'hseo_post_opengraph', 
                            );
    
    // static pages
    private $checkedPagesItems = array('hseo_staticpage_title', 'hseo_staticpage_description', 'hseo_staticpage_keywords',
                            'hseo_staticpage_canonical', 'hseo_staticpage_cache', 'hseo_staticpage_follow',
                            'hseo_staticpage_index', 'hseo_staticpage_opengraph'            
                        );

    // static pages title, description and keywords input
    private $textItems = array('hseo_staticpage_title_data', 'hseo_staticpage_description_data', 'hseo_staticpage_keywords_data');

        
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
        
        // post, home
        foreach ($this->checkedItems as $item) {
            $$item = isset($hseo_settings[$item]) ? $hseo_settings[$item] : '';
        } 
       
         // array of static pages
        $staticpages = $this->static_pages($h);
        //print_r($staticpages);
        
        // static pages
        foreach($staticpages as $currentKey ) { 
            foreach ($this->checkedPagesItems as $item) {                
                ${$item}[$currentKey] = isset($hseo_settings[$item . '_' . $currentKey]) ? $hseo_settings[$item . '_' . $currentKey] : '';                
            } 
            
            foreach ($this->textItems as $item) {                
                ${$item}[$currentKey] = isset($hseo_settings[$item . '_' . $currentKey]) ? $hseo_settings[$item . '_' . $currentKey] : '';                
            } 
        } 
        
        // hook in case another plugin wants to populate the values
        $h->pluginHook('hseo_settings_get_values');

        // form
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
        
        // post, home
        foreach ($this->checkedItems as $item) {
            if ($h->cage->post->keyExists($item)) { 
                $$item = 'checked';
            } else {
                $$item = '';
            }                        
        }                              

        $staticpages = $this->static_pages($h);
               
        // static pages
        foreach($staticpages as $currentKey) {
            foreach ($this->checkedPagesItems as $item) {
                if ($h->cage->post->keyExists($item . '_' . $currentKey)) { 
                    ${$item}[$currentKey] = 'checked';    // using curly brackets to avoid ambiguity with array involved instead of just $$item[$currentKey] 
                } else {
                    ${$item}[$currentKey] = '';
                }
            }       
                    
            foreach ($this->textItems as $item) {
                if ($h->cage->post->keyExists($item . '_' . $currentKey)) {                     
                    ${$item}[$currentKey] = $h->cage->post->sanitizeAll($item . '_' . $currentKey);
                } else {
                    ${$item}[$currentKey] = '';
                }
            }                                               
        }
                
        $h->pluginHook('hseo_save_settings');
        
        if ($error == 0) {
            // save settings
            
            // post, home
            foreach ($this->checkedItems as $item) {
                $hseo_settings[$item] = $$item;
            }                       
            
            // save static pages
            foreach($staticpages as $currentKey ) {
                foreach ($this->checkedPagesItems as $item) {
                    $hseo_settings[$item . '_' . $currentKey] = ${$item}[$currentKey];
                }

                foreach ($this->textItems as $item) {
                    $hseo_settings[$item . '_' . $currentKey] = ${$item}[$currentKey];
                }
            }
        
            $h->updateSetting('hseo_settings', serialize($hseo_settings));

            $h->message = $h->lang["main_settings_saved"];
            $h->messageType = "green alert-success";
        } else {
            $h->message = $h->lang["main_settings_not_saved"];
            $h->messageType = "alert-error";
        }
        
        $h->showMessage();
        
        return true;    
    }
    
    
    
}
?>