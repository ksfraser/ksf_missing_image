
<?php
define ('SS_ksf_missing_image', 111<<8);
//SA_ITEM defined in includes/access_levels.inc
//include_once( $path_to_root . '/includes/access_levels.inc' );

/***************************************************************************************
 *
 * Hooks is what adds menus, etc to FrontAccounting.
 * It also appears to be called pre and post database transactions
 * for certain modules (see includes/hooks.inc) around line 360
 * 	hook_db_prewrite
 * 	hook_db_postwrite
 * 	hook_db_prevoid
 *
 * Looks like we could also provide our own authentication module
 * 	hook_authenticate (useful for REST?)
 *
 * ***********************************************************************************/
class hooks_ksf_missing_image extends hooks {
	var $module_name = 'ksf_missing_image'; 

	/*
		Install additonal menu options provided by module
	*/
	function install_options($app) {
		global $path_to_root;

		switch($app->id) {
			//case 'GL':
			//case 'system':
			//case 'stock':
			//case 'AP':
			//case 'orders':
			case 'stock':
				$app->add_rapp_function(2, _('ksf_missing_image'), 
					$path_to_root.'/modules/ksf_missing_image/ksf_missing_image.php', 'SA_ksf_missing_image');
				$app->add_rapp_function(3, _('ksf_missing_image'), 
					$path_to_root.'/modules/ksf_missing_image/ksf_missing_image.php', 'SA_ITEM');
		}
	}

	function install_access()
	{
		$security_sections[SS_ksf_missing_image] = _("ksf_missing_image");
		//$security_sections[SA_ITEM] = _("ksf_missing_image");

		$security_areas['SA_ksf_missing_image'] = array(SS_ksf_missing_image|101, _("ksf_missing_image"));
		//$security_areas['SA_ITEM'] = array(SS_ksf_missing_image|101, _("ksf_missing_image"));

		return array($security_areas, $security_sections);
	}
	function db_postwrite(&$cart, $trans_type)
	{
		//display_notification( "WOO_EXPORT hooks was told about " . $trans_type );
		//this is called every time a CART is written to a db
		//we could use this to send updates for QOH, or every time
		//a new product is added we could send to WOO
		//type 30 == sales_order
		//type 13 == delivery
		//type 12 == invoice?
		//type 10 == payment?
		return true;
	}
	/*
	function install_tabs($app)
	{
		$app->add_application(new example_class); // add menu tab defined by example_class
	}
	//
	//	Invoked for all modules before page header is displayed
	//
	function pre_header($fun_args)
	{
	}
	//
	//	Invoked for all modules before page footer is displayed
	//
	function pre_footer($fun_args)
	{
	}

	//
	// Price in words. $doc_type is set to document type and can be used to suppress 
	// price in words printing for selected document types.
	// Used instead of built in simple english price_in_words() function.
	//
	//	Returns: amount in words as string.

	function price_in_words($amount, $doc_type)
	{
	}
	//
	// Exchange rate currency $curr as on date $date.
	// Keep in mind FA has internally implemented 3 exrate providers
	// If any of them supports your currency, you can simply use function below
	// with apprioprate provider set, otherwise implement your own.
	// Returns: $curr value in home currency units as a real number.

	function retrieve_exrate($curr, $date)
	{
//	 	$provider = 'ECB'; // 'ECB', 'YAHOO' or 'GOOGLE'
//		return get_extern_rate($curr, $provider, $date);
		return null;
	}

	// External authentication
	// If used should return true after successfull athentication, false otherwise.
	function authenticate($login, $password)
	{
		return null;
	}
	// Generic function called at the end of Tax Report (report 709)
	// Can be used e.g. for special database updates on every report printing
	// or to print special tax report footer 
	//
	// Returns: nothing
	function tax_report_done()
	{
	}
	// Following database transaction hooks akcepts array of parameters:
	// 'cart' => transaction data
	// 'trans_type' => transaction type

	function db_prewrite(&$cart, $trans_type)
	{
		return true;
	}

	function db_postwrite(&$cart, $trans_type)
	{
		return true;
		//display_notification( "WOO_EXPORT hooks was told about " . $trans_type );
		//this is called every time a CART is written to a db
		//we could use this to send updates for QOH, 
		//or every time a new product is added we could send to WOO
		//Every time a sales order is placed we could send WOO the order
		//Every time a delivery is done update WOO (this allows reviews?)
		//type 30 == sales_order
		//type 13 == delivery
		//type 12 == invoice?
		//type 10 == payment?
	 	 
	}

	function db_prevoid($trans_type, $trans_no)
	{
		return true;
		//Something like:
		/*	$sql = "
	    	 *	UPDATE ".TB_PREF."bi_transactions
	    	 *		SET status=0
	    	 *		WHERE
		 *		fa_trans_no=".db_escape($trans_no)." AND
		 *		fa_trans_type=".db_escape($trans_type)." AND
		 *		status = 1";
		 *		//display_notification($sql);
		 *	db_query($sql, 'Could not void transaction');
	 	 * /}
	//
	//	This method is called after module install.
	//
	function install_extension($check_only=true)
	{
		return true;
	}
	//
	//	This method is called after module uninstall.
	//
	function uninstall_extension($check_only=true)
	{
		return true;
	}
	//
	//	This method is called on extension activation for company.
	//
	function activate_extension($company, $check_only=true)
	{
		return true;
     		global $db_connections;
                $updates = array(
                        //'install_myapp.sql' => array('assets'),
			'sql/crm_campaign_types.sql' => array('crm_campaign_types'),
			'sql/crm_mailinglist.sql' => array('crm_mailinglist'),

                );

                return $this->update_databases($company, $updates, $check_only);	}
	//
	//	This method is called when extension is deactivated for company.
	//
	function deactivate_extension($company, $check_only=true)
	{
		return true;
  		global $db_connections;
                $updates = array(
                        'drop_myapp.sql' => array('assets')
                );

		return $this->update_databases($company, $updates, $check_only);	}

	 */
}
