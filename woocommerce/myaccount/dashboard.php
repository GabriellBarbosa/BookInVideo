<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$currentUser = wp_get_current_user();
$certificate = new \AppCertificate\Certificate($currentUser->ID);
$userCertificate = $certificate->getByUser();

$course;
$certificateLink;
if ($userCertificate != null) {
	$course = new \AppCourse\Course($userCertificate->courseSlug);
	$certificateLink = '/certificate' . '/' . $userCertificate->id;
}
?>

<div class="myaccount_content">
	<h2><?= esc_html( $current_user->first_name ) . ' ' . esc_html( $current_user->last_name ) ?></h2>
	<p>Neste painel, você pode editar seus dados, alterar sua senha e ver os seus pedidos.</p>
	<h2>Curso</h2>
	<a class="call_to_action" href="<?= getCourseLink() ?>">Ir para o curso</a>
	<h2>Certificado</h2>
	<?php if ($userCertificate == null): ?>
		<p>O seu certificado estará disponível aqui quando você completar todas as aulas.</p>
	<?php else: ?>
		<p class>O seu certificado está disponível.</p>
		<p>
			<a class="certificate_link" href="<?= $certificateLink ?>" target="_blank"><?= $course->getName() ?></a>
		</p>
	<?php endif; ?>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
