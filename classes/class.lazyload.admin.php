<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TDT_Lazyload_Admin {

	private $tdt_lazyload_options;

	function __construct() {
		add_action(
			'admin_menu',
			array( $this, 'admin_menu' )
		);

		add_action(
			'admin_init',
			array( $this, 'init' )
		);

		$this->tdt_lazyload_options = array(
			'tdt_lazyload_enable_for'          => array(
				'widget'    => 'Widget text',
				'thumbnail' => 'Post thumbnail',
				'avatar'    => 'Author and comment avatar',
			),
			'tdt_lazyload_enable_for_advanced' => array(
				'image'  => 'Image <code>&lt;img...&gt;</code>',
				'iframe' => 'Iframe <code>&lt;iframe...&gt;&lt;/iframe&gt;</code>',
			),
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	public function load_scripts() {
		wp_enqueue_style(
			'tdt-lazyload-bootstrap-grid',
			TDT_LAZYLOAD_PLUGIN_DIR . 'assets/css/bootstrap.min.css',
			'',
			null,
			false
		);
		wp_enqueue_style(
			'tdt-lazyload-admin',
			TDT_LAZYLOAD_PLUGIN_DIR . 'assets/css/admin.css',
			'',
			null,
			false
		);
	}

	private function install() {
		add_option(
			'tdt_lazyload_display_on',
			array(
				'post'    => '1',
				'page'    => '1',
				'product' => '1',
			)
		);
		add_option(
			'tdt_lazyload_enable_for',
			array(
				'widget'    => '1',
				'thumbnail' => '1',
				'avatar'    => '1',
			)
		);
		add_option(
			'tdt_lazyload_enable_for_advanced',
			array(
				'image' => '1',
			)
		);
		add_option(
			'tdt_lazyload_exclude_image_with_class',
			'nolazyload,'
		);
		add_option(
			'tdt_lazyload_exclude_iframe_with_class',
			'nolazyload,'
		);
	}

	public function admin_menu() {
		add_submenu_page(
			'options-general.php',
			'TDT Lazyload Settings Page',
			'TDT Lazyload',
			'manage_options',
			'tdt-lazyload',
			array( $this, 'show_options' )
		);
	}

	public function disabled_notice() {
		if ( get_option( 'tdt_lazyload_disable' ) ) {
			echo '<div class="error"><p>TDT Lazyload <strong>currently disabled</strong> so all your changes might not affected.</p></div>';
		}
	}

	public function show_options() {
		?>
	   <div class="container-fluid">
		 <div class="row">
			<div class="wrap col-md-7">
			   <h1>TDT Lazyload Settings</h1>
				<?php $this->disabled_notice(); ?>
			   <form method="POST" action="options.php">
					<?php
					do_settings_sections( 'tdt-lazyload' );
					settings_fields( 'tdt-lazyload-settings' );
					submit_button();
					?>
				</form>
			 </div>
			 <div class="col-md-offset-1 col-md-3 donate">
				<h2>Demo &amp; Support</h2>
				<ul style="list-style-type: square">
				   <li><a href="https://wordpress.org/plugins/tdt-lazyload/" target="_blank">TDT Lazyload on WordPress.org</a></li>
				   <li><a href="https://github.com/tdtgit/tdt-lazyload" target="_blank">TDT Lazyload on Github</a></li>
				   <li><a href="https://duonganhtuan.com" target="_blank">My personal website</a></li>
				</ul>
				<h2>Donate</h2>
				<p>If you found this plugin useful and want to help me to make it better in the future,
				   you can donate to my Paypal account. Its my pleasure to be backed up by you.</p>
				<p><a href="https://paypal.me/mrsugarvn/2" target="_blank" title="Donate using Paypal"><img height="50" src="<?php echo TDT_LAZYLOAD_PLUGIN_DIR; ?>/assets/img/donate.png"></a></p>
			 </div>
		  </div>
	   </div>
		<?php
	}

	public function init() {
		// General Settings /////////////////////
		add_settings_section(
			'tdt-lazyload-general-section',
			'General Settings',
			null,
			'tdt-lazyload'
		);

		add_settings_field(
			'tdt_lazyload_disable',
			'Disable plugin?',
			array( $this, 'render_tdt_lazyload_enable' ),
			'tdt-lazyload',
			'tdt-lazyload-general-section'
		);

		register_setting(
			'tdt-lazyload-settings',
			'tdt_lazyload_disable'
		);

		add_settings_field(
			'tdt_lazyload_display_on',
			'Enable lazyload image on:',
			array( $this, 'render_tdt_lazyload_display_on' ),
			'tdt-lazyload',
			'tdt-lazyload-general-section'
		);

		register_setting(
			'tdt-lazyload-settings',
			'tdt_lazyload_display_on'
		);

		add_settings_field(
			'tdt_lazyload_enable_for',
			'Enable lazyload image on:',
			array( $this, 'render_tdt_lazyload_enable_for' ),
			'tdt-lazyload',
			'tdt-lazyload-general-section'
		);

		register_setting(
			'tdt-lazyload-settings',
			'tdt_lazyload_enable_for'
		);

		// Advanced Settings /////////////////////
		add_settings_section(
			'tdt-lazyload-advanced-section',
			'Advanced Settings',
			null,
			'tdt-lazyload'
		);

		add_settings_field(
			'tdt_lazyload_enable_for_advanced',
			'Enable lazyload for:',
			array( $this, 'render_tdt_lazyload_enable_for_advanced' ),
			'tdt-lazyload',
			'tdt-lazyload-advanced-section'
		);

		register_setting(
			'tdt-lazyload-settings',
			'tdt_lazyload_enable_for_advanced'
		);

		add_settings_field(
			'tdt_lazyload_exclude_image_with_class',
			'Exclude images from lazyload:',
			array( $this, 'render_tdt_lazyload_exclude_image_with_class' ),
			'tdt-lazyload',
			'tdt-lazyload-advanced-section'
		);

		register_setting(
			'tdt-lazyload-settings',
			'tdt_lazyload_exclude_image_with_class'
		);

		add_settings_field(
			'tdt_lazyload_exclude_iframe_with_class',
			'Exclude iframe from lazyload:',
			array( $this, 'render_tdt_lazyload_exclude_iframe_with_class' ),
			'tdt-lazyload',
			'tdt-lazyload-advanced-section'
		);

		register_setting(
			'tdt-lazyload-settings',
			'tdt_lazyload_exclude_iframe_with_class'
		);
	}

	public function render_tdt_lazyload_enable() {
		echo '<input type="checkbox" name="tdt_lazyload_disable" value="1" ' . checked( 1, get_option( 'tdt_lazyload_disable' ), false ) . ' />';
	}

	public function render_tdt_lazyload_display_on() {
		echo '<fieldset>';
		foreach ( get_post_types( null, 'objects' ) as $post_type ) {
			if ( $post_type->public == true ) {
				echo '<label for="tdt_lazyload_display_on[' . $post_type->name . ']">
                  <input type="checkbox" name="tdt_lazyload_display_on[' . $post_type->name . ']" id="tdt_lazyload_display_on[' . $post_type->name . ']" value="1"';
				if ( isset( get_option( 'tdt_lazyload_display_on' )[ $post_type->name ] ) ) {
					echo checked( 1, get_option( 'tdt_lazyload_display_on' )[ $post_type->name ], true );
				}
				echo '/> ' . $post_type->name . '</label><br/>';
			}
		}
		echo '</fieldset>';
	}

	public function render_tdt_lazyload_enable_for() {
		echo '<fieldset>';
		foreach ( $this->tdt_lazyload_options['tdt_lazyload_enable_for'] as $item_key => $item_name ) {
			echo '<label for="tdt_lazyload_enable_for[' . $item_key . ']">
               <input type="checkbox" name="tdt_lazyload_enable_for[' . $item_key . ']" id="tdt_lazyload_enable_for[' . $item_key . ']" value="1" ';
			if ( isset( get_option( 'tdt_lazyload_enable_for' )[ $item_key ] ) ) {
				checked( 1, get_option( 'tdt_lazyload_enable_for' )[ $item_key ], true );
			}
			echo ' /> ' . $item_name . '</label><br/>';
		}
		echo '</fieldset>';
	}

	public function render_tdt_lazyload_enable_for_advanced() {
		echo '<fieldset>';
		foreach ( $this->tdt_lazyload_options['tdt_lazyload_enable_for_advanced'] as $item_key => $item_name ) {
			echo '<label for="tdt_lazyload_enable_for_advanced[' . $item_key . ']">
               <input type="checkbox" name="tdt_lazyload_enable_for_advanced[' . $item_key . ']" id="tdt_lazyload_enable_for_advanced[' . $item_key . ']" value="1" ';
			if ( isset( get_option( 'tdt_lazyload_enable_for_advanced' )[ $item_key ] ) ) {
				checked( 1, get_option( 'tdt_lazyload_enable_for_advanced' )[ $item_key ], true );
			}
			echo ' /> ' . $item_name . '</label><br/>';
		}
		echo '</fieldset>';
	}

	public function render_tdt_lazyload_exclude_image_with_class() {
		echo '<input type="text" style="width: 100%" name="tdt_lazyload_exclude_image_with_class" value="' . get_option( 'tdt_lazyload_exclude_image_with_class' ) . '" />
      <p>A comma-separated list of CSS class of images you want to exclude from being optimized.</p>';
	}

	public function render_tdt_lazyload_exclude_iframe_with_class() {
		echo '<input type="text" style="width: 100%" name="tdt_lazyload_exclude_iframe_with_class" value="' . get_option( 'tdt_lazyload_exclude_iframe_with_class' ) . '" />
      <p>A comma-separated list of CSS class of iframes you want to exclude from being optimized.</p>';
	}
}

if ( is_admin() ) {
	$lazyload_admin = new TDT_Lazyload_Admin();
	register_activation_hook( __FILE__, array( $lazyload_admin, 'install' ) );
}
