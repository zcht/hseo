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
////        echo "<h1>" . $h->lang["hseo_settings_header"] . "</h1>\n";
                // If the form has been submitted, go and save the data...
        if ($h->cage->post->getAlpha('submitted') == 'true') { 
            $this->saveSettings($h); 
        }
        
        //  array of static pages
        $staticpages = $this->static_pages($h);
        //print_r($staticpages);
        
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

        foreach($staticpages as $currentKey ) { 
            $hseo_staticpage_title[$currentKey] = $hseo_settings['hseo_staticpage_title_'.$currentKey];
            $hseo_staticpage_description[$currentKey] = $hseo_settings['hseo_staticpage_description_'.$currentKey];
            $hseo_staticpage_keywords[$currentKey] = $hseo_settings['hseo_staticpage_keywords_'.$currentKey];
            $hseo_staticpage_canonical[$currentKey] = $hseo_settings['hseo_staticpage_canonical_'.$currentKey];
            $hseo_staticpage_cache[$currentKey] = $hseo_settings['hseo_staticpage_cache_'.$currentKey];
            $hseo_staticpage_follow[$currentKey] = $hseo_settings['hseo_staticpage_follow_'.$currentKey];
            $hseo_staticpage_index[$currentKey] = $hseo_settings['hseo_staticpage_index_'.$currentKey];
            $hseo_staticpage_opengraph[$currentKey] = $hseo_settings['hseo_staticpage_opengraph_'.$currentKey];
            
            $hseo_staticpage_title_data[$currentKey] = $hseo_settings['hseo_staticpage_title_data_'.$currentKey];
  

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
        
?>

<h1><?php echo $h->lang["hseo_settings_header"]; ?></h1>
<p class="breadcrumb"><?php echo $h->lang["hseo_settings_instructions"]; ?></p>

    <ul class="nav nav-tabs" id="hSEOSettings_Tab">                         
        <li class="active"><a href="#home" data-toggle="tab">Dashboard</a></li>
        <li><a href="#meta" data-toggle="tab">Edit meta</a></li>
        <li><a href="#support" data-toggle="tab">Support</a></li>
        <li><a href="#about" data-toggle="tab">About</a></li>                    
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <table class="table table-striped">
  <thead>
      <tr><h3><?php //echo $h->lang["hseo_settings"]; ?></h3></tr>
    <tr>
      <th style="width: 15%"></th>  
      <th style="width: 10%; text-align: center;">Title <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_title"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Description <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_description"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Keywords <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_keywords"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Canonical <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_canonical"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Open Graph <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_opengraph"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Cache <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_robots_cache"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Index <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_robots_follow"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
      <th style="width: 10%; text-align: center;">Follow <span class="badge badge-info" rel="tooltip" title="<?php echo $h->lang["hseo_robots_index"]; ?>"><i class="icon-info-sign icon-white"></i></span></th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>Home</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_home_canonical' value='hseo_home_canonical' <?php echo $hseo_home_canonical; ?>></td>
        <td></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_home_cache' value='hseo_home_cache' <?php echo $hseo_home_cache; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_home_index' value='hseo_home_index' <?php echo $hseo_home_index; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_home_follow' value='hseo_home_follow' <?php echo $hseo_home_follow; ?>></td>
    </tr>
    <tr>
        <td>Posts</td>
        <td style="text-align: center"><input  type='checkbox' name='hseo_post_title' value='hseo_post_title' <?php echo $hseo_post_title; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_description' value='hseo_post_description' <?php echo $hseo_post_description; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_keywords' value='hseo_post_keywords' <?php echo $hseo_post_keywords; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_canonical' value='hseo_post_canonical' <?php echo $hseo_post_canonical; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_opengraph' value='hseo_post_opengraph' <?php echo $hseo_post_opengraph; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_cache' value='hseo_post_cache' <?php echo $hseo_post_cache; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_follow' value='hseo_post_follow' <?php echo $hseo_post_follow; ?>></td>
        <td style="text-align: center"><input type='checkbox' name='hseo_post_index' value='hseo_post_index' <?php echo $hseo_post_index; ?>></td>
    </tr>
        <tr>
        <td>List</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
      <tr>
        <td colspan="9"><strong>Static pages</strong>: du findest deine static pages in deinem theme verzeichnis. weitere infos: <a href="http://docs.hotarucms.org/index.php/Creating_a_Page" target="_blank">Hotaru docs</a></td>
    </tr>
    
        <?php
        $x = 0;
        foreach($staticpages as $currentKey ) {
            $x = $x +1;
            if ($x == 12) {
           ?>
          <thead>
          <tr><h3><?php //echo $h->lang["hseo_settings"]; ?></h3></tr>
          <tr>
            <th style="width: 15%"></th>  
            <th style="width: 10%; text-align: center;">Title</th>
            <th style="width: 10%; text-align: center;">Description</th>
            <th style="width: 10%; text-align: center;">Keywords</th>
            <th style="width: 10%; text-align: center;">Canonical</th>
            <th style="width: 10%; text-align: center;">Open Graph</th>
            <th style="width: 10%; text-align: center;">Cache</th>
            <th style="width: 10%; text-align: center;">Index</th>
            <th style="width: 10%; text-align: center;">Follow</th>
          </tr>
        </thead>
            <?php } ?>
           
    <tr>
        <td><em><?php echo $currentKey; ?></em></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_title_<?php echo $currentKey; ?>" value='hseo_staticpage_title_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_title[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_description_<?php echo $currentKey; ?>" value='hseo_staticpage_description_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_description[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_keywords_<?php echo $currentKey; ?>" value='hseo_staticpage_keywords_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_keywords[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_canonical_<?php echo $currentKey; ?>" value='hseo_staticpage_canonical_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_canonical[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_opengraph_<?php echo $currentKey; ?>" value='hseo_staticpage_opengraph_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_opengraph[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_cache_<?php echo $currentKey; ?>" value='hseo_staticpage_cache_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_cache[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_follow_<?php echo $currentKey; ?>" value='hseo_staticpage_follow_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_follow[$currentKey]; ?>></td>
        <td style="text-align: center"><input  type='checkbox' name="hseo_staticpage_index_<?php echo $currentKey; ?>" value='hseo_staticpage_index_<?php echo $currentKey; ?>' <?php echo $hseo_staticpage_index[$currentKey]; ?>></td>
    </tr>
        <?php   } ?>
    
  </tbody>
</table>
            
        </div>

        <div class="form tab-pane" id="meta">
            
        
            
        
            
<table class="table table-striped">
  <thead>
    <tr>
      <th style="width: 15%">Static page name</th>  
      <th style="width: 85%;"><em>Add your Title, Description and Keywords for every Static Page</em></th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php foreach($staticpages as $currentKey ) { ?>
        <td><?php echo $currentKey; ?>: </td>
        <td>
            <table class="table table-hover">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input  type='text' name="hseo_staticpage_title_data_<?php echo $currentKey; ?>" value='<?php echo $hseo_staticpage_title_data[$currentKey]; ?>' >
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><input  type='text' size='300' name="hseo_staticpage_description_data_<?php echo $currentKey; ?>" value="<?php //echo 'hseo_staticpage_description_data_'.$currentKey; ?>"></td>
                </tr>
                <tr>
                    <td>Keywords: </td>
                    <td><input  type='text' size='300' name="hseo_staticpage_keywords_data_<?php echo $currentKey; ?>" value="<?php //echo 'hseo_staticpage_keywords_data_'.$currentKey;  ?>"'></td>
                </tr>
            </table>
        </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
            
            
            
            
            
        </div>

       <div class="form tab-pane" id="support">
            <p>busy</p>
        </div>

        <div class="form tab-pane" id="about">
            <p>You can see Example on www.trendkraft.de</p>
        </div>
    </div>




<?php        
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
    
    
    
    public function static_pages($h){

        $themes = $h->getFiles(THEMES, array('404error.php'));
        if ($themes) {
                $themes = sksort($themes, $subkey="name", $type="char", true);
                foreach ($themes as $theme) { 
                        if ($theme == rtrim(THEME, '/')) {
                                $dir = THEMES . THEME;
                               // print_r($dir);
                        }
                }
        }

         //Das Ziel-Array
        $file_array = Array();
        $denied_staticpage = array( '404error', 'header', 'index', 'footer', 'sidebar', 'navigation', 'settings', 'support', 'bookmarking_sort_filter');  
                
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