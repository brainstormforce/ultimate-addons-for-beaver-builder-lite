<?php
global $bsf_product_validate_url, $bsf_support_url;

if ( defined( 'BSF_PRODUCT_VALIDATE_URL' ) ) {
	$bsf_product_validate_url = BSF_PRODUCT_VALIDATE_URL;
} else {
	$bsf_product_validate_url = 'https://support.brainstormforce.com/wp-admin/admin-ajax.php';
}

$bsf_support_url = 'https://support.brainstormforce.com/';
// Generate 32 characters
if(!function_exists('bsf_generate_rand_token')) {
	function bsf_generate_rand_token(){
		$validCharacters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$myKeeper = '';
		$length = 32;
		for ($n = 1; $n < $length; $n++) {
			$whichCharacter = rand(0, strlen($validCharacters)-1);
			$myKeeper .= $validCharacters{$whichCharacter};
		}
		return $myKeeper;
	}
}
// product registration
add_action( 'wp_ajax_bsf_register_product', 'bsf_register_product_callback' );
if(!function_exists('bsf_register_product_callback')) {
	function bsf_register_product_callback() {

		global $bsf_product_validate_url;
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();

		$bsf_product_plugins = $bsf_product_themes = array();

		$type = isset($_POST['type']) ? $_POST['type'] : '';
		$product = isset($_POST['product']) ? $_POST['product'] : '';
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$bsf_username = isset($_POST['bsf_username']) ? $_POST['bsf_username'] : '';
		$bsf_useremail = isset($_POST['bsf_useremail']) ? $_POST['bsf_useremail'] : '';
		$purchase_key = isset($_POST['purchase_key']) ? $_POST['purchase_key'] : '';
		$version = isset($_POST['version']) ? $_POST['version'] : '';
		$step = isset($_POST['step']) ? $_POST['step'] : '';
		$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
		$token = bsf_generate_rand_token();

		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;

		$product_key = $is_edd = '';

		if($type === 'plugin' || $type === 'theme')
		{
			$bsf_products_array = array();
			if($type == 'plugin')
				$bsf_products_array = $bsf_product_plugins;
			elseif($type == 'theme')
				$bsf_products_array = $bsf_product_themes;
			if(!empty($bsf_products_array)) :
				foreach($bsf_products_array as $key => $bsf_product)
				{
					$bsf_template = $bsf_product['template'];
					if($product == $bsf_template)
					{
						$product_key = $key;
						$brainstrom_products[$type.'s'][$key]['purchase_key'] = $purchase_key;
						$brainstrom_products[$type.'s'][$key]['version'] = $version;
						$brainstrom_products[$type.'s'][$key]['product_name'] = $product_name;
						$is_edd = (isset($brainstrom_products[$type.'s'][$key]['edd'])) ? $brainstrom_products[$type.'s'][$key]['edd'] : '';
					}
				}
			endif;
		}

		update_option('brainstrom_products', $brainstrom_products);

		$path = $bsf_product_validate_url;

		$data = array(
				'action' => 'bsf_product_registration',
				'purchase_key' => $purchase_key,
				'bsf_username' => $bsf_username,
				'bsf_useremail' => $bsf_useremail,
				'site_url' => get_site_url(),
				'version' => $version,
				'token' => $token,
				'referer' => 'customer',
				'id' => $id
			);
		if($is_edd)
			$data['edd'] = $is_edd;
		$data = apply_filters('bsf_product_registration_args', $data);
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '30',
				'sslverify' => false
			)
		);

		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			$status = '';
			//echo json_encode($result); die();
			if(isset($result->status))
			{
				$status = $result->status;
				$brainstrom_products[$type.'s'][$product_key]['status'] = $status;
			}

			if($status === 'registered')
			{
				$brainstrom_products[$type.'s'][$product_key]['step'] = 'step-all-success';
				$temp_info['product_info'] = $brainstrom_products[$type.'s'][$product_key];

				$user_array = array(
					'email' => $bsf_useremail,
					'token' => $token
				);
				if(!empty($brainstrom_users))
				{
					$find_key = false;
					foreach($brainstrom_users as $key => $user)
					{
						if($user['email'] === $bsf_useremail)
						{
							$brainstrom_users[$key]['token'] = $token;
							$find_key = true;
						}
					}
					if(!$find_key)
						array_push($brainstrom_users, $user_array);
				}
				else
					array_push($brainstrom_users, $user_array);
				update_option('brainstrom_users', $brainstrom_users);
			}

			update_option('brainstrom_products', $brainstrom_products);

			echo json_encode($result);

		}
		else
		{
			$arr = array('response' => $request->get_error_message());
			echo json_encode($arr);
		}

		wp_die();
	} //end of bsf_register_product_callback
}
// function to de register licence
add_action( 'wp_ajax_bsf_deregister_product', 'bsf_deregister_product_callback' );
if(!function_exists('bsf_deregister_product_callback')) {
	function bsf_deregister_product_callback() {
		global $bsf_product_validate_url;
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();

		$bsf_product_plugins = $bsf_product_themes = array();

		$type = isset($_POST['type']) ? $_POST['type'] : '';
		$product = isset($_POST['product']) ? $_POST['product'] : '';
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$bsf_useremail = isset($_POST['bsf_useremail']) ? $_POST['bsf_useremail'] : '';
		$purchase_key = isset($_POST['purchase_key']) ? $_POST['purchase_key'] : '';
		$version = isset($_POST['version']) ? $_POST['version'] : '';
		$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
		$token = bsf_generate_rand_token();

		if ( trim( $purchase_key ) == '' ) {
			if ( class_exists( 'BSF_License_Manager' ) ) {
				$bsf_license_manager = new BSF_License_Manager();
				$purchase_key = $bsf_license_manager->bsf_get_license_key( $id );
			}
			
		}

		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;

		$product_key = $is_edd = '';

		if($type === 'plugin' || $type === 'theme')
		{
			$bsf_products_array = array();
			if($type == 'plugin')
				$bsf_products_array = $bsf_product_plugins;
			elseif($type == 'theme')
				$bsf_products_array = $bsf_product_themes;
			if(!empty($bsf_products_array)) :
				foreach($bsf_products_array as $key => $bsf_product)
				{
					if(!isset($bsf_product['template']))
						continue;
					$bsf_template = $bsf_product['template'];
					if($product == $bsf_template)
					{
						$product_key = $key;
						$brainstrom_products[$type.'s'][$key]['status'] = 'not-registered';
						$is_edd = (isset($brainstrom_products[$type.'s'][$key]['edd'])) ? $brainstrom_products[$type.'s'][$key]['edd'] : '';
					}
				}
			endif;
		}

		update_option('brainstrom_products', $brainstrom_products);

		$path = $bsf_product_validate_url;

		$data = array(
				'action' => 'bsf_product_deregistration',
				'purchase_key' => $purchase_key,
				'bsf_useremail' => $bsf_useremail,
				'site_url' => get_site_url(),
				'version' => $version,
				'id' => $id,
				'token' => $token,
				'product' => $product_name
			);
		if($is_edd)
			$data['edd'] = $is_edd;
		$data = apply_filters('bsf_product_deregistration_args', $data);
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '30',
				'sslverify' => false
			)
		);

		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			//$result->message_html = 'Site deactivated!<br/>'.$result->message_html;
			echo json_encode($result);
		}
		else
		{
			$res['response'] = array(
				'title' => 'Error',
				'message_html' => 'Site deactivated!<br/> Error while communicating with server'.$request->get_error_message()
			);
			$res['proceed'] = true;
			echo json_encode($res);
		}

		wp_die();
	}
}
// first step execution of user registration
add_action( 'wp_ajax_bsf_register_user', 'bsf_register_user_callback' );
if(!function_exists('bsf_register_user_callback')) {
	function bsf_register_user_callback() {
		global $bsf_product_validate_url;

		$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();

		$bsf_username = isset($_POST['bsf_username']) ? $_POST['bsf_username'] : '';
		$bsf_useremail = isset($_POST['bsf_useremail']) ? $_POST['bsf_useremail'] : '';
		$bsf_useremail_reenter = isset($_POST['bsf_useremail_reenter']) ? $_POST['bsf_useremail_reenter'] : '';

		$subscribe = isset($_POST['ultimate_user_receive']) ? $_POST['ultimate_user_receive'] : '';

		$token = bsf_generate_rand_token();

		if($bsf_useremail !== $bsf_useremail_reenter) {
			$response['response'] = array(
				'title' => 'Error',
				'message_html' => 'Email address did not matched'
			);
			$response['proceed'] = false;

			echo json_encode($response);
			wp_die();
		}

		$domain = substr(strrchr($bsf_useremail, "@"), 1);
		if($domain === '' || $domain === false)
			$domain = $bsf_useremail;
		if(function_exists('checkdnsrr')) {
			$dns_check = checkdnsrr($domain, 'MX');
			if(!$dns_check)
			{
				$response['response'] = array(
					'title' => 'Error',
					'message_html' => 'Please enter valid email address, username and password will sent to your provided email address'
				);
				$response['proceed'] = false;
				echo json_encode($response);
				wp_die();
			}
		}

		$path = $bsf_product_validate_url;

		$data = array(
				'action' => 'bsf_user_registration',
				'bsf_username' => $bsf_username,
				'bsf_useremail' => $bsf_useremail,
				'bsf_useremail_confirm' => $bsf_useremail_reenter,
				'ultimate_user_receive' => $subscribe,
				'site_url' => get_site_url(),
				'token' => $token,
			);

		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '60',
				'sslverify' => false
			)
		);

		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			if((isset($result->proceed)) && ($result->proceed === 'true' || $result->proceed === true))
			{
				$user_array = array(
					'name' => $bsf_username,
					'email' => $bsf_useremail,
					'token' => $token
				);
				if(!empty($brainstrom_users))
				{
					$find_key = false;
					foreach($brainstrom_users as $key => $user)
					{
						if($user['email'] === $bsf_useremail)
						{
							$brainstrom_users[$key]['name'] = $bsf_username;
							$brainstrom_users[$key]['token'] = $token;
							$find_key = true;
							break;
						}
					}
					if(!$find_key)
						array_push($brainstrom_users, $user_array);
				}
				else
					array_push($brainstrom_users, $user_array);

				update_option('brainstrom_users', $brainstrom_users);

				global $ultimate_referer;
				$ultimate_referer = 'on-user-register';
				bsf_check_product_update();
			}
			echo json_encode($result);
		}
		else
		{
			$arr = array('response' => $request->get_error_message());
			echo json_encode($arr);
		}

		wp_die();
	}// end of bsf_register_user_callback
}

/**
 * Update version numbers of all the brainstorm products in options `brainstorm_products` and `brainstrom_bundled_products`
 *
 * @todo Current version numbers can be fetched from WordPress at runtime whenever ruquired,
 *          Remote version can only be required when transient for update data is deleted (i hope)
 */
if ( ! function_exists( 'bsf_update_all_product_version' ) ) {

	function bsf_update_all_product_version() {

		$brainstrom_products         = ( get_option( 'brainstrom_products' ) ) ? get_option( 'brainstrom_products' ) : array();
		$brainstrom_bundled_products = ( get_option( 'brainstrom_bundled_products' ) ) ? get_option( 'brainstrom_bundled_products' ) : array();

		$mix_products = $update_ready = $bsf_product_plugins = $bsf_product_themes = array();

		if ( ! empty( $brainstrom_products ) ) :
			$bsf_product_plugins = ( isset( $brainstrom_products['plugins'] ) ) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes  = ( isset( $brainstrom_products['themes'] ) ) ? $brainstrom_products['themes'] : array();
		endif;

		$product_updated = $bundled_product_updated = false;

		if ( ! empty( $bsf_product_plugins ) ) {

			foreach ( $bsf_product_plugins as $key => $plugin ) {
				if ( ! isset( $plugin['id'] ) || empty( $plugin['id'] ) ) {
					continue;
				}
				if ( ! isset( $plugin['template'] ) || empty( $plugin['template'] ) ) {
					continue;
				}
				if ( ! isset( $plugin['type'] ) || empty( $plugin['type'] ) ) {
					continue;
				}
				$version         = ( isset( $plugin['version'] ) ) ? $plugin['version'] : '';
				$current_version = bsf_get_current_version( $plugin['template'], $plugin['type'] );
				$name            = bsf_get_current_name( $plugin['template'], $plugin['type'] );
				if ( $name !== '' ) {
					$brainstrom_products['plugins'][ $key ]['product_name'] = $name;
				}
				if ( $current_version !== '' ) {
					if ( version_compare( $version, $current_version ) === - 1 || version_compare( $version, $current_version ) === 1 ) {
						$brainstrom_products['plugins'][ $key ]['version'] = $current_version;
						$product_updated                                   = true;
					}
				}
			}
		}

		if ( ! empty( $bsf_product_themes ) ) {

			foreach ( $bsf_product_themes as $key => $theme ) {
				if ( ! isset( $theme['id'] ) || empty( $theme['id'] ) ) {
					continue;
				}
				if ( ! isset( $theme['template'] ) || empty( $theme['template'] ) ) {
					continue;
				}
				if ( ! isset( $theme['type'] ) || empty( $theme['type'] ) ) {
					continue;
				}
				$version         = ( isset( $theme['version'] ) ) ? $theme['version'] : '';
				$current_version = bsf_get_current_version( $theme['template'], $theme['type'] );
				$name            = bsf_get_current_name( $theme['template'], $theme['type'] );
				if ( $name !== '' ) {
					$brainstrom_products['themes'][ $key ]['product_name'] = $name;
				}
				if ( $current_version !== '' || $current_version !== false ) {
					if ( version_compare( $version, $current_version ) === - 1 || version_compare( $version, $current_version ) === 1 ) {
						$brainstrom_products['themes'][ $key ]['version'] = $current_version;
						$product_updated                                  = true;
					}
				}
			}
		}

		if ( ! empty( $brainstrom_bundled_products ) ) {

			foreach ( $brainstrom_bundled_products as $keys => $bps ) {
				$version = '';
				if ( strlen( $keys ) > 1 ) {
					foreach ( $bps as $key => $bp ) {
						if ( ! isset( $bp->id ) || $bp->id === '' ) {
							continue;
						}
						$version         = $bp->version;
						$current_version = bsf_get_current_version( $bp->init, $bp->type );

						if ( $current_version !== '' && $current_version !== false ) {
							if ( version_compare( $version, $current_version ) === - 1 || version_compare( $version, $current_version ) === 1 ) {
								if ( is_object( $brainstrom_bundled_products ) ) {
									$brainstrom_bundled_products = array( $brainstrom_bundled_products );
								}
								$single_bp                            = $brainstrom_bundled_products[ $keys ];
								$single_bp[ $key ]->version           = $current_version;
								$bundled_product_updated              = true;
								$brainstrom_bundled_products[ $keys ] = $single_bp;
							}
						}
					}
				} else {
					if ( ! isset( $bps->id ) || $bps->id === '' ) {
						continue;
					}
					$version         = $bps->version;
					$current_version = bsf_get_current_version( $bps->init, $bps->type );
					if ( $current_version !== '' || $current_version !== false ) {
						if ( version_compare( $version, $current_version ) === - 1 || version_compare( $version, $current_version ) === 1 ) {
							$brainstrom_bundled_products[ $keys ]->version = $current_version;
							$bundled_product_updated                       = true;
						}
					}
				}
			}
		}

		update_option( 'brainstrom_products', $brainstrom_products );

		if ( $bundled_product_updated ) {			
			update_option( 'brainstrom_bundled_products', $brainstrom_bundled_products );
		}
	}
}

add_action( 'admin_init', 'bsf_update_all_product_version', 1000 );

if(!function_exists('bsf_get_current_version')) {
	function bsf_get_current_version($template, $type) {
		if($template === '')
			return false;
		if($type === 'theme' || $type === 'themes')
		{
			$theme = wp_get_theme($template);
			$version = $theme->get( 'Version' );
		}
		else if($type === 'plugin' || $type === 'plugins')
		{
			$plugin_file = rtrim(WP_PLUGIN_DIR,'/').'/'.$template;
			if(!is_file($plugin_file))
				return false;
			$plugin = get_plugin_data($plugin_file);
			$version = $plugin['Version'];
		}
		return $version;
	}
}
if(!function_exists('bsf_get_current_name')) {
	function bsf_get_current_name($template, $type) {
		if($template === '')
			return false;
		if($type === 'theme' || $type === 'themes')
		{
			$theme = wp_get_theme($template);
			$name = $theme->get( 'Name' );
		}
		else if($type === 'plugin' || $type === 'plugins')
		{
			$plugin_file = rtrim(WP_PLUGIN_DIR,'/').'/'.$template;
			if(!is_file($plugin_file))
				return false;
			$plugin = get_plugin_data($plugin_file);
			$name = $plugin['Name'];
		}
		return $name;
	}
}
add_action('admin_notices','bsf_notices',1000);
add_action('network_admin_notices','bsf_notices',1000);
if(!function_exists('bsf_notices')) {
	function bsf_notices() {
		global $pagenow;

		if ( $pagenow === 'plugins.php' || $pagenow === 'post-new.php' || $pagenow === 'edit.php' || $pagenow === 'post.php') {
			$brainstrom_products = get_option('brainstrom_products');
			$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();

			if(empty($brainstrom_products))
				return false;

			$brainstrom_bundled_products_keys = array();

			if(!empty($brainstrom_bundled_products)) :
				foreach($brainstrom_bundled_products as $bps) {
					foreach ($bps as $key => $bp) {
						array_push($brainstrom_bundled_products_keys, $bp->id);
					}
				}
			endif;

			$mix = array();

			$plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();

			$mix = array_merge($plugins, $themes);

			if(empty($mix))
				return false;

			if((defined('BSF_PRODUCTS_NOTICES') && (BSF_PRODUCTS_NOTICES === 'false' || BSF_PRODUCTS_NOTICES === false)))
				return false;

			$is_multisite = is_multisite();
			$is_network_admin = is_network_admin();

			foreach($mix as $product) :
				if(!isset($product['id']))
					continue;
				if(isset($product['is_product_free']) && ($product['is_product_free'] === 'true' || $product['is_product_free'] === true))
					continue;
				$constant = strtoupper(str_replace('-', '_', $product['id']));
				$constant_nag = 'BSF_'.$constant.'_NAG';
				$constant_notice = 'BSF_'.$constant.'_NOTICES';

				$show_nag = false;

				if(defined($constant_nag) && (constant($constant_nag) === 'false' || constant($constant_nag) === false))
					continue;
				if(defined($constant_notice) && (constant($constant_notice) === 'false' || constant($constant_notice) === false))
					continue;

				$status = (isset($product['status'])) ? $product['status'] : false;
				$type = (isset($product['type'])) ? $product['type'] : false;

				if(!$type)
					continue;

				if($type === 'plugin') {
					if(!is_plugin_active($product['template']))
						continue;
				}
				elseif($type === 'theme') {
					$theme = wp_get_theme();
					if ($product['template'] !== $theme->template)
						continue;
				}
				else
					continue;

				if(in_array($product['id'],$brainstrom_bundled_products_keys))
					continue;

				if($status !== 'registered') :

					$url = bsf_registration_page_url( '', $product['id'] );

					$message = __('Please','bsf').' <a href="'.$url.'">'.__('activate','bsf').'</a> '.__('your copy of the','bsf').' <i>'.$product['product_name'].'</i> '.__('to get update notifications, access to support features & other resources!','bsf');

					if(($is_multisite && $is_network_admin) || !$is_multisite)
						echo '<div class="update-nag bsf-update-nag">'.$message.'</div>';
				endif;
			endforeach;
		}
	}
}

if(!function_exists('bsf_grant_developer_access')) {
	function bsf_grant_developer_access($action){
		$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();

		if(empty($brainstrom_users))
			return false;

		global $current_user;
		$user = $current_user->user_login;
		$email = $current_user->user_email;

		// $token = bin2hex(openssl_random_pseudo_bytes(32));
		$token = bsf_generate_rand_token();
		$url = wp_nonce_url( get_site_url().'/wp-login.php?developer_access=true&access_id='.$user.'&access_token='.$token);

		$subject = $message = $vc_version = '';

		$username = (isset($brainstrom_users[0]['name'])) ? $brainstrom_users[0]['name'] : $user;

		$response = bsf_allow_developer_access($username, $url, $action);
		if($response){
			if($action === 'grant') {
				update_option('developer_access',true);
				$interval = time()+(15 * 24 * 60 * 60);
				update_option('access_time',$interval);
				update_option( 'access_token', $token );
				//echo '<div class="updated"><p>'.$response.'</p></div>';
			}
			else {
				$interval = time()-(10000);
				update_option('access_time',$interval);
				if(update_option('developer_access',false)){
					//echo __("Access Revoked!",'bsf');
				} else {
					?>
                    <div class="error"><p><?php echo __("Something went wrong. Please try again!",'bsf'); ?></p></div>
                    <?php
				}
			}
		} else {
			echo '<div class="error"><p>Something went wrong. Please try again.</p></div>';
			update_option('developer_access',false);
			$interval = time();
			update_option('access_time',$interval);
		}
	}
}
if(!function_exists('bsf_allow_developer_access')) {
	function bsf_allow_developer_access($username, $url, $process){
		global $bsf_product_validate_url;
		$path = $bsf_product_validate_url;
		$new_url = $url;
		$user = $username;
		$request = @wp_remote_post(
						$path, 	array(
							'body' => array(
								'action' => 'give_developer_access',
								'userid' => $user,
								'login_url' => $new_url,
								'site_url' => get_site_url(),
								'process' => $process,
							),
							'timeout' => '30',
							'sslverify' => false
						)
					);
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
			return ($request['body']);
		}
	}
}
if(!function_exists('bsf_process_developer_login')) {
	function bsf_process_developer_login(){
		$basename = basename($_SERVER['SCRIPT_NAME']);
		if($basename=='wp-login.php'){
			$interval = get_option('access_time');
			$now = time();
			if($interval <= $now){
				update_option('developer_access',false);
			}
			require_once( ABSPATH . 'wp-includes/pluggable.php' );

			if(isset($_GET['access_token'])){
				$access = get_option('developer_access');
				$access_token = get_option('access_token');
				$verify_token = $_GET['access_token'];
				$verified = ($access_token === $verify_token) ? true : false;
				if(isset($_GET['developer_access']) && $access && $verified)
				{
					$user_login = $_GET['access_id'];
					$user =  get_user_by('login',$user_login);
					$user_id = $user->ID;
					wp_set_current_user($user_id, $user_login);
					wp_set_auth_cookie($user_id);
					$redirect_to = user_admin_url();
					setcookie("DeveloperAccess", "active", time()+86400);
					wp_safe_redirect( $redirect_to );
					exit();
				}
			}
		}
	}
}
bsf_process_developer_login();

if(!function_exists('bsf_get_free_products')) {
	function bsf_get_free_products () {
		$plugins = get_plugins();
		$themes = wp_get_themes();

		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();

		$bsf_free_products = array();

		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;

		foreach($plugins as $plugin => $plugin_data)
		{
			if(trim($plugin_data['Author']) === 'Brainstorm Force')
			{
				if(!empty($bsf_product_plugins)) :
					foreach($bsf_product_plugins as $key => $bsf_product_plugin)
					{
						$bsf_template = (isset($bsf_product_plugin['template'])) ? $bsf_product_plugin['template'] : '';
						if($plugin == $bsf_template)
						{
							//$plugin_data = array_merge($plugin_data, $temp);
							if(isset($bsf_product_plugin['is_product_free']) && ($bsf_product_plugin['is_product_free'] === true || $bsf_product_plugin['is_product_free'] === 'true'))
								$bsf_free_products[] = $bsf_product_plugin;
						}
					}
				endif;
			}
		}

		foreach($themes as $theme => $theme_data)
		{
			$data = wp_get_theme($theme);
			$theme_author = trim($data->display('Author', FALSE));
			if($theme_author === 'Brainstorm Force')
			{
				if(!empty($bsf_product_themes)) :
					foreach($bsf_product_themes as $key => $bsf_product_theme)
					{
						$bsf_template = $bsf_product_theme['template'];
						if($theme == $bsf_template)
						{
							if(isset($bsf_product_theme['is_product_free']) && ($bsf_product_theme['is_product_free'] === true || $bsf_product_theme['is_product_free'] === 'true'))
								$bsf_free_products[] = $bsf_product_theme;
						}
					}
				endif;
			}
		}

		return $bsf_free_products;
	}
}
// function to toggle licence from server
add_action( 'wp_ajax_bsf_update_client_license', 'bsf_server_update_client_license' );
add_action( 'wp_ajax_nopriv_bsf_update_client_license', 'bsf_server_update_client_license' );
if(!function_exists('bsf_server_update_client_license')) {
	function bsf_server_update_client_license() {
		if(isset($_SERVER['HTTP_ORIGIN'])){
			header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Max-Age: 1000');
			header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$product_id = (isset($_POST['product_id'])) ? $_POST['product_id'] : '';
		$product_type = (isset($_POST['product_type'])) ? $_POST['product_type'] : '';
		$purchase_code = (isset($_POST['purchase_code'])) ? $_POST['purchase_code'] : '';
		$useremail = (isset($_POST['user_email'])) ? $_POST['user_email'] : '';
		$userid = $useremail;
		$process = (isset($_POST['process'])) ? $_POST['process'] : '';
		$site_url = (isset($_POST['site_url'])) ? $_POST['site_url'] : '';
		$status = (isset($_POST['status'])) ? $_POST['status'] : '';

		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();

		if(!empty($brainstrom_products)) {
			if((isset($brainstrom_products[$product_type.'s'])) && (!empty($brainstrom_products[$product_type.'s']))) {
				if(isset($brainstrom_products[$product_type.'s'][$product_id])) {
					$brainstrom_products[$product_type.'s'][$product_id]['status'] = $status;
					if(empty($brainstrom_products[$product_type.'s'][$product_id]['purchase_key']))
						$brainstrom_products[$product_type.'s'][$product_id]['purchase_key'] = $purchase_code;
					update_option('brainstrom_products', $brainstrom_products);
					echo true;
					die();
				}
			}
		}
		echo false;
		die();
	}
}
// delete bundled products after switch theme

if( ! function_exists( 'bsf_theme_deactivation' ) ) {

	function bsf_theme_deactivation() {

		delete_option( 'brainstrom_bundled_products' );
		delete_site_transient( 'bsf_get_bundled_products' );
		delete_site_option( 'bsf_installer_menu' );
		update_option( 'bsf_force_check_extensions', false );
	}

}

add_action( 'switch_theme', 'bsf_theme_deactivation' );
add_action( 'deactivated_plugin', 'bsf_theme_deactivation' );

if(!function_exists('bsf_get_free_menu_position')) {
	function bsf_get_free_menu_position($start, $increment = 0.3) {
		foreach ($GLOBALS['menu'] as $key => $menu) {
			$menus_positions[] = $key;
		}

		if (!in_array($start, $menus_positions)) return $start;

		/* the position is already reserved find the closet one */
		while (in_array($start, $menus_positions)) {
			$start += $increment;
		}
		return $start;
	}
}
if(!function_exists('bsf_get_option')) {
	function bsf_get_option($request = false) {
		$bsf_options = get_option('bsf_options');
		if(!$request)
			return $bsf_options;
		else
			return (isset($bsf_options[$request])) ? $bsf_options[$request] : false;
	}
}
if(!function_exists('bsf_update_option')) {
	function bsf_update_option($request, $value) {
		$bsf_options = get_option('bsf_options');
		$bsf_options[$request] = $value;
		return update_option('bsf_options', $bsf_options);
	}
}

// to sort array of objects
if(!function_exists('bsf_sort')) {
    function bsf_sort($a, $b)
    {
        return @strcmp(strtolower($a->short_name), strtolower($b->short_name));
    }
}

/**
 * Brainstorm Switch
 * 
 * Outputs markup for the switch
 *
 * @param $name (string) - name for the switch, this will be the reference for saving the value
 * @param $default (boolean) - Default valuw of switch, true|false
 */
if ( ! function_exists( 'brainstorm_switch' ) ) {

	function brainstorm_switch( $name = '', $default = false ) {

		$checked = '0';
		$bsf_updater_options = get_option( 'bsf_updater_options', array() );

		if ( isset( $bsf_updater_options[ $name ] ) ) {
			$checked = $bsf_updater_options[ $name ];
		}
		$uid     = uniqid();
		$switch  = '';

		$switch .= "\t\t" . '<div class="switch-wrapper">
							<input type="text"  id="brainstorm_switch_' . $uid . '" class="'. $name .' form-control smile-input bsf-switch-input" value="'. esc_attr( $checked ) .'"/>
							<input type="checkbox" '. checked( true, $checked, false ) .' id="brainstorm_core_switch_' . $uid . '" name="' . $name . '" class="ios-toggle smile-input bsf-switch-input switch-checkbox smile-switch " value="0" >
							<label class="bsf-switch-btn checkbox-label" data-on="ON"  data-off="OFF" data-id="brainstorm_switch_' . $uid . '" for="brainstorm_core_switch_' . $uid . '">
							</label>
						</div>';

		return $switch;
	}
	
}

/**
 * Save option brainstorm updater advanced/debug settings
 */
if ( ! function_exists( 'update_bsf_core_options_callback' ) ) {
	
	function update_bsf_core_options_callback() {

		$option = isset( $_POST['option'] ) ? esc_attr( $_POST['option'] ) : '';
		$value = isset( $_POST['value'] ) ? esc_attr( $_POST['value'] ) : '';

		$bsf_updater_options = get_option( 'bsf_updater_options', array() );
		$bsf_updater_options[ $option ] = $value;

		update_option( 'bsf_updater_options', $bsf_updater_options );
		$bsf_updater_options = get_option( 'bsf_updater_options', array() );

		$location = bsf_registration_page_url( '&author' );

		$response = array(
			'redirect' => $location
			);

		wp_send_json( $response );
	}

}

add_action( 'wp_ajax_update_bsf_core_options', 'update_bsf_core_options_callback' );
