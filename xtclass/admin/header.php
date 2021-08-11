<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
     
if ((!defined('ABS_PATH'))) exit('ABS_PATH is not loaded. Direct access is not allowed.');
if (!OC_ADMIN) exit('User access is not allowed.'); ?>

<style type="text/css" media="screen">
    .command { background-color: white; color: #2E2E2E; border: 1px solid black; padding: 8px; }
    .theme-files { min-width: 500px; }
</style>

<?php if (is_writable(xtclass_images_uploads_path())) : ?>
    
    <h2 class="render-title"><?php _e('Header images', XTCLASS_THEME_FOLDER); ?></h2>

    <?php
    $image  = '1520x893-intro-bg.jpg';
    $path   = xtclass_images_uploads_path($image);
    ?>

    <h3 class="render-title"><?php _e('Background for Full Screen:', XTCLASS_THEME_FOLDER) ?></h3>

    <?php if (file_exists($path)) : ?>
        <img border="0" width="15%" alt="<?php echo osc_esc_html(osc_page_title()); ?>" src="<?php echo xtclass_images_uploads_url($image).'?'.filemtime($path); ?>" />
        <br /><?php echo $image; ?><br /><br />
        <form action="" method="post" enctype="multipart/form-data" class="nocsrf">
            <input type="hidden" name="action_specific" value="remove_image" />
            <input type="hidden" name="target" value="<?php echo $image; ?>" />
            <fieldset>
                <button id="button_remove" class="btn btn-red btn-mini" type="submit"><?php echo osc_esc_html(__('Remove image', XTCLASS_THEME_FOLDER)); ?></button>
            </fieldset>
        </form>
    <?php else : ?>
        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e('No image has been uploaded yet', XTCLASS_THEME_FOLDER); ?></p>
        </div>
    <?php endif; ?>

    <p><?php _e('The preferred size of the image is 1520x893.', XTCLASS_THEME_FOLDER); ?></p>
    
    <?php if (file_exists($path)) : ?>
    <div class="flashmessage flashmessage-inline flashmessage-warning"><p><?php _e('<strong>Note:</strong> Uploading another image will overwrite the current image.', XTCLASS_THEME_FOLDER); ?></p></div>
    <br /><br />
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" class="nocsrf">
        <input type="hidden" name="action_specific" value="upload_image" />
        <input type="hidden" name="target" value="<?php echo basename($path, '.jpg'); ?>" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <span><?php _e('Image (jpg):',XTCLASS_THEME_FOLDER); ?></span>
                    <input type="file" name="file" id="package" />
                    <button id="button_save" class="btn btn-submit btn-mini" type="submit"><?php echo osc_esc_html(__('Upload',XTCLASS_THEME_FOLDER)); ?></button>
                </div>
            </div>
        </fieldset>
    </form>

    <br />

    <?php
    $image  = '1280x893-intro-bg.jpg';
    $path   = xtclass_images_uploads_path($image);
    ?>

    <h3 class="render-title"><?php _e('Background for Tablets:', XTCLASS_THEME_FOLDER) ?></h3>

    <?php if (file_exists($path)) : ?>
        <img border="0" width="15%" alt="<?php echo osc_esc_html(osc_page_title()); ?>" src="<?php echo xtclass_images_uploads_url($image).'?'.filemtime($path); ?>" />
        <br /><?php echo $image; ?><br /><br />
        <form action="" method="post" enctype="multipart/form-data" class="nocsrf">
            <input type="hidden" name="action_specific" value="remove_image" />
            <input type="hidden" name="target" value="<?php echo $image; ?>" />
            <fieldset>
                <button id="button_remove" class="btn btn-red btn-mini" type="submit"><?php echo osc_esc_html(__('Remove image', XTCLASS_THEME_FOLDER)); ?></button>
            </fieldset>
        </form>
    <?php else : ?>
        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e('No image has been uploaded yet', XTCLASS_THEME_FOLDER); ?></p>
        </div>
    <?php endif; ?>

    <p><?php _e('The preferred size of the image is 1280x893.', XTCLASS_THEME_FOLDER); ?></p>
    
    <?php if (file_exists($path)) : ?>
    <div class="flashmessage flashmessage-inline flashmessage-warning"><p><?php _e('<strong>Note:</strong> Uploading another image will overwrite the current image.', XTCLASS_THEME_FOLDER); ?></p></div>
    <br /><br />
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" class="nocsrf">
        <input type="hidden" name="action_specific" value="upload_image" />
        <input type="hidden" name="target" value="<?php echo basename($path, '.jpg'); ?>" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <span><?php _e('Image (jpg):',XTCLASS_THEME_FOLDER); ?></span>
                    <input type="file" name="file" id="package" />
                    <button id="button_save" class="btn btn-submit btn-mini" type="submit"><?php echo osc_esc_html(__('Upload',XTCLASS_THEME_FOLDER)); ?></button>
                </div>
            </div>
        </fieldset>
    </form>

     <br />

    <?php
    $image  = '800x893-intro-bg.jpg';
    $path   = xtclass_images_uploads_path($image);
    ?>

    <h3 class="render-title"><?php _e('Background for Smartphones:', XTCLASS_THEME_FOLDER) ?></h3>

    <?php if (file_exists($path)) : ?>
        <img border="0" width="15%" alt="<?php echo osc_esc_html(osc_page_title()); ?>" src="<?php echo xtclass_images_uploads_url($image).'?'.filemtime($path); ?>" />
        <br /><?php echo $image; ?><br /><br />
        <form action="" method="post" enctype="multipart/form-data" class="nocsrf">
            <input type="hidden" name="action_specific" value="remove_image" />
            <input type="hidden" name="target" value="<?php echo $image; ?>" />
            <fieldset>
                <button id="button_remove" class="btn btn-red btn-mini" type="submit"><?php echo osc_esc_html(__('Remove image', XTCLASS_THEME_FOLDER)); ?></button>
            </fieldset>
        </form>
    <?php else : ?>
        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e('No image has been uploaded yet', XTCLASS_THEME_FOLDER); ?></p>
        </div>
    <?php endif; ?>

    <p><?php _e('The preferred size of the image is 800x893.', XTCLASS_THEME_FOLDER); ?></p>
    
    <?php if (file_exists($path)) : ?>
    <div class="flashmessage flashmessage-inline flashmessage-warning"><p><?php _e('<strong>Note:</strong> Uploading another image will overwrite the current image.', XTCLASS_THEME_FOLDER); ?></p></div>
    <br /><br />
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" class="nocsrf">
        <input type="hidden" name="action_specific" value="upload_image" />
        <input type="hidden" name="target" value="<?php echo basename($path, '.jpg'); ?>" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <span><?php _e('Image (jpg):',XTCLASS_THEME_FOLDER); ?></span>
                    <input type="file" name="file" id="package" />
                    <button id="button_save" class="btn btn-submit btn-mini" type="submit"><?php echo osc_esc_html(__('Upload',XTCLASS_THEME_FOLDER)); ?></button>
                </div>
            </div>
        </fieldset>
    </form>

<?php else : ?>

    <div class="flashmessage flashmessage-error" style="display: block;">
        <p>
    	<?php
        $msg  = sprintf(__('The images folder <strong>%s</strong> is not writable on your server', XTCLASS_THEME_FOLDER), xtclass_images_uploads_path() ) .", ";
        $msg .= __("Osclass can't upload the logo image from the administration panel.", XTCLASS_THEME_FOLDER) . ' ';
        $msg .= __('Please make the aforementioned image folder writable.', XTCLASS_THEME_FOLDER) . ' ';
        echo $msg;
        ?>
        </p>
        <p><?php _e('To make a directory writable under UNIX execute this command from the shell:', XTCLASS_THEME_FOLDER); ?></p>
        <p class="command">chmod a+w <?php echo xtclass_images_uploads_path(); ?></p>
    </div>

<?php endif; ?>