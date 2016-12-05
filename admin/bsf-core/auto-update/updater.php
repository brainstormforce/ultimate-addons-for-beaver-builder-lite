<?php
// Alternative function for wp_remote_get
if(!function_exists('bsf_get_remote_version')) {
	function bsf_get_remote_version($products, $check_license){
		global $ultimate_referer;
		global $bsf_product_validate_url;

		$path = $bsf_product_validate_url.'?referer='.$ultimate_referer;

		$data = array(
				'action' => 'bsf_get_product_versions',
				'ids' => $products,
				'linceses_check' => $check_license
			);
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '15',
				'sslverify' => false
			)
		);

		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			
			bsf_update_license_checked($result->updated_licenses);

			if(!$result->error)
				return $result->updated_versions;
			else
				return $result->error;
		}
	}
}
if(!function_exists('bsf_update_license_checked')) {
	function bsf_update_license_checked($updated_licenses) {
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		if(empty($brainstrom_products))
			return false;
		if(empty($updated_licenses))
			return false;

		$is_updated = false;

		foreach($updated_licenses as $license) :
			$product_id = $license->product_id;
			$type = $license->type.'s';
			$new_status = $license->status;
			$purchase_key = $license->purchase_code;
			if(isset($brainstrom_products[$type]) && !empty($brainstrom_products[$type])) {
				if(isset($brainstrom_products[$type][$product_id])) {
					$old_status = $brainstrom_products[$type][$product_id]['status'];
					if($old_status !== $new_status) {
						$brainstrom_products[$type][$product_id]['status'] = $new_status;
						$is_updated = true;
					}
				}
			}
		endforeach;

		if($is_updated)
			update_option('brainstrom_products', $brainstrom_products);
	}
}
if(!function_exists('bsf_check_product_update')) {
	function bsf_check_product_update(){
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$bsf_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();
		$bsf_user_email = $bsf_user_name = '';

		$mix = $bsf_product_plugins = $bsf_product_themes = $registered = $check_license = array();

		if(!empty($bsf_users)) {
			$bsf_user_email = isset( $bsf_users[0]['email'] ) ? $bsf_users[0]['email'] : "";
			$bsf_user_name = isset( $bsf_users[0]['name'] ) ? $bsf_users[0]['name'] : "";
		}

		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;

		$mix = array_merge($bsf_product_plugins, $bsf_product_themes);

		$is_update = false;
		$temp = '';
		if(!empty($mix)) :
			foreach($mix as $key => $product) :
				if(!isset($product['id']))
					continue;
				$constant = strtoupper(str_replace('-', '_', $product['id']));
				$constant = 'BSF_'.$constant.'_CHECK_UPDATES';
				if(defined($constant) && (constant($constant) === 'false' || constant($constant) === false)) {
					continue;
				}
				array_push($registered, $product['id']);
				//check license array build
				$temp = array();
				$temp['site_url'] = site_url();
				if(!isset($product['purchase_key']))
					continue;
				$is_wp = (isset($product['in_house']) && $product['in_house'] === 'wp') ? true : false;
				if($is_wp)
					continue;
				$temp['purchase_code'] = $product['purchase_key'];
				$temp['user_email'] = $bsf_user_email;
				$temp['user_name'] = $bsf_user_name;
				$temp['product_id'] = $product['id'];
				$temp['type'] = $product['type'];
				array_push($check_license, $temp);

			endforeach;
		endif;
		if(!empty($registered))
		{
			$remote_versions = bsf_get_remote_version($registered, $check_license);

			$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
			$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();

			if($remote_versions !== false)
			{
				if(!empty($remote_versions))
				{
					$is_bundled_update = false;
					foreach($remote_versions as $rkey => $remote_data)
					{
						$rid = (string)$remote_data->id;
						$remote_version = (isset($remote_data->remote_version)) ? $remote_data->remote_version : '';
						$in_house = (isset($remote_data->in_house)) ? $remote_data->in_house : '';
						$on_market = (isset($remote_data->on_market)) ? $remote_data->on_market : '';
						$is_product_free = (isset($remote_data->is_product_free)) ? $remote_data->is_product_free : '';
						$short_name = (isset($remote_data->short_name)) ? $remote_data->short_name : '';
						$changelog_url = (isset($remote_data->changelog_url)) ? $remote_data->changelog_url : '';
						$purchase_url = (isset($remote_data->purchase_url)) ? $remote_data->purchase_url : '';
						if(!empty($bsf_product_plugins))
						{
							foreach($bsf_product_plugins as $key => $plugin)
							{
								if(!isset($plugin['id']))
									continue;
								$pid = (string)$plugin['id'];
								if($pid === $rid)
								{
									$brainstrom_products['plugins'][$key]['remote'] = $remote_version;
									$brainstrom_products['plugins'][$key]['in_house'] = $in_house;
									$brainstrom_products['plugins'][$key]['on_market'] = $on_market;
									$brainstrom_products['plugins'][$key]['is_product_free'] = $is_product_free;
									$brainstrom_products['plugins'][$key]['short_name'] = $short_name;
									$brainstrom_products['plugins'][$key]['changelog_url'] = $changelog_url;
									$brainstrom_products['plugins'][$key]['purchase_url'] = $purchase_url;
									$is_update = true;
								}
							}
						}
						if(!empty($bsf_product_themes))
						{
							foreach($bsf_product_themes as $key => $theme)
							{
								if(!isset($theme['id']))
									continue;
								$pid = $theme['id'];
								if($pid === $rid)
								{
									$brainstrom_products['themes'][$key]['remote'] = $remote_version;
									$brainstrom_products['themes'][$key]['in_house'] = $in_house;
									$brainstrom_products['themes'][$key]['on_market'] = $on_market;
									$brainstrom_products['themes'][$key]['is_product_free'] = $is_product_free;
									$brainstrom_products['themes'][$key]['short_name'] = $short_name;
									$brainstrom_products['themes'][$key]['changelog_url'] = $changelog_url;
									$brainstrom_products['themes'][$key]['purchase_url'] = $purchase_url;
									$is_update = true;
								}
							}
						}

						if(isset($remote_data->bundled_products) && !empty($remote_data->bundled_products)) {
							if(!empty($brainstrom_bundled_products)) {
								foreach($brainstrom_bundled_products as $bkeys => $bps) {
									foreach ($bps as $bkey => $bp) {
										if(!isset($bp->id))
											continue;
										foreach($remote_data->bundled_products as $rbp) {
											if(!isset($rbp->id))
												continue;
											if( $rbp->id === $bp->id ) {
												$bprd = $brainstrom_bundled_products[$bkeys];
												$brainstrom_bundled_products[$bkeys][$bkey]->remote = $rbp->remote_version;
												$brainstrom_bundled_products[$bkeys][$bkey]->parent = $rbp->parent;
												$brainstrom_bundled_products[$bkeys][$bkey]->short_name = $rbp->short_name;
												$brainstrom_bundled_products[$bkeys][$bkey]->changelog_url = $rbp->changelog_url;
												/*$bprd[$bkey]->remote = $rbp->remote_version;
												$bprd[$bkey]->parent = $rbp->parent;
												$bprd[$bkey]->short_name = $rbp->short_name;
												$bprd[$bkey]->changelog_url = $rbp->changelog_url;*/

												//$brainstrom_bundled_products->$bkeys = $bprd;
												$is_bundled_update = true;
											}
										}
									}

								}
							}
						}
					}

					if($is_bundled_update){
						//echo 'CHECK UPDATE FUNCTION'; die();
						/*echo '<pre>';
						print_r($brainstrom_bundled_products);
						echo '</pre>'; die();*/
						update_option('brainstrom_bundled_products', $brainstrom_bundled_products);
					}
				}
			}
		}

		if($is_update)
			update_option('brainstrom_products', $brainstrom_products);

		//new Ultimate_Auto_Update(ULTIMATE_VERSION, 'http://ec2-54-183-173-184.us-west-1.compute.amazonaws.com/updates/?'.time(), 'Ultimate_VC_Addons/Ultimate_VC_Addons.php');
	}
}
if(!defined('BSF_CHECK_PRODUCT_UPDATES'))
	$BSF_CHECK_PRODUCT_UPDATES = true;
else
	$BSF_CHECK_PRODUCT_UPDATES = BSF_CHECK_PRODUCT_UPDATES;

if((false === get_transient( 'bsf_check_product_updates') && ($BSF_CHECK_PRODUCT_UPDATES === true || $BSF_CHECK_PRODUCT_UPDATES === 'true') )) {
	$proceed = true;

	if(phpversion() > 5.2) {
		$bsf_local_transient = get_option('bsf_local_transient');
		if($bsf_local_transient != false) {
			$datetime1 = new DateTime();
			$date_string = gmdate("Y-m-d\TH:i:s\Z", $bsf_local_transient);
			$datetime2 = new DateTime($date_string);

			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%h');
			$elapsed = $elapsed + ($interval->days*24);
			if($elapsed <= 48 || $elapsed <= '48') {
				$proceed = false;
			}
		}
	}

	if($proceed) {
		global $ultimate_referer;
		$ultimate_referer = 'on-transient-delete';
		bsf_check_product_update();
		update_option('bsf_local_transient', current_time( 'timestamp' ));
		set_transient( 'bsf_check_product_updates', true, 2*24*60*60 );
	}
}

if(!function_exists('get_bsf_product_upgrade_link')) {
	function get_bsf_product_upgrade_link($product) {
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();

		$mix = $bsf_product_plugins = $bsf_product_themes = $registered = array();
		$licence_require_update = '';

		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;

		$mix = array_merge($bsf_product_plugins, $bsf_product_themes);
		$status = (isset($product['status'])) ? $product['status'] : '';
		$name = (isset($product['bundled']) && ($product['bundled'])) ? $product['name'] : $product['product_name'];
		$free = (isset($product['is_product_free']) && ($product['is_product_free'] == true || $product['is_product_free'] == 'true')) ? $product['is_product_free'] : 'false';

		$id = $product['id'];

		$original_id = $id;

		$not_registered_msg = 'Activate your licence for one click update.';
		if($product['bundled'])
		{
			$product_name = '';
			$parent = $product['parent'];
			foreach($mix as $key => $bsf_p) {
				if($bsf_p['id'] == $parent) {
					$status = (isset($bsf_p['status'])) ? $bsf_p['status'] : '';
					$product_name = (isset($bsf_p['product_name'])) ? $bsf_p['product_name'] : '';
					$id = $parent;
					break;
				}
			}
			$not_registered_msg = 'This is bundled with '.$product_name.', Activate '.$product_name.'\'s licence for one click update.';
		}

		if ( array_key_exists( 'licence_require_update', $product ) ) {
			$licence_require_update = $product['licence_require_update'];
		}

		if($status === 'registered' || ($free === true || $free === 'true') || $licence_require_update == 'false' ) {

			$request = bsf_registration_page_url( '&action=upgrade&id='.$original_id );

			if($product['bundled'])
				$request .= '&bundled='.$id;
			if(is_multisite()) {
				$link = '<a href="'.network_admin_url($request).'" data-pid="'.$original_id.'" data-bundled="'.$product['bundled'].'" data-bid="'.$id.'" class="bsf-update-product-button">'.__('Update '.$name.'.', 'bsf').'</a><span class="spinner bsf-update-spinner"></span>';
			}
			else {
				$link = '<a href="'.admin_url($request).'" data-pid="'.$original_id.'" data-bundled="'.$product['bundled'].'" data-bid="'.$id.'" class="bsf-update-product-button">'.__('Update '.$name.'.', 'bsf').'</a><span class="spinner bsf-update-spinner"></span>';
			}
		} else {
			$link = '<a href="'. bsf_registration_page_url( '&id='.$id ) .'">' . __( $not_registered_msg, 'bsf' ) . '</a>';

		}

		return $link;
	}
}

/**
 * Unique sort final update ready array
 *
 * @param array
 *
 * @return array with unique plugins
 */
if ( ! function_exists( 'bsf_array_unique' ) ) {
	function bsf_array_unique( $arrs ) {

		$available_inits = array();

		foreach ( $arrs as $key => $arr ) {
			if( array_key_exists( 'init', $arr ) ) {
				if ( in_array( $arr['init'], $available_inits ) ) {
					unset( $arrs[$key] );
				} else {
					array_push( $available_inits , $arr['init']);
				}
			}
		}

		return $arrs;
	}
}
