<?php if ((!defined('ABS_PATH'))) exit('ABS_PATH is not loaded. Direct access is not allowed.');
if (!OC_ADMIN) exit('User access is not allowed.');
$scss_file_path = xtclass_scss_style_path();
$css_file_path 	= xtclass_css_style_path();
?>

<link href="<?php echo osc_current_web_theme_url('admin/scss-compiler/scss-compiler.css') ?>" rel="stylesheet" type="text/css">

<?php if (is_writable($scss_file_path) && is_writable($css_file_path)) : ?>

	<?php if (file_exists(XTCLASS_THEME_PATH . 'scss/style.css')) : ?>
	<div class="flashmessage flashmessage-info" style="display: block;">
		<p><h2>DEVELOPER MODE:</h2></p>
		<p>
		<?php 
		$msg = __('This mode is automatically activated when it detected <strong>style.css</strong> file in <strong>scss</strong> folder.', XTCLASS_THEME_FOLDER);
		$msg .= "<br><br>";
		$msg .= __('To unable this mode:', XTCLASS_THEME_FOLDER);
		$msg .= "<br><br>";
		$msg .= __('1) Delete <strong>style.css</strong> file in <strong>scss</strong> folder, under UNIX execute this command from the shell:');
		echo $msg;
		?>
		</p>
	    <p class="command">rm <?php echo XTCLASS_THEME_PATH . 'scss/style.css'; ?></p>
	    <p><?php _e('2) And then click on <b>Build</b>.', XTCLASS_THEME_FOLDER); ?></p>
	</div>

	<br>
	<?php endif; ?>

	<div class="d-flex" style="justify-content: space-between;">
		<h2 class="render-title">CSS style editor</h2>
		<button form="build-form" type="submit" class="btn btn-submit btn-mini"><?php _e('Build', XTCLASS_THEME_FOLDER); ?></button>
	</div>

	<form id="build-form" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action_specific" value="compile_scss">

		<div class="d-flex">

		    <!-- Left content -->
		    <div id="wrapper-scss" class="wrapper flex-5">
				<div id="tab-scss" class="scroll-h-auto scroll-h-hidden tab">
				    <div class="tab-content text-nowrap">
				    	<span>SCSS: css/style.scss</span>
					</div>
				</div>
	<textarea name="scss" data-editor="scss" class="ace-custom" data-gutter="1"
	><?php echo file_get_contents($scss_file_path); ?></textarea>
		    </div>

		    <span id="separator" class="separator"></span>

		    <!-- Right content -->
		    <div id="wrapper-css" class="wrapper flex-5">
				<div id="tab-css" class="scroll-h-auto scroll-h-hidden tab">
				    <div class="tab-content text-nowrap">
				    	<span>CSS: css/style.css</span>
					</div>
				</div>
	<textarea data-editor="css" class="ace-custom" data-gutter="1" disabled
	><?php echo file_get_contents($css_file_path); ?></textarea>
		    </div>

		</div> <!-- /.d-flex -->

		<br>

		<button type="submit" class="btn btn-submit btn-mini" style="float: right;"><?php _e('Build', XTCLASS_THEME_FOLDER); ?></button>

	</form>

	<?php
		// Add js at the footer
		osc_add_hook('admin_footer', function() {
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>'.PHP_EOL;
			echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ext-language_tools.js"></script>'.PHP_EOL;
			echo '<script src="'.osc_current_web_theme_url('admin/scss-compiler/scss-compiler.js').'"></script>';
		});
	?>

<?php else : ?>

	<div class="flashmessage flashmessage-error" style="display: block;">
        <p><?php _e('Make recursively this folders <strong>css</strong> and <strong>scss</strong> and its files writables:', XTCLASS_THEME_FOLDER); ?></p>
        <p><?php _e('Or under UNIX execute this command from the shell:', XTCLASS_THEME_FOLDER); ?></p>
        <p class="command">chmod -R 775 <?php echo XTCLASS_THEME_PATH . 'css'; ?> <?php echo XTCLASS_THEME_PATH . 'scss'; ?></p>
    </div>

<?php endif; ?>