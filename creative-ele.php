<?php

/**
 * Plugin Name: Creative Elements for Elementor
 * Description: <a href="https://creativexpo.net/creative-ele">Creative Elements for Elementor</a> Is the Best Elementor Addons for creative and modern web design. Creative Elements comes with Team widget. More widgets & exciting features are coming soon. 
 * Plugin URI: https://creativexpo.net/creative-ele/
 * Version:     1.0.0
 * Author:      creativeXpo
 * Author URI:  https://creativexpo.net/
 * Text Domain: creative-ele
 * Elementor tested up to: 3.3.1
 * Elementor Pro tested up to: 3.3.1
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace CreativeEle;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


define('CREATIVE_ELE_VERSION', '1.0.0');
define('CREATIVE_ELE_DIR_PATH', plugin_dir_path(__FILE__));
define('CREATIVE_ELE_DIR_URL', plugin_dir_url(__FILE__));
define('CREATIVE_ELE_PLG_BASENAME', plugin_basename(__FILE__));

/**
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Creative_Ele
{

    /**
     * Minimum Elementor Version
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     *
     * @access private
     * @static
     *
     * @var Creative_Ele The single instance of the class.
     */

    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @access public
     * @static
     *
     * @return Creative_Ele An instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @access public
     */

    public function __construct()
    {

        add_action('plugins_loaded', [$this, 'on_plugins_loaded']);
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     *
     * @access public
     */

    public function i18n()
    {

        load_plugin_textdomain('creative-ele');
    }

    /**
     * On Plugins Loaded
     *
     * Checks if Elementor has loaded, and performs some compatibility checks.
     * If All checks pass, inits the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     *
     * @access public
     */

    public function on_plugins_loaded()
    {

        if ($this->is_compatible()) {
            add_action('elementor/init', [$this, 'init']);
        }
    }

    /**
     * Compatibility Checks
     *
     * Checks if the installed version of Elementor meets the plugin's minimum requirement.
     * Checks if the installed PHP version meets the plugin's minimum requirement.
     *
     * @access public
     */

    public function is_compatible()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return false;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     *
     * @access public
     */

    public function init()
    {

        $this->i18n();

        // Include plugin files
        $this->includes();

        // Add Plugin actions
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'ce_elementor_widget_categories']);
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     *
     * @access public
     */

    public function init_widgets()
    {

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CE_Team());

    }


    public function includes()
    {

        // Include Widget files
        require_once __DIR__ . '/widgets/team.php';

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @access public
     */

    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'creative-ele'),
            '<strong>' . esc_html__('Creative Elements for Elementor', 'creative-ele') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'creative-ele') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @access public
     */

    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'creative-ele'),
            '<strong>' . esc_html__('Creative Elements for Elementor', 'creative-ele') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'creative-ele') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @access public
     */

    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'creative-ele'),
            '<strong>' . esc_html__('Creative Elements for Elementor', 'creative-ele') . '</strong>',
            '<strong>' . esc_html__('PHP', 'creative-ele') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /* Add Custom Widget Category */

    public function ce_elementor_widget_categories($elements_manager)
    {

        $elements_manager->add_category(
            'ce-widget-category',
            [
                'title' => __('Creative Elements', 'creative-ele'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /* Register Style*/
    
    public function enqueue_editor_scripts() {
        wp_enqueue_style(
            'creative-ele-icons',
            CREATIVE_ELE_DIR_URL . 'assets/css/creative-ele-icons.min.css',
            null,
            CREATIVE_ELE_VERSION
		);

		wp_enqueue_style( 'creative-ele-icons' );

	}
}

Creative_Ele::instance();