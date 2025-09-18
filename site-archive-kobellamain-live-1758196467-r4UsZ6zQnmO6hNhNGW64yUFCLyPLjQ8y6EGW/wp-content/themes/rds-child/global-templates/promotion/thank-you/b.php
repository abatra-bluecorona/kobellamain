<?php
if (function_exists("get_promotion_query")) {
	$query = get_promotion_query(1);
	if ($query->have_posts()) {
		while ($query->have_posts()):
			$query->the_post();
			$promotion_type = get_post_meta(
				get_the_ID(),
				"promotion_type",
				true
			);
			$noexpiry = get_post_meta(get_the_ID(), "promotion_noexpiry", true);
			$colorCode = get_post_meta(get_the_ID(), "promotion_color", true);
			$date = get_post_meta(get_the_ID(), "promotion_expiry_date1", true);
			$open_new_tab = get_post_meta(
				get_the_ID(),
				"promotion_open_new_tab",
				true
			);
			if (
				strtotime($date) >= strtotime(current_time("m/d/Y")) ||
				$noexpiry == 1
			) {

				$title = get_post_meta(get_the_ID(), "promotion_title1", true);
				$color = get_post_meta(get_the_ID(), "promotion_color", true);
				$subheading = get_post_meta(
					get_the_ID(),
					"promotion_subheading",
					true
				);
				$heading = get_post_meta(
					get_the_ID(),
					"promotion_heading",
					true
				);
				$footer_heading = get_post_meta(
					get_the_ID(),
					"promotion_footer_heading",
					true
				);
				$requestButtonLink = get_post_meta(
					$post->ID,
					"request_button_link",
					true
				);
				$requestButtonTitle = get_post_meta(
					$post->ID,
					"request_button_title",
					true
				);
				?>
                <div class="col-lg-6 px-0 px-lg-3">
    <div class="h-auto border-quaternary-dashed p-lg-2 p-3">
        <div class="coupon_name color_primary_bg h-100 py-4 p-4 px-lg-0 text-center" style="background-color: <?php echo !empty($colorCode) ? $colorCode : '#ffffff'; ?>;">
            <?php if (!empty($heading)) : ?>
                <span class="d-block text-center px-lg-0 px-3 pt-lg-0 pt-2 coupon_subtitle coupon_heading"><?php echo $heading; ?></span>
            <?php endif; ?>

            <?php if (!empty($subheading)) : ?>
                <span class="d-block text-center py-2 px-lg-0 px-2 pt-2 my-lg-1 coupon_sub_heading"><?php echo $subheading; ?></span>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h4 class="mb-0 py-3 coupon_title coupon_offer"><?php echo $title; ?></h4>
            <?php endif; ?>

            <?php if (!empty($requestButtonLink) || !empty($requestButtonTitle)) : ?>
                <a data-bs-toggle="<?php echo empty($requestButtonLink) ? 'modal' : ''; ?>"
                   data-bs-target="<?php echo empty($requestButtonLink) ? '#request_coupon_form_template_b' : ''; ?>"
                   <?php echo empty($requestButtonLink) ? 'onclick="couponButtonClick(this);"' : 'href="' . $requestButtonLink . '"'; ?>
                   <?php echo empty($requestButtonTitle) ? 'aria-label="Request Service"' : 'aria-label="' . $requestButtonTitle . '"'; ?>
                   class="btn btn-secondary mw-226 request_service_button"
                   <?php echo !empty($open_new_tab) && $open_new_tab == 1 ? 'target="_blank"' : ''; ?>>
                   <?php echo empty($requestButtonTitle) ? 'Request Service' : $requestButtonTitle; ?>
                   <i class="icon-chevron-right text_18 line_height_18 ms-2"></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($date) && $noexpiry != 1) : ?>
                <span class="pt-lg-3 pt-2 d-block px-3 coupon_expiry">Expires <?php echo $date; ?></span>
            <?php endif; ?>

            <?php if (!empty($footer_heading)) : ?>
                <span class="d-block coupon_disclaimer"><?php echo $footer_heading; ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

            <?php
			}
		endwhile; ?>
    <?php
	}
} ?> 