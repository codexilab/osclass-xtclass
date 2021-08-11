<?php
	/*
	 * MIT License
	 * 
	 * Copyright (c) 2020 CodexiLab
	 * 
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 * 
	 * The above copyright notice and this permission notice shall be included in all
	 * copies or substantial portions of the Software.
	 * 
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	 * SOFTWARE.
	 */
?>
		</div><!-- /.row -->
	</main><!-- /.container -->

	<?php osc_run_hook('after-main'); ?>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- General Modal -->
	<div class="modal fade" id="genModal" tabindex="-1" role="dialog">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header"></div>
	            <div class="modal-body text-center">
	            	<div class="d-flex justify-content-center">
						<div class="spinner-border" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>
	            </div>
	            <div class="modal-footer"></div>
	        </div>
	    </div>
	</div>

	<?php osc_show_widgets('footer');?>

	<footer class="mt-3">
		<div class="container pt-3">
			<div class="row">
				<div class="col-md-3 col-sm-12 text-center text-md-left d-none d-md-block">
					<p><a href="<?php echo osc_contact_url(); ?>" class="font-weight-bold"><?php _e('Contact', XTCLASS_THEME_FOLDER); ?></a></p>
					<p><?php echo xtclass_logo_footer(); ?><br /><p class="small">Copyright &copy; <a href="<?php echo osc_base_url(); ?>"><?php echo osc_page_title(); ?></a> 2015-2020.</p></p>
				</div>

				<div class="col-md-6 col-sm-12 text-center text-md-left">
					<p class="font-weight-bolder"><?php _e('Categories', XTCLASS_THEME_FOLDER); ?></p>
					<ul class="list-unstyled">
						<?php osc_goto_first_category() ; ?>
	                    <?php while ( osc_has_categories() ) : ?>
	                    <li><a class="w-50 float-md-left" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a></li>
	                    <?php endwhile; ?>
					</ul>
				</div>

				<div class="col-md-3 col-sm-12 text-center text-md-left">
					<ul class="list-unstyled font-weight-bolder">
					<?php if (osc_users_enabled()) : ?>
						<?php if (osc_is_web_user_logged_in()) : ?>
							<li class="mb-2 font-weight-normal"><?php echo sprintf(__('Hi %s', XTCLASS_THEME_FOLDER), osc_logged_user_name() . '!'); ?> &middot; <a href="<?php echo osc_user_dashboard_url(); ?>" class="font-weight-bolder"><?php _e('My account', XTCLASS_THEME_FOLDER); ?></a></li>
							<li class="mb-2"><a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', XTCLASS_THEME_FOLDER); ?></a></li>
						<?php else: ?>
							<li class="mb-2"><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', XTCLASS_THEME_FOLDER); ?></a></li>
						
							<?php if (osc_user_registration_enabled()) : ?>
							<li class="mb-2"><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', XTCLASS_THEME_FOLDER); ?></a></li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>

					<?php osc_reset_static_pages(); while (osc_has_static_pages()) : ?>
						<li class="mb-2"><a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>

			        <?php if (osc_count_web_enabled_locales() > 1) : ?>
			        <?php osc_goto_first_locale(); ?>
			        <?php $i = 0;  ?>
			        <span class="font-weight-bolder"><?php _e('Language:', XTCLASS_THEME_FOLDER); ?></span>
			        <ul class="list-inline">
			        	<?php while (osc_has_web_enabled_locales()) : ?>
			        	<li class="list-inline-item"><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url (osc_locale_code()); ?>"><?php echo osc_locale_name(); ?></a></li>
			        	<?php $i++; ?>
			            <?php endwhile; ?>
			        </ul>
			        <?php endif; ?>
				</div>

				<div class="col-md-3 col-sm-12 text-center text-md-left d-md-none">
					<p><a href="<?php echo osc_contact_url(); ?>" class="font-weight-bold"><?php _e('Contact', XTCLASS_THEME_FOLDER); ?></a></p>
					<p><?php echo xtclass_logo_footer(); ?><br /><p class="small">Copyright &copy; <a href="<?php echo osc_base_url(); ?>"><?php echo osc_page_title(); ?></a> 2015-2020.</p></p>
				</div>

			</div>
		</div>
	</footer>


	<script>
	<?php if (osc_users_enabled()) : ?>
		<?php if (osc_is_web_user_logged_in()) : ?>
		$(document).ready(function() {
			$(".logout").click(function() {
			    $('#genModal').modal('show');
			    $('#genModal').on('shown.bs.modal', function(e) {
		            $("#genModal .modal-header").html('<h5 class="modal-title"><?php _e('Ready to Leave?', XTCLASS_THEME_FOLDER); ?></h5>');
		            $("#genModal .modal-body").html('<?php _e('Select "Logout" below if you are ready to end your current session.', XTCLASS_THEME_FOLDER); ?>');
		            
		            let btnCancel = `
			    		<button class="btn btn-secondary" type="button" onclick="genModalHide();return false;">
			    			<?php _e('Cancel'); ?>
			    		</button>
			    	`

			    	let btnLogout = `
				    	<a class="btn btn-custom-1" href="<?php echo osc_user_logout_url(); ?>">
				    		<?php _e('Logout', XTCLASS_THEME_FOLDER); ?>
				    	</a>
			    	`

		            $("#genModal .modal-footer").html(btnCancel+btnLogout);
			    });
			});
		});

		function modalDeleteItem(url) {
			$('#genModal').modal('show');
			$('#genModal').on('shown.bs.modal', function(e) {
				$("#genModal .modal-header").html('<h5 class="modal-title"><?php echo osc_esc_js(__('Message', XTCLASS_THEME_FOLDER)); ?></h5>');
				$("#genModal .modal-body").html('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', XTCLASS_THEME_FOLDER)) ?>');
				
				let btnCancel = `
					<button class="btn btn-secondary" type="button" onclick="genModalHide();return false;">
						<?php echo osc_esc_js(__('Cancel')); ?>
					</button>
				`

				let btnDelete = `
					<a class="btn btn-custom-1" href="`+url+`">
						<?php echo osc_esc_js(__('Delete', XTCLASS_THEME_FOLDER)); ?>
					</a>
				`

				$("#genModal .modal-footer").html(btnCancel+btnDelete);
			});
		}
		<?php endif; ?>
	<?php endif; ?>

		function copyPriceToClipboard(itemId, type) {
			var btnPrice 	= 'price-'+type+'-'+itemId
			var msgCopyTo 	= '<?php echo osc_esc_js(__('Copy to Clipboard', XTCLASS_THEME_FOLDER)); ?>'
			var msgCopied 	= '<?php echo osc_esc_js(__('Copied!', XTCLASS_THEME_FOLDER)); ?>'

			if (copyToClipboard(btnPrice) === true) {
				$('#'+btnPrice).attr('data-original-title', msgCopied)
					.tooltip('show')
					.attr('data-original-title', msgCopyTo);
			} else {
				$('#'+btnPrice).attr('data-original-title', 'Copy with Ctrl-c')
					.tooltip('show')
					.attr('data-original-title', msgCopyTo);
			}

		}
	</script>

	<?php osc_run_hook('footer'); ?>

</body>
</html>