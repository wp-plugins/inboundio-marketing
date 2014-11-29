<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://www.inboundio.com
 * @since      1.0.0
 *
 * @package    imp
 * @subpackage imp/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    imp
 * @subpackage imp/admin
 * @author     Anurag Singh <anurag722@hotmail.com>
 */
class Imp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $plugin_slug;
	protected $plugin_screen_hook_suffix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_slug = 'imp';
		$plugin_screen_hook_suffix = null;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/imp-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_slug .'-dropzone-styles', plugins_url( 'css/dropzone.css', __FILE__ ), array(), $this->version, 'all' );

		}

		if ( $screen->id == 'inboundio-marketing_page_imp_new_contact') {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/new_contact.css', array(), $this->version, 'all' );
		}

		if ( $screen->id == 'inboundio-marketing_page_imp_send_email') {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/send_email.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name."-chosen", plugin_dir_url( __FILE__ ) . 'css/chosen.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script-dropzone', plugins_url( 'js/dropzone.js', __FILE__ ), array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/imp-admin.js', array( 'jquery' ), $this->version, false );
		}

		if ( $screen->id == 'inboundio-marketing_page_imp_new_contact') {
			wp_enqueue_script( $this->plugin_slug . '-admin-script-serializeJSON', plugins_url( 'js/jquery_serializeJSON.js', __FILE__ ), array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name."-new_contact", plugin_dir_url( __FILE__ ) . 'js/new_contact.js', array( 'jquery' ), $this->version, false );
		}

		if ( $screen->id == 'inboundio-marketing_page_imp_send_email') {
			wp_enqueue_script( $this->plugin_slug . '-admin-script-chosen', plugins_url( 'js/chosen.jquery.min.js', __FILE__ ), array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_slug . '-admin-script-serializeJSON', plugins_url( 'js/jquery_serializeJSON.js', __FILE__ ), array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name."-send_email", plugin_dir_url( __FILE__ ) . 'js/send_email.js', array( 'jquery' ), $this->version, false );
		}

	}


	// loading admin menu here
	public function add_plugin_admin_menu(){
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Inboundio Marketing', $this->plugin_slug ),
			__( 'Inboundio Marketing', $this->plugin_slug ),
			'edit_others_posts',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ),
			'',
			"11.1"
			);

		add_submenu_page(
			$this->plugin_slug,
			'Send Email', 
			'Send Email',
			'edit_others_posts',
			$this->plugin_slug.'_send_email',
			array($this, 'display_plugin_admin_send_email_page')
			);

		add_submenu_page(
			$this->plugin_slug,
			'New Contact', 
			'New Contact',
			'edit_others_posts',
			$this->plugin_slug.'_new_contact',
			array($this, 'display_plugin_admin_new_contact_page')
			);
	}

	public function display_plugin_admin_page() {
		include_once( 'partials/imp-admin-display.php' );
	}

	public function display_plugin_admin_send_email_page() {
		include_once( 'partials/admin_send_email.php' );
	}
	
	public function display_plugin_admin_new_contact_page() {
		include_once( 'partials/admin_new_contact.php' );
	}
	
	// function to parse imported csv
	public function action_parse_csv(){
		global $wpdb;
		$url = $_POST['url'];
		$size = $_POST['size'];
		
		$length = $size;
		if($length < 0){
			echo "Error opening file, Please rename the file without special characters and spaces.";
			return;
		}
		else{
			$handler = fopen("$url", "r");
			$table_name = $wpdb->prefix . "imp_leads"; 
			// PARSING CSV 
			// FORMAT: NAME, EMAIL, CONTACT
        	//loop through the csv file and insert into database 
			$contact_ctr = 0;
			while (($data = fgetcsv($handler,$length,",","'"))!== FALSE){
				$first_name = $data[0];
				$last_name = $data[1];
				$email = $data[2];
				$contact = $data[3];				

				$result = $wpdb->insert($table_name,
					array(
						'first_name'=> $first_name,
						'last_name'=> $last_name,
						'email_address'=> $email,
						'contact_number'=> $contact,
						'imported'=>'1',
						'status'=>'0'
						)
					);
				$contact_ctr++;
			}
		}
		echo "$contact_ctr contacts imported.";
	}

	// EXPORT CSV
	public function action_export_csv() {
		// @TODO: Define your action hook callback here
		$filename = "contacts.csv";
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$filename);

		global $wpdb;
		$table_name = $wpdb->prefix . "imp_leads"; 

		$output = "";
		$query = "SELECT first_name, last_name, email_address, contact_number FROM $table_name";

		$results = $wpdb->get_results($query);
		// var_dump($results);

		foreach ( $results as $result ) 
		{
			$output = $output
			.$result->first_name.","
			.$result->last_name.","
			.$result->email_address.","
			.$result->contact_number
			."\n";
		}
		echo $output;
		exit;
	}

	// ADD NEW CONTACT
	public function action_new_contact(){
		// @TODO: Define your action hook callback here
		global $wpdb;

		$str = $_POST['form_data'];
		$str = (string)str_replace("\\","", $str);
		$data =json_decode($str, true);


		$first_name = "";
		$last_name = "";
		$email_address = "";
		$contact_number = "";

		if(isset($data['first_name']))
			$first_name = $data['first_name'];

		if(isset($data['last_name']))
			$last_name = $data['last_name'];

		if(isset($data['email']))
			$email_address = $data['email'];
		
		if(isset($data['contact_number']))
			$contact_number = $data['contact_number'];

		// status variable values: NULL, transfered
		$table_name = $wpdb->prefix . "imp_leads"; 
		$result = $wpdb->insert($table_name,
			array(
				'first_name'=> $first_name,
				'last_name'=> $last_name,
				'email_address'=> $email_address,
				'contact_number'=> $contact_number,
				'imported'=>'1',
				'status'=>'0'
				)
			);

		$lastid = $wpdb->insert_id;
		echo $lastid;
	}

	// SEND EMAIL
	public function action_send_mail(){
		$admin_email = get_option( 'admin_email' ); 
		$author = get_the_author();
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		
		$message = "";
		$subject = "";
		$recipient_list = "";

		global $mail;
		$message = $_POST['message'];
		$subject = $_POST['subject'];
		$recipient_list = $_POST['recipient_list'];

		wp_mail( $recipient_list, $subject, $message, $headers );
		
		echo "sent";
		return;
	}

	public function action_delete_multiple(){
		// @TODO: Define your action hook callback here
		global $wpdb;
		$table_name = $wpdb->prefix . "imp_leads"; 
		
		$ids = $_POST['ids'];
		$str = (string)str_replace("\\","", $ids);
		$id_list = json_decode($str, true);
		
		$ctr = 0;		
		foreach ($id_list as $id) {
			$wpdb->delete( $table_name, array( 'id' => $id ) );	
			$ctr++;
		}

		echo "$ctr records deleted";		
		
	}
}
