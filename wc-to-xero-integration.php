<?php
/**
 * Plugin Name: WooCommerce Xero Integration By WPPOOL
 * Plugin URI: https://wppol.dev
 * Description: Integrates <a href="https://woocommerce.com/" target="_blank" >WooCommerce</a> with the <a href="http://www.xero.com" target="_blank">Xero</a> accounting software.
 * Author: wppool
 * Author URI: https://wppol.dev
 * Version: 1.0.0
 * Text Domain: wc-xero-wppool
 * Domain Path: /languages/
 * Tested up to: 5.6
 * WC tested up to: 5.7
 * WC requires at least: 2.6
 */
defined('ABSPATH') || exit;

final class WCToXeroWPPOOL
{

    /**
     * Plugin Version
     */
    const version = '1.0';
    /**
     * Undocumented function
     */
    public function __construct()
    {
        //register_activation_hook(__FILE__, 'WP_To_Slack_Helper::support_slack_cron_activate');
        //register_deactivation_hook(__FILE__, array($this, 'support_slack_cron_deactivate'));
        $this->define_constants();
        // activation hook
        // load plugin important file
        //add_action('plugins_loaded', array($this, 'init_plugin') );
        //$this->load_dependencies();
        add_filter('plugin_action_links_'.plugin_basename(__FILE__), array($this, 'support_add_plugin_page_settings_link'));
        add_action('admin_menu', array($this, 'xero_by_wppool_menu'),99);
        add_action( 'admin_init', array($this, 'add_settings' ));
    }

    private function load_dependencies()
    {
        
    }

    
    /**
     * includes plugin important file
     *
     * @return void
     */
    public function init_plugin()
    {
        new WP_Support_Slack_Admin();
    }

    /**
     * init function for single tone approach
     *
     * @return void
     */
    public static function init()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    public function define_constants()
    {
    
    }

    public function has_error($key)
    {
        return isset($this->errors[$key]) ? true : false;
    }

    /**
     * Undocumented function
     *
     * @param [type] $links
     * @return void
     */
    public function support_add_plugin_page_settings_link($links) {
        $links[] = '<a href="' .
            admin_url('admin.php?page=xero_by_wppool') .
            '">' . __('Settings', 'xero_by_wppool') . '</a>';
        return $links;
    }

    public function xero_by_wppool_menu() {
        add_submenu_page( 'woocommerce', 'XERO Integration by WPPOOL', 'XERO by WPPOOL', 'manage_options', 'xero_by_wppool', [$this, 'xero_by_wppool_content'] );
        add_submenu_page(
			null,
			__( 'Xero OAuth', 'wc-xero' ),
			__( 'Xero OAuth', 'wc-xero' ),
			'manage_woocommerce',
			'woocommerce_wppool_xero_oauth',
			array(
				$this,
				'oauth_redirect',
			)
		);
        add_submenu_page(
			null,
			__( 'Xero OAuth Callback', 'wc-xero' ),
			__( 'Xero OAuth Callback', 'wc-xero' ),
			'manage_woocommerce',
			'woocommerce_wppool_oauth_callback',
			array(
				$this,
				'oauth_callback',
			)
		);
    }
    public function oauth_callback(){
        $admin_url = admin_url();
        require_once('callback.php');
    }
    
    public function xero_by_wppool_content() {
        echo '<div class="wrap"><form method="post" action="options.php">';	
		settings_fields( 'xero_by_wppool' ); // settings group name
		do_settings_sections( 'xero_by_wppool' ); // just a page slug
		submit_button();
		echo '</form></div>';

    }
    public function add_settings(){
		add_settings_section(
			'xero_by_wppool_section',
			'Freshdesk Settings',
			array( $this,'settings_section' ),
			'xero_by_wppool'
		);
	
		// Register a callback
		register_setting(
			'xero_by_wppool',
			'xero_client_id',
		);
		// Register a callback
		register_setting(
			'xero_by_wppool',
			'xero_client_secret',
		);
        register_setting(
			'xero_by_wppool',
			'xero_auth_on_off',
		);
		// Register the field for the "avatars" section.
		add_settings_field(
			'xero_client_id',
			'XERO Client ID',
			array($this, 'xero_client_id_field'),
			'xero_by_wppool',
			'xero_by_wppool_section',
			array ( 'label_for' => 'freshdesk_api_domain' )
		);
		add_settings_field(
			'xero_client_secret',
			'XERO Client Secret',
			array($this, 'xero_client_secret_field'),
			'xero_by_wppool',
			'xero_by_wppool_section',
			array ( 'label_for' => 'freshdesk_api_label' )
		);
        $xero_client_id = get_option('xero_client_id');
        $xero_client_secret = get_option('xero_client_secret');

        if(!empty($xero_client_secret) && !empty($xero_client_id)){
            add_settings_field(
                'xero_auth_on_off',
                'XERO Authentication',
                array($this, 'xero_client_auth'),
                'xero_by_wppool',
                'xero_by_wppool_section',
                array ( 'label_for' => 'freshdesk_api_label' )
            );
        }
	}

    /**
     * Undocumented function
     *
     * @param [type] $args
     * @return void
     */
    public function xero_client_id_field($args){
		$data = esc_attr( get_option( 'xero_client_id', '' ) );
		printf( '<input type="text" name="xero_client_id" value="%1$s" id="%2$s" /><code>Your XERO app client ID</code>', $data,$args['label_for'] );
	}
    /**
     * Undocumented function
     *
     * @param [type] $args
     * @return void
     */
	public function xero_client_secret_field($args){
		$data = esc_attr( get_option( 'xero_client_secret', '' ) );
		printf( '<input type="text" name="xero_client_secret" value="%1$s" id="%2$s" /><code> Your XERO app client Secret</code>', $data,$args['label_for'] );
	}
    public function xero_client_auth($args){
		$data = esc_attr( get_option( 'xero_auth_on_off', '' ) );
		echo '<button type="button" name="xero_auth_on_off" value="Sign in with XERO" id=""><a href="'.admin_url().'admin.php?page=woocommerce_wppool_xero_oauth">Sign in with XERO</a></button>';
	}
    public function oauth_redirect(){
        $admin_url = admin_url();
        require_once('authorization.php');
    }
}

/**
 * initialise the main function
 *
 * @return void
 */
function support_slack()
{
    return WCToXeroWPPOOL::init();
}

// let's start the plugin
support_slack();
