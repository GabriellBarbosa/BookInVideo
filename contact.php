<?php
/* Template Name: Contact */ 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

get_header();

require $template_directory . '/utils/PHPMailer/src/Exception.php';
require $template_directory . '/utils/PHPMailer/src/PHPMailer.php';
require $template_directory . '/utils/PHPMailer/src/SMTP.php';

$template_directory =  get_template_directory();
?>

<div id="contact-page">
    <div class="page_title_wrapper">
        <h1 class="page_title container"><?= the_title(); ?></h1>
    </div>
    <div class="container page-content">
        <form method="post">
            <?php
            if (isset($_POST['contact_form'])) {
                sendMailAndPrintMessage(new PHPMailer(true));
            }
            ?>

            <h2>Mande sua dúvida</h2>
            <input type="hidden" name="contact_form">
            <label>Nome</label>
            <input type="text" name="username" required>
            <label>Email</label>
            <input type="email" name="useremail" required>
            <label>Mensagem</label>
            <textarea name="usermessage" required></textarea>
            <button type="submit">Enviar mensagem</button>
        </form>
        <ul class="faq">
            <li>
                <h2>Certificado</h2>
                <p>
                    O certificado é liberado assim que você completar 100% das aulas. Ele estará 
                    disponível na página "Minha Conta". O certificado é válido em todo território 
                    nacional brasileiro, conforme a lei do Curso livre.
                </p>
            </li>
        </ul>
    </div>
</div>

<?php 
function sendMailAndPrintMessage(PHPMailer $mail) {    
    try {
        tryToSendMail($mail);
        echo '
            <span class="contact_success">
                Mensagem recebida
            </span>
        ';
    } catch (Exception $e) {
        echo '
            <span class="contact_fail">
                Não foi possível enviar a mensagem
            </span>
        ';
    }
}

function tryToSendMail(PHPMailer $mail) {
    $userName = $_POST['username'];
    $email = $_POST['useremail'];
    $message = $_POST['usermessage'];
    $isLogged = is_user_logged_in() ? 'logged' : 'not logged';

    //Server settings
    $mail->isSMTP();
    $mail->CharSet    = "UTF-8";
    $mail->Host       = 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'email@sample.com';
    $mail->Password   = 'password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom('email@sample.com', "{$userName} - {$isLogged}");
    $mail->addAddress('email@sample.com', 'bookinvideo');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Contato';
    $mail->Body    = "
        <div>
            <span>nome: <b>{$userName}</b></span>
            <span>|</span>
            <span>
                email: <b>{$email}</b>
            </span>
        </div>
        <hr/>
        <p style='line-height: 1.5'>{$message}</p>
    ";

    $mail->send();
}
?>

<?php get_footer() ?>