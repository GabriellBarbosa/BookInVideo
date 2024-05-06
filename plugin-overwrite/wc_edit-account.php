<?php
add_filter('woocommerce_save_account_details_required_fields', 'removeDisplayNameFromRequiredFields');
function removeDisplayNameFromRequiredFields($required_fields) {
	unset($required_fields['account_display_name']);
	return $required_fields;
}

add_action('woocommerce_save_account_details_errors', 'blockUnalterableFieldsChange', 10, 2);
function blockUnalterableFieldsChange(&$error, &$user){
	$current_user = get_user_by('id', $user->ID);

	if ($current_user->user_email !== $user->user_email)
		$error->add( 'error', '<b>Endereço de e-mail</b> não pode ser alterado.');

	if ($current_user->first_name !== $user->first_name)
		$error->add( 'error', '<b>Nome</b> não pode ser alterado.');
}
?>