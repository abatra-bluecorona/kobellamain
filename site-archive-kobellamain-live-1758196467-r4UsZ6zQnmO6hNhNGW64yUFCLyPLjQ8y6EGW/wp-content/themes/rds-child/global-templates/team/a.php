<div class="container-fluid py-lg-5 py-4">
    <div class="container px-lg-3 px-0 overflow-hidden">
        <div class="row">
            <div class="col-lg-12 mb-lg-5 pb-4">
                <h1><?php echo !empty(get_the_title()) ? get_the_title() : ''; ?></h1>
                
            </div>
        </div>

        <!-- FIRST TEAM QUERY -->
        <div class="row">
            <?php
            $team_args = [
                "post_type"      => "bc_teams",
                "posts_per_page" => -1,
                "order"          => "DESC",
                "post_status"    => "publish",
                "tax_query"      => [
                    [
                        "taxonomy" => "bc_teams_category",
                        "field"    => "term_id",
                        "terms"    => 34,
                    ]
                ]
            ];

            $query = new WP_Query($team_args);
            if ($query->have_posts()):
                while ($query->have_posts()): $query->the_post();
                    $image_full = get_the_post_thumbnail_url(get_the_ID(), "full") ?: get_exist_image_url("meet-the-team", "team_placeholder.png");
            ?>
                <div class="col-lg-4 team_card [ is-collapsed ] border-0">
                    <div class="card__inner [ js-expander ] mb-4">
                        <div class="team_img">
                            <img src="<?php echo esc_url($image_full); ?>" class="img-fluid w-100" alt="team image" width="350" height="220">
                        </div>
                        <div class="row pt-3">
                            <div class="col-8">
                                <h3><?php the_title(); ?></h3>
                                <span class="h7">
                                    <?php echo esc_html(get_post_meta(get_the_ID(), "team_position", true) ?: ''); ?>
                                </span>
                            </div>
                            <div class="col-4 pt-1">
                                <span class="d-block text-end text-uppercase text_18 line_height_23 font_alt_2 text_medium color_primary">
                                    bio <i class="icon-plus1 text_18 line_height_18"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card__expander pb-4">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <!-- SECOND TEAM QUERY -->
        <div class="row">
            <?php
            $team_args = [
                "post_type"      => "bc_teams",
                "posts_per_page" => -1,
                "order"          => "DESC",
                "post_status"    => "publish",
                "tax_query"      => [
                    [
                        "taxonomy" => "bc_teams_category",
                        "field"    => "term_id",
                        "terms"    => 34,
                        "operator" => "NOT IN",
                    ]
                ]
            ];

            $query = new WP_Query($team_args);
            if ($query->have_posts()):
                while ($query->have_posts()): $query->the_post();
                    $image_full = get_the_post_thumbnail_url(get_the_ID(), "full") ?: get_exist_image_url("meet-the-team", "team_placeholder.png");
            ?>
                <div class="col-lg-4 team_card [ is-collapsed ] border-0">
                    <div class="card__inner [ js-expander ] mb-4">
                        <div class="team_img">
                            <img src="<?php echo esc_url($image_full); ?>" class="img-fluid w-100" alt="team image" width="350" height="220">
                        </div>
                        <div class="row pt-3">
                            <div class="col-8">
                                <h3><?php the_title(); ?></h3>
                                <span class="h7">
                                    <?php echo esc_html(get_post_meta(get_the_ID(), "team_position", true) ?: ''); ?>
                                </span>
                            </div>
                            <div class="col-4 pt-1">
                                <span class="d-block text-end text-uppercase text_18 line_height_23 font_alt_2 text_medium color_primary">
                                    bio <i class="icon-plus1 text_18 line_height_18"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card__expander pb-4">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>

<!-- JavaScript for Team Cards -->
<script>
    jQuery(document).ready(function() {
        var $cell = jQuery('.team_card');

        $cell.find('.js-expander').click(function() {
            var $thisCell = jQuery(this).closest('.team_card');

            if ($thisCell.hasClass('is-collapsed')) {
                $thisCell.siblings('.team_card').find('i').removeClass('icon-minus1').addClass('icon-plus1');
                $thisCell.find('i').toggleClass('icon-plus1 icon-minus1');
                $cell.not($thisCell).removeClass('is-expanded').addClass('is-collapsed');
                $thisCell.removeClass('is-collapsed').addClass('is-expanded');
            } else {
                $thisCell.find('i').toggleClass('icon-plus1 icon-minus1');
                $thisCell.removeClass('is-expanded').addClass('is-collapsed');
                $cell.not($thisCell).removeClass('is-inactive');
            }
        });

        $cell.find('.js-collapser').click(function() {
            var $thisCell = jQuery(this).closest('.team_card');
            $thisCell.removeClass('is-expanded').addClass('is-collapsed');
            $cell.not($thisCell).removeClass('is-inactive');
        });
    });
</script>
