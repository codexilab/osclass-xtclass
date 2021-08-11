<?php
	/*
	 * MIT License
	 * 
	 * Copyright (c) 2021 CodexiLab
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
	 
// meta tag robots
if( osc_item_is_spam() || osc_premium_is_spam() ) {
    osc_add_hook('header', 'xtclass_nofollow_construct');
} else {
    osc_add_hook('header', 'xtclass_follow_construct');
}

// For related items loop
$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (xtclass_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

$location = array();
if( osc_item_city_area() !== '' ) {
    $location[] = osc_item_city_area();
}
if( osc_item_city() !== '' ) {
    $location[] = osc_item_city();
}
if( osc_item_region() !== '' ) {
    $location[] = osc_item_region();
}
if( osc_item_country() !== '' ) {
    $location[] = osc_item_country();
}

function js_item() {
	CustomCommentForm::js_validation();
}
osc_add_hook('footer', 'js_item');

osc_current_web_theme_path('header.php'); ?>

	<?php osc_current_web_theme_path('item-sidebar.php'); ?>

	<article id="item-content" class="col-md-8 order-1 pb-3 item">
		<h1>
			<b><?php echo osc_item_title(); ?></b><br />
			<small><span class="text-muted"><b><?php _e('Category', XTCLASS_THEME_FOLDER); ?>:</b></span> <a href="<?php echo osc_item_category_url(osc_item_category_id()); ?>"><?php echo osc_item_category(); ?></a></small>
		</h1>

		<span class="text-nowrap"><?php if (osc_item_pub_date() !== '') printf(__('<strong class="publish">Published date</strong>: %1$s', XTCLASS_THEME_FOLDER), osc_format_date( osc_item_pub_date())); ?></span>
		<span class="text-nowrap"><?php if (osc_item_mod_date() !== '') printf(__('<strong class="update">Modified date:</strong> %1$s', XTCLASS_THEME_FOLDER), osc_format_date( osc_item_mod_date())); ?></span>

		<?php if (osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) : ?>
		<span class="text-right text-nowrap"><a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', XTCLASS_THEME_FOLDER); ?></a></span>
		<?php endif; ?>

		<?php if (osc_images_enabled_at_items()) : ?>
		<?php if (osc_count_item_resources() > 0) : ?>
		<div id="itemCarousel" class="carousel slide" data-ride="carousel">

			<div class="carousel-inner">
				<?php $num = 0; while (osc_has_item_resources()) : $num++; ?>
				<div class="carousel-item<?php if ($num == 1) echo ' active'; ?>">
					<a href="<?php echo osc_resource_original_url(); ?>" target="_blank">
						<img src="<?php echo osc_resource_url(); ?>" class="img-fluid" alt="<?php echo osc_resource_name(); ?>">
					</a>
				</div>
				<?php endwhile; ?>
			</div>

			<?php if (osc_count_item_resources() > 1) : ?>
			<a class="carousel-control-prev" href="#itemCarousel" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>

			<a class="carousel-control-next" href="#itemCarousel" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
			<?php endif; ?>
			
		</div>
		<?php endif; // if (osc_count_item_resources() > 0) ?>

		<?php View::newInstance()->_erase('resources'); ?>
		<?php if (osc_count_item_resources() > 1) : ?>
		<div class="scroll-h-auto mt-2">
			<div class="center">
				<div style="width: max-content">
					<ul class="list-inline">
						<?php $num = 0; while (osc_has_item_resources()) : ?>
						<li class="list-inline-item m-1">
							<a href="" data-target="#itemCarousel" data-slide-to="<?php echo $num++; ?>">
								<img width="75" src="<?php echo osc_resource_thumbnail_url(); ?>" alt="<?php echo osc_item_title(); ?>" class="img-fluid img-thumbnail" title="<?php echo osc_item_title(); ?>" />
							</a>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
		<?php endif; // if (osc_count_item_resources() > 1) ?>
		<?php endif; // if (osc_images_enabled_at_items()) ?>

		<section class="mt-1">
			<?php osc_run_hook('location'); ?>

			<?php if ((count($location)>0) || (osc_item_address() != '')) : ?>
			<div id="item_location">
				<?php if(osc_item_address() != '') : ?>
				<span><i class="fas fa-map-marker-alt"></i> <?php echo osc_item_address(); ?></span>
				<?php endif; ?>

				<?php if (count($location)>0) : ?>
				<span><i class="fas fa-map-marker-alt"></i> <?php echo implode(', ', $location); ?></span>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</section>

		<?php if (osc_count_item_meta() >= 1) : ?>
		<section id="custom_fields" class="mt-1 border border-bender rounded clearfix">
            <ul class="list-unstyled meta_list">
                <?php while (osc_has_item_meta()) : ?>
                    <?php if (osc_item_meta_value()!='') : ?>
                        <li class="w-50 float-left meta"><b><?php echo osc_item_meta_name(); ?>:</b> <span class="float-right mr-1"><?php echo osc_item_meta_value(); ?></span></li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
		</section>
		<?php endif; ?>

		<?php osc_run_hook('item_detail', osc_item()); ?>

		<section id="description" class="mt-2 border border-bender rounded clearfix">
			<?php echo osc_item_description(); ?>

			<?php if (!osc_item_is_expired()) : ?>
			<?php if (!( ( osc_logged_user_id() == osc_item_user_id()) && osc_logged_user_id() != 0)) : ?>
				<?php if (osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact()) : ?>
				<a href="#contact" class="btn btn-custom-1 btn-block d-md-none mt-2"><?php _e('Contact seller', XTCLASS_THEME_FOLDER); ?>r</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
		</section>

	    <?php related_listings(); ?>
        <?php if (osc_count_items() > 0) : ?>
        <section class="similar_ads mt-3">
            <h2><?php _e('Related listings', XTCLASS_THEME_FOLDER); ?></h2>
            <div class="row">
        	<?php
            View::newInstance()->_exportVariableToView("listType", 'items');
            View::newInstance()->_exportVariableToView("listClass", $listClass);
            osc_current_web_theme_path('loop.php');
            ?>
            </div>
            <div class="clear"></div>
        </section>
    	<?php endif; ?>

    	<?php if (osc_comments_enabled()) : ?>
    	<?php if (osc_reg_user_post_comments() && osc_is_web_user_logged_in() || !osc_reg_user_post_comments()) : ?>
		<section id="comments" class="mt-1">
			
			<h2><?php _e('Comments', XTCLASS_THEME_FOLDER); ?></h2>

			<?php if (osc_count_item_comments() >= 1) : ?>
				<?php while (osc_has_item_comments()) : ?>
				<article class="media mt-3 mb-2">
					<div class="w-min-content">
						<img width="64" src="<?php echo user_thumb_url(); ?>" class="rounded-circle mr-3" alt="...">
						<br>
						<div class="text-wrap text-center mr-3"><h5><small><?php echo osc_format_date(osc_comment_pub_date(), 'M j, Y g:i a'); ?></small></h5></div>
					</div>

					<div class="media-body mw-100 scroll-h-auto">
						<h5 class="mt-0"><?php echo osc_comment_title(); ?> <small><?php _e("by", XTCLASS_THEME_FOLDER); ?> <?php echo xtclass_comment_author(); ?></small></h5>
						<?php echo nl2br(osc_comment_body()); ?>
					</div>

					<?php if (osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id())) : ?>
					<div>
						<a href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-caret-down"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a rel="nofollow" class="dropdown-item" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', XTCLASS_THEME_FOLDER); ?>"><?php _e('Delete', XTCLASS_THEME_FOLDER); ?></a>
						</div>
					</div>
					<?php endif; ?>
				</article>
				<?php endwhile; ?>
			<?php endif; ?>

			<p class="text-dark"><b><?php _e('Leave your comment (spam and offensive messages will be removed)', XTCLASS_THEME_FOLDER); ?></b></p>

			<form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
				<input type="hidden" name="action" value="add_comment" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
            	
            	<?php if (osc_is_web_user_logged_in()) : ?>
            	<input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name()); ?>" />
                <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email(); ?>" />
            	
            	<?php else : ?>
				
				<div class="form-group row text-md-right">
					<label for="authorName" class="col-sm-2 col-form-label"><?php _e('Your name', XTCLASS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::author_input_text(); ?>
					</div>
				</div>
				<div class="form-group row text-md-right">
					<label for="authorEmail" class="col-sm-2 col-form-label"><?php _e('Your e-mail', XTCLASS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::email_input_text(); ?>
					</div>
				</div>
            	<?php endif; ?>

            	<div class="form-group row text-md-right">
					<label for="title" class="col-sm-2 col-form-label"><?php _e('Title', XTCLASS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::title_input_text(); ?>
					</div>
				</div>
				<div class="form-group row text-md-right">
					<label for="body" class="col-sm-2 col-form-label"><?php _e('Comment', XTCLASS_THEME_FOLDER); ?></label>
					<div class="col-sm-10">
						<?php CustomCommentForm::body_input_textarea(); ?>
					</div>
				</div>
            	<div class="form-group row">
				    <div class="col-sm-12 col-md-10 ml-md-auto">
				    	<button type="submit" class="btn btn-custom-1 btn-block-md-down"><?php _e('Send', XTCLASS_THEME_FOLDER); ?></button>
				    </div>
				</div>
			</form>
		</section>
    	<?php endif; ?>
    	<?php endif; // if (osc_comments_enabled()) ?>

	</article><!-- /#item-content -->
<?php osc_current_web_theme_path('footer.php') ; ?>