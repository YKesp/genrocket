<?php /* Template Name: TDG Template */ ?>

<?php get_header(); ?>
<style type="text/css">
    .inner-page h5 {
        color: #000;
        font-size: 26px;
        line-height: 1.2;
        margin: 0 0 20px;
        font-weight: 700;
    }
</style>
    <div class="banner ">

        <img src="<?php bloginfo('template_url'); ?>/assets/images/tdgbanner1.png" alt="GenRocket - Test Data Management">

    </div>

    <main id="main">

        <div class="block inner-page">

            <div class="container">

                <?php

                if(have_posts()){

                    while(have_posts()){

                        the_post();

                        the_content();

                    }

                }

                ?>

            </div>

        </div>

    </main>

<?php get_footer(); ?>

