<table class="table table-striped">
  <thead>      
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