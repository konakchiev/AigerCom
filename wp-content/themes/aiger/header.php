<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet"
</head>
<body<?php body_class();?>>

<header class="default-header">
    <div class="container breakpoint-low">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="logo">
                    <?php the_custom_logo(); ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <nav class="navi">
                    <?php
                    $args = array(
                            'container' => false,
                        'theme_location' => 'primary-menu',
                        'menu_class' => 'top-menu',
                        );
                    wp_nav_menu( $args );
                    ?>
                </nav>
                <input id="toggle" type="checkbox"></input>

                <label for="toggle" class="hamburger">
                    <div class="top-bun"></div>
                    <div class="meat"></div>
                    <div class="bottom-bun"></div>
                </label>

                <div class="nav">
                    <div class="nav-wrapper">
                        <?php
                        $args = array(
                            'container' => false,
                            'theme_location' => 'primary-menu',
                            'menu_class' => 'top-menu',
                        );
                        wp_nav_menu( $args );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>