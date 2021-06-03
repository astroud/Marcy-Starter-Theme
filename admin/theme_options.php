<div class="wrap theme_options">

	<div id="message" class="updated above-h2" style="display:none;"><p></p></div>

	<h2>Theme Options</h2> 
        
    <h2 class="nav-tab-wrapper">
        <a id="tab_general" class="nav-tab nav-tab-active"><div class="dashicons dashicons-admin-generic"></div> General</a>
        <a id="tab_sn" class="nav-tab"><div class="dashicons dashicons-share"></div> Social Networks</a>
    </h2>

    <form id="md_theme_settings">
        
        <div id="content_tab_general" class="content_tab content_tab_active">
        
            <div class="general_setting">
                <h4>Logo Image</h4>
                <div class="input_wrap"><input name="header_logo" type="text" value="<?php echo get_option("header_logo");?>"/><input class="button media_upload_button" type="button" value="Upload Image"/></div>
            </div>
            
            <div class="general_setting">
                <h4>Footer Content</h4>
                <div class="input_wrap"><textarea name="footer_content"><?php echo stripslashes(get_option("footer_content"));?></textarea> <i><code>&amp;copy; [year] Demo Company&lt;br/&gt;12345 Main St. | Columbus, OH 12345 | Phone: 123.456.7890</code></i></div>
            </div>
            
            <div class="general_setting">
                <h4>Analytics Tracking Code</h4>
                <div class="input_wrap"><textarea name="google_analytics"><?php echo stripslashes(get_option("google_analytics"));?></textarea> <i><code>paste your Google Analytics tracking code here.</code></i></div>
            </div>
        
        </div>
        
        <div id="content_tab_sn" class="content_tab">
            <?php 
            global $social_networks; 
            foreach($social_networks AS $id=>$network){ 
            ?>
                <div class="social_network">
                    <h4><?php echo $network["icon"]; ?> <?php echo $network["name"]; ?></h4>
                    <div class="input_wrap"><input type="text" name="<?php echo $id; ?>" value="<?php echo get_option($id);?>" placeholder="Enter your <?php echo $network["name"]; ?> URL"/></div>
                </div>
            <?php } ?>
        </div>

        <input type="submit" value="Save Settings" class="button-primary hide_submit"/>
        
    </form>

  
</div>