<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ReparandoYa - Encuentra profesionales para fontanería, electricidad, cerrajería y más servicios cerca de ti">
    <meta name="keywords" content="servicios, fontanero, electricista, cerrajero, profesionales, reparaciones">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php
                if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<strong style="font-size: 1.5rem; color: #007bff;">ReparandoYa</strong>';
                }
                ?>
            </a>
            
            <!-- Toggle button para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'navbar-nav me-auto',
                    'fallback_cb' => 'reparandoya_fallback_menu',
                    'walker' => new ReparandoYa_Walker_Nav_Menu()
                ));
                
                // Menú de fallback si no hay menú configurado
                function reparandoya_fallback_menu() {
                    echo '<ul class="navbar-nav me-auto">';
                    echo '<li class="nav-item"><a class="nav-link" href="' . home_url() . '">Inicio</a></li>';
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Servicios</a>';
                    echo '<ul class="dropdown-menu">';
                    echo '<li><a class="dropdown-item" href="' . home_url('/servicios') . '">Todos los Servicios</a></li>';
                    echo '<li><a class="dropdown-item" href="#">Fontanería</a></li>';
                    echo '<li><a class="dropdown-item" href="#">Electricidad</a></li>';
                    echo '</ul></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="' . home_url('/profesionales') . '">Profesionales</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="' . home_url('/como-funciona') . '">Cómo Funciona</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="' . home_url('/contacto') . '">Contacto</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="https://www.google.com" target="_blank">Enlace Externo</a></li>';
                    echo '</ul>';
                }
                ?>
                
                <!-- Búsqueda y botones de usuario -->
                <div class="navbar-nav ms-auto">
                    <!-- Barra de búsqueda -->
                    <form class="d-flex me-3" role="search" method="get" action="<?php echo home_url(); ?>">
                        <input class="form-control me-2" type="search" name="s" placeholder="Buscar servicios..." value="<?php echo get_search_query(); ?>">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <?php if (is_user_logged_in()): ?>
                        <!-- Usuario logueado -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <?php echo wp_get_current_user()->display_name; ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Mi Cuenta</a></li>
                                <li><a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Usuario no logueado -->
                        <a href="<?php echo wp_login_url(); ?>" class="btn btn-outline-primary me-2">Iniciar Sesión</a>
                        <a href="<?php echo wp_registration_url(); ?>" class="btn btn-primary">Registrarse</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Barra de categorías de servicios -->
    <div class="services-bar bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="services-menu d-flex justify-content-center py-2">
                        <a href="<?php echo home_url('/servicios/fontaneria'); ?>" class="service-link text-white mx-3">
                            <i class="fas fa-wrench"></i> Fontanería
                        </a>
                        <a href="<?php echo home_url('/servicios/electricidad'); ?>" class="service-link text-white mx-3">
                            <i class="fas fa-bolt"></i> Electricidad
                        </a>
                        <a href="<?php echo home_url('/servicios/cerrajeria'); ?>" class="service-link text-white mx-3">
                            <i class="fas fa-key"></i> Cerrajería
                        </a>
                        <a href="<?php echo home_url('/servicios/limpieza'); ?>" class="service-link text-white mx-3">
                            <i class="fas fa-broom"></i> Limpieza
                        </a>
                        <a href="<?php echo home_url('/servicios/jardineria'); ?>" class="service-link text-white mx-3">
                            <i class="fas fa-seedling"></i> Jardinería
                        </a>
                        <a href="<?php echo home_url('/servicios'); ?>" class="service-link text-white mx-3">
                            <i class="fas fa-plus"></i> Más Servicios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="main-content"><?php // El contenido se agregará en cada plantilla ?>