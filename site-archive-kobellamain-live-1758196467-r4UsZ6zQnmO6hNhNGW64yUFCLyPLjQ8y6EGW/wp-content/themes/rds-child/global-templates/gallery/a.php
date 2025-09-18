<?php
global $post;
$get_rds_template_data_array = rds_template();

// Handle pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$total_posts = 0;

// Get selected category from query string
$cat_slug = isset($_GET['cat']) ? sanitize_text_field($_GET['cat']) : '';

// Fetch all gallery categories
$categories = get_terms([
    'taxonomy'   => 'bc_gallery_category',
    'hide_empty' => true,
]);
?>

<style type="text/css">
    .mySwiper-lightbox {
        visibility: hidden;
    }
    html {
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>

<main>
    <div class="w-100 d-block">
        <div class="d-flex flex-column">
            <div class="container-fluid pt-4 pt-lg-5 mt-2 px-lg-3 px-0">
                <div class="container px-lg-3 px-0">
                    <div class="row pb-lg-2 mx-0">
                        <div class="col-12">
                            <h1 class="mb-0 pb-4"><?php the_title(); ?></h1>
                            <p>
                                <?php
                                $content = get_post_field('post_content', $post->ID);
                                echo $content ? do_shortcode($content) : $get_rds_template_data_array['page_templates']['gallery_page']['content'];
                                ?>
                            </p>

                            <?php get_template_part('sidebar-templates/search', 'gallerytopbar'); ?>

                            <div class="row mt-3">
                                <?php
                                foreach ($categories as $category) {
                                    if ($cat_slug && $cat_slug !== 'categories' && $category->slug !== $cat_slug) {
                                        continue; // Skip non-matching categories
                                    }

                                    echo '<h2>' . esc_html($category->name) . '</h2>';

                                    // Query posts for each category
                                    $args = [
                                        'post_type'      => 'bc_galleries',
                                        'posts_per_page' => -1,
                                        'paged'          => $paged,
                                        'tax_query'      => [
                                            [
                                                'taxonomy' => 'bc_gallery_category',
                                                'field'    => 'term_id',
                                                'terms'    => $category->term_id,
                                            ],
                                        ],
                                    ];


                                    $gallery_posts = new WP_Query($args);

                                    if ($gallery_posts->have_posts()) :
                                        while ($gallery_posts->have_posts()) : $gallery_posts->the_post();
                                            get_template_part('loop-templates/content-gallery');
                                            $total_posts++;
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        get_template_part('loop-templates/content', 'none');
                                    endif;
                                }
                                ?>
                            </div>

                            <div class="d-flex align-items-center justify-content-center my-5">
                                <?php
                                echo paginate_links([
                                    'total'     => $gallery_posts->max_num_pages,
                                    'current'   => $paged,
                                    'prev_text' => '<i class="icon-angles-left4"></i>',
                                    'next_text' => '<i class="icon-angles-right4"></i>',
                                ]);
                                ?>
                            </div>

                            <?php get_template_part('page-templates/common/bc-gallery-popup'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
<script>
    var gallerySwiper;
    var activeSlideIndex = 0;

    document.addEventListener("DOMContentLoaded", function () {
        gallerySwiper = new Swiper('.swiper_custom', {
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                slideChange: function () {
                    activeSlideIndex = this.activeIndex;
                }
            }
        });

        jQuery(".gallery_modal").on('hide.bs.modal', function () {
            activeSlideIndex = gallerySwiper.activeIndex;
        });

        jQuery(".gallery_modal").on('show.bs.modal', function () {
            gallerySwiper = new Swiper('.swiper_custom', {
                slidesPerView: 1,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                initialSlide: activeSlideIndex,
            });
        });
    });
</script>