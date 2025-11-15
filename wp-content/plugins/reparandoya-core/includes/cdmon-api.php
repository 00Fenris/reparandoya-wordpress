<?php
/**
 * Configuración de CDMon API para ReparandoYa
 * Integración con hosting CDMon
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class ReparandoyaCDMonAPI {
    
    private $api_key;
    private $api_url;
    
    public function __construct() {
        $this->api_key = 'pAb5UIS0ypNY4ZA2Cv0qaYcyy7teYrGT';
        $this->api_url = 'https://api.cdmon.com/v1/';
        
        // Hooks para funcionalidades de hosting
        add_action('wp_ajax_check_domain_availability', array($this, 'check_domain_availability'));
        add_action('wp_ajax_nopriv_check_domain_availability', array($this, 'check_domain_availability'));
    }
    
    /**
     * Realizar petición a la API de CDMon
     */
    private function make_api_request($endpoint, $method = 'GET', $data = array()) {
        $url = $this->api_url . $endpoint;
        
        $args = array(
            'method' => $method,
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->api_key,
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30
        );
        
        if (!empty($data) && in_array($method, array('POST', 'PUT', 'PATCH'))) {
            $args['body'] = json_encode($data);
        }
        
        $response = wp_remote_request($url, $args);
        
        if (is_wp_error($response)) {
            return array('error' => $response->get_error_message());
        }
        
        $body = wp_remote_retrieve_body($response);
        $status_code = wp_remote_retrieve_response_code($response);
        
        $decoded = json_decode($body, true);
        
        if ($status_code >= 200 && $status_code < 300) {
            return $decoded;
        } else {
            return array('error' => 'Error en la API: ' . $status_code, 'response' => $decoded);
        }
    }
    
    /**
     * Verificar disponibilidad de dominio
     */
    public function check_domain_availability() {
        check_ajax_referer('reparandoya_nonce', 'nonce');
        
        $domain = sanitize_text_field($_POST['domain']);
        
        if (empty($domain)) {
            wp_send_json_error('Dominio requerido');
        }
        
        $result = $this->make_api_request('domains/check/' . $domain);
        
        if (isset($result['error'])) {
            wp_send_json_error($result['error']);
        }
        
        wp_send_json_success($result);
    }
    
    /**
     * Obtener información del hosting
     */
    public function get_hosting_info() {
        return $this->make_api_request('hosting');
    }
    
    /**
     * Configurar DNS para subdominio de profesional
     */
    public function setup_professional_subdomain($professional_id, $subdomain) {
        $dns_data = array(
            'type' => 'CNAME',
            'name' => $subdomain,
            'content' => 'reparandoya.com',
            'ttl' => 3600
        );
        
        return $this->make_api_request('dns/records', 'POST', $dns_data);
    }
    
    /**
     * Crear backup automático
     */
    public function create_backup($description = '') {
        $backup_data = array(
            'description' => $description ?: 'Backup automático ReparandoYa - ' . date('Y-m-d H:i:s')
        );
        
        return $this->make_api_request('backups', 'POST', $backup_data);
    }
    
    /**
     * Monitoreo de rendimiento
     */
    public function get_performance_metrics() {
        return $this->make_api_request('metrics/performance');
    }
    
    /**
     * Configurar SSL para subdominios
     */
    public function setup_ssl($domain) {
        $ssl_data = array(
            'domain' => $domain,
            'type' => 'letsencrypt'
        );
        
        return $this->make_api_request('ssl/certificates', 'POST', $ssl_data);
    }
}

// Inicializar la clase
new ReparandoyaCDMonAPI();
?>