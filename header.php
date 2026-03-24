<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-inner">
        <div class="site-branding">
            <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="The Strata Review Home">
                <?php 
                $logo_path = get_template_directory() . '/assets/images/logo.png';
                $logo_url  = get_template_directory_uri() . '/assets/images/logo.png';
                if ( file_exists( $logo_path ) ) : ?>
                    <img class="site-logo" src="<?php echo esc_url( $logo_url ); ?>" alt="The Strata Review" width="320" height="80" />
                <?php else : ?>
                    <span class="site-title">The Strata Review</span>
                <?php endif; ?>
            </a>
        </div>

        <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="site-navigation" role="navigation" aria-label="Primary menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'wp_page_menu',
                'menu_class'     => 'menu-items',
            ));
            ?>
        </nav>
    </div>
</header>

<main class="site-content">
