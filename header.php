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
                $logo_path = get_template_directory() . '/assets/images/logo.svg';
                if ( file_exists( $logo_path ) ) {
                    $logo_svg = file_get_contents( $logo_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
                    $logo_svg = preg_replace( '/<\?xml[^?]*\?>\s*/i', '', $logo_svg );
                    $logo_svg = preg_replace( '/<svg\b/', '<svg class="site-logo" aria-hidden="true" focusable="false"', $logo_svg, 1 );
                    echo $logo_svg; // phpcs:ignore WordPress.Security.EscapeOutput
                } else { ?>
                    <span class="site-title">The Strata Review</span>
                <?php } ?>
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
