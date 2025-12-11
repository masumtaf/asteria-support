<?php
/**
 * Plugin main class
 */
namespace AsteriaSupport;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 
 * Plugin main class
 */
final class Base {
    /**
     * instance
     */
    private static $_instance = null;

    /**
     * Version
     */
    private $version = '1.0.0';

    /**
     * Plugin name
     * @since  1.0.0
     * @access private
     * @var    string
     */
    private $plugin_name = null;

    /**
     * Plugin url
     * @since  1.0.0
     * @access private
     * @var    string
     */
    private $plugin_url = null;

    /**
     * Plugin path
     * @since  1.0.0
     * @access private
     * @var    string
     */
    private $plugin_path = null;

    /**
     * Plugin Framework
     * Components
     */
    public $framework = null;

    /**
     * Constructor
     */
    public function __construct(){
        $this->plugin_name = 'asteria-support/asteria-support';

        //load framework
        add_action( 'plugins_loaded', [ $this, 'framework_loader'], -20 );

        //internationalize the text strings used.
        add_action( 'init', [ $this, 'i18n'], -999);

        //load files
        add_action( 'init', [ $this, 'init'], -999);

        if( is_admin() ){
            //asteria dashboard init
            add_action( 'init', [ $this, 'dashboard_init'], -999);

            //Admin init
            add_action( 'init', [ $this, 'admin_init'], -999);
        }
    }

    /**
     * Load framework
     */
    public function framework_loader(){
        // require_once ASTSP_ADMIN . 'loader.php';
		// require $this->plugin_admin_path( 'loader.php' );

		// $this->framework = new \Asteria_CX_Loader(
		// 	array(
		
		// 		$this->plugin_admin_path( 'vue-ui/cherry-x-vue-ui.php' ),
		// 		$this->plugin_admin_path( 'asteria-dashboard/asteria-dashboard.php' ),
			
		// 	)
		// );
    }
    /**
     * Version
     */
    public function get_version(){
        return $this->version;
    }

    /**
     * Load the translation files
     */
    public function i18n(){
        load_plugin_textdomain( 'asteria-support', false, dirname( plugin_basename(__FILE__)) . '/language');
    }
    /**
     * Load the translation files
     */
    public function init(){
        $this->load_files();
    }
    /**
     * Load require files
     */
    public function load_files(){
        // Load necessary files.
        //  require $this->plugin_path('includes/class-blocks-manager.php');
        //  require_once base_init()->plugin_admin_path( 'settings-config.php' );

        //  require $this->plugin_admin_path( 'api/api.php');
    }

    /**
     * Returns path to file or dir inside plugin folder
     *
     * @param string $path Path inside plugin dir.
     *
     * @return string
     */
    public function plugin_path( $path = null ) {

        if ( ! $this->plugin_path ) {
            $this->plugin_path = trailingslashit( plugin_dir_path( ASTSP_FILE ) );
        }

        return $this->plugin_path . $path;

    }

      /**
     * Returns path to file or dir inside plugin admin folder
     *
     * @param string $path Path inside plugin dir.
     *
     * @return string
     */
    public function plugin_admin_path( $path = null ) {

        if ( ! defined('ASTSP_ADMIN')) {
            return;
        }
        return ASTSP_ADMIN . $path;

    }

    /**
     * Returns url to file or dir inside plugin folder
     *
     * @param string $path Path inside plugin dir.
     *
     * @return string
     */
    public function plugin_url( $path = null ) {

        if ( ! $this->plugin_url ) {
            $this->plugin_url = trailingslashit( plugin_dir_url( ASTSP_FILE ) );
        }

        return $this->plugin_url . $path;

    }

     /**
     * Returns url to file or dir inside plugin admin folder
     *
     * @param string $path Path inside plugin dir.
     *
     * @return string
     */
    public function plugin_admin_url( $path = null ) {

        if ( ! defined('ASTSP_ADMIN_URL')) {
            return;
        }

        return ASTSP_ADMIN_URL . $path;

    }

     /**
     * Get the template path.
     *
     * @return string
     */
    public function template_path() {
        return apply_filters( 'asteria-support/template-path', 'asteria-support/' );
    }

     /**
     * Returns path to template file.
     *
     * @return string|bool
     */
    public function get_template( $name = null ) {

        $template = locate_template( $this->template_path() . $name );

        if ( ! $template ) {
            $template = $this->plugin_path( 'includes/templates/' . $name );
        }

        if ( file_exists( $template ) ) {
            return $template;
        } else {
            return false;
        }

    }

    /**
     * Init Admin
     */
    public function admin_init() {
        // require $this->plugin_admin_path('class-dashboard-settings.php');
    }

     	/**
	 * Init the AsteriaDashboard module
	 *
	 * @return void
	 */
	public function dashboard_init() {

        // $asteria_dashboard_module_data = $this->framework->get_included_module_data( 'asteria-dashboard.php' );

        // $asteria_dashboard = \Asteria\Dashboard::get_instance();

        // $asteria_dashboard->init( array(
        //     'path'           => $asteria_dashboard_module_data['path'],
        //     'url'            => $asteria_dashboard_module_data['url'],
        //     'cx_ui_instance' => array( $this, 'asteria_dashboard_ui_instance_init' ),
        //     'plugin_data'    => array(
        //         'slug'    => 'plugin-dashboard-with-vue-ui',
        //         'file'    => 'plugin-dashboard-with-vue-ui/asteria.php',
        //         'version' => $this->get_version(),
        //         'plugin_links' => array(
        //             array(
        //                 'label'  => esc_html__( 'Settings', 'asteria' ),
        //                 'url'    => add_query_arg( array( 'page' => 'asteria' ), admin_url( 'admin.php' ) ),
        //                 'target' => 'self',
        //             ),
        //         ),
        //     ),
        // ) );
		
	}


    /**
	 * Get Vue UI Instance for AsteriaDashboard module
	 *
	 * @return CX_Vue_UI
	 */
	public function asteria_dashboard_ui_instance_init() {
		// $cx_ui_module_data = $this->framework->get_included_module_data( 'cherry-x-vue-ui.php' );

		// return new \CX_Vue_UI( $cx_ui_module_data );
	}

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return Base An instance of the class.
     */
    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }
}

if ( ! function_exists( 'base_init' ) ) {

	/**
	 * Returns instance of the plugin class.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	function base_init() {
		return Base::get_instance();
	}

}

base_init();