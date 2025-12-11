<?php
/**
 * Dashboard Settings Page
 */
 namespace AsteriaSupport;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Dashboard_Init {

	/**
	 * Components
	 */
	public $framework;
	
	/**
	 * Plugin base name
	 *
	 * @var string
	 */
	public $plugin_name = null;

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	private $version = '1.0.0';

    /**
	 * Module directory path.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var srting.
	 */
	protected $path;

	/**
	 * Holder for base plugin path
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string
	 */
	private $plugin_path = null;

	/**
	 * asteria menu page slug
	 *
	 * @var string
	 */
	public $admin_page = 'asteria-support';

    /**
	 * [$dashboard_slug description]
	 * @var string
	 */
	public $dashboard_slug = 'asteria-support';

	/**
	 * Constructor of the class
	 * @param
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->plugin_name = plugin_basename( __FILE__ );

        $this->load_files();

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		//Init Setting Pages
		// require base_init()->plugin_admin_path('setting-pages.php');
		// new Admin_Setting_Pages();

        $this->load_files();

		// add_action( 'init', array( $this, 'init_managers' ), -998 );

		add_action( 'admin_menu', array( $this, 'register_page' ), -999 );

		// add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_dashboard_assets' ) );

		
	}
	
    	/**
	 * [load_files description]
	 * @return [type] [description]
	 */
	public function load_files() {
		/**
		 * Modules
		 */
		// require $this->path . 'templates/welcome.php';
		// require $this->path . 'inc/modules/page-base.php';
		// require $this->path . 'inc/modules/welcome/module.php';
		// require $this->path . 'inc/modules/welcome/dev-test.php';
		// require $this->path . 'inc/modules/settings/module.php';

		// require $this->path . 'inc/data-manager.php';
		// require $this->path . 'inc/notice-manager.php';

	}
    /**
	 * Register add/edit page
	 *
	 * @return void
	 */
	public function register_page() {

		add_menu_page(
			esc_html__( 'Asteria Support', 'asteria' ),
			esc_html__( 'Asteria Support', 'asteria' ),
			'manage_options',
			$this->dashboard_slug,
			function() {
				include $this->path . 'templates/welcome.php';
                
			},
			base_init()->plugin_admin_url( 'assets/img/exclusive-blocks-icon.svg' ),
			59
		);

		add_submenu_page(
			$this->dashboard_slug,
			esc_html__( 'Dashboard', 'asteria' ),
			esc_html__( 'Dashboard', 'asteria' ),
			'manage_options',
			$this->dashboard_slug
		);

		do_action( 'asteria-support/after-page-registration', $this );
	}

    /**
	 * Returns path to view file
	 *
	 * @param  [type] $path [description]
	 * @return [type]       [description]
	 */
	public function get_view( $path ) {
		// return apply_filters( 'asteria-support/get-view', $this->path . 'views/' . $path . '.php' );
		return apply_filters( 'asteria-support/get-view', $this->path . 'templates/' . $path . '.php' );
	}

	/**
	 * Loading required scripts
	 * @param
	 * @return void
	 * @since 1.0.0
	 */	
	public function enqueue_admin_scripts( $hook ) {

		// $module_data = base_init()->framework->get_included_module_data( 'cherry-x-vue-ui.php' );
		// $ui          = new \CX_Vue_UI( $module_data );

		// $ui->enqueue_assets();

        wp_enqueue_style( 'spc-notice-css', base_init()->plugin_admin_path( 'assets/css/admin-notice.css' ) );

		// if( isset( $hook ) && $hook == 'toplevel_page_spc-settings' ) {
			wp_enqueue_style( 'as-admin-css', base_init()->plugin_admin_url( 'assets/css/admin-style.css' ) );
			wp_enqueue_script( 'as-admin-js', base_init()->plugin_admin_url( 'assets/js/admin-script.js' ), array( 'jquery' ), ASTSP_VER, true );
		// }

	}

	/**
	 * Register module assets
	 *
	 * @return [type] [description]
	 */
	public function assets() {

		$this->enqueue_module_assets();

		add_filter( 'asteria-dashboard/js-page-config', array( $this, 'page_config' ), 10, 3 );

		add_filter( 'asteria-dashboard/js-page-templates', array( $this, 'page_templates' ), 10, 3 );
	}


	/**
	 * Returns plugin version
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Returns path to file or dir inside plugin folder
	 *
	 * @param  string $path Path inside plugin dir.
	 * @return string
	 */
	public function plugin_path( $path = null ) {

		if ( ! $this->plugin_path ) {
			$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		}

		return $this->plugin_path . $path;
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
			$template = $this->plugin_path( 'templates/' . $name );
		}

		if ( file_exists( $template ) ) {
			return $template;
		} else {
			return false;
		}
	}


}

new Dashboard_Init();