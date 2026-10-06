<?php
    //if ( !session_id() ) {
    //    session_start();
    //}
    
    function genrocket_start_session() {
    if ( session_status() === PHP_SESSION_NONE && ! headers_sent() ) {
        session_start();
    }
}
    
    //--------- above lines commented / added by Kay on Aug 20, 2026
    
    /**
     * Monarch functions and definitions
     * @package WordPress
     * @subpackage California Defensa Criminal
     */
    add_action( 'wp_footer', 'redirect_cf7' );
    function redirect_cf7() { ?>
        <script type="text/javascript">
            document.addEventListener( 'wpcf7mailsent', function( event ) {
                if ( '4291' == event.detail.contactFormId ) { //Contact Form ID
                    location = '<?php echo get_page_link(4298); ?>'; // Page ID
                }
                else if( '3649' == event.detail.contactFormId ) {
                    location = '<?php echo get_page_link(7739); ?>'; // Page ID
                }
                else{
                    location = '<?php echo esc_url(site_url()); ?>/thank-you/';
                }
            }, false );
        </script>
    <?php }
        /**************************************************
                        REMOVE ADMIN MENU
        **************************************************/
                        function remove_menus(){
    // remove_menu_page( 'index.php' );               //Dashboard
    remove_menu_page( 'edit.php' );                   //Posts
    // remove_menu_page( 'upload.php' );              //Media
    remove_menu_page( 'edit-comments.php' );          //Comments
    // remove_menu_page( 'plugins.php' );             //Plugins
    // remove_menu_page( 'users.php' );               //Users
    //remove_menu_page( 'tools.php' );                  //Tools
    // remove_menu_page( 'options-general.php' );     //Settings
    }
    add_action( 'admin_menu', 'remove_menus' );

    // Remove WordPress version from header
    remove_action('wp_head', 'wp_generator');

    // Remove WordPress version from RSS feeds
    add_filter('the_generator', '__return_empty_string');

    // Remove version from scripts and styles
    function remove_version_from_scripts($src) {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
    add_filter('style_loader_src', 'remove_version_from_scripts', 9999);
    add_filter('script_loader_src', 'remove_version_from_scripts', 9999);

    function add_sri_attributes($tag, $handle, $src) {
        // List the handles of the scripts you want to secure
        $scripts_to_secure = [
            'bootstrap-js' => 'sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor',
        ];

        if (array_key_exists($handle, $scripts_to_secure)) {
            return str_replace(
                ' src',
                ' integrity="' . $scripts_to_secure[$handle] . '" crossorigin="anonymous" src',
                $tag
            );
        }
        return $tag;
    }
    add_filter('script_loader_tag', 'add_sri_attributes', 10, 3);

        /**************************************************
                        HIDE UPDATE OPTION
        **************************************************/
    /*function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
    add_filter('pre_site_transient_update_plugins','remove_core_updates');*/
        /**************************************************
                    REGISTER HEADER AND FOOTER
        **************************************************/
                    register_nav_menus( array(
                    'top'  => __( 'Top Menu', 'genrocket' ),
                    'footer-nav'  => __( 'Footer Menu', 'genrocket' ),
                    'products-subnav'  => __( 'Products SubMenu', 'genrocket' ),
                    'social' => __( 'Social Links Menu', 'genrocket' ),
                ) );
                    add_theme_support( 'menus' );
        /**************************************************
                    ADD CLASS IN MENU ANCHOR LINK
        **************************************************/
        /**************************************************
                    register Widget
        **************************************************/
                    register_sidebar( array(
                        'id'          => 'latest-posts',
                        'name'        => __( 'Lates Posts' ),
                        'description' => __( 'This sidebar is located in footer.' ),
                    ) );
                    function wpse156165_menu_add_class( $atts, $item, $args, $depth ) {
                    if ($depth === 0) {
                        if($args->theme_location == 'top'){
                            $class = 'nav-link';
                            $atts['class'] = $class;
                        }
                    }
                    return $atts;
                }
                add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 4 );
                /***************************/
                if (function_exists('acf_add_options_page')) {
                    acf_add_options_page(array(
                        'page_title' => 'Theme General Settings',
                        'menu_title' => 'Theme Settings',
                        'menu_slug' => 'theme-general-settings',
                        'capability' => 'edit_posts',
                        'redirect' => false
                    ));
        /*acf_add_options_sub_page(array(
            'page_title' => 'Theme Footer Settings',
            'menu_title' => 'Footer',
            'parent_slug' => 'theme-general-settings',
        ));*/
    }
    function print_menu_shortcode($atts, $content = null) {
        return wp_nav_menu(array(
        'theme_location'  => $atts["name"],
        'container'       => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => false,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'depth'           => 0
    ));
    }
    add_shortcode('custom_menu', 'print_menu_shortcode');
    /**************************************************
             Span option enabled in editor
            **************************************************/
            function override_mce_options($initArray)
            {
                $opts = '*[*]';
                $initArray['valid_elements'] = $opts;
                $initArray['extended_valid_elements'] = $opts;
                return $initArray;
            }
            add_filter('tiny_mce_before_init', 'override_mce_options');
    /**************************************************
             Span option enabled in editor
            **************************************************/
            /**************News Post Type********************/
            function news_post_type() {
                $labels = array(
                    'name'                => _x( 'News', 'Post Type General Name', 'genrocket' ),
                    'singular_name'       => _x( 'News', 'Post Type Singular Name', 'genrocket' ),
                    'menu_name'           => __( 'News & Events', 'genrocket' ),
                    'parent_item_colon'   => __( 'Parent News', 'genrocket' ),
                    'all_items'           => __( 'All News', 'genrocket' ),
                    'view_item'           => __( 'View News', 'genrocket' ),
                    'add_new_item'        => __( 'Add New News', 'genrocket' ),
                    'add_new'             => __( 'Add New', 'genrocket' ),
                    'edit_item'           => __( 'Edit News', 'genrocket' ),
                    'update_item'         => __( 'Update News', 'genrocket' ),
                    'search_items'        => __( 'Search News', 'genrocket' ),
                    'not_found'           => __( 'Not Found', 'genrocket' ),
                    'not_found_in_trash'  => __( 'Not found in Trash', 'genrocket' ),
                );
                $args = array(
                    'label'               => __( 'news', 'genrocket' ),
                    'description'         => __( 'News news and reviews', 'genrocket' ),
                    'labels'              => $labels,
                    'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
                    'taxonomies'          => array( 'news-category' ),
                    'hierarchical'        => false,
                    'public'              => true,
                    'show_ui'             => true,
                    'show_in_menu'        => true,
                    'show_in_nav_menus'   => true,
                    'show_in_admin_bar'   => true,
                    'menu_position'       => 5,
                    'can_export'          => true,
                    'has_archive'         => 'news',
                    'exclude_from_search' => false,
                    'publicly_queryable'  => true,
                    'capability_type'     => 'page',
                    'rewrite'             => array( 'slug' => 'news', 'with_front' => false ),
                );
                register_post_type( 'news', $args );
            }
            add_action( 'init', 'news_post_type', 0 );

            // Custom rewrite rules for news posts with category in URL (/news/%news-category%/%postname%/)
            add_action( 'init', 'genrocket_news_rewrite_rules', 10 );
            function genrocket_news_rewrite_rules() {
                // 2 segments with pagination: /news/category-slug/post-slug/2/
                add_rewrite_rule(
                    '^news/([^/]+)/([^/]+)/([0-9]+)/?$',
                    'index.php?news=$matches[2]&page=$matches[3]',
                    'top'
                );
                // 2 segments: /news/category-slug/post-slug/
                add_rewrite_rule(
                    '^news/([^/]+)/([^/]+)/?$',
                    'index.php?news=$matches[2]',
                    'top'
                );
            }

            // Dynamic permalink for News: show category in URL if assigned, or direct URL if not assigned
            add_filter( 'post_type_link', 'genrocket_news_post_type_link', 10, 2 );
            function genrocket_news_post_type_link( $post_link, $post ) {
                if ( is_object( $post ) && $post->post_type === 'news' ) {
                    $terms = wp_get_object_terms( $post->ID, 'news-category' );
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        $cat_slug = $terms[0]->slug;
                        return home_url( user_trailingslashit( 'news/' . $cat_slug . '/' . $post->post_name ) );
                    } else {
                        return home_url( user_trailingslashit( 'news/' . $post->post_name ) );
                    }
                }
                return $post_link;
            }

            // Flush rewrite rules automatically when update is deployed
            add_action( 'init', 'genrocket_flush_news_rewrite_rules_once', 99 );
            function genrocket_flush_news_rewrite_rules_once() {
                $version = '1.4';
                if ( get_option( 'genrocket_news_rewrite_version' ) !== $version ) {
                    flush_rewrite_rules( false );
                    update_option( 'genrocket_news_rewrite_version', $version );
                }
            }
            /**************News Post Type********************/
            function partner_resource() {
                $labels = array(
                    'name'                => _x( 'Partner Resource', 'Post Type General Name', 'genrocket' ),
                    'singular_name'       => _x( 'Partner Resource', 'Post Type Singular Name', 'genrocket' ),
                    'menu_name'           => __( 'Partner Resource', 'genrocket' ),
                    'parent_item_colon'   => __( 'Parent Partner Resource', 'genrocket' ),
                    'all_items'           => __( 'All Partner Resource', 'genrocket' ),
                    'view_item'           => __( 'View Partner Resource', 'genrocket' ),
                    'add_new_item'        => __( 'Add New Partner Resource', 'genrocket' ),
                    'add_new'             => __( 'Add New', 'genrocket' ),
                    'edit_item'           => __( 'Edit Partner Resource', 'genrocket' ),
                    'update_item'         => __( 'Update Partner Resource', 'genrocket' ),
                    'search_items'        => __( 'Search Partner Resource', 'genrocket' ),
                    'not_found'           => __( 'Not Found', 'genrocket' ),
                    'not_found_in_trash'  => __( 'Not found in Trash', 'genrocket' ),
                );
                $args = array(
                    'label'               => __( 'Partner Resource', 'genrocket' ),
                    'description'         => __( 'Partner Resource', 'genrocket' ),
                    'labels'              => $labels,
                    'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
                    'taxonomies'          => array( 'genres' ),
                    'hierarchical'        => false,
                    'public'              => true,
                    'show_ui'             => true,
                    'show_in_menu'        => true,
                    'show_in_nav_menus'   => true,
                    'show_in_admin_bar'   => true,
                    'menu_position'       => 5,
                    'can_export'          => true,
                    'has_archive'         => true,
                    'exclude_from_search' => false,
                    'publicly_queryable'  => true,
                    'capability_type'     => 'page',
                );
                register_post_type( 'partner-resource', $args );
            }
            add_action( 'init', 'partner_resource', 0 );
    // hook into the init action and call create_services_taxonomies when it fires
            add_action( 'init', 'create_partner_resource_taxonomies', 0 );
            function create_partner_resource_taxonomies() {
                $labels = array(
                    'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
                    'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
                    'search_items'      => __( 'Search Categories', 'textdomain' ),
                    'all_items'         => __( 'All Categories', 'textdomain' ),
                    'parent_item'       => __( 'Parent Category', 'textdomain' ),
                    'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
                    'edit_item'         => __( 'Edit Category', 'textdomain' ),
                    'update_item'       => __( 'Update Category', 'textdomain' ),
                    'add_new_item'      => __( 'Add New Category', 'textdomain' ),
                    'new_item_name'     => __( 'New Category Name', 'textdomain' ),
                    'menu_name'         => __( 'Categories', 'textdomain' ),
                );
                $args = array(
                    'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite'           => array( 'slug' => 'partner-category', 'with_front' => true ),
                );
                register_taxonomy( 'partner-category', array( 'partner-resource' ), $args );
            }
            add_action( 'widgets_init', 'theme_slug_widgets_init' );
            function theme_slug_widgets_init() {
                register_sidebar( array(
                    'name' => __( 'Partner Categories Dropdown', 'theme-slug' ),
                    'id' => 'partner-categories-dropdown',
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<span class="widgettitle">',
                    'after_title'   => '<span>',
                ) );
            }
    // hook into the init action and call create_services_taxonomies when it fires
            add_action( 'init', 'create_news_taxonomies', 0 );
            function create_news_taxonomies() {
                $labels = array(
                    'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
                    'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
                    'search_items'      => __( 'Search Categories', 'textdomain' ),
                    'all_items'         => __( 'All Categories', 'textdomain' ),
                    'parent_item'       => __( 'Parent Category', 'textdomain' ),
                    'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
                    'edit_item'         => __( 'Edit Category', 'textdomain' ),
                    'update_item'       => __( 'Update Category', 'textdomain' ),
                    'add_new_item'      => __( 'Add New Category', 'textdomain' ),
                    'new_item_name'     => __( 'New Category Name', 'textdomain' ),
                    'menu_name'         => __( 'Categories', 'textdomain' ),
                );
                $args = array(
                    'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite'           => array( 'slug' => 'category', 'with_front' => true ),
                );
                register_taxonomy( 'news-category', array( 'news' ), $args );
            }
            function genrocket_filter_category_request( $query_vars ) {
                // 1. Handle /category/category-name/ request
                if ( isset( $query_vars['category_name'] ) ) {
                    $raw_slug = $query_vars['category_name'];
                    $slug = basename( untrailingslashit( $raw_slug ) );
                    $term = get_term_by( 'slug', $slug, 'news-category' );
                    if ( ! $term || is_wp_error( $term ) ) {
                        $term = get_term_by( 'name', $slug, 'news-category' );
                    }
                    if ( $term && ! is_wp_error( $term ) ) {
                        unset( $query_vars['category_name'] );
                        unset( $query_vars['name'] );
                        $query_vars['news-category'] = $term->slug;
                        $query_vars['taxonomy']      = 'news-category';
                        $query_vars['term']          = $term->slug;
                        $query_vars['post_type']     = 'news';
                    }
                }

                // 2. Handle /news/slug/ where slug might be a news-category term rather than a post name
                if ( ! is_admin() ) {
                    $candidate_slug = '';
                    if ( ! empty( $query_vars['news'] ) ) {
                        $candidate_slug = $query_vars['news'];
                    } elseif ( isset( $query_vars['post_type'] ) && $query_vars['post_type'] === 'news' && ! empty( $query_vars['name'] ) ) {
                        $candidate_slug = $query_vars['name'];
                    }

                    if ( ! empty( $candidate_slug ) ) {
                        global $wpdb;
                        $post_exists = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = 'news' AND post_status = 'publish' LIMIT 1", $candidate_slug ) );

                        // If no news post with this slug, check if it matches a news-category term
                        if ( ! $post_exists ) {
                            $term = get_term_by( 'slug', $candidate_slug, 'news-category' );
                            if ( ! $term || is_wp_error( $term ) ) {
                                $term = get_term_by( 'name', $candidate_slug, 'news-category' );
                            }
                            if ( $term && ! is_wp_error( $term ) ) {
                                unset( $query_vars['news'] );
                                unset( $query_vars['name'] );
                                $query_vars['news-category'] = $term->slug;
                                $query_vars['taxonomy']      = 'news-category';
                                $query_vars['term']          = $term->slug;
                                $query_vars['post_type']     = 'news';
                            }
                        }
                    }
                }

                return $query_vars;
            }
            add_filter( 'request', 'genrocket_filter_category_request' );

            function genrocket_include_custom_post_types_in_categories( $query ) {
                if ( ! is_admin() && $query->is_main_query() ) {
                    if ( $query->is_category() || $query->is_tag() || $query->is_tax( 'news-category' ) ) {
                        $query->set( 'post_type', array( 'post', 'news' ) );
                    }
                }
            }
            add_action( 'pre_get_posts', 'genrocket_include_custom_post_types_in_categories' );
            /**************Lessons Post Type********************/
            function lessons_post_type() {
                $labels = array(
                    'name'                => _x( 'Lessons', 'Post Type General Name', 'genrocket' ),
                    'singular_name'       => _x( 'Lessons', 'Post Type Singular Name', 'genrocket' ),
                    'menu_name'           => __( 'Lessons', 'genrocket' ),
                    'parent_item_colon'   => __( 'Parent Lessons', 'genrocket' ),
                    'all_items'           => __( 'All Lessons', 'genrocket' ),
                    'view_item'           => __( 'View Lessons', 'genrocket' ),
                    'add_new_item'        => __( 'Add New Lessons', 'genrocket' ),
                    'add_new'             => __( 'Add New', 'genrocket' ),
                    'edit_item'           => __( 'Edit Lessons', 'genrocket' ),
                    'update_item'         => __( 'Update Lessons', 'genrocket' ),
                    'search_items'        => __( 'Search Lessons', 'genrocket' ),
                    'not_found'           => __( 'Not Found', 'genrocket' ),
                    'not_found_in_trash'  => __( 'Not found in Trash', 'genrocket' ),
                );
                $args = array(
                    'label'               => __( 'lessons', 'genrocket' ),
                    'description'         => __( 'lessons and reviews', 'genrocket' ),
                    'labels'              => $labels,
                    'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
                    'taxonomies'          => array( 'genres' ),
                    'hierarchical'        => true,
                    'menu_icon'           => 'dashicons-media-document',
                    'public'              => true,
                    'show_ui'             => true,
                    'show_in_menu'        => true,
                    'show_in_nav_menus'   => true,
                    'show_in_admin_bar'   => true,
                    'menu_position'       => 5,
                    'can_export'          => true,
                    'has_archive'         => true,
                    'exclude_from_search' => false,
                    'publicly_queryable'  => true,
                    'capability_type'     => 'page',
            //'rewrite' => false,
                );
                register_post_type( 'flight-school', $args );
            }
            add_action( 'init', 'lessons_post_type', 0 ); 
    // hook into the init action and call create_services_taxonomies when it fires
            add_action( 'init', 'create_lessons_taxonomies', 0 );
            function create_lessons_taxonomies() {
                $labels = array(
                    'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
                    'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
                    'search_items'      => __( 'Search Categories', 'textdomain' ),
                    'all_items'         => __( 'All Categories', 'textdomain' ),
                    'parent_item'       => __( 'Parent Category', 'textdomain' ),
                    'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
                    'edit_item'         => __( 'Edit Category', 'textdomain' ),
                    'update_item'       => __( 'Update Category', 'textdomain' ),
                    'add_new_item'      => __( 'Add New Category', 'textdomain' ),
                    'new_item_name'     => __( 'New Category Name', 'textdomain' ),
                    'menu_name'         => __( 'Categories', 'textdomain' ),
                );
                $args = array(
                    'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite'           => array( 'slug' => 'category', 'with_front' => true ),
                );
                register_taxonomy( 'lessons-category', array( 'flight-school' ), $args );
            }
            /**************Newsletter Post Type********************/
            function newsletter_post_type() {
            $singular = 'Newsletter';
            $plural = 'Newsletters';
            $labels = array(
                'name'                => _x($plural, 'Post Type General Name', 'genrocket' ),
                'singular_name'       => _x($singular, 'Post Type Singular Name', 'genrocket' ),
                'menu_name'           => __( $plural, 'genrocket' ),
                'parent_item_colon'   => __( 'Parent '.$plural, 'genrocket' ),
                'all_items'           => __( 'All '.$plural, 'genrocket' ),
                'view_item'           => __( 'View '.$singular, 'genrocket' ),
                'add_new_item'        => __( 'Add New '.$singular, 'genrocket' ),
                'add_new'             => __( 'Add New', 'genrocket' ),
                'edit_item'           => __( 'Edit '.$singular, 'genrocket' ),
                'update_item'         => __( 'Update '.$singular, 'genrocket' ),
                'search_items'        => __( 'Search '.$singular, 'genrocket' ),
                'not_found'           => __( 'Not Found', 'genrocket' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'genrocket' ),
            );
            $args = array(
                'label'               => __( $singular, 'genrocket' ),
                'description'         => __( $singular.' reviews', 'genrocket' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
                'taxonomies'          => array( 'newsletters' ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
            );
            register_post_type( 'newsletter', $args );
        }
        add_action( 'init', 'newsletter_post_type', 0 );
    // hook into the init action and call create_services_taxonomies when it fires
        add_action( 'init', 'create_newsletters_taxonomies', 0 );
        function create_newsletters_taxonomies() {
            $labels = array(
                'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
                'search_items'      => __( 'Search Categories', 'textdomain' ),
                'all_items'         => __( 'All Categories', 'textdomain' ),
                'parent_item'       => __( 'Parent Category', 'textdomain' ),
                'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
                'edit_item'         => __( 'Edit Category', 'textdomain' ),
                'update_item'       => __( 'Update Category', 'textdomain' ),
                'add_new_item'      => __( 'Add New Category', 'textdomain' ),
                'new_item_name'     => __( 'New Category Name', 'textdomain' ),
                'menu_name'         => __( 'Categories', 'textdomain' ),
            );
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'newsletters', 'with_front' => true ),
            );
            register_taxonomy( 'newsletter-category', array( 'newsletter' ), $args );
        }
        add_filter( 'init', 'disableWpautop', 10, 2);
        function disableWpautop(){
        remove_filter( 'the_content', 'wpautop');
        remove_filter( 'the_excerpt', 'wpautop');
        remove_filter( 'acf_the_content', 'wpautop');
        add_filter('the_content', 'wpautop', 12);
        function wpse_wpautop_nobr( $content ) {
        return wpautop( $content, false );
    }
    function remove_empty_p( $content ) {
        $content = force_balance_tags( $content );
        $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
        $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
        return $content;
    }
    }
    /*add_filter('single_template', function($original){
    global $post;
    $post_name = $post->post_name;
    $post_type = $post->post_type;
    $base_name = $post_type . '-' . $post_name . '.php';
    $template = locate_template($base_name);
    if ($template && ! empty($template)) return $template;
    return $original;
    });*/
    function zakra_post_navigation() {
    the_post_navigation( array( 'in_same_term' => true, ) );
    }
    add_action( 'zakra_after_single_post_content', 'zakra_post_navigation', 10 );
    // add_filter('wp_feed_cache_transient_lifetime', create_function('', 'return 60;'));
    /**
     * Setting a new cache time for feeds in WordPress
     */
    // function prefix_set_feed_cache_time( $seconds ) {
    //   return 1;
    // }
    // add_filter( 'wp_feed_cache_transient_lifetime' , 'prefix_set_feed_cache_time' );
    function danniee001_feed_lifetime( $interval, $url ) {
    $interval = 10;
    return $interval;
    }
    add_filter( 'wp_feed_cache_transient_lifetime', 'danniee001_feed_lifetime', 10, 2 );
    remove_theme_support( 'title-tag' );
    /*
    // Add custom validation for CF7 form fields
        function is_company_email($email){ // Check against list of common public email providers & return true if the email provided *doesn't* match one of them
                if(
                        preg_match('/@gmail.com/i', $email) ||
                        preg_match('/@hotmail.com/i', $email) ||
                        preg_match('/@live.com/i', $email) ||
                        preg_match('/@msn.com/i', $email) ||
                        preg_match('/@aol.com/i', $email) ||
                        preg_match('/@yahoo.com/i', $email) ||
                        preg_match('/@inbox.com/i', $email) ||
                        preg_match('/@gmx.com/i', $email) ||
                        preg_match('/@me.com/i', $email)
                ){
                        return false; // It's a publicly available email address
                }else{
                        return true; // It's probably a company email address
                }
        }
        function your_validation_filter_func($result,$tag){
        //echo '<pre>';
        //print_r($tag);
                $type = $tag['type'];
                $name = $tag['name'];
                if('email' == $type){ // Only apply to fields with the form field name of "company-email"
                        $the_value = $_POST[$name];
                        if(!is_company_email($the_value)){ // Isn't a company email address (it matched the list of free email providers)
                                $result['valid'] = false;
                                $result['reason'][$name] = 'You need to provide an email address that isn\'t hosted by a free provider.<br />Please contact us directly if this isn\'t possible.';
                        }
                }
                return $result;
        }
    //add_filter( 'wpcf7_validate_text', 'your_validation_filter_func', 20, 2 ); // Email field or contact number field
    //add_filter( 'wpcf7_validate_text*', 'your_validation_filter_func', 20, 2 ); // Req. Email field or contact number
    add_filter( 'wpcf7_validate_email', 'your_validation_filter_func', 1, 2 );
    add_filter( 'wpcf7_validate_email*', 'your_validation_filter_func', 1, 2 );
    */
    /*
    // Add custom validation for CF7 form fields
    function is_company_email($email){
    // Check against list of common public email providers & return true if the email provided doesn't match one of them
    if(
    preg_match('/@gmail.com/i', $email) ||
    preg_match('/@hotmail.com/i', $email) ||
    preg_match('/@live.com/i', $email) ||
    preg_match('/@msn.com/i', $email) ||
    preg_match('/@aol.com/i', $email) ||
    preg_match('/@yahoo.com/i', $email) ||
    preg_match('/@inbox.com/i', $email) ||
    preg_match('/@gmx.com/i', $email) ||
    preg_match('/@me.com/i', $email)
    ){
        return false; // It's a publicly available email address
    }else{
        return true; // It's probably a company email address
    }
    }
    function custom_email_validation_filter($result,$tag){
    $type = $tag['type'];
    $name = $tag['name'];
    if($type == 'email'){ // Only apply to fields with the form field name of "comany-email"
        $the_value = $_POST[$name];
        if(!is_company_email($the_value)){ // Isn't a company email address (it matched the list of free email providers)
            $result['valid'] = false;
            $result['reason'][$name] = 'You need to provide an email address that isn\'t hosted by a free provider.
    Please contact us directly if this isn\'t possible.';
        }
    }
    return $result;
    }
    add_filter('wpcf7_validate_email','custom_email_validation_filter', 40, 2); // Email field
    add_filter('wpcf7_validate_email*', 'custom_email_validation_filter',40, 2); // Req. Email field
    */
    /* Validation filter */
    // remove_filter( 'wpcf7_validate_text');
    // remove_filter( 'wpcf7_validate_text*');
    // remove_filter( 'wpcf7_validate_email');
    // remove_filter( 'wpcf7_validate_email*');
    // remove_filter( 'wpcf7_validate_url');
    // remove_filter( 'wpcf7_validate_url*');
    // remove_filter( 'wpcf7_validate_tel');
    // remove_filter( 'wpcf7_validate_tel*');
    add_filter( 'wpcf7_validate_text', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_text*', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_email', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_email*', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_url', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_url*', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_tel', 'wpcf7_text_validation_filter123', 1, 2 );
    add_filter( 'wpcf7_validate_tel*', 'wpcf7_text_validation_filter123', 1, 2 );
    function wpcf7_text_validation_filter123( $result, $tag ) {
    $name = $tag->name;
    $value = isset( $_POST[$name] )
    ? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
    : '';
    if ( 'text' == $tag->basetype ) {
        if ( $tag->is_required() and '' == $value ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
    }
    }
    /*
    if ( 'email' == $tag->basetype ) {
        if ( $tag->is_required() and '' == $value ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        } elseif ( '' != $value and ! wpcf7_is_email( $value ) ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_email' ) );
        }
    }*/
    if ( 'email' == $tag->basetype && 'email_address' != $tag->name ) {
    /*add the domain names you want to block in the $domains array*/
        // $domains = array("gmail.com","yahoo.com","yahoo.co.in","hotmail.com","live.com","msn.com","aol.com","inbox.com","gmx.com","me.com");
    $domains = array("gmail.com","yahoo.com","yahoo.co.in","hotmail.com","live.com","msn.com","aol.com","inbox.com","gmx.com","me.com","zoho.com","mail.com","protonmail.com","yandex.com","tutanota.com","icloud.com");
        /*explode will store the string into array
            e.g: example@gmail.com
            array(example, gmail.com)*/
            $udomain = explode('@', $value);
        //select the email domain from the above splitted array
            $email_domain = $udomain[1];
        // check name is 'company-email' else default validation will work
        //if('email' == $tag->name) {
            //check entered value = $value exists in $domain array
            if(in_array($email_domain, $domains)) {
                //display error
                $result->invalidate( $tag, "Use Business Email" );
            }
        //}
        //email field is empty
            if ( $tag->is_required() && '' == $value ) {
                $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
            }
        //check basic email validation
            elseif ( '' != $value && ! wpcf7_is_email( $value ) ) {
                $result->invalidate( $tag, wpcf7_get_message( 'invalid_email' ) );
            }
        }
        if ( 'url' == $tag->basetype ) {
            if ( $tag->is_required() and '' == $value ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        } elseif ( '' != $value and ! wpcf7_is_url( $value ) ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_url' ) );
        }
    }
    if ( 'tel' == $tag->basetype ) {
        if ( $tag->is_required() and '' == $value ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
    } elseif ( '' != $value and ! wpcf7_is_tel( $value ) ) {
        $result->invalidate( $tag, wpcf7_get_message( 'invalid_tel' ) );
    }
    }
    if ( '' !== $value ) {
        $maxlength = $tag->get_maxlength_option();
        $minlength = $tag->get_minlength_option();
        if ( $maxlength and $minlength and $maxlength < $minlength ) {
        $maxlength = $minlength = null;
    }
    $code_units = wpcf7_count_code_units( stripslashes( $value ) );
    if ( false !== $code_units ) {
        if ( $maxlength and $maxlength < $code_units ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_too_long' ) );
        } elseif ( $minlength and $code_units < $minlength ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_too_short' ) );
        }
    }
    }
    return $result;
    }
    /************Redirect Blog Posts************/
    function check_post_type(){
        global $post;
        //echo $post->ID;
        if('post' == get_post_type()){
            wp_redirect(site_url().'/blog/');
        }   
    }
    add_action('template_redirect', 'check_post_type');
    /***Remove Unnecessary Assets to home*******/
    include('remove-assets.php');
    add_shortcode('get_upload_file_link', 'print_menu_shortcode_2');
    function print_menu_shortcode_2($atts = null, $content = null) {
        $submission = WPCF7_Submission::get_instance();
        $files = $submission->uploaded_files();
        $upload_dir   = wp_upload_dir();
        return $upload_dir['basedir'] . '/advanced-cf7-upload/'.$files;
    }
    add_filter( 'init', 'disableWpautopCF7', 10, 2);
    function disableWpautopCF7(){
    add_filter( 'wpcf7_autop_or_not', '__return_false' );
    }
    function rudr_posts_taxonomy_filter() {
        global $typenow; // this variable stores the current custom post type
        if( $typenow == 'flight-school' ){ // choose one or more post types to apply taxonomy filter for them if( in_array( $typenow  array('post','games') )
        $taxonomy_names = array('lessons-category');
        foreach ($taxonomy_names as $single_taxonomy) {
            $current_taxonomy = isset( $_GET[$single_taxonomy] ) ? $_GET[$single_taxonomy] : '';
            $taxonomy_object = get_taxonomy( $single_taxonomy );
            $taxonomy_name = strtolower( $taxonomy_object->labels->name );
            $taxonomy_terms = get_terms( $single_taxonomy );
            $myterms = get_terms( array( 'lessons-category' => 'flight-school', 'parent' => 0 ) );
                //var_dump($taxonomy_terms);
            if(count($taxonomy_terms) > 0) {
                echo "<select name='$single_taxonomy' id='$single_taxonomy' class='postform'>";
                echo "<option value=''>All $taxonomy_name</option>";
                foreach ($taxonomy_terms as $single_term) {
                $child_term = get_term( $single_term->term_id, 'lessons-category' );
                $parent_term = get_term( $child_term->parent, 'lessons-category' );
                        //echo $parent_term->name;
                echo '<option value='. $single_term->slug, $current_taxonomy == $single_term->slug ? ' selected="selected"' : '','>' . $parent_term->name.' -> '.$single_term->name  . ' (' . $single_term->count .')</option>'; 
            }
            echo "</select>";
        }
    }
    }
    }
    add_action( 'restrict_manage_posts', 'rudr_posts_taxonomy_filter' );
    /**
     * Set the country code on Smart Phone form field country flag
     *
     * @link   https://wpforms.com/how-to-set-a-default-flag-on-smart-phone-field-with-gdpr/
     *
     */



    function wpf_dev_smart_phone_field_initial_country() {
        ?>
        <script type="text/javascript">
            function checkFormSubmitButton(){
                /*validateFormMixedFields();
                validateFormTextareaFields();
                validateFormPlaintextFields();
                validateFormTextFields();*/


                var formSubmitButton = true;

                var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                var urlSubmit = true;
                $( ".wpforms-form textarea").each(function() {
                    var message2 = this.value;

                    if(message2.match(urlRegex)){
                        urlSubmit = false;
                    }
                });
                
                var formSubmit = true;
                var emptyTextFields = true;
                $( ".wpforms-form input[type=email]" ).each(function() {
                    var str = this.value.toLowerCase();
                    
                    //console.log(str.includes('yahoo'));
                    if(str.includes('@yahoo') || str.includes('@gmail') || str.includes('@aol') || str.includes('@hotmail') || str.includes('@live') || str.includes('@msn') || str.includes('.cn') || str.includes('.ru') || str.includes('.kr') || str.includes('.ua') || str.includes('.oo') || str.includes('mailto:') || str.includes('@mail') || str.includes('@yaho.') || str.includes('@yaoo')){
                        formSubmit = false;

                        formSubmitButton = false;
                    }
                }); 

            //-----------------------------------------

                var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                var urlSubmit = false;
                var emptyTextareaFields = true;
                $( ".wpforms-form textarea").each(function() {
                    var message2 = this.value;
                    
                    if(message2 != "")
                        emptyTextareaFields = false;

                    if(message2.match(urlRegex)){
                        urlSubmit = true;
                        formSubmitButton = false;
                    }
                });

            //-----------------------------------------

                var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                var urlSubmit = false;
                var emptyTextareaFields = true;
                $( ".wpforms-form input[type='text']").each(function() {
                    var message2 = this.value;
                    console.log(this.value);
                    
                    if(message2 != "")
                        emptyTextareaFields = false;

                    if(message2.match(urlRegex)){
                        urlSubmit = true;
                        formSubmitButton = false;
                    }
                });

            //-----------------------------------------

                var formSubmit = true;
                var emptyTextFields= true;
                $( ".wpforms-form input[type=email]" ).each(function() {
                    var str = this.value.toLowerCase();

                    if(str != "")
                        emptyTextFields = false;
                    
                    //console.log(str.includes('yahoo'));
                    if(str.includes('@yahoo') || str.includes('@gmail') || str.includes('@aol') || str.includes('@hotmail') || str.includes('@live') || str.includes('@msn') || str.includes('.cn') || str.includes('.ru') || str.includes('.kr') || str.includes('.ua') || str.includes('.oo') || str.includes('mailto:') || str.includes('@mail') || str.includes('@yaho.') || str.includes('@yaoo')){
                        formSubmit = false;
                        formSubmitButton = false;
                    }
                });

            //-----------------------------------------


                if(formSubmitButton == false){
                    $(".wpforms-submit").addClass('disabled');
                }else{
                    $(".wpforms-submit").removeClass('disabled');
                }

            }

            jQuery( document ).on( 'wpformsReady', function() {
                $('.wpforms-form input[type=email]').click(function(){
                    $(this).attr('autocomplete', 'off');
                });
                $('.wpforms-form input[type=email]').keyup(function(){
                    var str = this.value.toLowerCase();
                    //console.log(str.includes('yahoo'));
                    if(str.includes('@yahoo') || str.includes('@gmail') || str.includes('@aol') || str.includes('@hotmail') || str.includes('@live') || str.includes('@msn') || str.includes('.cn') || str.includes('.ru') || str.includes('.kr') || str.includes('.ua') || str.includes('.oo') || str.includes('mailto:') || str.includes('@mail') || str.includes('@yaho.') || str.includes('@yaoo')){
                        $(this).addClass('email-error');
                    }
                    else{
                        $(this).removeClass('email-error');
                    }
                        checkFormSubmitButton();
                    // validateFormMixedFields();
                    //  validateFormPlaintextFields();
                    //  validateFormTextFields();
                    /*validateFormTextFields();
                    validateFormTextareaFields();*/
                });
                //URL/link not send on textarea
                $('.wpforms-form textarea').keyup(function(){
                    var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                    var message = this.value; //$(this).val()
                    if(message.match(urlRegex)){
                        $(this).addClass('email-error');
                    } else {
                        $(this).removeClass('email-error');
                    }
                    checkFormSubmitButton();
                    // validateFormMixedFields();
                    /*validateFormTextareaFields();
                    validateFormTextFields();*/       

                });
                $('.wpforms-form input[type="text"]').keyup(function(){
                    var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                    var message = this.value; //$(this).val()
                    if(message.match(urlRegex)){
                        $(this).addClass('email-error');
                    } else {
                        $(this).removeClass('email-error');
                    }
                    checkFormSubmitButton();
                    // validateFormMixedFields();
                    // validateFormPlaintextFields();
                    /*validateFormTextareaFields();
                    validateFormTextFields();*/       

                });
                var $el = jQuery( '.wpforms-smart-phone-field' ),
                iti = $el.data( 'plugin_intlTelInput' ),
                options;
                // Options are located in different keys of minified and unminified versions of jquery.intl-tel-input.js.
                /*if ( iti.d ) {
                    options = Object.assign( {}, iti.d);
                } else if ( iti.options ) {
                    options = Object.assign( {}, iti.options );
                }*/
                if ( ! options ) {
                    return;
                }
                $el.intlTelInput( 'destroy' );
                // Put a country code here according to this list: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
                options.initialCountry = 'SZ';
                $el.intlTelInput( options );
                // Restore hidden input name after intlTelInput is reinitialized.
                $el.siblings( 'input[type="hidden"]' ).attr( 'name', 'wpforms[fields][' + options.hiddenInput + ']' );
            } );
            
            function validateFormMixedFields (){
                console.log('validateFormMixedFields');
                
                var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                var urlSubmit = true;
                $( ".wpforms-form textarea").each(function() {
                    var message2 = this.value;

                    if(message2.match(urlRegex)){
                        urlSubmit = false;
                    }
                });
                
                //-----------------------------------------
                var formSubmit = true;
                var emptyTextFields = true;
                $( ".wpforms-form input[type=email]" ).each(function() {
                    var str = this.value.toLowerCase();
                    
                    //console.log(str.includes('yahoo'));
                    if(str.includes('@yahoo') || str.includes('@gmail') || str.includes('@aol') || str.includes('@hotmail') || str.includes('@live') || str.includes('@msn') || str.includes('.cn') || str.includes('.ru') || str.includes('.kr') || str.includes('.ua') || str.includes('.oo') || str.includes('mailto:') || str.includes('@mail') || str.includes('@yaho.') || str.includes('@yaoo')){
                        formSubmit = false;
                    }
                });            
                
                if(urlSubmit == false || formSubmit == false){
                    $(".wpforms-submit").addClass('disabled');
                }else{
                    $(".wpforms-submit").removeClass('disabled');
                }          
            }

            function validateFormTextareaFields (){
                console.log('validateFormTextareaFields');

                var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                var urlSubmit = false;
                var emptyTextareaFields = true;
                $( ".wpforms-form textarea").each(function() {
                    var message2 = this.value;
                    
                    if(message2 != "")
                        emptyTextareaFields = false;

                    if(message2.match(urlRegex)){
                        urlSubmit = true;
                    }
                });
                
                if(emptyTextareaFields == false){
                    console.log('emptyTextareaFields')
                    if(urlSubmit){
                        $(".wpforms-submit").addClass('disabled');
                    }else{
                        $(".wpforms-submit").removeClass('disabled');
                    }   
                }            
            }
            function validateFormPlaintextFields (){
                console.log('validateFormPlaintextFields');

                var urlRegex = /(https?:\/\/[^\s]+)|(www\.)/gm;
                var urlSubmit = false;
                var emptyTextareaFields = true;
                $( ".wpforms-form input[type='text']").each(function() {
                    var message2 = this.value;
                    console.log(this.value);
                    
                    if(message2 != "")
                        emptyTextareaFields = false;

                    if(message2.match(urlRegex)){
                        urlSubmit = true;
                    }
                });
                
                if(emptyTextareaFields == false){
                    //console.log('emptyTextareaFields')
                    if(urlSubmit){
                        console.log('urlSubmit true')
                        $(".wpforms-submit").addClass('disabled');
                    }else{
                        console.log('urlSubmit false')
                        $(".wpforms-submit").removeClass('disabled');
                    }   
                }            
            }

            function validateFormTextFields(){
                console.log('validateFormTextFields');

                var formSubmit = true;
                var emptyTextFields= true;
                $( ".wpforms-form input[type=email]" ).each(function() {
                    var str = this.value.toLowerCase();

                    if(str != "")
                        emptyTextFields = false;
                    
                    //console.log(str.includes('yahoo'));
                    if(str.includes('@yahoo') || str.includes('@gmail') || str.includes('@aol') || str.includes('@hotmail') || str.includes('@live') || str.includes('@msn') || str.includes('.cn') || str.includes('.ru') || str.includes('.kr') || str.includes('.ua') || str.includes('.oo') || str.includes('mailto:') || str.includes('@mail') || str.includes('@yaho.') || str.includes('@yaoo')){
                        formSubmit = false;
                    }
                });

                if(emptyTextFields == false){
                    //console.log('emptyTextFields')
                    if(formSubmit){
                        $(".wpforms-submit").removeClass('disabled');
                    }else{
                        $(".wpforms-submit").addClass('disabled');
                    }   
                }            
            }

        </script>
        <?php
    }

    /**
     * Disable form notifications sending asynchronously.
     *
     * @link    https://wpforms.com/developers/how-to-disable-the-background-processing-for-sending-email-notifications/
     */
    
    //add_filter( 'wpforms_tasks_entry_emails_trigger_send_same_process', '__return_true' );

    add_action( 'wpforms_wp_footer', 'wpf_dev_smart_phone_field_initial_country' );
    add_action( 'init', 'registeration_submit_user' );
    function registeration_submit_user( $content ) {
        // Checks for $_POST value of nons_ipt
        if ( isset($_POST['action']) && $_POST['action'] === 'clogin' )
        {
            $creds = array(
                'user_login'    => $_POST["log"],
                'user_password' => $_POST["pwd"],
                'remember'      => isset($_POST["rememberme"]) ? true : false
            );
            $user = wp_signon( $creds, false );
            
            /*echo "<pre>";
            print_r($user); exit();*/
            
            if ( is_wp_error( $user ) ) {
                $message = "Invalid username or password."; //$user->get_error_message();
                $response = array();
                $response["status"] = "FAIL";
                
                
                if(strpos($user->get_error_message(), "Additional verification is required for login"))
                $response["message"] = str_replace("VERIFICATION REQUIRED:","", strip_tags($user->get_error_message()) );
                else
                $response["message"] = $message;
                
                echo json_encode($response);
                exit();
            }else{

                $user_id = $user->ID;

                wp_set_current_user( $user_id, $user->user_login );
                wp_set_auth_cookie( $user_id );
                do_action( 'wp_login', $user->user_login );


                $response = array();
                $response["status"] = "OK";
                echo json_encode($response);
                exit();
            }
        }
            $allowedmail = get_field('allowdomains', 'option');
            $allowedmail = preg_replace('/\s+/', '', $allowedmail);
            $allowedmail = str_replace(' ', '', $allowedmail);
            $allowedmail = strtolower($allowedmail);
            $allowDomains = explode(',', $allowedmail);

        // Checks for $_POST value of nons_ipt
        if ( isset($_POST['action']) && $_POST['action'] === 'cregister' )
        {
            $user_name = $_POST['email'];
            $user_pass = $_POST['password'];
            $get_domain_from_email = explode("@", $user_name);
            if(!in_array( strtolower($get_domain_from_email[1]), $allowDomains)){
                $message = 'You are not allowed to register. Please contact us for more details';
                $response = array();
                $response["status"] = "FAIL";
                $response["message"] = $message;
                echo json_encode($response);
                exit();
            }
            $user_id = username_exists( $user_name );
            if ( ! $user_id && false == email_exists( $user_name ) ) {
                //$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
                $user_id = wp_create_user( $user_name, $user_pass, $user_name );
            } else {
                $message = 'User already exists.  Password inherited.';
                $response = array();
                $response["status"] = "FAIL";
                $response["message"] = $message;
                echo json_encode($response);
                exit();
            }
            if($user_id){
                wp_new_user_notification ( $user_id, null, 'both' );    
            }
            $user = new WP_User($user_id);
            $user->set_role('partner_customers');
            wp_update_user( array( 'ID' => $user_id, 'display_name' => $_POST['fullname'] ) );
            //wp_update_user( array( 'ID' => $user_id, 'first_name' => $pUser["Name"] ) );
            add_user_meta( $user_id, '_compnay', $_POST['company']);
            add_user_meta( $user_id, '_phone', $_POST['phone']);
            //update_user_meta( $user_id, 'pw_user_status', strtolower($pUser["Status"]));
            // login user through code
            clean_user_cache($user_id);
            wp_clear_auth_cookie();
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id, true, false);
            $user = get_user_by('id', $user_id);
            update_user_caches($user);
            $response = array();
            $response["status"] = "OK";
            echo json_encode($response);
            exit();
        }
    }
    function my_login_redirect( $redirect_to, $request, $user ) {
        //is there a user to check?
        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            //check for admins
            if ( in_array( 'partner_customers', $user->roles ) ) {
                // redirect them to the default place
                $redirect_to = get_page_link(7906);
                return $redirect_to;
            } else {
                //return home_url();
                return $redirect_to;
            }
        } else {
            return $redirect_to;
        }
    }
    add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
    function my_loginout_redirect( $redirect_to, $request, $user ) {
        //is there a user to check?
        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            //check for admins
            if ( in_array( 'partner_customers', $user->roles ) ) {
                // redirect them to the default place
                $redirect_to = get_page_link(7906);
                return $redirect_to;
            } else {
                //return home_url();
                return $redirect_to;
            }
        } else {
            return $redirect_to;
        }
    }
    add_filter( 'logout_redirect', 'my_loginout_redirect', 10, 3 );

    //Change Admin Logo
        function my_login_logo() { ?>
            <style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url(<?php echo get_site_url(); ?>/wp-content/uploads/2022/04/logo.png);
                height:62px;
                width:240px;
                background-size: 240px 62px;
                background-repeat: no-repeat;
                    padding-bottom: 10px;
                }
            </style>
        <?php }
        add_action( 'login_enqueue_scripts', 'my_login_logo' );


        /****************Bussiness Email***************/
    function custom_text_validation_filter($result, $tag) {  
    $type = $tag['type'];
    $name = $tag['name'];
    if($name == 'email' || $name =='wpforms[fields][8]' ){
    $value = $_POST[$name];
            $nourl_pattern1 = '(@yahoo|@gmail|@aol|@hotmail|@live|@msn|@yaho|@yaoo|.cn|.ru|.kr|.ua)';
            $nourl_pattern = '/<(.+?)[\s]*\/?[\s]*>/si';
    if(preg_match($nourl_pattern,$value) || preg_match($nourl_pattern1,$value)){

        $result->invalidate( $tag, "Use Valid Email." );
                    }

    }
        
    return $result;
    }
    add_filter('wpcf7_validate_email','custom_text_validation_filter', 10, 2);
    add_filter('wpcf7_validate_email*', 'custom_text_validation_filter', 10, 2);



    /**************************************************
     * Html tags and Links Remove Form text Area 
     **************************************************/
    function custom_textarea_validation_filter($result, $tag) {  
    $type = $tag['type'];
    $name = $tag['name'];
    if($name == 'message' ) {
    $value = $_POST[$name];
            $nourl_pattern2 ='(http|https|href)';
            $nourl_pattern3= '/<(.+?)[\s]*\/?[\s]*>/si';
    if(preg_match($nourl_pattern2,$value) || preg_match($nourl_pattern3,$value)){

        $result->invalidate( $tag, "Please no urls or email addresses in your message !" );
                    }
    }
    return $result;
    }
    add_filter('wpcf7_validate_textarea','custom_textarea_validation_filter', 10, 2);
    add_filter('wpcf7_validate_textarea*', 'custom_textarea_validation_filter', 10, 2);

    //add_filter( 'wpforms_mailcheck_enabled', '__return_false' );

    add_action('init', 'process_post');
    function process_post(){
        if(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 8749) {
            wpformvalidation($_POST['wpforms']['fields']['8']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 8749) {
            wpformvalidation($_POST['wpforms']['fields']['8']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9883) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9840) {
            wpformvalidation($_POST['wpforms']['fields']['8']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9724) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9639) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9635) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 10055) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 10069) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 10067) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9562) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7863) {
            wpformvalidation($_POST['wpforms']['fields']['2']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 9955) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7755) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7783) {
            wpformvalidation($_POST['wpforms']['fields']['8']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7768) {
            wpformvalidation($_POST['wpforms']['fields']['6']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7765) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7762) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7759) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7751) {
            wpformvalidation($_POST['wpforms']['fields']['1']);     
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 7745) {
            wpformvalidation($_POST['wpforms']['fields']['1']);    
        }
        elseif(isset($_POST['wpforms']['id']) && $_POST['wpforms']['id'] == 8749) {
            domaincheck($_POST['wpforms']['fields']['0']['first']);    
        }
    }
    function wpformvalidation ($emailField){
        if(isset($emailField)){
            $email_arr1 = ['mail.com','yahoo.com','gmail.com','aol.com','hotmail.com','live.com','msn.com','yaoo.com','yaho.com'];
            $email_arr2 = ['cn','ru','kr','ua','oo'];

            $email =  $emailField;
            $email = strtolower($email);
            $email =  explode('@',$email);
            $email2 = explode('.',$email[1]);

            $domain_ext = end($email2);

            if(in_array($email[1],$email_arr1)){
                exit();
            }else if(in_array($domain_ext,$email_arr2)){
                exit();
            }
        }
    }

    function domaincheck ($plainField){

        //echo strpos('checkurl:'.$plainField, 'http://');

        if (strpos('checkurl:'.$plainField, 'http://') > 0 || strpos('checkurl:'.$plainField, 'https://') > 0 || strpos('checkurl:'.$plainField, 'www.') > 0) {
            //echo $plainField;
            exit();
        }   

        //echo $plainField;

        //exit();

        /*$domain = ['http','https','www'];
                
        if(in_array($plainField,$domain)){
            print_r($domain);
                exit();

    } else {
            print_r($plainField);
            exit();
    }*/
        
    }


    // function check_honeypot_field($fields, $entry, $form_data) {
    //     // Only apply this check to the specific form with ID 8749
    //     if ($form_data['id'] == 8749) {
    //         // The field ID for the honeypot field
    //         $honeypot_field_id = 11;

    //         // Check if the honeypot field is filled
    //         if (!empty($fields[$honeypot_field_id]['value'])) {
    //             // Add an error to the form if the honeypot field is filled
    //             wpforms()->process->errors[$form_data['id']]['header'] = 'Your submission looks like spam. Please try again.';
    //         }
    //     }
    // }
    // add_action('wpforms_process', 'check_honeypot_field', 10, 3);

    function check_honeypot_field($fields, $entry, $form_data) {
        // Define an array with form IDs as keys and corresponding honeypot field IDs as values
        $honeypot_fields = [
            8749 => 11,
            7755 => 9,
            7745 => 15,
            9562 => 9,
            9635 => 9,
            9639 => 9,
            9955 => 8,
            10055 => 9,
            10067 => 10,
            10069 => 8,
            7745 => 15,
        ];

        // Check if the form ID exists in the honeypot fields array
        if (isset($honeypot_fields[$form_data['id']])) {
            // Get the honeypot field ID for the current form
            $honeypot_field_id = $honeypot_fields[$form_data['id']];

            // Check if the honeypot field is filled
            if (!empty($fields[$honeypot_field_id]['value'])) {
                // Add an error to the form if the honeypot field is filled
                wpforms()->process->errors[$form_data['id']]['header'] = 'Your submission looks like spam. Please try again.';
            }
        }
    }
    add_action('wpforms_process', 'check_honeypot_field', 10, 3);

    //--------------------------------------------------------------------------------

    function isValidEmail_WPForm($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
        }else{
        return false;
        }
    }

    function handle_usertestformresults_encoder($atts){
        ob_start();
        //require get_template_directory() . '/lib/shortcode/testform.php';
        require get_stylesheet_directory() . '/lib/shortcode/usertestformresults.php';
        $template_html = ob_get_contents();
        ob_end_clean();
        return $template_html;
    }
    add_shortcode('usertestformresults_encoder', 'handle_usertestformresults_encoder');

    function handle_usertestform_encoder($atts){
        ob_start();
        //require get_template_directory() . '/lib/shortcode/testform.php';
        require get_stylesheet_directory() . '/lib/shortcode/usertestform.php';
        $template_html = ob_get_contents();
        ob_end_clean();
        return $template_html;
    }
    add_shortcode('usertestform_encoder', 'handle_usertestform_encoder');

    function usertest_form_send_request(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if( !isset($_POST['name']) || empty($_POST['name']) ){
                wp_send_json_error(array('message' => esc_html__( "Please type your name.", 'prolancer' ))); exit();
            }

            if( !isset($_POST['email']) || empty($_POST['email']) ){
                wp_send_json_error(array('message' => esc_html__( "Please type your email address", 'prolancer' ))); exit();
            }

            if( !isValidEmail_WPForm($_POST['email']) ){
                wp_send_json_error(array('message' => esc_html__( "Please type your valid email address", 'prolancer' ))); exit();
            }
            
            //////////////////////////////////////
            
            // this block updated by Kay on Aug 20, 2026

            //$_SESSION['user_name'] = $_POST['name'];
            //$_SESSION['user_email'] = $_POST['email'];
            
            genrocket_start_session();

            $_SESSION['user_name']  = sanitize_text_field($_POST['name']);
            $_SESSION['user_email'] = sanitize_email($_POST['email']);

            session_write_close();
            
            ////////////////////////////////////////
            
        }
        wp_send_json_success(array('message' => esc_html__("Your transaction has been placed successfully.", 'prolancer'))); exit();
    }
    add_action('wp_ajax_usertest_form_send_request', 'usertest_form_send_request');
    add_action('wp_ajax_nopriv_usertest_form_send_request', 'usertest_form_send_request');


    function handle_testform_encoder($atts){
        ob_start();
        //require get_template_directory() . '/lib/shortcode/testform.php';
        require get_stylesheet_directory() . '/lib/shortcode/testform.php';
        $template_html = ob_get_contents();
        ob_end_clean();
        return $template_html;
    }
    add_shortcode('testform_encoder', 'handle_testform_encoder');

    function test_form_send_request(){

        $questions = [
            1 => [
                "question" => "What is GenRocket's core differentiator in the synthetic data space?",
                "options"  => ["A" => " Speed of data processing", "B" => "Design-Driven Data platform", "C" => "Low-code test automation", "D" => "AI model hosting capabilities"],
                "answer"   => "B"
            ],
            2 => [
                "question" => "In the tax fraud detection case study, how long did it take to generate the final dataset after designing it?",
                "options"  => ["A" => "24 hours", "B" => "1 week", "C" => "Under 2 hours", "D" => "3 days"],
                "answer"   => "C"
            ],
            3 => [
                "question" => "What was the AI use case for the global bank mentioned in the deck?",
                "options"  => ["A" => "Credit scoring improvement", "B" => "Fraudulent transaction detection", "C" => "Bank check OCR training", "D" => "Loan default risk prediction"],
                "answer"   => "C"
            ],
            4 => [
                "question" => "Which types of checks were included in the synthetic data set for AI training?",
                "options"  => ["A" => "Valid and duplicate checks", "B" => "Blank and filled checks", "C" => "Good, bad, and edge case checks", "D" => "Canceled and processed checks"],
                "answer"   => "C"
            ],
            5 => [
                "question" => "What advantage did the law firm gain from using GenRocket’s platform for AI legal document generation?",
                "options"  => ["A" => "Reduced employee headcount", "B" => "Enhanced security, data quality, and scalability", "C" => "Elimination of legal fees", "D" => "Faster court settlements"],
                "answer"   => "B"
            ],
            6 => [
                "question" => "According to MIT Sloan, what percentage of AI performance is driven by data quality?",
                "options"  => ["A" => "50%", "B" => "65%", "C" => "80%", "D" => "95%"],
                "answer"   => "C"
            ],
            7 => [
                "question" => "McKinsey reports that 65–80% of AI project time is spent on which activity?",
                "options"  => ["A" => "Model deployment", "B" => "Data preparation", "C" => "Algorithm selection", "D" => "Bias mitigation"],
                "answer"   => "B"
            ],
            8 => [
                "question" => "Compared to traditional testing, how much more diverse data does AI typically require?",
                "options"  => ["A" => "10x", "B" => "100x", "C" => "1000x", "D" => "10,000x"],
                "answer"   => "C"
            ],
            9 => [
                "question" => "According to IBM, how much does bad data cost U.S. businesses annually?",
                "options"  => ["A" => "$1 trillion", "B" => "$2.1 trillion", "C" => "$3.1 trillion", "D" => "$5 trillion"],
                "answer"   => "C"
            ],
            10 => [
                "question" => "Which of the following is not listed as a pain point of real-world data?",
                "options"  => ["A" => "Delayed QA cycles", "B" => "Skyrocketing costs", "C" => "Compliance risks", "D" => "Enhanced edge-case coverage"],
                "answer"   => "D"
            ],
        ];
            
        $score = 0;
        $total = count($questions);
        $result = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($questions as $qNo => $qData) {
                if (isset($_POST["q$qNo"])) {
                    if ($_POST["q$qNo"] == $qData["answer"]) {
                        $score++;
                    }
                }else{
                    wp_send_json_error(array('message' => esc_html__( "Please select all questions answer and continue", 'prolancer' ))); exit();
                }
            }
            $percentage = ($score / $total) * 100;

            // Get submitted time
            $timeTaken = isset($_POST['time_taken']) ? (int)$_POST['time_taken'] : 0;
            $minutes = floor($timeTaken / 60);
            $seconds = $timeTaken % 60;

            $formula_result = (0.7 * ($score / 10)) + (0.3 * (1 - ($timeTaken / 1200)));

            $post_data = array();
            
            //////////////////////////////////////////
            
            // this block updated by Kay on Aug 20, 2026
            
            //$post_data["user_name"] = $_SESSION['user_name'];
            //$post_data["user_email"] = $_SESSION['user_email'];
            
            genrocket_start_session();

            $post_data["user_name"]  = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
            $post_data["user_email"] = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
            
            session_write_close();
            
            //////////////////////////////////////////
            
            
            $post_data["total_time_spend"] = $timeTaken;
            $post_data["correct_answer"] = $score;
            $post_data["result"] = round($percentage, 2);
            $post_data["formula_result"] = number_format($formula_result, 2);
            
            //echo "<pre>"; print_r($post_data); exit();
            /* $result  = "<h3>Your Score: $score / $total</h3>";
            $result .= "<h3>Percentage: " . round($percentage, 2) . "%</h3>";
            $result .= "<h3>Total Time: {$minutes} min {$seconds} sec</h3>"; */

            global $wpdb;
            $wpdb->insert('wp_usertest', $post_data);
        }

        wp_send_json_success(array('message' => esc_html__("Your transaction has been placed successfully.", 'prolancer'))); exit();
    }
    add_action('wp_ajax_test_form_send_request', 'test_form_send_request');
    add_action('wp_ajax_nopriv_test_form_send_request', 'test_form_send_request');



    
    // Create custom table for PDF tracking
    function create_pdf_tracking_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gr_pdf_tracking';
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id INT AUTO_INCREMENT PRIMARY KEY,
            entry_id INT DEFAULT 0,
            pdf_path VARCHAR(500),
            pdf_url VARCHAR(500),
            user_email VARCHAR(255),
            user_name VARCHAR(255),
            company VARCHAR(255),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX entry_id (entry_id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    add_action('init', 'create_pdf_tracking_table');

    // Increase PHP limits
    add_action('init', 'increase_upload_limits');
    function increase_upload_limits() {
        @ini_set('upload_max_filesize', '50M');
        @ini_set('post_max_size', '50M');
        @ini_set('max_execution_time', '300');
        @ini_set('memory_limit', '256M');
    }

    // Handle PDF file upload and send email directly
add_action('wp_ajax_upload_roi_pdf', 'handle_roi_pdf_upload');
add_action('wp_ajax_nopriv_upload_roi_pdf', 'handle_roi_pdf_upload');

function handle_roi_pdf_upload() {
    // Check for file
    if (!isset($_FILES['roi_pdf']) || $_FILES['roi_pdf']['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error('No PDF file uploaded');
        return;
    }
    
    $company = sanitize_text_field($_POST['company']);
    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);
    $role = sanitize_text_field($_POST['role'] ?? '');
    
    $upload_dir = wp_upload_dir();
    
    // Create directory if needed
    if (!file_exists($upload_dir['path'])) {
        wp_mkdir_p($upload_dir['path']);
    }
    
    $pdf_filename = 'TDM_cost_report_' . sanitize_title($company) . '_' . date('Ymd_His') . '.pdf';
    $pdf_path = $upload_dir['path'] . '/' . $pdf_filename;
    $pdf_url = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $pdf_path);
    
    // Save PDF
    if (move_uploaded_file($_FILES['roi_pdf']['tmp_name'], $pdf_path)) {
        
        // Store PDF info in database
        global $wpdb;
        $table_name = $wpdb->prefix . 'gr_pdf_tracking';
        
        $wpdb->insert($table_name, [
            'pdf_path' => $pdf_path,
            'pdf_url' => $pdf_url,
            'user_email' => $email,
            'user_name' => $name,
            'company' => $company
        ]);
        
        $pdf_id = $wpdb->insert_id;
        
        // ========== SIMPLE EMAIL ==========
    $to = 'dave@genrcoekt.com,louie@genrocket.com,shruti.tiwari@genrocket.com,kay@espis.com';
    //$to = 'kay@espis.com,yasir.kazmi@espinspire.com';
        $subject = 'New TDM Cost Report - ' . $company;
        
        // Simple HTML email - clean white box
        $message = '
        <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TDM Cost Report</title>
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                background-color: #f5f7fa;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                border-radius: 0;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }
            .content {
                padding: 30px;
            }
            .greeting {
                font-size: 18px;
                color: #213C4B;
                margin-bottom: 20px;
                font-weight: 600;
            }
            .info-box {
                background-color: #f8f9fa;
                padding: 20px;
                margin-bottom: 25px;
            }
            .info-row {
                margin-bottom: 20px;
                display: flex;
                align-items: baseline;
                border-bottom: 1px solid #ddd;
                padding:10px 0;
            }
            .info-label {
                width: 100px;
                font-weight: 600;
                color: #213C4B;
                font-size: 14px;
            }
            .info-value {
                color: #555;
                font-size: 14px;
                flex: 1;
            }
            .divider {
                height: 1px;
                background-color: #e0e0e0;
                margin: 20px 0;
            }
            
            .badge {
                display: inline-block;
                background-color: #24ace3;
                color: #fff;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                margin-bottom: 15px;
            }
            .attachment-note {
                background-color: #e8f5e9;
                border-radius: 8px;
                padding: 15px;
                margin: 20px 0;
                text-align: center;
            }
            .attachment-note p {
                margin: 0;
                color: #2e7d32;
                font-size: 14px;
            }
            .btn {
                display: inline-block;
                background-color: #24ace3;
                color: white;
                padding: 10px 24px;
                border-radius: 6px;
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
                margin-top: 15px;
            }
            .btn:hover {
                background-color: #2a4a5c;
            }
        </style>
    </head>
    <body>
        <div style="padding: 20px;">
            <div class="container">
               
                <div class="content">
                    <div class="greeting">Hello Team,</div>
                    
                    <p style="color: #555; margin-bottom: 25px;">A new TDM Cost Report has been generated. Please find the customer details below:</p>
                    
                    <div class="info-box">
                        <div class="info-row">
                            <div class="info-label">Full name</div>
                            <div class="info-value">' . esc_html($name) . '</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Work email</div>
                            <div class="info-value">' . esc_html($email) . '</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Company</div>
                            <div class="info-value">' . esc_html($company) . '</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Role</div>
                            <div class="info-value">' . esc_html($role) . '</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Report ID</div>
                            <div class="info-value">#' . $pdf_id . '</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Date</div>
                            <div class="info-value">' . date('F j, Y \a\t g:i A') . '</div>
                        </div>
                    </div>
                </div>
                
                <div class="footer">
                    <p>© ' . date('Y') . ' GenRocket - TDM Cost Calculator</p>
                </div>
            </div>
        </div>
    </body>
    </html>';
        
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: GenRocket <noreply@genrocket.com>',
            'Reply-To: ' . $email
        );
        
        $attachments = array($pdf_path);
        
        // Send the email
        $email_sent = wp_mail($to, $subject, $message, $headers, $attachments);
        
        // Store the PDF ID in cookie and session
        setcookie('tdm_pdf_id', $pdf_id, time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
        
        
        //$_SESSION['tdm_pdf_id'] = $pdf_id;
        genrocket_start_session();
        $_SESSION['tdm_pdf_id'] = $pdf_id;
        session_write_close();
        
        
        // Store in transient
        $transient_key = 'tdm_pdf_' . md5($email);
        set_transient($transient_key, [
            'pdf_id' => $pdf_id,
            'pdf_path' => $pdf_path,
            'pdf_url' => $pdf_url
        ], HOUR_IN_SECONDS);
        
        wp_send_json_success([
            'pdf_id' => $pdf_id,
            'pdf_path' => $pdf_path,
            'pdf_url' => $pdf_url,
            'email_sent' => $email_sent,
            'message' => 'PDF saved and email sent successfully'
        ]);
    } else {
        wp_send_json_error('Failed to save PDF');
    }
}

    // ATTACH PDF TO WPFORMS EMAIL - IMPROVED VERSION
    //add_filter('wpforms_email_attachments', 'attach_tdm_pdf_to_email', 999, 4);
    function attach_tdm_pdf_to_email($attachments, $email, $form_data, $entry_id) {
        // Only for form ID 11933
        if ($form_data['id'] != 11933) {
            return $attachments;
        }
        
        $pdf_path = '';
        $pdf_id = 0;
        
        // Method 1: Check cookie for PDF ID
        if (isset($_COOKIE['tdm_pdf_id'])) {
            $pdf_id = intval($_COOKIE['tdm_pdf_id']);
        }
        
        // Method 2: Check session
        //if (!$pdf_id && isset($_SESSION['tdm_pdf_id'])) {
        //    $pdf_id = intval($_SESSION['tdm_pdf_id']);
        //}
        
        genrocket_start_session();

        if (!$pdf_id && isset($_SESSION['tdm_pdf_id'])) {
            $pdf_id = intval($_SESSION['tdm_pdf_id']);
        }
        
        session_write_close();
        
        
        // Get user email from POST data
        $user_email = '';
        if (isset($_POST['wpforms']['fields'][2])) {
            $user_email = sanitize_email($_POST['wpforms']['fields'][2]);
        }
        
        // Method 3: Check transient by email
        if (!$pdf_path && $user_email) {
            $transient_key = 'tdm_pdf_' . md5($user_email);
            $pdf_data = get_transient($transient_key);
            if ($pdf_data && !empty($pdf_data['pdf_path'])) {
                $pdf_path = $pdf_data['pdf_path'];
                $pdf_id = $pdf_data['pdf_id'];
            }
        }
        
        // Method 4: Get PDF by ID from database
        if ($pdf_id && !$pdf_path) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'gr_pdf_tracking';
            $pdf = $wpdb->get_row($wpdb->prepare(
                "SELECT pdf_path FROM $table_name WHERE id = %d",
                $pdf_id
            ));
            if ($pdf && !empty($pdf->pdf_path)) {
                $pdf_path = $pdf->pdf_path;
            }
        }
        
        // Method 5: Get most recent PDF for this email
        if (!$pdf_path && $user_email) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'gr_pdf_tracking';
            $pdf = $wpdb->get_row($wpdb->prepare(
                "SELECT pdf_path FROM $table_name WHERE user_email = %s ORDER BY created_at DESC LIMIT 1",
                $user_email
            ));
            if ($pdf && !empty($pdf->pdf_path)) {
                $pdf_path = $pdf->pdf_path;
            }
        }
        
        // Attach PDF if it exists
        if (!empty($pdf_path) && file_exists($pdf_path)) {
            $attachments[] = $pdf_path;
            
            // Clear the cookie and session after use
            setcookie('tdm_pdf_id', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN);
            
            genrocket_start_session();
            unset($_SESSION['tdm_pdf_id']);
            session_write_close();
            
            
            if ($user_email) {
                delete_transient('tdm_pdf_' . md5($user_email));
            }
        }
        
        return $attachments;
    }

 

    // Add TDM Report column to WPForms entries list
    add_filter('wpforms_entry_table_columns', 'add_tdm_column_to_entries', 10, 2);
    function add_tdm_column_to_entries($columns, $form_data) {
        if ($form_data['id'] == 11933) {
            $columns['tdm_report'] = 'TDM Report';
        }
        return $columns;
    }

    // Add PDF download link to entries list
    add_action('wpforms_entry_table_column', 'add_tdm_column_content', 10, 3);
    function add_tdm_column_content($entry, $column_name, $form_data) {
        if ($column_name != 'tdm_report' || $form_data['id'] != 11933) {
            return;
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'gr_pdf_tracking';
        
        $entry_id = is_object($entry) ? $entry->entry_id : (is_array($entry) ? $entry['entry_id'] : 0);
        
        if ($entry_id) {
            $pdf = $wpdb->get_row($wpdb->prepare(
                "SELECT pdf_url FROM $table_name WHERE entry_id = %d",
                $entry_id
            ));
            
            if ($pdf && !empty($pdf->pdf_url)) {
                echo '<a href="' . esc_url($pdf->pdf_url) . '" target="_blank" class="button button-small">📄 View Report</a>';
            } else {
                echo '—';
            }
        } else {
            echo '—';
        }
    }

    // Add PDF display in single entry view
    add_action('wpforms_entry_details_sidebar', 'add_tdm_report_to_single_entry', 10, 2);
    function add_tdm_report_to_single_entry($entry, $form_data) {
        if ($form_data['id'] != 11933) {
            return;
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'gr_pdf_tracking';
        
        $entry_id = is_object($entry) ? $entry->entry_id : (is_array($entry) ? $entry['entry_id'] : 0);
        
        if ($entry_id) {
            $pdf = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM $table_name WHERE entry_id = %d",
                $entry_id
            ));
            
            if ($pdf && !empty($pdf->pdf_url)) {
                echo '<div class="postbox" style="margin-top: 20px;">';
                echo '<div class="postbox-header"><h2 class="hndle">📄 TDM Cost Report</h2></div>';
                echo '<div class="inside">';
                echo '<p><strong>Customer:</strong> ' . esc_html($pdf->user_name) . '</p>';
                echo '<p><strong>Company:</strong> ' . esc_html($pdf->company) . '</p>';
                echo '<p><strong>Email:</strong> ' . esc_html($pdf->user_email) . '</p>';
                echo '<p><strong>Date:</strong> ' . date('F j, Y g:i A', strtotime($pdf->created_at)) . '</p>';
                echo '<a href="' . esc_url($pdf->pdf_url) . '" target="_blank" class="button button-primary">📄 Download TDM Report</a>';
                echo '</div></div>';
            }
        }
    }

    // Add custom admin menu page for all TDM Cost Reports
    add_action('admin_menu', 'add_tdm_reports_admin_page');
    function add_tdm_reports_admin_page() {
        add_submenu_page(
            'wpforms-overview',
            'TDM Cost Reports',
            '📄 TDM Cost Reports',
            'manage_options',
            'tdm-cost-reports',
            'display_all_tdm_reports'
        );
    }
// Display all reports with delete option and checkbox selection
function display_all_tdm_reports() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'gr_pdf_tracking';
    $reports = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
    
    // Show delete success message
    if (isset($_GET['deleted'])) {
        echo '<div class="notice notice-success"><p>Report(s) deleted successfully.</p></div>';
    }
    
    echo '<div class="wrap">';
    echo '<h1>TDM Cost Reports</h1>';
    echo '<div class="notice notice-info"><p>TDM Cost Reports are automatically linked to WPForms entries when available.</p></div>';
    
    // Bulk delete form
    echo '<form method="post" action="" id="tdm-reports-form">';
    echo '<input type="hidden" name="bulk_delete_tdm_reports" value="1">';
    wp_nonce_field('bulk_delete_tdm_reports');
    
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th><input type="checkbox" id="select-all-reports"></th>';
    echo '<th>ID</th>';
    echo '<th>Entry ID</th>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>Company</th>';
    echo '<th>Created</th>';
    echo '<th>Action</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</thead><tbody>';
    
    if ($reports && !empty($reports)) {
        foreach ($reports as $report) {
            $entry_link = '';
            if ($report->entry_id) {
                if (function_exists('wpforms')) {
                    $entry_link = '<a href="' . admin_url('admin.php?page=wpforms-entries&view=details&entry_id=' . $report->entry_id) . '">#' . $report->entry_id . '</a>';
                } else {
                    $entry_link = '#' . $report->entry_id;
                }
            } else {
                $entry_link = '—';
            }
            
            // Individual delete URL with nonce for security
            $delete_url = wp_nonce_url(
                admin_url('admin.php?page=tdm-cost-reports&action=delete_tdm_report&id=' . $report->id),
                'delete_tdm_report_' . $report->id
            );
            
            echo '<tr>';
            echo '<td><input type="checkbox" name="report_ids[]" value="' . intval($report->id) . '" class="report-checkbox"></td>';
            echo '<td>' . intval($report->id) . '</td>';
            echo '<td>' . $entry_link . '</td>';
            echo '<td>' . esc_html($report->user_name) . '</td>';
            echo '<td>' . esc_html($report->user_email) . '</td>';
            echo '<td>' . esc_html($report->company) . '</td>';
            echo '<td>' . esc_html(date('Y-m-d H:i', strtotime($report->created_at))) . '</td>';
            echo '<td><a href="' . esc_url($report->pdf_url) . '" target="_blank" class="button button-small">📄 Download PDF</a></td>';
            echo '<td><a href="' . esc_url($delete_url) . '" class="button button-small button-link-delete" onclick="return confirm(\'Are you sure you want to delete this report? This action cannot be undone.\');">🗑️ Delete</a></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="9">No reports found. Submit the calculator form to generate reports.</td></tr>';
    }
    
    echo '</tbody></table>';
    
    // Bulk action controls
    if ($reports && !empty($reports)) {
        echo '<div style="margin-top: 20px; display: flex; gap: 10px; align-items: center;">';
        echo '<button type="submit" name="delete_selected" class="button button-secondary" onclick="return confirmDeleteSelected();">🗑️ Delete Selected</button>';
        echo '<span style="color: #666; font-size: 13px;">Select reports using the checkboxes above</span>';
        echo '<button type="submit" name="delete_all" class="button button-secondary" onclick="return confirm(\'Are you sure you want to delete ALL reports? This action cannot be undone.\');" style="margin-left: auto;">🗑️ Delete All Reports</button>';
        echo '</div>';
    }
    
    echo '</form>';
    echo '</div>';
    
    // JavaScript for select all and confirmation
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Select all functionality
            const selectAllCheckbox = document.getElementById('select-all-reports');
            const reportCheckboxes = document.querySelectorAll('.report-checkbox');
            
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    reportCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });
            }
            
            // Update select all state when individual checkboxes change
            reportCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (selectAllCheckbox) {
                        const allChecked = Array.from(reportCheckboxes).every(cb => cb.checked);
                        const someChecked = Array.from(reportCheckboxes).some(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                        selectAllCheckbox.indeterminate = someChecked && !allChecked;
                    }
                });
            });
        });
        
        // Confirmation for deleting selected
        function confirmDeleteSelected() {
            const checkboxes = document.querySelectorAll('.report-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one report to delete.');
                return false;
            }
            return confirm('Are you sure you want to delete ' + checkboxes.length + ' selected report(s)? This action cannot be undone.');
        }
    </script>
    <?php
}

// Handle delete request (single)
add_action('admin_init', 'handle_delete_tdm_report');
function handle_delete_tdm_report() {
    if (isset($_GET['action']) && $_GET['action'] === 'delete_tdm_report' && isset($_GET['id']) && is_numeric($_GET['id'])) {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        $report_id = intval($_GET['id']);
        check_admin_referer('delete_tdm_report_' . $report_id);
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'gr_pdf_tracking';
        
        // Get the PDF file path before deleting
        $report = $wpdb->get_row($wpdb->prepare("SELECT pdf_path FROM $table_name WHERE id = %d", $report_id));
        
        if ($report && !empty($report->pdf_path) && file_exists($report->pdf_path)) {
            // Delete the physical PDF file
            @unlink($report->pdf_path);
        }
        
        // Delete the database record
        $wpdb->delete($table_name, ['id' => $report_id]);
        
        // Redirect back to the reports page
        wp_redirect(admin_url('admin.php?page=tdm-cost-reports&deleted=1'));
        exit;
    }
}

// Handle bulk delete (selected and all)
add_action('admin_init', 'handle_bulk_delete_tdm_reports');
function handle_bulk_delete_tdm_reports() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    if (isset($_POST['bulk_delete_tdm_reports']) && check_admin_referer('bulk_delete_tdm_reports')) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gr_pdf_tracking';
        
        // Handle "Delete All" 
        if (isset($_POST['delete_all'])) {
            // Get all PDF files
            $reports = $wpdb->get_results("SELECT pdf_path FROM $table_name");
            
            // Delete all physical files
            foreach ($reports as $report) {
                if (!empty($report->pdf_path) && file_exists($report->pdf_path)) {
                    @unlink($report->pdf_path);
                }
            }
            
            // Delete all database records
            $wpdb->query("TRUNCATE TABLE $table_name");
            
            wp_redirect(admin_url('admin.php?page=tdm-cost-reports&deleted=all'));
            exit;
        }
        
        // Handle "Delete Selected"
        if (isset($_POST['delete_selected']) && isset($_POST['report_ids']) && is_array($_POST['report_ids'])) {
            $report_ids = array_map('intval', $_POST['report_ids']);
            
            if (!empty($report_ids)) {
                // Create placeholders for the query
                $placeholders = implode(',', array_fill(0, count($report_ids), '%d'));
                
                // Get PDF paths for selected reports
                $query = $wpdb->prepare(
                    "SELECT pdf_path FROM $table_name WHERE id IN ($placeholders)",
                    $report_ids
                );
                $reports = $wpdb->get_results($query);
                
                // Delete physical files
                foreach ($reports as $report) {
                    if (!empty($report->pdf_path) && file_exists($report->pdf_path)) {
                        @unlink($report->pdf_path);
                    }
                }
                
                // Delete selected database records
                $ids_string = implode(',', $report_ids);
                $wpdb->query("DELETE FROM $table_name WHERE id IN ($ids_string)");
                
                wp_redirect(admin_url('admin.php?page=tdm-cost-reports&deleted=' . count($report_ids)));
                exit;
            }
        }
    }
}
    // Localize script for AJAX
    add_action('wp_enqueue_scripts', 'localize_tdm_calculator_script');
    function localize_tdm_calculator_script() {
        if (is_page('tdm-cost-calculator')) {
            wp_localize_script('jquery', 'grPdfAjax', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('gr_roi_nonce')
            ]);
        }
    }
    // Disable AJAX submission for form ID 11933
add_filter('wpforms_frontend_load', 'disable_ajax_for_tdm_form', 10, 2);
function disable_ajax_for_tdm_form($load, $form_data) {
    if ($form_data['id'] == 11933) {
        // Force disable AJAX
        add_filter('wpforms_frontend_form_data', function($form_data) {
            $form_data['settings']['ajax_submit'] = '0';
            return $form_data;
        });
    }
    return $load;
}
// Disable ALL WPForms email notifications for form 11933
add_filter('wpforms_process_bypass_email', 'disable_wpforms_emails_for_tdm', 10, 3);
function disable_wpforms_emails_for_tdm($bypass, $fields, $form_data) {
    if ($form_data['id'] == 11933) {
        return true; // Bypass all WPForms emails
    }
    return $bypass;
}

//add_action('init', 'start_session_for_tdm');
//function start_session_for_tdm() {
//    if (!session_id() && !headers_sent()) {
//        session_start();
//    }
//}

wp_enqueue_script( 'pe-cookie-consent', get_template_directory_uri() . '/assets/js/cookie-consent.js', array(), '1.0', false );

add_filter('nav_menu_link_attributes', function($atts, $item, $args, $depth) {
    if ($item->title === 'Cookie Preferences') {
        $atts['href'] = '#';
        $atts['onclick'] = 'window.openCookiePreferences(); return false;';
    }
    return $atts;
}, 10, 4);

// ==========================================
// DQE ASSESSMENT REPORTS CUSTOM ADMIN PAGE & DB STORAGE
// ==========================================

// 1. Create table for DQE Reports tracking
function create_dqe_reports_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'dqe_reports';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        entry_id INT DEFAULT 0,
        share_id VARCHAR(100),
        user_name VARCHAR(255),
        user_email VARCHAR(255),
        company VARCHAR(255),
        overall_score VARCHAR(100),
        maturity_level VARCHAR(100),
        report_url VARCHAR(500),
        pdf_url VARCHAR(500),
        pdf_path VARCHAR(500),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        INDEX share_id (share_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('init', 'create_dqe_reports_table');

// 2. Add DQE Reports Submenu under WPForms
add_action('admin_menu', 'add_dqe_reports_admin_page');
function add_dqe_reports_admin_page() {
    add_submenu_page(
        'wpforms-overview',
        'DQE Reports',
        '📊 DQE Reports',
        'manage_options',
        'dqe-reports',
        'display_all_dqe_reports'
    );
}

// 3. Render DQE Reports Admin Page
function display_all_dqe_reports() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'dqe_reports';

    // Handle saving email notification settings
    if (isset($_POST['save_dqe_email_settings'])) {
        check_admin_referer('save_dqe_email_settings_nonce');
        $notification_emails = sanitize_text_field($_POST['dqe_notification_emails']);
        update_option('dqe_notification_emails', $notification_emails);
        echo '<div class="notice notice-success"><p>Notification email list updated successfully!</p></div>';
    }

    $notification_emails = get_option('dqe_notification_emails');

    // Handle single delete
    if (isset($_GET['action']) && $_GET['action'] === 'delete_dqe_report' && isset($_GET['id']) && is_numeric($_GET['id'])) {
        if (current_user_can('manage_options')) {
            $report_id = intval($_GET['id']);
            check_admin_referer('delete_dqe_report_' . $report_id);
            
            // Delete file if exists
            $report = $wpdb->get_row($wpdb->prepare("SELECT pdf_path FROM $table_name WHERE id = %d", $report_id));
            if ($report && !empty($report->pdf_path) && file_exists($report->pdf_path)) {
                @unlink($report->pdf_path);
            }
            
            $wpdb->delete($table_name, array('id' => $report_id));
            echo '<div class="notice notice-success"><p>DQE Report deleted successfully.</p></div>';
        }
    }

    // Handle bulk delete
    if (isset($_POST['bulk_delete_dqe_reports'])) {
        check_admin_referer('bulk_delete_dqe_reports');
        if (isset($_POST['delete_all'])) {
            // Delete all files
            $reports = $wpdb->get_results("SELECT pdf_path FROM $table_name");
            foreach ($reports as $report) {
                if (!empty($report->pdf_path) && file_exists($report->pdf_path)) {
                    @unlink($report->pdf_path);
                }
            }
            $wpdb->query("TRUNCATE TABLE $table_name");
            echo '<div class="notice notice-success"><p>All DQE Reports deleted successfully.</p></div>';
        } elseif (!empty($_POST['report_ids']) && is_array($_POST['report_ids'])) {
            $ids = array_map('intval', $_POST['report_ids']);
            $ids_imploded = implode(',', $ids);
            
            // Delete files
            $reports = $wpdb->get_results("SELECT pdf_path FROM $table_name WHERE id IN ($ids_imploded)");
            foreach ($reports as $report) {
                if (!empty($report->pdf_path) && file_exists($report->pdf_path)) {
                    @unlink($report->pdf_path);
                }
            }
            
            $wpdb->query("DELETE FROM $table_name WHERE id IN ($ids_imploded)");
            echo '<div class="notice notice-success"><p>Selected DQE Report(s) deleted successfully.</p></div>';
        }
    }

    $reports = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

    echo '<div class="wrap">';
    echo '<h1>DQE Assessment Reports</h1>';
    echo '<div class="notice notice-info"><p>DQE Assessment Reports are automatically saved and emailed to recipient list on form submission.</p></div>';

    // Email Settings Card
    ?>
    <div class="card" style="max-width: 100%; margin-bottom: 24px; padding: 20px; background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
        <h2 style="margin-top: 0; font-size: 16px; color: #213C4B; display: flex; align-items: center; gap: 8px;">
            <span>📧 Notification Email Recipients</span>
        </h2>
        <p style="color: #555; font-size: 13px; margin-bottom: 14px;">
            Enter the email addresses that should receive notifications and PDF attachments when visitors complete the DQE Index Assessment. Separate multiple email addresses with commas.
        </p>
        <form method="post" action="">
            <?php wp_nonce_field('save_dqe_email_settings_nonce'); ?>
            <input type="hidden" name="save_dqe_email_settings" value="1">
            <div style="display: flex; gap: 12px; align-items: center;">
                <input type="text" name="dqe_notification_emails" value="<?php echo esc_attr($notification_emails); ?>" class="regular-text" style="width: 75%; padding: 6px 12px; font-size: 14px;" placeholder="kay@espis.com">
                <button type="submit" class="button button-primary button-large">Save Recipient Emails</button>
            </div>
        </form>
    </div>
    <?php

    echo '<form method="post" action="" id="dqe-reports-form">';
    echo '<input type="hidden" name="bulk_delete_dqe_reports" value="1">';
    wp_nonce_field('bulk_delete_dqe_reports');

    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th><input type="checkbox" id="select-all-dqe-reports"></th>';
    echo '<th>ID</th>';
    echo '<th>Entry ID</th>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>Company</th>';
    echo '<th>Score / Level</th>';
    echo '<th>Created</th>';
    echo '<th>View Report</th>';
    echo '<th>Download PDF</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</thead><tbody>';

    if ($reports && !empty($reports)) {
        foreach ($reports as $report) {
            $entry_link = '';
            if ($report->entry_id) {
                if (function_exists('wpforms')) {
                    $entry_link = '<a href="' . admin_url('admin.php?page=wpforms-entries&view=details&entry_id=' . $report->entry_id) . '">#' . $report->entry_id . '</a>';
                } else {
                    $entry_link = '#' . $report->entry_id;
                }
            } else {
                $entry_link = '—';
            }

            $delete_url = wp_nonce_url(
                admin_url('admin.php?page=dqe-reports&action=delete_dqe_report&id=' . $report->id),
                'delete_dqe_report_' . $report->id
            );

            $pdf_btn = !empty($report->pdf_url) 
                ? '<a href="' . esc_url($report->pdf_url) . '" target="_blank" download class="button button-small">📄 Download PDF</a>' 
                : '—';

            echo '<tr>';
            echo '<td><input type="checkbox" name="report_ids[]" value="' . intval($report->id) . '" class="dqe-report-checkbox"></td>';
            echo '<td>' . intval($report->id) . '</td>';
            echo '<td>' . $entry_link . '</td>';
            echo '<td>' . esc_html($report->user_name) . '</td>';
            echo '<td>' . esc_html($report->user_email) . '</td>';
            echo '<td>' . esc_html($report->company) . '</td>';
            echo '<td><strong>' . esc_html($report->overall_score) . '</strong><br/><small>' . esc_html($report->maturity_level) . '</small></td>';
            echo '<td>' . esc_html(date('Y-m-d H:i', strtotime($report->created_at))) . '</td>';
            echo '<td><a href="' . esc_url($report->report_url) . '" target="_blank" class="button button-small button-primary">📊 View Report</a></td>';
            echo '<td>' . $pdf_btn . '</td>';
            echo '<td><a href="' . esc_url($delete_url) . '" class="button button-small button-link-delete" onclick="return confirm(\'Are you sure you want to delete this report? This action cannot be undone.\');">🗑️ Delete</a></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="11">No DQE reports found. Submit the assessment form to generate reports.</td></tr>';
    }

    echo '</tbody></table>';

    if ($reports && !empty($reports)) {
        echo '<div style="margin-top: 20px; display: flex; gap: 10px; align-items: center;">';
        echo '<button type="submit" name="delete_selected" class="button button-secondary" onclick="return confirmDeleteSelectedDqe();">🗑️ Delete Selected</button>';
        echo '<span style="color: #666; font-size: 13px;">Select reports using the checkboxes above</span>';
        echo '<button type="submit" name="delete_all" class="button button-secondary" onclick="return confirm(\'Are you sure you want to delete ALL DQE reports?\');" style="margin-left: auto;">🗑️ Delete All Reports</button>';
        echo '</div>';
    }

    echo '</form>';
    echo '</div>';
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all-dqe-reports');
            const checkboxes = document.querySelectorAll('.dqe-report-checkbox');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = selectAll.checked);
                });
            }
        });
        function confirmDeleteSelectedDqe() {
            const checked = document.querySelectorAll('.dqe-report-checkbox:checked');
            if (checked.length === 0) {
                alert('Please select at least one report to delete.');
                return false;
            }
            return confirm('Are you sure you want to delete ' + checked.length + ' selected report(s)?');
        }
    </script>
    <?php
}

// Helper function to send email notification with PDF report attached
function send_dqe_report_email($name, $email, $company, $score, $level, $share_url, $pdf_path = '') {
    $admin_emails = get_option('dqe_notification_emails');
    $to_list = array_filter(array_map('trim', explode(',', $admin_emails)));

    $to = !empty($to_list) ? implode(',', $to_list) : get_option('admin_email');
    $subject = 'New DQE Assessment Report - ' . ($company ? $company : ($name ? $name : 'Visitor'));

    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>New DQE Assessment Report</title>
        <style>
            body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background-color: #f4f7f9; color: #213C4B; margin: 0; padding: 20px; }
            .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; border: 1px solid #e1e8ed; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
            .header { background: #213C4B; padding: 24px; border-radius: 6px; text-align: center; color: #ffffff; }
            .header h1 { margin: 0; font-size: 22px; color: #27BFF0; letter-spacing: -0.02em; }
            .info-box { background: #f8fafc; border-left: 4px solid #27BFF0; padding: 18px; margin: 20px 0; border-radius: 4px; }
            .info-row { margin-bottom: 10px; font-size: 14px; line-height: 1.5; }
            .info-label { font-weight: bold; color: #213C4B; }
            .score-badge { display: inline-block; background: #6DBF42; color: #ffffff; padding: 4px 12px; border-radius: 20px; font-weight: bold; font-size: 14px; }
            .btn { display: inline-block; background: #27BFF0; color: #ffffff !important; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 15px; }
            .footer { font-size: 12px; color: #888; text-align: center; margin-top: 25px; border-top: 1px solid #eee; padding-top: 15px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>GenRocket DQE Index</h1>
                <p style="margin: 6px 0 0; font-size: 14px; opacity: 0.9;">New Assessment Submission</p>
            </div>
            
            <p>Hello Team,</p>
            <p>A new visitor has completed the <strong>Data Quality Evolution Index Assessment</strong>. Here are the details:</p>
            
            <div class="info-box">
                <div class="info-row"><span class="info-label">Customer Name:</span> ' . esc_html($name ? $name : 'N/A') . '</div>
                <div class="info-row"><span class="info-label">Work Email:</span> <a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></div>
                <div class="info-row"><span class="info-label">Company:</span> ' . esc_html($company ? $company : 'N/A') . '</div>
                <div class="info-row"><span class="info-label">Overall DQE Score:</span> <span class="score-badge">' . esc_html($score) . '</span></div>
                <div class="info-row"><span class="info-label">Maturity Level:</span> ' . esc_html($level) . '</div>
            </div>

            <p style="text-align: center;">
                <a href="' . esc_url($share_url) . '" class="btn" target="_blank">📊 View Interactive Report</a>
            </p>

            ' . (!empty($pdf_path) && file_exists($pdf_path) ? '<p style="font-size: 13px; color: #555; text-align: center;">📎 The PDF report is attached to this email.</p>' : '') . '

            <div class="footer">
                © GenRocket, Inc. — Data Quality Evolution Index Assessment
            </div>
        </div>
    </body>
    </html>
    ';

    $domain = parse_url(site_url(), PHP_URL_HOST);
    if (empty($domain) || $domain === 'localhost' || $domain === '127.0.0.1') {
        $domain = 'genrocket.com';
    }
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: GenRocket DQE Assessment <noreply@' . $domain . '>'
    );

    $attachments = array();
    if (!empty($pdf_path) && file_exists($pdf_path)) {
        $attachments[] = $pdf_path;
    }

    // Send email to admin team
    @wp_mail($to, $subject, $message, $headers, $attachments);

    // Also send copy to customer if valid email
    if (is_email($email)) {
        $user_subject = 'Your Data Quality Evolution (DQE) Index Report';
        $user_message = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Your DQE Assessment Report</title>
            <style>
                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background-color: #f4f7f9; color: #213C4B; margin: 0; padding: 20px; }
                .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; border: 1px solid #e1e8ed; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
                .header { background: #213C4B; padding: 24px; border-radius: 6px; text-align: center; color: #ffffff; }
                .header h1 { margin: 0; font-size: 22px; color: #27BFF0; }
                .info-box { background: #f8fafc; border-left: 4px solid #27BFF0; padding: 18px; margin: 20px 0; border-radius: 4px; }
                .btn { display: inline-block; background: #27BFF0; color: #ffffff !important; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 15px; }
                .footer { font-size: 12px; color: #888; text-align: center; margin-top: 25px; border-top: 1px solid #eee; padding-top: 15px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>GenRocket DQE Index</h1>
                    <p style="margin: 6px 0 0; font-size: 14px; opacity: 0.9;">Your Assessment Results</p>
                </div>
                
                <p>Hello ' . esc_html($name ? $name : 'there') . ',</p>
                <p>Thank you for completing the <strong>Data Quality Evolution Index Assessment</strong>. Below is your maturity summary:</p>
                
                <div class="info-box">
                    <p style="margin: 0 0 8px; font-size: 15px; font-weight: bold;">Overall DQE Score: ' . esc_html($score) . '</p>
                    <p style="margin: 0; color: #27BFF0; font-size: 15px; font-weight: bold;">Maturity Level: ' . esc_html($level) . '</p>
                </div>

                <p style="text-align: center;">
                    <a href="' . esc_url($share_url) . '" class="btn" target="_blank">📊 View Your Full Interactive Report</a>
                </p>

                ' . (!empty($pdf_path) && file_exists($pdf_path) ? '<p style="font-size: 13px; color: #555; text-align: center;">📎 Your custom PDF report is attached to this email.</p>' : '') . '

                <p>If you have any questions or would like to explore how to advance your data maturity with GenRocket, visit <a href="https://www.genrocket.com" target="_blank">genrocket.com</a>.</p>

                <div class="footer">
                    © GenRocket, Inc. — Data Quality Evolution Index Assessment
                </div>
            </div>
        </body>
        </html>
        ';

        @wp_mail($email, $user_subject, $user_message, $headers, $attachments);
    }
}

// 4. Handle DQE PDF file upload & session saving via AJAX
add_action('wp_ajax_upload_dqe_pdf', 'handle_upload_dqe_pdf');
add_action('wp_ajax_nopriv_upload_dqe_pdf', 'handle_upload_dqe_pdf');

function handle_upload_dqe_pdf() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'dqe_reports';

    $company  = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $email    = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $name     = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $score    = isset($_POST['score']) ? sanitize_text_field($_POST['score']) : '';
    $level    = isset($_POST['level']) ? sanitize_text_field($_POST['level']) : '';
    $share_id = isset($_POST['share_id']) ? sanitize_text_field($_POST['share_id']) : '';
    $url      = isset($_POST['share_url']) ? esc_url_raw($_POST['share_url']) : site_url('/data-quality-evolution-index-assessment/?id=' . $share_id);

    // Save session payload to options for cross-browser share links
    if (!empty($share_id) && !empty($_POST['scores_json'])) {
        $scores_data = json_decode(stripslashes($_POST['scores_json']), true);
        if ($scores_data) {
            update_option('dqe_session_' . $share_id, array(
                'scores'         => $scores_data,
                'reportUnlocked' => true,
                'contact'        => array('name' => $name, 'email' => $email, 'company' => $company),
                'timestamp'      => time()
            ));
        }
    }

    $pdf_url  = '';
    $pdf_path = '';

    // Save PDF file if uploaded
    if (isset($_FILES['dqe_pdf']) && $_FILES['dqe_pdf']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = wp_upload_dir();
        $target_dir = $upload_dir['basedir'] . '/dqe-reports';
        if (!file_exists($target_dir)) {
            wp_mkdir_p($target_dir);
        }

        $clean_title  = sanitize_title($company ? $company : ($name ? $name : 'report'));
        $pdf_filename = 'DQE_Report_' . $clean_title . '_' . date('Ymd_His') . '.pdf';
        $pdf_path     = $target_dir . '/' . $pdf_filename;
        $pdf_url      = $upload_dir['baseurl'] . '/dqe-reports/' . $pdf_filename;

        move_uploaded_file($_FILES['dqe_pdf']['tmp_name'], $pdf_path);
    }

    $existing_id = 0;
    if ($share_id) {
        $existing_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE share_id = %s", $share_id));
    }

    if ($existing_id) {
        $update_data = array(
            'user_name'      => $name,
            'user_email'     => $email,
            'company'        => $company,
            'overall_score'  => $score,
            'maturity_level' => $level,
            'report_url'     => $url
        );
        if (!empty($pdf_url))  { $update_data['pdf_url']  = $pdf_url; }
        if (!empty($pdf_path)) { $update_data['pdf_path'] = $pdf_path; }

        $wpdb->update($table_name, $update_data, array('id' => $existing_id));
        $record_id = $existing_id;
    } else {
        $wpdb->insert($table_name, array(
            'entry_id'       => 0,
            'share_id'       => $share_id,
            'user_name'      => $name,
            'user_email'     => $email,
            'company'        => $company,
            'overall_score'  => $score,
            'maturity_level' => $level,
            'report_url'     => $url,
            'pdf_url'        => $pdf_url,
            'pdf_path'       => $pdf_path,
            'created_at'     => current_time('mysql')
        ));
        $record_id = $wpdb->insert_id;
    }

    // Trigger email sending
    send_dqe_report_email($name, $email, $company, $score, $level, $url, $pdf_path);

    wp_send_json_success(array(
        'id'        => $record_id,
        'pdf_url'   => $pdf_url,
        'share_url' => $url
    ));
}

// 5. Direct AJAX endpoint fallback for DQE Assessment Lead saving
add_action('wp_ajax_save_dqe_lead', 'handle_save_dqe_lead');
add_action('wp_ajax_nopriv_save_dqe_lead', 'handle_save_dqe_lead');
function handle_save_dqe_lead() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'dqe_reports';

    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email   = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';

    $score = isset($_POST['score']) ? sanitize_text_field($_POST['score']) : '';
    $level = isset($_POST['level']) ? sanitize_text_field($_POST['level']) : '';
    $url   = isset($_POST['share_url']) ? esc_url_raw($_POST['share_url']) : site_url('/data-quality-evolution-index-assessment/');

    if (!empty($email) || !empty($name)) {
        $wpdb->insert($table_name, array(
            'entry_id'       => 0,
            'user_name'      => $name,
            'user_email'     => $email,
            'company'        => $company,
            'overall_score'  => $score,
            'maturity_level' => $level,
            'report_url'     => $url,
            'created_at'     => current_time('mysql')
        ));
        $insert_id = $wpdb->insert_id;

        // Trigger email notification
        send_dqe_report_email($name, $email, $company, $score, $level, $url, '');

        wp_send_json_success(array('id' => $insert_id));
    } else {
        wp_send_json_error('Missing contact data');
    }
}

// 6. Automatically save DQE report to database & send email when WPForms 12197 is submitted
add_action('wpforms_process_complete', 'handle_dqe_wpforms_submission', 10, 4);
function handle_dqe_wpforms_submission($fields, $entry, $form_data, $entry_id) {
    if (!isset($form_data['id']) || (int)$form_data['id'] !== 12197) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'dqe_reports';

    $name    = '';
    $email   = '';
    $company = '';

    if (!empty($fields) && is_array($fields)) {
        foreach ($fields as $field) {
            $field_id   = isset($field['id']) ? (int)$field['id'] : 0;
            $val        = isset($field['value']) ? trim($field['value']) : '';
            $field_name = strtolower($field['name'] ?? '');

            if ($field_id === 1 || strpos($field_name, 'name') !== false) {
                if (empty($name)) { $name = sanitize_text_field($val); }
            } elseif ($field_id === 2 || strpos($field_name, 'email') !== false || is_email($val)) {
                if (empty($email)) { $email = sanitize_email($val); }
            } elseif ($field_id === 3 || strpos($field_name, 'company') !== false) {
                if (empty($company)) { $company = sanitize_text_field($val); }
            }
        }
    }

    // Direct $_POST fallbacks for name, email, company
    if (empty($name) && isset($_POST['wpforms']['fields'][1])) {
        $raw_name = $_POST['wpforms']['fields'][1];
        $name = is_array($raw_name) ? trim(($raw_name['first'] ?? '') . ' ' . ($raw_name['last'] ?? '')) : sanitize_text_field($raw_name);
    }
    if (empty($email) && isset($_POST['wpforms']['fields'][2])) {
        $email = sanitize_email($_POST['wpforms']['fields'][2]);
    }
    if (empty($company) && isset($_POST['wpforms']['fields'][3])) {
        $company = sanitize_text_field($_POST['wpforms']['fields'][3]);
    }

    $score     = isset($_POST['dqe_overall_score']) ? sanitize_text_field($_POST['dqe_overall_score']) : '';
    $level     = isset($_POST['dqe_maturity_level']) ? sanitize_text_field($_POST['dqe_maturity_level']) : '';
    $share_url = isset($_POST['dqe_share_url']) ? esc_url_raw($_POST['dqe_share_url']) : '';
    
    $share_id = '';
    if (!empty($_POST['share_id'])) {
        $share_id = sanitize_text_field($_POST['share_id']);
    } elseif (!empty($_POST['dqe_share_id'])) {
        $share_id = sanitize_text_field($_POST['dqe_share_id']);
    } elseif (!empty($share_url)) {
        $parsed_url = parse_url($share_url);
        if (!empty($parsed_url['query'])) {
            parse_str($parsed_url['query'], $query_params);
            if (!empty($query_params['id'])) {
                $share_id = sanitize_text_field($query_params['id']);
            }
        }
    }
    if (empty($share_id) && !empty($_GET['id'])) {
        $share_id = sanitize_text_field($_GET['id']);
    }

    if (empty($share_url) && !empty($share_id)) {
        $share_url = site_url('/data-quality-evolution-index-assessment/?id=' . $share_id);
    }

    $existing_id = 0;
    if (!empty($share_id)) {
        $existing_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name WHERE share_id = %s", $share_id));
    }

    if ($existing_id) {
        $wpdb->update(
            $table_name,
            array(
                'entry_id'       => $entry_id,
                'user_name'      => $name,
                'user_email'     => $email,
                'company'        => $company,
                'overall_score'  => $score,
                'maturity_level' => $level,
                'report_url'     => $share_url
            ),
            array('id' => $existing_id)
        );
    } else {
        $wpdb->insert(
            $table_name,
            array(
                'entry_id'       => $entry_id,
                'share_id'       => $share_id,
                'user_name'      => $name,
                'user_email'     => $email,
                'company'        => $company,
                'overall_score'  => $score,
                'maturity_level' => $level,
                'report_url'     => $share_url,
                'created_at'     => current_time('mysql')
            )
        );
    }

    // Send email notification
    send_dqe_report_email($name, $email, $company, $score, $level, $share_url, '');
}

// Helper to auto-extract company name from email domain
function get_company_from_email($email) {
    if (empty($email) || !is_email($email)) {
        return '';
    }
    $parts = explode('@', $email);
    if (count($parts) < 2) {
        return '';
    }
    $domain = strtolower(trim($parts[1]));
    $domain_parts = explode('.', $domain);
    if (empty($domain_parts)) {
        return '';
    }

    // Skip generic prefixes/subdomains (e.g. ad.infosys.in, in.ibm.com, mail.corp.com)
    $skip_sub = array('ad', 'mail', 'corp', 'internal', 'in', 'us', 'uk', 'eu', 'apac', 'emea', 'dev', 'qa', 'app', 'mx');
    $main = $domain_parts[0];
    if (in_array($main, $skip_sub) && count($domain_parts) > 2) {
        $main = $domain_parts[1];
    }
    if (empty($main)) {
        return '';
    }

    $known_upper = array('ibm', 'aws', 'sap', 'hcl', 'tcs', 'hp', 'ey', 'pwc', 'ge', 'it', 'qa', 'sdet', 'wipro');
    $words = preg_split('/[-_.]/', $main);
    $formatted = array();
    foreach ($words as $w) {
        if (empty($w)) continue;
        if (in_array(strtolower($w), $known_upper)) {
            $formatted[] = strtoupper($w);
        } else {
            $formatted[] = ucfirst(strtolower($w));
        }
    }
    return implode(' ', $formatted);
}

// 1. Create Booth Quiz Leaderboard Table & Auto-Migrate Old Designation Data
add_action('init', 'create_booth_quiz_leaderboard_table');
add_action('admin_init', 'create_booth_quiz_leaderboard_table', 1);
function create_booth_quiz_leaderboard_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'booth_quiz_leaderboard';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_name VARCHAR(255) NOT NULL,
        user_email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) DEFAULT '',
        designation VARCHAR(255) DEFAULT '',
        company VARCHAR(255) DEFAULT '',
        score INT(11) NOT NULL DEFAULT 0,
        total_questions INT(11) NOT NULL DEFAULT 6,
        score_text VARCHAR(50) NOT NULL DEFAULT '0 / 6',
        percentage DECIMAL(5,2) NOT NULL DEFAULT 0.00,
        time_taken VARCHAR(50) NOT NULL DEFAULT '00:00:000',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX user_email (user_email),
        INDEX score (score),
        INDEX created_at (created_at)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Ensure columns exist using SHOW COLUMNS (reliable on all MySQL / MariaDB environments)
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name) {
        $existing_cols = $wpdb->get_col("SHOW COLUMNS FROM $table_name");
        if (is_array($existing_cols)) {
            if (!in_array('phone', $existing_cols)) {
                $wpdb->query("ALTER TABLE $table_name ADD COLUMN phone VARCHAR(50) DEFAULT '' AFTER user_email");
            }
            if (!in_array('designation', $existing_cols)) {
                $wpdb->query("ALTER TABLE $table_name ADD COLUMN designation VARCHAR(255) DEFAULT '' AFTER phone");
            }
        }
    }

    // Auto-fix existing old entries where designation was stored in company column
    fix_booth_quiz_old_designations();
}

// Automatically migrate old entries where designation was saved under company column
function fix_booth_quiz_old_designations() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'booth_quiz_leaderboard';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        return;
    }

    // Find all rows where designation is empty but company has data
    $rows = $wpdb->get_results("SELECT id, user_email, company, designation FROM $table_name WHERE (designation IS NULL OR designation = '') AND (company IS NOT NULL AND company != '')");
    if (!empty($rows)) {
        foreach ($rows as $row) {
            $company_val = trim($row->company);
            $email = trim($row->user_email);
            $derived_company = get_company_from_email($email);

            if (!empty($derived_company)) {
                // If company value is different from email company (e.g. "Tech Support" vs "Infosys")
                if (strcasecmp($company_val, $derived_company) !== 0) {
                    $wpdb->update(
                        $table_name,
                        array(
                            'designation' => $company_val,
                            'company'     => $derived_company
                        ),
                        array('id' => $row->id)
                    );
                }
            }
        }
    }
}
add_action('admin_init', 'fix_booth_quiz_old_designations', 5);

// 2. Helper to Save/Update Booth Quiz Entry
function save_booth_quiz_leaderboard_entry($name, $email, $company = '', $score_text = '6 / 6', $time_taken = '00:00:000', $created_at = null, $designation = '', $phone = '') {
    global $wpdb;
    $table_name = $wpdb->prefix . 'booth_quiz_leaderboard';

    $name        = sanitize_text_field($name);
    $email       = sanitize_email($email);
    $phone       = sanitize_text_field($phone);
    $designation = sanitize_text_field($designation);
    $company     = sanitize_text_field($company);
    $score_text  = sanitize_text_field($score_text);
    $time_taken  = sanitize_text_field($time_taken);
    if (empty($time_taken)) {
        $time_taken = '00:00:000';
    }
    $entry_time = !empty($created_at) ? sanitize_text_field($created_at) : current_time('mysql');

    if (empty($name) && empty($email)) {
        return false;
    }
    if (empty($name)) {
        $name = 'Participant';
    }
    if (empty($company) && !empty($email)) {
        $company = get_company_from_email($email);
    }

    $score = 0;
    $total = 6;
    if (preg_match('/(\d+)\s*\/\s*(\d+)/', $score_text, $m)) {
        $score = intval($m[1]);
        $total = intval($m[2]);
    } elseif (is_numeric($score_text)) {
        $score = intval($score_text);
    }
    $percentage = ($total > 0) ? round(($score / $total) * 100, 2) : 0;

    // Check if user exists by email
    $existing_row = null;
    if (!empty($email)) {
        $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE user_email = %s ORDER BY id DESC LIMIT 1", $email), ARRAY_A);
    }

    if ($existing_row) {
        $existing_id   = (int)$existing_row['id'];
        $current_score = (int)$existing_row['score'];

        $update_fields = array();

        if ($score >= $current_score) {
            if (!empty($name) && $name !== 'Participant') {
                $update_fields['user_name'] = $name;
            }
            $update_fields['score']           = $score;
            $update_fields['total_questions'] = $total;
            $update_fields['score_text']      = $score_text;
            $update_fields['percentage']      = $percentage;
            if (!empty($time_taken) && $time_taken !== '00:00:000') {
                $update_fields['time_taken']  = $time_taken;
            }
            if (!empty($entry_time)) {
                $update_fields['created_at']  = $entry_time;
            }
        }

        // Always update phone if provided
        if (!empty($phone)) {
            $update_fields['phone'] = $phone;
        }

        // Always update designation if provided
        if (!empty($designation)) {
            $update_fields['designation'] = $designation;
        }

        // Always update company if provided
        if (!empty($company)) {
            $update_fields['company'] = $company;
        }

        if (!empty($update_fields)) {
            $wpdb->update(
                $table_name,
                $update_fields,
                array('id' => $existing_id)
            );
        }
        return $existing_id;
    } else {
        $wpdb->insert(
            $table_name,
            array(
                'user_name'       => $name,
                'user_email'      => $email,
                'phone'           => $phone,
                'designation'     => $designation,
                'company'         => $company,
                'score'           => $score,
                'total_questions' => $total,
                'score_text'      => $score_text,
                'percentage'      => $percentage,
                'time_taken'      => $time_taken,
                'created_at'      => $entry_time
            )
        );
        return $wpdb->insert_id;
    }
}

// 3. WPForms 12790 Process Filter: Auto-populate Score (Field 5), Time (Field 9) and Company Name (Field 11)
add_filter('wpforms_process_filter', 'genrocket_booth_quiz_wpforms_process_filter', 10, 3);
function genrocket_booth_quiz_wpforms_process_filter($fields, $entry, $form_data) {
    if (isset($form_data['id']) && (int)$form_data['id'] === 12790) {
        // Extract Email
        $email = '';
        if (!empty($fields[3]['value']) && is_email($fields[3]['value'])) {
            $email = sanitize_email($fields[3]['value']);
        } elseif (!empty($_POST['wpforms']['fields']['3'])) {
            $email = sanitize_email($_POST['wpforms']['fields']['3']);
        }

        // Score (Field 5)
        $score = !empty($_POST['wpforms']['fields']['5']) ? sanitize_text_field($_POST['wpforms']['fields']['5']) : (!empty($_POST['booth_quiz_score']) ? sanitize_text_field($_POST['booth_quiz_score']) : (!empty($fields[5]['value']) ? sanitize_text_field($fields[5]['value']) : '6 / 6'));
        $fields[5] = array(
            'name'  => isset($fields[5]['name']) && !empty($fields[5]['name']) ? $fields[5]['name'] : 'Booth Quiz Score',
            'value' => $score,
            'id'    => 5,
            'type'  => 'hidden'
        );

        // Time Taken (Field 9)
        $time_val = !empty($_POST['wpforms']['fields']['9']) ? sanitize_text_field($_POST['wpforms']['fields']['9']) : (!empty($_POST['time_taken']) ? sanitize_text_field($_POST['time_taken']) : (!empty($fields[9]['value']) ? sanitize_text_field($fields[9]['value']) : ''));
        if (!empty($time_val)) {
            $fields[9] = array(
                'name'  => isset($fields[9]['name']) && !empty($fields[9]['name']) ? $fields[9]['name'] : 'Booth Quiz Time Taken',
                'value' => $time_val,
                'id'    => 9,
                'type'  => 'hidden'
            );
        }

        // Company Name (Field 11) - Auto-identified from participant email domain
        $company = !empty($_POST['wpforms']['fields']['11']) ? sanitize_text_field($_POST['wpforms']['fields']['11']) : (!empty($_POST['booth_quiz_company']) ? sanitize_text_field($_POST['booth_quiz_company']) : (!empty($fields[11]['value']) ? sanitize_text_field($fields[11]['value']) : ''));
        if (empty($company) && !empty($email)) {
            $company = get_company_from_email($email);
        }

        if (!empty($company)) {
            $fields[11] = array(
                'name'  => isset($fields[11]['name']) && !empty($fields[11]['name']) ? $fields[11]['name'] : 'Company name',
                'value' => $company,
                'id'    => 11,
                'type'  => 'hidden'
            );
        }
    }
    return $fields;
}

// 4. WPForms 12790 Entry Save Filter: Ensure Field 11 (Company name) and Field 9 (Time taken) are saved into wp_wpforms_entries
add_filter('wpforms_entry_save_args', 'genrocket_booth_quiz_entry_save_args', 10, 2);
function genrocket_booth_quiz_entry_save_args($args, $form_data = array()) {
    if (isset($form_data['id']) && (int)$form_data['id'] === 12790) {
        $fields_data = !empty($args['fields']) ? json_decode($args['fields'], true) : array();
        if (is_array($fields_data)) {
            $email = !empty($fields_data[3]['value']) ? sanitize_email($fields_data[3]['value']) : '';
            if (empty($email) && !empty($_POST['wpforms']['fields']['3'])) {
                $email = sanitize_email($_POST['wpforms']['fields']['3']);
            }

            // Company Name (Field 11)
            $company = !empty($fields_data[11]['value']) ? $fields_data[11]['value'] : (!empty($_POST['wpforms']['fields']['11']) ? sanitize_text_field($_POST['wpforms']['fields']['11']) : '');
            if (empty($company) && !empty($email)) {
                $company = get_company_from_email($email);
            }
            if (!empty($company)) {
                $fields_data[11] = array(
                    'name'  => isset($fields_data[11]['name']) && !empty($fields_data[11]['name']) ? $fields_data[11]['name'] : 'Company name',
                    'value' => $company,
                    'id'    => 11,
                    'type'  => 'hidden'
                );
            }

            // Time Taken (Field 9)
            $time_taken = !empty($fields_data[9]['value']) ? $fields_data[9]['value'] : (!empty($_POST['wpforms']['fields']['9']) ? sanitize_text_field($_POST['wpforms']['fields']['9']) : (!empty($_POST['time_taken']) ? sanitize_text_field($_POST['time_taken']) : (!empty($_POST['booth_quiz_time_taken']) ? sanitize_text_field($_POST['booth_quiz_time_taken']) : '00:00:000')));
            if (!empty($time_taken)) {
                $fields_data[9] = array(
                    'name'  => isset($fields_data[9]['name']) && !empty($fields_data[9]['name']) ? $fields_data[9]['name'] : 'Booth Quiz Time Taken',
                    'value' => $time_taken,
                    'id'    => 9,
                    'type'  => 'hidden'
                );
            }

            // Score (Field 5)
            $score = !empty($fields_data[5]['value']) ? $fields_data[5]['value'] : (!empty($_POST['wpforms']['fields']['5']) ? sanitize_text_field($_POST['wpforms']['fields']['5']) : (!empty($_POST['booth_quiz_score']) ? sanitize_text_field($_POST['booth_quiz_score']) : '6 / 6'));
            $fields_data[5] = array(
                'name'  => isset($fields_data[5]['name']) && !empty($fields_data[5]['name']) ? $fields_data[5]['name'] : 'Booth Quiz Score',
                'value' => $score,
                'id'    => 5,
                'type'  => 'hidden'
            );

            $args['fields'] = wp_json_encode($fields_data);
        }
    }
    return $args;
}

// 5. Hook WPForms 12790 process complete to save leaderboard entry
add_action('wpforms_process_complete', 'record_booth_quiz_wpforms_entry', 20, 4);
function record_booth_quiz_wpforms_entry($fields, $entry, $form_data, $entry_id) {
    if (!isset($form_data['id']) || (int)$form_data['id'] !== 12790) {
        return;
    }

    $name = '';
    $email = '';
    $phone = '';
    $designation = '';
    $company = '';

    if (!empty($fields) && is_array($fields)) {
        foreach ($fields as $fid => $f) {
            if (!is_array($f)) continue;
            $type = strtolower($f['type'] ?? '');
            $val = $f['value'] ?? ($f['value_raw'] ?? ($f['raw'] ?? ''));
            if (is_array($val)) {
                $val = implode(' ', array_filter($val));
            }
            $val = trim((string)$val);
            $fname = strtolower(trim(($f['name'] ?? '') . ' ' . ($f['label'] ?? '') . ' ' . ($f['title'] ?? '')));
            $fid_num = intval($f['id'] ?? $fid);

            if (empty($val)) continue;

            if ($type === 'email' || is_email($val) || strpos($fname, 'email') !== false) {
                if (empty($email) && is_email($val)) $email = sanitize_email($val);
            } elseif ($type === 'phone' || $type === 'tel' || strpos($fname, 'phone') !== false || strpos($fname, 'contact') !== false || strpos($fname, 'mobile') !== false || strpos($fname, 'cell') !== false || strpos($fname, 'tel') !== false || strpos($fname, 'whatsapp') !== false || (strpos($fname, 'number') !== false && strpos($fname, 'score') === false && strpos($fname, 'time') === false)) {
                if (empty($phone)) $phone = sanitize_text_field($val);
            } elseif (empty($phone) && strpos($fname, 'score') === false && strpos($fname, 'time') === false && strpos($fname, 'name') === false && strpos($fname, 'company') === false && strpos($fname, 'designation') === false && !is_email($val) && preg_match('/^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.\/0-9]{6,20}$/', $val)) {
                $phone = sanitize_text_field($val);
            } elseif ($type === 'name' || $fid_num === 2 || strpos($fname, 'name') !== false) {
                if (empty($name)) {
                    $name = !empty($f['first']) ? trim($f['first'] . ' ' . ($f['last'] ?? '')) : sanitize_text_field($val);
                }
            } elseif ($fid_num === 4 || strpos($fname, 'designation') !== false || strpos($fname, 'title') !== false || strpos($fname, 'role') !== false || strpos($fname, 'position') !== false || strpos($fname, 'job') !== false) {
                if (empty($designation)) $designation = sanitize_text_field($val);
            } elseif ($fid_num === 11 || strpos($fname, 'company') !== false || strpos($fname, 'organization') !== false) {
                if (empty($company)) $company = sanitize_text_field($val);
            }
        }
    }

    if (empty($name) && isset($_POST['wpforms']['fields'][2])) {
        $name = sanitize_text_field($_POST['wpforms']['fields'][2]);
    }
    if (empty($email) && isset($_POST['wpforms']['fields'][3])) {
        $email = sanitize_email($_POST['wpforms']['fields'][3]);
    }
    if (empty($phone) && isset($_POST['wpforms']['fields']['phone'])) {
        $phone = sanitize_text_field($_POST['wpforms']['fields']['phone']);
    }
    if (empty($phone) && isset($_POST['phone'])) {
        $phone = sanitize_text_field($_POST['phone']);
    }
    if (empty($phone) && !empty($_POST['wpforms']['fields']) && is_array($_POST['wpforms']['fields'])) {
        foreach ($_POST['wpforms']['fields'] as $pf_k => $pf_v) {
            if (is_string($pf_v) && empty($phone) && preg_match('/^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.\/0-9]{6,20}$/', trim($pf_v)) && !is_email($pf_v) && strpos($pf_v, '@') === false) {
                $phone = sanitize_text_field($pf_v);
            }
        }
    }
    if (empty($designation) && isset($_POST['wpforms']['fields'][4])) {
        $designation = sanitize_text_field($_POST['wpforms']['fields'][4]);
    }
    if (empty($company) && isset($_POST['wpforms']['fields'][11])) {
        $company = sanitize_text_field($_POST['wpforms']['fields'][11]);
    }
    if (empty($company) && !empty($email)) {
        $company = get_company_from_email($email);
    }

    $score = !empty($fields[5]['value']) ? sanitize_text_field($fields[5]['value']) : (!empty($_POST['wpforms']['fields']['5']) ? sanitize_text_field($_POST['wpforms']['fields']['5']) : (!empty($_POST['booth_quiz_score']) ? sanitize_text_field($_POST['booth_quiz_score']) : '6 / 6'));
    $time_taken = !empty($fields[9]['value']) ? sanitize_text_field($fields[9]['value']) : (!empty($_POST['wpforms']['fields']['9']) ? sanitize_text_field($_POST['wpforms']['fields']['9']) : (!empty($_POST['time_taken']) ? sanitize_text_field($_POST['time_taken']) : (!empty($_POST['booth_quiz_time_taken']) ? sanitize_text_field($_POST['booth_quiz_time_taken']) : '00:00:000')));

    save_booth_quiz_leaderboard_entry($name, $email, $company, $score, $time_taken, null, $designation, $phone);
}

// Helper to batch sync existing WPForms entries into Leaderboard and populate Company name if missing
function sync_booth_quiz_from_wpforms($form_id = 12790) {
    global $wpdb;
    $entries_table = $wpdb->prefix . 'wpforms_entries';

    if ($wpdb->get_var("SHOW TABLES LIKE '$entries_table'") !== $entries_table) {
        return 0;
    }

    $entry_fields_table = $wpdb->prefix . 'wpforms_entry_fields';
    $has_entry_fields = ($wpdb->get_var("SHOW TABLES LIKE '$entry_fields_table'") === $entry_fields_table);

    $rows = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $entries_table WHERE form_id = %d ORDER BY entry_id ASC",
        $form_id
    ));

    if (empty($rows)) {
        return 0;
    }

    $imported = 0;
    foreach ($rows as $row) {
        $fields_data = json_decode($row->fields, true);
        if (empty($fields_data) && is_string($row->fields)) {
            $fields_data = maybe_unserialize($row->fields);
        }
        if (!is_array($fields_data)) {
            $fields_data = array();
        }

        $name = '';
        $email = '';
        $phone = '';
        $designation = '';
        $company = '';
        $score = '6 / 6';
        $time_taken = '00:00:000';
        $needs_db_update = false;

        foreach ($fields_data as $fid => $f) {
            if (!is_array($f)) continue;
            $type = strtolower($f['type'] ?? '');
            $val = $f['value'] ?? ($f['value_raw'] ?? ($f['raw'] ?? ''));
            if (is_array($val)) {
                $val = implode(' ', array_filter($val));
            }
            $val = trim((string)$val);
            $fname = strtolower(trim(($f['name'] ?? '') . ' ' . ($f['label'] ?? '') . ' ' . ($f['title'] ?? '')));
            $fid_num = intval($f['id'] ?? $fid);

            if (empty($val)) continue;

            if ($type === 'email' || is_email($val) || strpos($fname, 'email') !== false) {
                if (empty($email) && is_email($val)) $email = sanitize_email($val);
            } elseif ($type === 'phone' || $type === 'tel' || strpos($fname, 'phone') !== false || strpos($fname, 'contact') !== false || strpos($fname, 'mobile') !== false || strpos($fname, 'cell') !== false || strpos($fname, 'tel') !== false || strpos($fname, 'whatsapp') !== false || (strpos($fname, 'number') !== false && strpos($fname, 'score') === false && strpos($fname, 'time') === false)) {
                if (empty($phone)) $phone = sanitize_text_field($val);
            } elseif (empty($phone) && strpos($fname, 'score') === false && strpos($fname, 'time') === false && strpos($fname, 'name') === false && strpos($fname, 'company') === false && strpos($fname, 'designation') === false && !is_email($val) && preg_match('/^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.\/0-9]{6,20}$/', $val)) {
                $phone = sanitize_text_field($val);
            } elseif ($type === 'name' || $fid_num === 2) {
                if (empty($name)) {
                    $name = !empty($f['first']) ? trim($f['first'] . ' ' . ($f['last'] ?? '')) : sanitize_text_field($val);
                }
            } elseif (strpos($fname, 'name') !== false && empty($name)) {
                $name = sanitize_text_field($val);
            } elseif ($fid_num === 4 || strpos($fname, 'designation') !== false || strpos($fname, 'title') !== false || strpos($fname, 'role') !== false || strpos($fname, 'position') !== false || strpos($fname, 'job') !== false) {
                if (empty($designation)) $designation = sanitize_text_field($val);
            } elseif ($fid_num === 11 || strpos($fname, 'company') !== false || strpos($fname, 'organization') !== false) {
                if (empty($company)) $company = sanitize_text_field($val);
            } elseif ($fid_num === 5 || strpos($fname, 'score') !== false || strpos($fname, 'quiz') !== false) {
                if (!empty($val)) $score = sanitize_text_field($val);
            } elseif ($fid_num === 9 || strpos($fname, 'time') !== false) {
                if (!empty($val)) $time_taken = sanitize_text_field($val);
            }
        }

        // Check extra entry fields table if phone or designation is still missing
        if ($has_entry_fields && (empty($phone) || empty($designation))) {
            $extra_fields = $wpdb->get_results($wpdb->prepare("SELECT field_id, value FROM $entry_fields_table WHERE entry_id = %d", $row->entry_id));
            if (!empty($extra_fields)) {
                foreach ($extra_fields as $ef) {
                    $ef_val = trim($ef->value);
                    if (empty($phone) && !empty($ef_val) && !is_email($ef_val) && strpos($ef_val, '@') === false && strpos($ef_val, ':') === false && strpos($ef_val, '/') === false && preg_match('/^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.\/0-9]{6,20}$/', $ef_val)) {
                        $phone = sanitize_text_field($ef_val);
                    }
                }
            }
        }

        $derived_company = get_company_from_email($email);
        if (!empty($company) && !empty($derived_company) && strcasecmp($company, $derived_company) !== 0 && empty($designation)) {
            $designation = $company;
            $company = $derived_company;
            $fields_data[11] = array(
                'name'  => 'Company name',
                'value' => $company,
                'id'    => 11,
                'type'  => 'hidden'
            );
            $needs_db_update = true;
        } elseif (empty($company) && !empty($derived_company)) {
            $company = $derived_company;
            $fields_data[11] = array(
                'name'  => 'Company name',
                'value' => $company,
                'id'    => 11,
                'type'  => 'hidden'
            );
            $needs_db_update = true;
        }

        if ($needs_db_update) {
            $wpdb->update(
                $entries_table,
                array('fields' => wp_json_encode($fields_data)),
                array('entry_id' => $row->entry_id)
            );
        }

        if (!empty($name) || !empty($email)) {
            $created_time = !empty($row->date) ? sanitize_text_field($row->date) : current_time('mysql');
            save_booth_quiz_leaderboard_entry($name, $email, $company, $score, $time_taken, $created_time, $designation, $phone);
            $imported++;
        }
    }

    return $imported;
}

// 6. Hook AJAX endpoints to retrieve leaderboard entries
add_action('wp_ajax_nopriv_get_booth_quiz_leaderboard', 'fetch_booth_quiz_leaderboard_ajax');
add_action('wp_ajax_get_booth_quiz_leaderboard', 'fetch_booth_quiz_leaderboard_ajax');
function fetch_booth_quiz_leaderboard_ajax() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'booth_quiz_leaderboard';
    
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
        wp_send_json_success(array('entries' => array(), 'total' => 0));
    }

    $limit = isset($_GET['limit']) ? min(50, max(1, intval($_GET['limit']))) : 10;
    
    $entries = $wpdb->get_results($wpdb->prepare(
        "SELECT id, user_name, user_email, phone, designation, company, score, total_questions, score_text, percentage, time_taken, created_at 
         FROM $table_name 
         ORDER BY score DESC, (CASE WHEN time_taken != '' AND time_taken != '00:00:000' AND time_taken != '0' THEN time_taken ELSE '99:99:999' END) ASC, created_at ASC 
         LIMIT %d",
        $limit
    ), ARRAY_A);

    $total = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");

    wp_send_json_success(array(
        'entries' => $entries ? $entries : array(),
        'total'   => intval($total)
    ));
}

// 7. AJAX endpoint to send quiz result email
add_action('wp_ajax_nopriv_send_booth_quiz_email', 'handle_booth_quiz_email_ajax');
add_action('wp_ajax_send_booth_quiz_email', 'handle_booth_quiz_email_ajax');
function handle_booth_quiz_email_ajax() {
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : 'Participant';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $designation = isset($_POST['designation']) ? sanitize_text_field($_POST['designation']) : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company']) : '';
    $score = isset($_POST['score']) ? sanitize_text_field($_POST['score']) : '6 / 6';
    $time_taken = isset($_POST['time_taken']) ? sanitize_text_field($_POST['time_taken']) : '00:00:000';

    if (empty($company) && !empty($email)) {
        $company = get_company_from_email($email);
    }

    // Save to Leaderboard database
    save_booth_quiz_leaderboard_entry($name, $email, $company, $score, $time_taken, null, $designation, $phone);

    if (!empty($email) && is_email($email)) {
        $subject = 'Your GenRocket Challenge Score: ' . $score;
        $body = '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <style>
            body { font-family: -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; background-color: #0F2028; color: #ffffff; margin: 0; padding: 20px; }
            .card { max-width: 560px; margin: 0 auto; background: #152A36; border: 1px solid rgba(39,191,240,0.3); border-radius: 18px; padding: 36px 28px; box-shadow: 0 16px 40px rgba(0,0,0,0.4); }
            .brand { text-align: center; margin-bottom: 22px; }
            .brand span.gen { color: #27BFF0; font-size: 28px; font-weight: 900; }
            .brand span.rocket { color: #A6D540; font-size: 28px; font-weight: 900; }
            .score { font-size: 58px; font-weight: 900; text-align: center; color: #27BFF0; margin: 16px 0 6px; line-height: 1; }
            .scorelbl { font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #9BB9C6; text-align: center; font-weight: 700; margin-bottom: 22px; }
            .content { font-size: 15px; line-height: 1.65; color: #dcecf3; margin-bottom: 24px; }
            .btn { display: block; text-align: center; background: linear-gradient(90deg, #27BFF0, #A6D540); color: #0b1a22 !important; text-decoration: none; font-weight: 900; font-size: 16px; padding: 15px 24px; border-radius: 100px; margin-top: 24px; }
            .footer { text-align: center; font-size: 12px; color: #7f97a3; margin-top: 28px; line-height: 1.5; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 18px; }
          </style>
        </head>
        <body>
          <div class="card">
            <div class="brand"><span class="gen">Gen</span><span class="rocket">Rocket</span></div>
            <div class="score">' . esc_html($score) . '</div>
            <div class="scorelbl">GenRocket Knowledge Score</div>
            <div class="content">
              <p>Hi <strong>' . esc_html($name) . '</strong>,</p>
              <p>Thank you for stopping by our booth and taking the <strong>GenRocket Challenge</strong>!</p>
              <p>GenRocket is the industry pioneer in <strong>Design-Driven Synthetic Data Generation</strong>, eliminating privacy risks and speeding up test data provisioning by over 10x.</p>
            </div>
            <a href="https://www.genrocket.com" class="btn" target="_blank">Explore GenRocket Synthetic Data →</a>
            <div class="footer">
              Design-Driven Synthetic Data · <a href="https://www.genrocket.com" style="color:#27BFF0; text-decoration:none; font-weight:700;">genrocket.com</a><br>
              © ' . date('Y') . ' GenRocket, Inc. All rights reserved.
            </div>
          </div>
        </body>
        </html>';

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: GenRocket <info@genrocket.com>'
        );

        wp_mail($email, $subject, $body, $headers);
        wp_send_json_success(array('message' => 'Result email sent'));
    } else {
        wp_send_json_error(array('message' => 'Invalid email address'));
    }
}

// 8. Admin Menu Page for Booth Quiz Leaderboard
add_action('admin_menu', 'add_booth_quiz_leaderboard_admin_page');
function add_booth_quiz_leaderboard_admin_page() {
    // 1. Add as top-level menu in WP Admin sidebar
    add_menu_page(
        'Booth Quiz Leaderboard',
        'Booth Leaderboard',
        'manage_options',
        'booth-quiz-leaderboard',
        'display_booth_quiz_leaderboard_admin',
        'dashicons-awards',
        30
    );

    // 2. Also register under WPForms submenu for direct convenience
    add_submenu_page(
        'wpforms-overview',
        'Booth Quiz Leaderboard',
        'Booth Leaderboard',
        'manage_options',
        'booth-quiz-leaderboard',
        'display_booth_quiz_leaderboard_admin'
    );
}

// Handle Admin Actions (Delete single, Bulk Delete, Seed, Clear, Manual Add, CSV Export)
add_action('admin_init', 'handle_booth_quiz_leaderboard_admin_actions');
function handle_booth_quiz_leaderboard_admin_actions() {
    if (!current_user_can('manage_options')) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'booth_quiz_leaderboard';

    // 1. Handle single delete
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        check_admin_referer('delete_booth_entry_' . $id);
        $wpdb->delete($table_name, array('id' => $id));
        wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard&deleted=1'));
        exit;
    }

    // 2. Handle sync from WPForms
    if (isset($_POST['sync_wpforms_leaderboard']) && check_admin_referer('sync_booth_leaderboard')) {
        $target_form_id = !empty($_POST['sync_form_id']) ? intval($_POST['sync_form_id']) : 12790;
        $imported_count = sync_booth_quiz_from_wpforms($target_form_id);
        wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard&synced=' . $imported_count));
        exit;
    }

    // 3. Handle manual entry addition
    if (isset($_POST['add_manual_leaderboard_entry']) && check_admin_referer('add_booth_manual_entry')) {
        $m_name = sanitize_text_field($_POST['m_name'] ?? '');
        $m_email = sanitize_email($_POST['m_email'] ?? '');
        $m_phone = sanitize_text_field($_POST['m_phone'] ?? '');
        $m_designation = sanitize_text_field($_POST['m_designation'] ?? '');
        $m_company = sanitize_text_field($_POST['m_company'] ?? '');
        $m_score = sanitize_text_field($_POST['m_score'] ?? '6 / 6');
        $m_time = sanitize_text_field($_POST['m_time'] ?? '00:00:000');

        if (!empty($m_name) || !empty($m_email)) {
            save_booth_quiz_leaderboard_entry($m_name, $m_email, $m_company, $m_score, $m_time, null, $m_designation, $m_phone);
        }
        wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard&added=1'));
        exit;
    }

    // 4. Handle seed sample entries
    if (isset($_POST['seed_sample_leaderboard']) && check_admin_referer('seed_booth_leaderboard')) {
        $now = current_time('timestamp');
        $samples = array(
            array('name' => 'Sarah Jenkins', 'email' => 'sarah.j@acme-fintech.com', 'phone' => '+1 (415) 890-1234', 'designation' => 'Lead SDET', 'company' => 'Acme FinTech', 'score_text' => '6 / 6', 'time_taken' => '00:38:420', 'created_at' => date('Y-m-d H:i:s', $now - 12 * 60)),
            array('name' => 'Michael Chang', 'email' => 'mchang@globalbank.io', 'phone' => '+1 (212) 555-8765', 'designation' => 'QA Architect', 'company' => 'Global Bank Corp', 'score_text' => '6 / 6', 'time_taken' => '00:45:110', 'created_at' => date('Y-m-d H:i:s', $now - 35 * 60)),
            array('name' => 'David Miller', 'email' => 'david.m@cloudscale.net', 'phone' => '+1 (512) 440-9821', 'designation' => 'Director of Quality Engineering', 'company' => 'CloudScale Systems', 'score_text' => '6 / 6', 'time_taken' => '00:52:850', 'created_at' => date('Y-m-d H:i:s', $now - 75 * 60)),
            array('name' => 'Elena Rostova', 'email' => 'elena@novatech.co', 'phone' => '+44 20 7946 0912', 'designation' => 'Senior Automation Lead', 'company' => 'Nova Technologies', 'score_text' => '5 / 6', 'time_taken' => '00:41:300', 'created_at' => date('Y-m-d H:i:s', $now - 2 * 3600)),
            array('name' => 'James Wilson', 'email' => 'jwilson@apexinsurance.com', 'phone' => '+1 (312) 670-3412', 'designation' => 'VP, Testing & Delivery', 'company' => 'Apex Insurance', 'score_text' => '5 / 6', 'time_taken' => '00:49:750', 'created_at' => date('Y-m-d H:i:s', $now - 3 * 3600)),
            array('name' => 'Priya Sharma', 'email' => 'priya.s@infosphere.in', 'phone' => '+91 98765 43210', 'designation' => 'Lead Quality Analyst', 'company' => 'InfoSphere Labs', 'score_text' => '5 / 6', 'time_taken' => '00:58:200', 'created_at' => date('Y-m-d H:i:s', $now - 4 * 3600)),
            array('name' => 'Alexandre Dubois', 'email' => 'a.dubois@telecom-eu.fr', 'phone' => '+33 1 42 68 55 00', 'designation' => 'DevOps & Test Engineer', 'company' => 'Telecom Europe', 'score_text' => '4 / 6', 'time_taken' => '00:44:600', 'created_at' => date('Y-m-d H:i:s', $now - 5 * 3600)),
            array('name' => 'Carlos Mendez', 'email' => 'cmendez@dataflow.org', 'phone' => '+34 91 123 4567', 'designation' => 'Software Engineer in Test', 'company' => 'DataFlow Solutions', 'score_text' => '4 / 6', 'time_taken' => '00:55:180', 'created_at' => date('Y-m-d H:i:s', $now - 6 * 3600)),
            array('name' => 'Hannah Schmidt', 'email' => 'h.schmidt@autoqa.de', 'phone' => '+49 30 2312 5678', 'designation' => 'Head of Test Automation', 'company' => 'AutoQA Digital', 'score_text' => '4 / 6', 'time_taken' => '01:03:900', 'created_at' => date('Y-m-d H:i:s', $now - 8 * 3600)),
            array('name' => 'Robert Taylor', 'email' => 'rtaylor@healthtech-core.com', 'phone' => '+1 (617) 902-3344', 'designation' => 'Senior QA Engineer', 'company' => 'HealthTech Core', 'score_text' => '3 / 6', 'time_taken' => '00:50:410', 'created_at' => date('Y-m-d H:i:s', $now - 12 * 3600)),
        );
        foreach ($samples as $s) {
            save_booth_quiz_leaderboard_entry($s['name'], $s['email'], $s['company'], $s['score_text'], $s['time_taken'], $s['created_at'], $s['designation'], $s['phone']);
        }
        wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard&seeded=1'));
        exit;
    }

    // 5. Handle clear all entries
    if (isset($_POST['clear_all_leaderboard']) && check_admin_referer('clear_booth_leaderboard')) {
        $wpdb->query("TRUNCATE TABLE $table_name");
        wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard&cleared=1'));
        exit;
    }

    // 6. Handle Export All Entries to CSV
    if (isset($_GET['action']) && $_GET['action'] === 'export_csv') {
        check_admin_referer('export_booth_leaderboard_csv');

        $search = isset($_GET['s']) ? sanitize_text_field(trim($_GET['s'])) : '';
        $where_sql = "";
        $query_args = array();
        if (!empty($search)) {
            $search_like = '%' . $wpdb->esc_like($search) . '%';
            $where_sql   = " WHERE (user_name LIKE %s OR user_email LIKE %s OR phone LIKE %s OR designation LIKE %s OR company LIKE %s)";
            $query_args  = array($search_like, $search_like, $search_like, $search_like, $search_like);
        }

        if (!empty($query_args)) {
            $rows = $wpdb->get_results($wpdb->prepare(
                "SELECT id, user_name, user_email, phone, designation, company, score_text, percentage, time_taken, created_at FROM $table_name $where_sql ORDER BY created_at DESC, id DESC",
                $query_args
            ), ARRAY_A);
        } else {
            $rows = $wpdb->get_results("SELECT id, user_name, user_email, phone, designation, company, score_text, percentage, time_taken, created_at FROM $table_name ORDER BY created_at DESC, id DESC", ARRAY_A);
        }

        $filename = 'genrocket_booth_quiz_entries_' . date('Y-m-d_His') . '.csv';

        // Clean buffer before sending CSV headers
        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // UTF-8 BOM for Excel compatibility
        fputs($output, "\xEF\xBB\xBF");

        // Header column names
        fputcsv($output, array('Entry ID', 'Full Name', 'Email Address', 'Contact Number', 'Designation', 'Company Name', 'Score', 'Percentage', 'Time Taken', 'Submitted Date & Time'));

        if (!empty($rows)) {
            foreach ($rows as $r) {
                $time_str = (!empty($r['time_taken']) && $r['time_taken'] !== '00:00:000' && $r['time_taken'] !== '0') ? $r['time_taken'] : '—';
                fputcsv($output, array(
                    $r['id'],
                    $r['user_name'],
                    $r['user_email'],
                    !empty($r['phone']) ? $r['phone'] : '',
                    !empty($r['designation']) ? $r['designation'] : '',
                    !empty($r['company']) ? $r['company'] : '',
                    $r['score_text'],
                    $r['percentage'] . '%',
                    $time_str,
                    $r['created_at']
                ));
            }
        }

        fclose($output);
        exit;
    }
    // 7. Handle Bulk Delete Entries
    if (isset($_POST['bulk_delete_booth_entries']) && check_admin_referer('bulk_delete_booth_entries_nonce')) {
        if (!empty($_POST['entry_ids']) && is_array($_POST['entry_ids'])) {
            $ids = array_map('intval', $_POST['entry_ids']);
            $ids = array_filter($ids);
            if (!empty($ids)) {
                $placeholders = implode(',', array_fill(0, count($ids), '%d'));
                $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id IN ($placeholders)", $ids));
                wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard&bulk_deleted=' . count($ids)));
                exit;
            }
        }
        wp_safe_redirect(admin_url('admin.php?page=booth-quiz-leaderboard'));
        exit;
    }
}

function display_booth_quiz_leaderboard_admin() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'booth_quiz_leaderboard';

    // Notices
    if (isset($_GET['deleted'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Entry deleted successfully.</p></div>';
    }
    if (isset($_GET['bulk_deleted'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Successfully deleted <strong>' . intval($_GET['bulk_deleted']) . '</strong> entries.</p></div>';
    }
    if (isset($_GET['synced'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Synced <strong>' . intval($_GET['synced']) . '</strong> entries from WPForms!</p></div>';
    }
    if (isset($_GET['added'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Entry added successfully!</p></div>';
    }
    if (isset($_GET['seeded'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Sample entries seeded successfully!</p></div>';
    }
    if (isset($_GET['cleared'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Leaderboard has been cleared.</p></div>';
    }

    // Search setup
    $search = isset($_GET['s']) ? sanitize_text_field(trim($_GET['s'])) : '';
    $where_sql = "";
    $query_args = array();
    if (!empty($search)) {
        $search_like = '%' . $wpdb->esc_like($search) . '%';
        $where_sql   = " WHERE (user_name LIKE %s OR user_email LIKE %s OR phone LIKE %s OR designation LIKE %s OR company LIKE %s)";
        $query_args  = array($search_like, $search_like, $search_like, $search_like, $search_like);
    }

    // Pagination setup
    $per_page     = 20;
    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    if (!empty($query_args)) {
        $total_items = (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name $where_sql", $query_args));
    } else {
        $total_items = (int)$wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    }
    $total_pages  = ceil($total_items / $per_page);
    $offset       = ($current_page - 1) * $per_page;

    // Query: Latest entries on top (ORDER BY created_at DESC, id DESC)
    if (!empty($query_args)) {
        $query_args_paginated = array_merge($query_args, array($per_page, $offset));
        $entries = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_name $where_sql ORDER BY created_at DESC, id DESC LIMIT %d OFFSET %d",
            $query_args_paginated
        ));
    } else {
        $entries = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $table_name ORDER BY created_at DESC, id DESC LIMIT %d OFFSET %d",
            $per_page,
            $offset
        ));
    }

    $start_num = ($total_items > 0) ? $offset + 1 : 0;
    $end_num   = min($offset + $per_page, $total_items);

    // Pagination URL Base
    $page_base = add_query_arg(array('paged' => '%#%'));
    if (!empty($search)) {
        $page_base = add_query_arg(array('s' => urlencode($search), 'paged' => '%#%'));
    }

    // Export CSV URL
    $export_params = array('action' => 'export_csv');
    if (!empty($search)) {
        $export_params['s'] = $search;
    }
    $export_url = wp_nonce_url(add_query_arg($export_params, admin_url('admin.php?page=booth-quiz-leaderboard')), 'export_booth_leaderboard_csv');
    ?>
    <div class="wrap">
        <h1 style="display:flex; align-items:center; gap:10px;">
            <span>🏆 GenRocket Booth Quiz Entries & Leaderboard</span>
            <a href="<?php echo esc_url(site_url('/booth-quiz-leaderboard/')); ?>" target="_blank" class="page-title-action">View Public Leaderboard Page ↗</a>
        </h1>
        <p>All participants and quiz entries from the GenRocket Booth Challenge. <em>(Showing latest submissions on top)</em></p>

        <!-- Action Bar with Search -->
        <div style="margin: 20px 0; display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; background: #fff; padding: 16px; border: 1px solid #ccd0d4; border-radius: 6px;">
            <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
                <div>
                    <strong>Total Entries:</strong> <?php echo $total_items; ?>
                    <?php if ($total_items > 0): ?>
                        <span style="color:#666; margin-left:6px;">(Displaying <?php echo $start_num; ?>–<?php echo $end_num; ?>)</span>
                    <?php endif; ?>
                </div>

                <!-- Search Form -->
                <form method="get" style="display:flex; gap:6px; align-items:center;">
                    <input type="hidden" name="page" value="booth-quiz-leaderboard">
                    <input type="search" name="s" value="<?php echo esc_attr($search); ?>" placeholder="Search name, email, phone, company..." style="width:260px; height:30px;">
                    <button type="submit" class="button">Search</button>
                    <?php if (!empty($search)): ?>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=booth-quiz-leaderboard')); ?>" class="button">Clear Search</a>
                    <?php endif; ?>
                </form>
            </div>

            <div style="display:flex; gap:10px; flex-wrap: wrap; align-items:center;">
                <!-- Export to CSV Button -->
                <?php if ($total_items > 0): ?>
                <a href="<?php echo esc_url($export_url); ?>" class="button button-primary" style="background:#2271b1; border-color:#2271b1; display:inline-flex; align-items:center; gap:5px; font-weight:600;">
                    📥 Export All (CSV)
                </a>
                <?php endif; ?>

                <!-- Sync from WPForms -->
                <form method="post" style="display:flex; gap:6px; align-items:center;">
                    <?php wp_nonce_field('sync_booth_leaderboard'); ?>
                    <input type="number" name="sync_form_id" value="12790" style="width:80px;" title="WPForms ID">
                    <button type="submit" name="sync_wpforms_leaderboard" class="button button-secondary">🔄 Sync from WPForms</button>
                </form>

                <!-- Seed Sample Data -->
                <form method="post">
                    <?php wp_nonce_field('seed_booth_leaderboard'); ?>
                    <button type="submit" name="seed_sample_leaderboard" class="button">🌱 Add Sample Top 10</button>
                </form>

                <!-- Clear Leaderboard -->
                <?php if ($total_items > 0): ?>
                <form method="post" onsubmit="return confirm('Are you sure you want to clear ALL leaderboard entries?');">
                    <?php wp_nonce_field('clear_booth_leaderboard'); ?>
                    <button type="submit" name="clear_all_leaderboard" class="button button-secondary" style="color:#b32d2e;">Reset / Clear All</button>
                </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- Add Manual Entry Box -->
        <details style="margin-bottom: 20px; background:#fff; border:1px solid #ccd0d4; border-radius:6px; padding:12px 16px;">
            <summary style="font-weight:bold; cursor:pointer; color:#0073aa;">➕ Add Single Participant Manually</summary>
            <form method="post" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)) 120px; gap:12px; align-items:end; margin-top:14px;">
                <?php wp_nonce_field('add_booth_manual_entry'); ?>
                <div>
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Full Name *</label>
                    <input type="text" name="m_name" required style="width:100%;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Email *</label>
                    <input type="email" name="m_email" required style="width:100%;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Contact Number</label>
                    <input type="text" name="m_phone" placeholder="e.g. +91 98765 43210" style="width:100%;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Designation / Title</label>
                    <input type="text" name="m_designation" placeholder="e.g. Lead SDET" style="width:100%;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Company</label>
                    <input type="text" name="m_company" placeholder="e.g. Acme Corp" style="width:100%;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:bold; margin-bottom:4px;">Score</label>
                    <select name="m_score" style="width:100%;">
                        <option value="6 / 6">6 / 6 (100%)</option>
                        <option value="5 / 6">5 / 6 (83%)</option>
                        <option value="4 / 6">4 / 6 (67%)</option>
                        <option value="3 / 6">3 / 6 (50%)</option>
                        <option value="2 / 6">2 / 6 (33%)</option>
                        <option value="1 / 6">1 / 6 (17%)</option>
                    </select>
                </div>
                <div>
                    <button type="submit" name="add_manual_leaderboard_entry" class="button button-primary" style="width:100%;">Add Entry</button>
                </div>
            </form>
        </details>

        <!-- Embedded Admin Styling for WordPress Standard UI -->
        <style>
            .tablenav {
                clear: both;
                height: 36px;
                margin: 10px 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 8px;
            }
            .tablenav .bulkactions {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .tablenav .tablenav-pages {
                margin-left: auto;
                display: flex;
                align-items: center;
                gap: 4px;
                font-size: 13px;
                color: #50575e;
            }
            .tablenav .tablenav-pages .displaying-num {
                margin-right: 10px;
                font-size: 13px;
                font-weight: 400;
                color: #50575e;
            }
            .tablenav-pages .pagination-links {
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }
            .tablenav-pages .page-numbers {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 28px;
                height: 28px;
                padding: 0 8px;
                font-size: 13px;
                font-weight: 500;
                line-height: 1;
                border: 1px solid #8c8f94;
                border-radius: 4px;
                background: #f6f7f7;
                color: #2271b1;
                text-decoration: none;
                box-sizing: border-box;
                cursor: pointer;
            }
            .tablenav-pages a.page-numbers:hover {
                background: #f0f0f1;
                border-color: #2271b1;
                color: #135e96;
            }
            .tablenav-pages .page-numbers.current {
                background: #2271b1;
                border-color: #2271b1;
                color: #ffffff;
                font-weight: 700;
            }
            .tablenav-pages .page-numbers.dots {
                background: transparent;
                border-color: transparent;
                color: #50575e;
                min-width: 18px;
                padding: 0 2px;
                cursor: default;
            }
            .tablenav-pages .prev.page-numbers,
            .tablenav-pages .next.page-numbers {
                padding: 0 10px;
                font-weight: 600;
            }
        </style>

        <!-- Bulk Action Form -->
        <form method="post" id="booth-leaderboard-bulk-form" onsubmit="return confirmBulkDelete();">
            <?php wp_nonce_field('bulk_delete_booth_entries_nonce'); ?>
            <input type="hidden" name="bulk_delete_booth_entries" value="1">

            <!-- Tablenav Top with Bulk Action & Pagination -->
            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <?php if (!empty($entries)): ?>
                        <button type="submit" class="button button-secondary" style="color:#b32d2e; font-weight:600;">🗑️ Delete Selected</button>
                        <span id="selected-count-msg" style="color:#666; font-size:12.5px; margin-left:4px;"></span>
                    <?php endif; ?>
                </div>

                <?php if ($total_pages > 1): ?>
                <div class="tablenav-pages">
                    <span class="displaying-num"><?php echo $total_items; ?> items</span>
                    <span class="pagination-links">
                        <?php
                        echo paginate_links(array(
                            'base'      => $page_base,
                            'format'    => '',
                            'prev_text' => '&laquo; Prev',
                            'next_text' => 'Next &raquo;',
                            'total'     => $total_pages,
                            'current'   => $current_page
                        ));
                        ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Table -->
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <td width="35" class="manage-column column-cb check-column" style="padding:11px 0 0 8px;">
                            <input type="checkbox" id="cb-select-all-top">
                        </td>
                        <th width="40">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th width="90">Score</th>
                        <th width="80">Percentage</th>
                        <th width="95">Time Taken</th>
                        <th width="165">Submitted (Latest First)</th>
                        <th width="75">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($entries)): ?>
                        <tr><td colspan="12" style="text-align:center; padding:24px;">No quiz entries found yet.</td></tr>
                    <?php else: 
                        $row_idx = $offset;
                        foreach ($entries as $row): 
                            $row_idx++;
                            $time_str = (!empty($row->time_taken) && $row->time_taken !== '00:00:000' && $row->time_taken !== '0') ? $row->time_taken : '—';
                    ?>
                        <tr>
                            <th scope="row" class="check-column" style="padding:11px 0 0 8px;">
                                <input type="checkbox" name="entry_ids[]" value="<?php echo esc_attr($row->id); ?>" class="entry-checkbox">
                            </th>
                            <td><strong><?php echo $row_idx; ?></strong></td>
                            <td><strong><?php echo esc_html($row->user_name); ?></strong></td>
                            <td><a href="mailto:<?php echo esc_attr($row->user_email); ?>"><?php echo esc_html($row->user_email); ?></a></td>
                            <td><?php echo esc_html(!empty($row->phone) ? $row->phone : '—'); ?></td>
                            <td><?php echo esc_html(!empty($row->designation) ? $row->designation : '—'); ?></td>
                            <td><?php echo esc_html(!empty($row->company) ? $row->company : '—'); ?></td>
                            <td><span style="font-weight:bold; color:#0073aa;"><?php echo esc_html($row->score_text); ?></span></td>
                            <td><?php echo esc_html($row->percentage); ?>%</td>
                            <td><?php echo esc_html($time_str); ?></td>
                            <td>
                                <?php
                                $row_ts = strtotime($row->created_at);
                                $cur_ts = current_time('timestamp');
                                $ago_lbl = ($cur_ts - $row_ts < 60 && $cur_ts >= $row_ts) ? 'Just now' : human_time_diff($row_ts, $cur_ts) . ' ago';
                                ?>
                                <strong><?php echo esc_html(mysql2date('M j, Y g:i a', $row->created_at)); ?></strong>
                                <div style="color:#666; font-size:12px;"><?php echo esc_html($ago_lbl); ?></div>
                            </td>
                            <td>
                                <?php 
                                $delete_url = wp_nonce_url(admin_url('admin.php?page=booth-quiz-leaderboard&action=delete&id=' . $row->id), 'delete_booth_entry_' . $row->id);
                                ?>
                                <a href="<?php echo esc_url($delete_url); ?>" style="color:#a00;" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="manage-column column-cb check-column" style="padding:11px 0 0 8px;">
                            <input type="checkbox" id="cb-select-all-bottom">
                        </td>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Designation</th>
                        <th>Company</th>
                        <th>Score</th>
                        <th>Percentage</th>
                        <th>Time Taken</th>
                        <th>Submitted (Latest First)</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Tablenav Bottom -->
            <div class="tablenav bottom">
                <div class="alignleft actions bulkactions">
                    <?php if (!empty($entries)): ?>
                        <button type="submit" class="button button-secondary" style="color:#b32d2e; font-weight:600;">🗑️ Delete Selected</button>
                    <?php endif; ?>
                </div>

                <?php if ($total_pages > 1): ?>
                <div class="tablenav-pages">
                    <span class="displaying-num"><?php echo $total_items; ?> items</span>
                    <span class="pagination-links">
                        <?php
                        echo paginate_links(array(
                            'base'      => $page_base,
                            'format'    => '',
                            'prev_text' => '&laquo; Prev',
                            'next_text' => 'Next &raquo;',
                            'total'     => $total_pages,
                            'current'   => $current_page
                        ));
                        ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>
        </form>

        <!-- JavaScript for Checkbox Selection & Bulk Confirmation -->
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const cbTop = document.getElementById('cb-select-all-top');
                const cbBottom = document.getElementById('cb-select-all-bottom');
                const checkboxes = document.querySelectorAll('.entry-checkbox');
                const countMsg = document.getElementById('selected-count-msg');

                function updateSelectedCount() {
                    const checked = document.querySelectorAll('.entry-checkbox:checked').length;
                    if (countMsg) {
                        countMsg.textContent = checked > 0 ? '(' + checked + ' selected)' : '';
                    }
                    if (cbTop) cbTop.checked = (checked > 0 && checked === checkboxes.length);
                    if (cbBottom) cbBottom.checked = (checked > 0 && checked === checkboxes.length);
                }

                function toggleAll(status) {
                    checkboxes.forEach(function(cb) {
                        cb.checked = status;
                    });
                    if (cbTop) cbTop.checked = status;
                    if (cbBottom) cbBottom.checked = status;
                    updateSelectedCount();
                }

                if (cbTop) {
                    cbTop.addEventListener('change', function() {
                        toggleAll(this.checked);
                    });
                }
                if (cbBottom) {
                    cbBottom.addEventListener('change', function() {
                        toggleAll(this.checked);
                    });
                }

                checkboxes.forEach(function(cb) {
                    cb.addEventListener('change', updateSelectedCount);
                });

                window.confirmBulkDelete = function() {
                    const selected = document.querySelectorAll('.entry-checkbox:checked').length;
                    if (selected === 0) {
                        alert('Please select at least one entry using the checkboxes.');
                        return false;
                    }
                    return confirm('Are you sure you want to delete ' + selected + ' selected entry/entries? This action cannot be undone.');
                };
            });
        </script>

    </div>
    <?php
}

// 6. Shortcode [booth_quiz_leaderboard]
add_shortcode('booth_quiz_leaderboard', 'render_booth_quiz_leaderboard_shortcode');
function render_booth_quiz_leaderboard_shortcode($atts) {
    ob_start();
    include(get_template_directory() . '/booth-quiz-leaderboard.php');
    return ob_get_clean();
}

/**************************************************
 * WPForms 12839 - TestMu Virtual Booth Google Sheets Integration
 **************************************************/
add_action('wpforms_process_complete', 'genrocket_testmu_save_to_google_sheet', 10, 4);
function genrocket_testmu_save_to_google_sheet($fields, $entry, $form_data, $entry_id) {
    if (isset($form_data['id']) && (int)$form_data['id'] === 12839) {
        $webhook_url = 'https://script.google.com/macros/s/AKfycbz1T-PyjmC7LROt4m-P1qgBos_uAH9RDmexazrci7-g5NiqMUEq73u95XkktaxZB1JwpA/exec';

        $sheet_data = array(
            'Submission Time' => current_time('Y-m-d H:i:s'),
            'Entry ID'        => $entry_id,
            'Form Name'       => isset($form_data['settings']['form_title']) ? $form_data['settings']['form_title'] : 'TestMu Booth Feedback',
            'Page Source'     => 'TestMu AI 2026 Virtual Booth',
        );

        // Dynamically extract all submitted form fields
        if (!empty($fields) && is_array($fields)) {
            foreach ($fields as $f_id => $field) {
                $label = !empty($field['name']) ? trim($field['name']) : 'Field_' . $f_id;
                $value = isset($field['value']) ? $field['value'] : '';

                if (is_array($value)) {
                    $value = implode(', ', array_filter($value));
                }

                $sheet_data[$label] = sanitize_text_field($value);
            }
        }

        // Send to Google Sheets Webhook
        wp_remote_post($webhook_url, array(
            'method'      => 'POST',
            'timeout'     => 15,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true, // must be true to follow Google Apps Script 302 redirect
            'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
            'body'        => wp_json_encode($sheet_data),
            'data_format' => 'body',
        ));
    }
}