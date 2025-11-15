<?php
/*
Plugin Name: ReparandoYa Core
Description: Plugin principal para la plataforma ReparandoYa - Gestiona servicios, profesionales y funcionalidades específicas
Version: 1.0.0
Author: Daniel Guerrero Galán & Ignacio Molina
Text Domain: reparandoya-core
*/

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del plugin
define('REPARANDOYA_PLUGIN_URL', plugin_dir_url(__FILE__));
define('REPARANDOYA_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('REPARANDOYA_PLUGIN_VERSION', '1.0.0');

// Clase principal del plugin
class ReparandoYa_Core_Plugin {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    public function init() {
        // Registrar custom post types
        $this->register_post_types();
        
        // Registrar taxonomías
        $this->register_taxonomies();
        
        // Registrar AJAX handlers
        $this->register_ajax_handlers();
        
        // Cargar CDMon API
        $this->load_cdmon_api();
    }
    
    public function enqueue_scripts() {
        wp_enqueue_script('reparandoya-core', REPARANDOYA_PLUGIN_URL . 'assets/js/reparandoya-core.js', array('jquery'), REPARANDOYA_PLUGIN_VERSION, true);
        
        wp_localize_script('reparandoya-core', 'reparandoya_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('reparandoya_nonce'),
            'cdmon_api_key' => 'pAb5UIS0ypNY4ZA2Cv0qaYcyy7teYrGT'
        ));
    }
    
    // Registrar Custom Post Types
    public function register_post_types() {
        // Post Type: Servicios
        register_post_type('service', array(
            'labels' => array(
                'name' => 'Servicios',
                'singular_name' => 'Servicio',
                'add_new' => 'Añadir Servicio',
                'add_new_item' => 'Añadir Nuevo Servicio',
                'edit_item' => 'Editar Servicio',
                'new_item' => 'Nuevo Servicio',
                'view_item' => 'Ver Servicio',
                'search_items' => 'Buscar Servicios',
                'not_found' => 'No se encontraron servicios',
                'not_found_in_trash' => 'No se encontraron servicios en la papelera'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'servicios'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'menu_icon' => 'dashicons-hammer',
            'show_in_rest' => true
        ));
        
        // Post Type: Profesionales
        register_post_type('professional', array(
            'labels' => array(
                'name' => 'Profesionales',
                'singular_name' => 'Profesional',
                'add_new' => 'Añadir Profesional',
                'add_new_item' => 'Añadir Nuevo Profesional',
                'edit_item' => 'Editar Profesional',
                'new_item' => 'Nuevo Profesional',
                'view_item' => 'Ver Profesional',
                'search_items' => 'Buscar Profesionales',
                'not_found' => 'No se encontraron profesionales',
                'not_found_in_trash' => 'No se encontraron profesionales en la papelera'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'profesionales'),
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'menu_icon' => 'dashicons-admin-users',
            'show_in_rest' => true
        ));
        
        // Post Type: Reservas
        register_post_type('booking', array(
            'labels' => array(
                'name' => 'Reservas',
                'singular_name' => 'Reserva',
                'add_new' => 'Añadir Reserva',
                'add_new_item' => 'Añadir Nueva Reserva',
                'edit_item' => 'Editar Reserva',
                'new_item' => 'Nueva Reserva',
                'view_item' => 'Ver Reserva',
                'search_items' => 'Buscar Reservas',
                'not_found' => 'No se encontraron reservas',
                'not_found_in_trash' => 'No se encontraron reservas en la papelera'
            ),
            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'custom-fields'),
            'menu_icon' => 'dashicons-calendar-alt',
            'show_in_rest' => true
        ));
    }
    
    // Registrar Taxonomías
    public function register_taxonomies() {
        // Taxonomía: Categorías de Servicio
        register_taxonomy('service_category', array('service', 'professional'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Categorías de Servicio',
                'singular_name' => 'Categoría de Servicio',
                'search_items' => 'Buscar Categorías',
                'all_items' => 'Todas las Categorías',
                'parent_item' => 'Categoría Padre',
                'parent_item_colon' => 'Categoría Padre:',
                'edit_item' => 'Editar Categoría',
                'update_item' => 'Actualizar Categoría',
                'add_new_item' => 'Añadir Nueva Categoría',
                'new_item_name' => 'Nombre de Nueva Categoría',
                'menu_name' => 'Categorías de Servicio'
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'categoria-servicio'),
            'show_in_rest' => true
        ));
        
        // Taxonomía: Ubicaciones
        register_taxonomy('location', array('service', 'professional'), array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Ubicaciones',
                'singular_name' => 'Ubicación',
                'search_items' => 'Buscar Ubicaciones',
                'all_items' => 'Todas las Ubicaciones',
                'parent_item' => 'Ubicación Padre',
                'parent_item_colon' => 'Ubicación Padre:',
                'edit_item' => 'Editar Ubicación',
                'update_item' => 'Actualizar Ubicación',
                'add_new_item' => 'Añadir Nueva Ubicación',
                'new_item_name' => 'Nombre de Nueva Ubicación',
                'menu_name' => 'Ubicaciones'
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'ubicacion'),
            'show_in_rest' => true
        ));
    }
    
    // Registrar AJAX Handlers
    public function register_ajax_handlers() {
        add_action('wp_ajax_search_services', array($this, 'ajax_search_services'));
        add_action('wp_ajax_nopriv_search_services', array($this, 'ajax_search_services'));
        
        add_action('wp_ajax_create_booking', array($this, 'ajax_create_booking'));
        add_action('wp_ajax_nopriv_create_booking', array($this, 'ajax_create_booking'));
        
        add_action('wp_ajax_get_professionals', array($this, 'ajax_get_professionals'));
        add_action('wp_ajax_nopriv_get_professionals', array($this, 'ajax_get_professionals'));
    }
    
    // AJAX: Buscar servicios
    public function ajax_search_services() {
        check_ajax_referer('reparandoya_nonce', 'nonce');
        
        $search_term = sanitize_text_field($_POST['search_term']);
        $category = sanitize_text_field($_POST['category']);
        $location = sanitize_text_field($_POST['location']);
        
        $args = array(
            'post_type' => 'service',
            'posts_per_page' => 12,
            's' => $search_term
        );
        
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'service_category',
                'field' => 'slug',
                'terms' => $category
            );
        }
        
        if (!empty($location)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'location',
                'field' => 'slug',
                'terms' => $location
            );
        }
        
        $services = new WP_Query($args);
        $results = array();
        
        if ($services->have_posts()) {
            while ($services->have_posts()) {
                $services->the_post();
                $results[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'permalink' => get_the_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
                );
            }
            wp_reset_postdata();
        }
        
        wp_send_json_success($results);
    }
    
    // AJAX: Crear reserva
    public function ajax_create_booking() {
        check_ajax_referer('reparandoya_nonce', 'nonce');
        
        $service_id = intval($_POST['service_id']);
        $professional_id = intval($_POST['professional_id']);
        $customer_name = sanitize_text_field($_POST['customer_name']);
        $customer_email = sanitize_email($_POST['customer_email']);
        $customer_phone = sanitize_text_field($_POST['customer_phone']);
        $booking_date = sanitize_text_field($_POST['booking_date']);
        $booking_time = sanitize_text_field($_POST['booking_time']);
        $notes = sanitize_textarea_field($_POST['notes']);
        
        // Crear la reserva
        $booking_id = wp_insert_post(array(
            'post_type' => 'booking',
            'post_title' => 'Reserva - ' . $customer_name . ' - ' . get_the_title($service_id),
            'post_status' => 'publish',
            'meta_input' => array(
                'service_id' => $service_id,
                'professional_id' => $professional_id,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $customer_phone,
                'booking_date' => $booking_date,
                'booking_time' => $booking_time,
                'notes' => $notes,
                'booking_status' => 'pending'
            )
        ));
        
        if ($booking_id) {
            // Enviar emails de confirmación
            $this->send_booking_notification($booking_id);
            wp_send_json_success(array('booking_id' => $booking_id));
        } else {
            wp_send_json_error('Error al crear la reserva');
        }
    }
    
    // AJAX: Obtener profesionales
    public function ajax_get_professionals() {
        check_ajax_referer('reparandoya_nonce', 'nonce');
        
        $category = sanitize_text_field($_POST['category']);
        $location = sanitize_text_field($_POST['location']);
        
        $args = array(
            'post_type' => 'professional',
            'posts_per_page' => 8,
            'meta_key' => 'rating',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        );
        
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'service_category',
                'field' => 'slug',
                'terms' => $category
            );
        }
        
        if (!empty($location)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'location',
                'field' => 'slug',
                'terms' => $location
            );
        }
        
        $professionals = new WP_Query($args);
        $results = array();
        
        if ($professionals->have_posts()) {
            while ($professionals->have_posts()) {
                $professionals->the_post();
                $results[] = array(
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'permalink' => get_the_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                    'rating' => get_post_meta(get_the_ID(), 'rating', true),
                    'price_range' => get_post_meta(get_the_ID(), 'price_range', true)
                );
            }
            wp_reset_postdata();
        }
        
        wp_send_json_success($results);
    }
    
    // Enviar notificación de reserva
    private function send_booking_notification($booking_id) {
        $booking = get_post($booking_id);
        $customer_email = get_post_meta($booking_id, 'customer_email', true);
        $customer_name = get_post_meta($booking_id, 'customer_name', true);
        
        // Email al cliente
        $subject = 'Confirmación de Reserva - ReparandoYa';
        $message = "Hola $customer_name,\n\nTu reserva ha sido confirmada.\n\nGracias por elegir ReparandoYa.";
        
        wp_mail($customer_email, $subject, $message);
        
        // Email al admin
        $admin_email = get_option('admin_email');
        wp_mail($admin_email, 'Nueva Reserva - ReparandoYa', "Se ha creado una nueva reserva: $booking_id");
    }
    
    // Cargar CDMon API
    public function load_cdmon_api() {
        require_once REPARANDOYA_PLUGIN_PATH . 'includes/cdmon-api.php';
    }
    
    // Activación del plugin
    public function activate() {
        // Flush rewrite rules
        $this->register_post_types();
        $this->register_taxonomies();
        flush_rewrite_rules();
        
        // Crear páginas necesarias
        $this->create_plugin_pages();
        
        // Crear términos de taxonomía por defecto
        $this->create_default_terms();
    }
    
    // Desactivación del plugin
    public function deactivate() {
        flush_rewrite_rules();
    }
    
    // Crear páginas del plugin
    private function create_plugin_pages() {
        $pages = array(
            'buscar-servicio' => array(
                'title' => 'Buscar Servicio',
                'content' => '[reparandoya_service_search]'
            ),
            'reservar-servicio' => array(
                'title' => 'Reservar Servicio',
                'content' => '[reparandoya_booking_form]'
            )
        );
        
        foreach ($pages as $slug => $page_data) {
            if (!get_page_by_path($slug)) {
                wp_insert_post(array(
                    'post_title' => $page_data['title'],
                    'post_name' => $slug,
                    'post_content' => $page_data['content'],
                    'post_status' => 'publish',
                    'post_type' => 'page'
                ));
            }
        }
    }
    
    // Crear términos por defecto
    private function create_default_terms() {
        // Categorías de servicio
        $service_categories = array(
            'fontaneria' => 'Fontanería',
            'electricidad' => 'Electricidad',
            'cerrajeria' => 'Cerrajería',
            'limpieza' => 'Limpieza',
            'jardineria' => 'Jardinería'
        );
        
        foreach ($service_categories as $slug => $name) {
            if (!term_exists($slug, 'service_category')) {
                wp_insert_term($name, 'service_category', array('slug' => $slug));
            }
        }
        
        // Ubicaciones
        $locations = array(
            'madrid' => 'Madrid',
            'barcelona' => 'Barcelona',
            'valencia' => 'Valencia',
            'sevilla' => 'Sevilla'
        );
        
        foreach ($locations as $slug => $name) {
            if (!term_exists($slug, 'location')) {
                wp_insert_term($name, 'location', array('slug' => $slug));
            }
        }
    }
}

// Inicializar el plugin
new ReparandoYa_Core_Plugin();

// Shortcodes del plugin
require_once REPARANDOYA_PLUGIN_PATH . 'includes/shortcodes.php';
?>