<?php
echo "<form name='hseo_settings_form' action='" . BASEURL . "admin_index.php?page=plugin_settings&amp;plugin=hseo#tab_editmeta' method='post'>\n";
?>

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
                            <input  type='text' name="hseo_staticpage_title_data_<?php echo $currentKey; ?>" value='<?php echo @$hseo_staticpage_title_data[$currentKey]; ?>' >
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

<?php
$h->pluginHook('hseo_editmeta_form');
                
        echo "<br />\n";    
        echo "<input type='hidden' name='submitted' value='true' />\n";
        echo "<input type='submit' value='" . $h->lang["main_form_save"] . "' />\n";
        echo "<input type='hidden' name='csrf' value='" . $h->csrfToken . "' />\n";
        echo "</form>\n";
?>