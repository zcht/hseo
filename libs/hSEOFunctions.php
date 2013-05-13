<?php
/**
 * hSEO functions
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
 * @copyright Copyright (c) 2009, Hotaru CMS
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link      http://www.hotarucms.org/
 */

class hSEO_Functions
{

    function __construct($h, $meta = null) {
        $this->meta = array(
            'license' =>  $this->license($h),
            'title' => $this->meta_title($h),
            'description' => $this->meta_description($h),
            'keywords' => $this->meta_keywords($h),
            'robots' => $this->meta_robots($h),
            'open_graph' => $this->open_graph($h),
            'favicon' => $this->get_favicon(),
            'canonical' => $this->meta_canonical($h)
            );
    }

 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
    public function getmeta($h) {
        
        $currentKey = 0;
        if (empty($this->meta['license'])) {return false;}
        foreach($this->meta as $currentKey => $x ) { 
            echo $x;
        }
        
    return true;
    }

    
    
    /**
    * 
    *
    * @param 
    * @param 
    * @return 
    */ 
   private function meta_title($h) {
       
       $hseo_settings = $h->getSerializedSettings();
       $title = $hseo_settings['hseo_post_title'];
       if ($title == true) {
            return "<title>". $h->getTitle() ."</title>"."\n";
       }
   }
    
   
   
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
private function get_favicon() {
    
        $favicon = SITEURL . "favicon.ico";
        
        if (file_exists($favicon)) {
            $get_favicon = "<link rel=\"shortcut icon\" href=\"data:image/x-icon;base64," . base64_encode(file_get_contents( $favicon)) ."\" />"."\n";
            return $get_favicon;
        } else {
            return false;
        }
        
    }
    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
private function meta_robots($h, $cache = true, $index = true, $follow = true) {
        
        if ($h->isHome()) { $cache = false; $index = true; $follow = true; }
        if ($h->pageType == 'post') { 
            $hseo_settings = $h->getSerializedSettings();
            $cache = $hseo_settings['hseo_post_cache'];
            $follow = $hseo_settings['hseo_post_follow'];
            $index = $hseo_settings['hseo_post_index'];
          //  $cache = false; $index = true; $follow = true; 
        }
        if ($h->pageType == 'list') { $cache = false; $index = false; $follow = true; }
        if ($h->pageType == 'login') { $cache = false; $index = false; $follow = true; }
        if ($h->pageType == 'register') { $cache = false; $index = false; $follow = true; }
        if ($h->pageType == 'pending') { $cache = false; $index = false; $follow = true; }
        if ($h->pageType == 'buried') { $cache = false; $index = false; $follow = true; }
        if ($h->pageType == 'user') { $cache = false; $index = true; $follow = true; }
        
        if ($cache == true) {
            $cache = "";
        } else {
            $cache = "nocache, ";
        }

        if ($index == true) {
            $index = "index";
        } else {
            $index = "noindex";
        }
        
        if ($follow == true) {
            $follow = "follow";
        } else {
            $follow = "nofollow";
        }
        $robots = "<meta name=\"robots\" content=\"" . $cache . $index . ", " . $follow ."\" />"."\n";
        return $robots;
 
    }
 
    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */    
    private function meta_keywords($h) {

    if ($h->post->status == 'pending' || $h->post->status == 'buried')  { return false; }
        
       if ($h->pageType == 'post') {
           if ($h->isActive('tags')) {
                $hseo_settings = $h->getSerializedSettings();
                $keywords = $hseo_settings['hseo_post_keywords'];
                if ($keywords == true) {
                    $meta_keywords = '<meta name="keywords" content="' . stripslashes($h->post->tags) . '" />'."\n";
                    return $meta_keywords;
                }
           } else {
                $meta_keywords = '<meta name="keywords" content="' . $h->lang['header_meta_keywords'] . '" />'."\n";
                return $meta_keywords;
           }
        } else {
            $meta_keywords = '<meta name="keywords" content="' . $h->lang['header_meta_keywords'] . '" />'."\n";
            return $meta_keywords;
        }
       
    }

    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
    private function meta_canonical($h) {

        if ($h->post->status == 'pending' || $h->post->status == 'buried')  { return false; }
        
               if ($h->pageName == $h->isHome()) {
                   $meta_canonical = "<link rel=\"canonical\" href=\"" . SITEURL ."\" />"."\n";
                   return $meta_canonical;
               }

               if ( $h->pageName == 'login' || $h->pageName == 'register' || $h->pageTitle == '404' || $h->pageType == 'list')  {

               }

               if ($h->pageType == 'post')  {
                    $hseo_settings = $h->getSerializedSettings();
                    $canonical = $hseo_settings['hseo_post_canonical'];
                    if ($canonical == true) {
                        $meta_canonical =  "<link rel=\"canonical\" href=\"". $h->url(array('page'=>$h->post->id)) ."\" />"."\n";
                        return $meta_canonical;
                    }
               }

               if ($h->pageType == 'user')  { 
                   $meta_canonical = "<link rel=\"canonical\" href=". $h->url(array('user' => $h->vars['user']->name)) ." />"."\n";
                   return $meta_canonical;
               }
               
               return false;
               
    }
    
    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
    private function meta_description($h) {
        
        if ($h->pageType == 'post')  {
            
            if ($h->post->status == 'pending' || $h->post->status == 'buried')  { return false; }
            
            $hseo_settings = $h->getSerializedSettings();
            $description = $hseo_settings['hseo_post_description'];
            if ($description == true) {
                $meta_description = sanitize($h->post->content, 'all');
                $meta_description = truncate($meta_description, 160);
                $meta_description = preg_replace('/(\\x0D|\\x0A|\\x0D\\x0A){2,}/', '', $meta_description);
                $meta_description = "<meta name=\"description\" content=\"" . $meta_description ."\" />"."\n";
                return $meta_description;
            }
        } else {
            $meta_description = '<meta name="description" content="' . $h->lang['header_meta_description'] . '" />'."\n"; // default meta tags
            return $meta_description;
        }        

    }
    
    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
   private function open_graph($h) {
        
        if ($h->pageType != 'post' || $h->post->status == 'pending' || $h->post->status == 'buried') { return false; }
        
        $hseo_settings = $h->getSerializedSettings();
        $open_graph = $hseo_settings['hseo_post_opengraph'];
        if ($open_graph == true) {
            $meta_content = sanitize($h->post->content, 'all');
            $meta_content = truncate($meta_content, 100);
            $meta_content = preg_replace('/(\\x0D|\\x0A|\\x0D\\x0A){2,}/','',$meta_content);
            $meta_open_graph = '<meta property="og:title" content="' . $h->getTitle(true) . '" />'."\n";
            $meta_open_graph.= '<meta property="og:description" content="' . $meta_content . '" />'."\n";
            $meta_open_graph.= '<meta property="og:type" content="article" />'."\n";
            $meta_open_graph.= '<meta property="og:url" content="' . $h->url(array('page'=>$h->post->id)) . '" />'."\n";
            $meta_open_graph.= '<meta property="og:site_name" content="' . SITE_NAME . '" />'."\n";
            
            return $meta_open_graph;
        }

           // prüfen ob image multi upload aktiviert ist
//        if ($h->isActive('ImageMultiUpload')) { 
//            $meta_open_graph.= $this->open_graph_image($h);
//        }
             
    }
    
    
    
 /**
 *  TODO - noch nicht implementiert
 *
 * @param 
 * @param 
 * @return 
 */ 
    private function open_graph_image($h) {
        
        if (!ImageMultiUpload::getImages($h)) { return false; }
        
    
            $iu_settings = $h->getSerializedSettings();
            $image = ($h->vars['post_images']);
            
    	$image = ($h->vars['post_images']);

                $year = date('Y', unixtimestamp($h->post->date)) . '/';
                $month = date('m', unixtimestamp($h->post->date)) . '/';
                $day = date('d', unixtimestamp($h->post->date)) . '/';
                $fff = $h->post->author.'/'.$year;


                        $image[0] = str_replace("C:fakepath", "", $image[0]);
                        $thumb = 'z3_'.$image[0];
                        
                        return '<meta property="og:image" content="' . IMGURL. $fff . $thumb . '" />' . "\n";
                        
    }
    
    protected function license($h) {
        if ( $h->lang["hseo_license"] == "<!-- This page was optimized by hSEO / http://www.trendkraft.de / http://goo.gl/lFZpt -->") {
            return $h->lang["hseo_license"]."\n";
        }
        return false;
    }
    
    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
    public function hseo_leverage_browser_caching() {
        
        //Expires Headers und Browser Cache manipulation
        $maxAge = 60*60*24*14; // max. Cache-Dauer in Sekunden
        header('Expires: '.gmdate('D, d M Y H:i:s', time()+$maxAge).' GMT');
        header("Last-Modified: ".gmdate("D, d M Y H:i:s",  time()) . " GMT");
        header('Cache-Control: max-age='.$maxAge);
        header("Pragma: no-cache");
                    
        return;
    }
   
    
    
 /**
 * 
 *
 * @param 
 * @param 
 * @return 
 */ 
    public function hseo_post_redirect($h) {
        
        if (FRIENDLY_URLS == "true") {
            if ($h->pageType != 'post') { return false; }

                $url = $h->cage->server->sanitizeTags('REQUEST_URI'); 
                if ($url === ("/" . $h->post->id) || $url === ("/" . $h->post->id . "/"))
                    {
                        header('HTTP/1.1 301 Moved Permanently', true);
                        header("Location: ".$h->url(array('page'=>$h->post->id)). "", true);
                    }
             }      
                    return;
        }
}
?>