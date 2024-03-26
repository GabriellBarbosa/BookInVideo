<?php
add_filter('woocommerce_save_account_details_required_fields', 'bookinvideo_account_remove_required_fields');
function bookinvideo_account_remove_required_fields($required_fields) {
	unset($required_fields['account_display_name']);
	return $required_fields;
}

add_filter('woocommerce_save_account_details_errors', 'bookinvideo_prevent_change_of_unalterable_fields', 10, 2);
function bookinvideo_prevent_change_of_unalterable_fields(&$error, &$user){
	$current_user = get_user_by('id', $user->ID);

	if ($current_user->user_email !== $user->user_email)
		$error->add( 'error', '<b>Endereço de e-mail</b> não pode ser alterado.');

	if ($current_user->first_name != $user->first_name)
		$error->add( 'error', '<b>Nome</b> não pode ser alterado.');
}
?>