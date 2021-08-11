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
	 
// meta tag robots
//osc_add_hook('header', 'xtclass_follow_construct');

osc_add_hook('header', 'scrollFunctionCSS', 9);
function scrollFunctionCSS() { ?>
<style type="text/css">#navbar { height: 6.375rem; }</style>
<?php }

$list 		= 'active';
$gallery 	= '';
$listClass 	= 'col-sm-12 list-item';
if (xtclass_show_as() == 'gallery') {
	$list 		= '';
	$gallery 	= 'active';
	$listClass 	= 'col-sm-4';
}

osc_add_hook('footer', 'scrollFuctionJS');
function scrollFuctionJS() { ?>
<script>
	window.onscroll = function() { scrollFunction() };

	function scrollFunction() {
		if (document.body.scrollTop > 90 || document.documentElement.scrollTop > 90) {
			document.getElementById("navbar").setAttribute("style", "height: 4.375rem;");
			document.getElementById("logo").setAttribute("style", "max-width: 166px;");
		} else {
			document.getElementById("navbar").setAttribute("style", "height: 6.375rem;");
			document.getElementById("logo").setAttribute("style", "");
		}
	}
</script>
<?php 
}
osc_current_web_theme_path('header.php'); ?>

	<section class="col-md-8 mt-max-sm-2 mt-3">

		<?php if (xtclass_show_premiums_home()) : ?>
		<?php osc_get_premiums(xtclass_num_premiums_home()); ?>
		<?php if (osc_count_premiums() > 0) : ?>
		<div class="row mb-3">

			<div class="col-md-6">
				<span class="h1"><?php _e('Premium Listings', XTCLASS_THEME_FOLDER) ; ?></span>
			</div>

			<?php if (osc_count_latest_items() > 0) : ?>
			<div class="col-md-6 text-right">
				<div class="btn-group btn-group-toggle">
					<a href="<?php echo osc_base_url(true); ?>?sShowAs=list" class="btn btn-custom-1 btn-sm <?php echo $list; ?>"
						data-toggle="tooltip" data-placement="top" title="<?php _e('List', XTCLASS_THEME_FOLDER); ?>">
						<i class="fas fa-list-ul"></i>
					</a>
					<a href="<?php echo osc_base_url(true); ?>?sShowAs=gallery" class="btn btn-custom-1 btn-sm <?php echo $gallery; ?>"
						data-toggle="tooltip" data-placement="top" title="<?php _e('Grid', XTCLASS_THEME_FOLDER); ?>">
						<i class="fas fa-th"></i>
					</a>
				</div>
			</div>
			<?php endif; ?>
		
		</div><!-- /.row -->

		<?php if (osc_count_latest_items() > 0) : ?>
		<section class="row">
		<?php
		View::newInstance()->_exportVariableToView("listType", 'premiums');
	    View::newInstance()->_exportVariableToView("listClass", $listClass);
	    osc_current_web_theme_path('loop.php');
		?>
		</section>
		<?php endif; ?>

		<div class="clearfix"></div>

		<?php endif; ?>
		<?php endif; ?>

		<div class="row mb-3">

			<div class="col-md-6">
				<span class="h1"><?php _e('Latest Listings', XTCLASS_THEME_FOLDER) ; ?></span>
			</div>

			<?php if (osc_count_latest_items() > 0) : ?>
			<div class="col-md-6 text-right">
				<div class="btn-group btn-group-toggle">
					<a href="<?php echo osc_base_url(true); ?>?sShowAs=list" class="btn btn-custom-1 btn-sm <?php echo $list; ?>"
						data-toggle="tooltip" data-placement="top" title="<?php _e('List', XTCLASS_THEME_FOLDER); ?>">
						<i class="fas fa-list-ul"></i>
					</a>
					<a href="<?php echo osc_base_url(true); ?>?sShowAs=gallery" class="btn btn-custom-1 btn-sm <?php echo $gallery; ?>"
						data-toggle="tooltip" data-placement="top" title="<?php _e('Grid', XTCLASS_THEME_FOLDER); ?>">
						<i class="fas fa-th"></i>
					</a>
				</div>
			</div>
			<?php endif; ?>
		
		</div><!-- /.row -->

		<?php if (osc_count_latest_items() > 0) : ?>

		<section class="row">
		<?php
		View::newInstance()->_exportVariableToView("listType", 'latestItems');
	    View::newInstance()->_exportVariableToView("listClass", $listClass);
	    osc_current_web_theme_path('loop.php');
		?>
		</section>

		<?php if (osc_count_latest_items() == osc_max_latest_items()) : ?>
		<div class="text-md-left text-right">
			<p><a href="<?php echo osc_search_show_all_url(); ?>"><strong><?php _e('See all listings', XTCLASS_THEME_FOLDER) ; ?> &raquo;</strong></a></p>	
		</div>
		<?php endif; ?>
		
		<?php else: ?>

		<div class="center"><?php _e("There aren't listings available at this moment", XTCLASS_THEME_FOLDER); ?></div>
		
		<?php endif; ?>

	</section><!-- /.col-md-9 -->

	<aside id="sidebar" class="col-md-4 mt-3">
		<?php if (osc_get_preference('sidebar-300x250', 'bender') != '') : ?>
		<div class="ads_300 mb-2"><!-- sidebar ad 300x250 -->
		<?php echo apply_eval_nice(osc_get_preference('sidebar-300x250', 'bender')); ?>
		</div><!-- /sidebar ad 300x250 -->
		<?php endif; ?>
	</aside>

	<?php if (osc_get_preference('homepage-728x90', 'bender') != '') : ?>
	<div class="col-sm-12 text-center">
		<!-- homepage ad 728x90-->
		<div class="ads_728">
			<?php echo apply_eval_nice(osc_get_preference('homepage-728x90', 'bender')); ?>
		</div>
	</div>
	<?php endif; ?>
<?php osc_current_web_theme_path('footer.php'); ?>