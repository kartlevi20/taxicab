<?php

/**
 * Rental form
 */

$style = get_query_var('lte_form_style');
if ( empty($style) ) {

	$style = 'pattern';
}

if ( !empty($_GET['rental_style']) AND $_GET['rental_style'] == 'gray' ) {

	$style = 'gray';
}

if ( $style == 'pattern' ):
?>
<form role="search" action="<?php echo esc_url(get_home_url()); ?>" method="get" class="lte-search-rental lte-style-<?php echo esc_attr($style); ?>">
	<input type="hidden" name="post_type" value="rental" />
	<input type="hidden" name="rental_style" value="<?php echo esc_attr($style); ?>" />
	<div class="row">
		<?php

		$cats = get_terms(array(
		    'taxonomy' => 'rental-category',
		));

		if ( !empty($cats) ) {

			echo '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
			<label>'.esc_html__("Category:", 'limme').'</label>
			<select name="s-cats">';
		
			echo '<option value="0">'.esc_html__("All", 'limme').'</option>';
			foreach ( $cats as $item ) {

				$exclude_search = fw_get_db_term_option($item->term_id, 'rental-category', 'exclude-search');
				if ( !empty( $exclude_search) ) continue;

				$sel = '';
				if ( !empty($_GET['s-cats']) AND $item->term_id == $_GET['s-cats'] ) $sel = ' selected';
				echo '<option value="'.$item->term_id.'"'.$sel.'>'.$item->name.'</option>';
			}

			echo '</select>
			</div>';
		}
		?>
		<?php

		$cats = get_terms(array(
		    'taxonomy' => 'rental-brand',
		));

		if ( !empty($cats) ) {
		
			echo '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
			<label>'.esc_html__("Brand:", 'limme').'</label>
			<select name="s-brand">';

			echo '<option value="0">'.esc_html__("All", 'limme').'</option>';		
			foreach ( $cats as $item ) {

				$sel = '';
				if ( !empty($_GET['s-brand']) AND $item->term_id == $_GET['s-brand'] ) $sel = ' selected';
				echo '<option value="'.$item->term_id.'"'.$sel.'>'.$item->name.'</option>';
			}

			echo '</select>
			</div>';
		}
		?>
		<?php

		$cats = get_terms(array(
		    'taxonomy' => 'rental-post_tag',
		));

		if ( !empty($cats) ) {
		
			echo '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
			<label>'.esc_html__("Options:", 'limme').'</label>
			<select name="s-tags">';
		
			echo '<option value="0">'.esc_html__("All", 'limme').'</option>';
			foreach ( $cats as $item ) {

				$sel = '';
				if ( !empty($_GET['s-tags']) AND $item->term_id == $_GET['s-tags'] ) $sel = ' selected';
				echo '<option value="'.$item->term_id.'"'.$sel.'>'.$item->name.'</option>';
			}

			echo '</select>
			</div>';
		}
		?>		
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
			<label class="lte-empty">&nbsp;</label>
			<?php if ( $style == 'pattern' ): ?>
				<input type="submit" value="<?php echo esc_html__("Find car", 'limme'); ?>" class="lte-btn btn-lg btn-black color-hover-white" />
			<?php else: ?>
				<input type="submit" value="<?php echo esc_html__("Get limousine", 'limme'); ?>" class="lte-btn btn-lg btn-main color-hover-black" />
			<?php endif; ?>
		</div>
	</div>
</form>
<?php
elseif ( $style == 'gray' ):
?>
<form role="search" action="<?php echo esc_url(get_home_url()); ?>" method="get" class="lte-search-rental lte-style-<?php echo esc_attr($style); ?>">
	<input type="hidden" name="post_type" value="rental" />
	<input type="hidden" name="rental_style" value="<?php echo esc_attr($style); ?>" />
	<div class="row">
		<?php

		$cats = get_terms(array(
		    'taxonomy' => 'rental-brand',
		));

		if ( !empty($cats) ) {
		
			echo '<div class="col-lg-5ths col-lg-3 col-md-6 col-sm-6 col-xs-12">';
			echo '<span class="fa fa-car lte-form-icon"></span>';
			echo '<select name="s-brand">';

			echo '<option value="0">'.esc_html__("Select Brand", 'limme').'</option>';		
			foreach ( $cats as $item ) {

				$sel = '';
				if ( !empty($_GET['s-brand']) AND $item->term_id == $_GET['s-brand'] ) $sel = ' selected';
				echo '<option value="'.$item->term_id.'"'.$sel.'>'.$item->name.'</option>';
			}

			echo '</select>
			</div>';
		}
		?>
		<?php

		$cats = get_terms(array(
		    'taxonomy' => 'rental-post_tag',
		));

		if ( !empty($cats) ) {
		
			echo '<div class="col-lg-5ths col-lg-3 col-md-6 col-sm-6 col-xs-12">';
			echo '<span class="fa fa-car lte-form-icon"></span>';
			echo '<select name="s-tags">';
		
			echo '<option value="0">'.esc_html__("Select Options", 'limme').'</option>';
			foreach ( $cats as $item ) {

				$sel = '';
				if ( !empty($_GET['s-tags']) AND $item->term_id == $_GET['s-tags'] ) $sel = ' selected';
				echo '<option value="'.$item->term_id.'"'.$sel.'>'.$item->name.'</option>';
			}

			echo '</select>
			</div>';
		}

		if ( !empty($_GET['price-from']) ) $price_from = $_GET['price-from']; else $price_from = '';
		if ( !empty($_GET['price-to']) ) $price_to = $_GET['price-to'];else $price_to = '';

		echo '<div class="col-lg-5ths col-lg-3 col-md-6 col-sm-6 col-xs-12">';
			echo '<span class="fa fa-dollar-sign lte-form-icon"></span>';
			echo '<input type="text" name="price-from" value="'.esc_attr($price_from).'" placeholder="'.esc_html__("Price from", 'limme').'">';
		echo '</div>';

		echo '<div class="col-lg-5ths col-lg-3 col-md-6 col-sm-6 col-xs-12">';
			echo '<span class="fa fa-dollar-sign lte-form-icon"></span>';
			echo '<input type="text" name="price-to" value="'.esc_attr($price_to).'" placeholder="'.esc_html__("Price to", 'limme').'">';
		echo '</div>';

		?>		
		<div class="col-lg-5ths col-lg-3 col-md-6 col-sm-6 col-xs-12">
			<label class="lte-empty">&nbsp;</label>
			<input type="submit" value="<?php echo esc_html__("Find car", 'limme'); ?>" class="lte-btn btn-lg btn-main color-hover-black" />
		</div>
	</div>
</form>
<?php

endif; ?>

