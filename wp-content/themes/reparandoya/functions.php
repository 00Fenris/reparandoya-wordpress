<?php
/*
Theme Name: ReparandoYa
Description: Tema personalizado para plataforma de servicios y reservas ReparandoYa - WordPress Practice Project
Version: 1.0.0
Author: Daniel Guerrero Galán & Ignacio Molina
Text Domain: reparandoya
*/

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Configuración del tema
function reparandoya_setup() {
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para menús
    add_theme_support('menus');
    
    // Soporte para título dinámico
    add_theme_support('title-tag');
    
    // Soporte para formatos de entrada
    add_theme_support('post-formats', array('gallery', 'video', 'audio'));
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
    ));
    
    // Soporte para logotipo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Registrar menús - REQUISITO: Menú con dos niveles
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'reparandoya'),
        'footer' => __('Menú Pie de Página', 'reparandoya'),
        'services' => __('Menú Servicios', 'reparandoya')
    ));
}
add_action('after_setup_theme', 'reparandoya_setup');

// Encolar estilos y scripts
function reparandoya_scripts() {
    wp_enqueue_style('reparandoya-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.1.3', true);
    wp_enqueue_script('reparandoya-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localizar scripts para AJAX
    wp_localize_script('reparandoya-js', 'reparandoya_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('reparandoya_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'reparandoya_scripts');

// Registrar sidebars
function reparandoya_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Principal', 'reparandoya'),
        'id' => 'sidebar-1',
        'description' => __('Aparece en el sidebar principal', 'reparandoya'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer', 'reparandoya'),
        'id' => 'footer-1',
        'description' => __('Aparece en el pie de página', 'reparandoya'),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'reparandoya_widgets_init');

// REQUISITO: Shortcodes para secciones funcionales
function reparandoya_hero_section_shortcode($atts) {
    ob_start();
    ?>
    <section class="hero-section bg-primary text-white py-5 mb-4">
        <div class="container text-center">
            <h1 class="display-4">Encuentra el Profesional Perfecto</h1>
            <p class="lead">Conectamos usuarios con profesionales cualificados</p>
            <a href="/servicios" class="btn btn-light btn-lg">Ver Servicios</a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('reparandoya_hero_section', 'reparandoya_hero_section_shortcode');

// REQUISITO: Formulario de contacto personalizado
function reparandoya_contact_form_shortcode($atts) {
    ob_start();
    ?>
    <form method="post" class="reparandoya-contact-form" id="contact-form">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre *</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="col-md-6 mb-3">
                <label for="servicio" class="form-label">Tipo de Servicio</label>
                <select class="form-select" id="servicio" name="servicio">
                    <option value="">Seleccionar...</option>
                    <option value="fontaneria">Fontanería</option>
                    <option value="electricidad">Electricidad</option>
                    <option value="cerrajeria">Cerrajería</option>
                    <option value="limpieza">Limpieza</option>
                </select>
            </div>
            <div class="col-12 mb-3">
                <label for="mensaje" class="form-label">Mensaje *</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
            </div>
            <div class="col-12 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" value="1">
                    <label class="form-check-label" for="newsletter">
                        Quiero recibir ofertas y novedades
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit_contact">Enviar Mensaje</button>
            </div>
        </div>
        <?php wp_nonce_field('reparandoya_contact', 'contact_nonce'); ?>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('reparandoya_contact_form', 'reparandoya_contact_form_shortcode');

// REQUISITO: Testimonios
function reparandoya_testimonials_shortcode($atts) {
    ob_start();
    ?>
    <section class="testimonials py-5">
        <div class="container">
            <h2 class="text-center mb-4">Lo Que Dicen Nuestros Clientes</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                            <p>"Excelente servicio, muy profesional"</p>
                            <strong>- María García</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                            <p>"Rápidos y eficientes, lo recomiendo"</p>
                            <strong>- Juan López</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="stars mb-2">⭐⭐⭐⭐⭐</div>
                            <p>"La mejor plataforma de servicios"</p>
                            <strong>- Ana Martín</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('reparandoya_testimonials', 'reparandoya_testimonials_shortcode');

// REQUISITO: Walker para menú con dos niveles
class ReparandoYa_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth == 0) {
            $output .= '<ul class="dropdown-menu">';
        }
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        if ($depth == 0) {
            $output .= '</ul>';
        }
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="nav-item ' . esc_attr($class_names) . '"' : ' class="nav-item"';
        
        $output .= '<li' . $class_names . '>';
        
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        if (in_array('menu-item-has-children', $classes)) {
            $attributes .= ' class="nav-link dropdown-toggle" data-bs-toggle="dropdown"';
        } else {
            $attributes .= ' class="nav-link"';
        }
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
?>