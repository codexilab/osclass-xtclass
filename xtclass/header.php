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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php osc_current_web_theme_path('common/head.php'); ?>
</head>

<body id="page-top" <?php xtclass_body_class(); ?>>
		
	<!-- nav -->
	<?php osc_current_web_theme_path('nav.php'); ?>

	<?php if (osc_is_home_page()) : ?>
	<header id="header" class="jumbotron">
		<div class="container container-fluid">
			<div class="row">
				<?php if (osc_get_preference('slogan', 'xtclass')) : ?>
				<div class="col-md-12">
					<div class="row">
						<h1 class="slogan"><?php echo osc_get_preference('slogan', 'xtclass'); ?></h1>
					</div>
				</div>
				<?php endif; ?>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="row">
						
						<div class="col-md-10">
							<form class="nocsrf navbar-search row" action="<?php echo osc_base_url(true); ?>" method="get">
								<input type="hidden" name="page" value="search"/>
								<div class="input-group input-group-lg">
									<input type="text" name="sPattern" value="" class="form-control form-control-info bg-light border-1 small" placeholder="<?php echo osc_esc_html(__(osc_get_preference('keyword_placeholder', 'bender'), XTCLASS_THEME_FOLDER)); ?>" aria-label="Search" aria-describedby="basic-addon2">
									<div class="input-group-append">
										<button class="btn btn-custom-1" type="submit">
											<i class="fas fa-search fa-sm"></i>
										</button>
									</div>
								</div>
							</form>    
						</div>

					</div>
				</div>

				<!-- style="padding-top: 10%;" -->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-max-md-2 mt-md-11">
					<div class="row">
						<div class="well w-100 bg-wellmain p-3 rounded">
							<ul class="list-unstyled mb-0">
								<?php osc_goto_first_category(); ?>
								<?php while (osc_has_categories()) : ?>
								<li><a class="text-lg w-50 float-md-left" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
			</div> <!-- ./row -->
		</div>
	</header>
	<?php endif; ?>

    <?php osc_run_hook('before-content'); ?>

    <?php if (osc_get_preference('header-728x90', 'bender') != '' && !osc_is_public_profile()) : ?>
	<!-- header ad 728x90-->
	<div class="container">
		<div class="row mb-2">
			<div class="col-sm-12 text-center">
				<div class="ads_header">
			    <?php echo apply_eval_nice(osc_get_preference('header-728x90', 'bender')); ?> 
			    </div>
			</div>
		</div>
	</div>
	<!-- /header ad 728x90-->
	<?php endif; ?>

    <?php osc_show_widgets('header'); ?>

	<main class="container">

		<?php osc_run_hook('before-main'); ?>

		<?php xtclass_show_flash_message(); ?>

		<div <?php xtclass_wrapper_class(); ?>>

			<?php osc_run_hook('inside-main'); ?>