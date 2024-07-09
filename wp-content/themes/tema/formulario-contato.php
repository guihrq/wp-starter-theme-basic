<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'inc/phpmailer/PHPMailerAutoload.php';
require_once('wp-load.php');

header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = sanitize_text_field($_POST['nome']);
    $email = sanitize_email($_POST['email']);
    $telefone = sanitize_text_field($_POST['telefone']);
    $mensagem = sanitize_textarea_field($_POST['mensagem']);

    global $wpdb;
    $table_name = $wpdb->prefix . 'contatos';

    $inserted = $wpdb->insert(
        $table_name,
        array(
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'mensagem' => $mensagem,
            'data' => current_time('mysql')
        )
    );

    if ($inserted) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.exemplo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'seu-email@exemplo.com';
            $mail->Password = 'sua-senha';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('seu-email@exemplo.com', 'Seu Nome');
            $mail->addAddress('destinatario@exemplo.com', 'Destinatário');

            $mail->isHTML(true);
            $mail->Subject = 'Nova mensagem de contato';
            $mail->Body = "Nome: $nome<br>Email: $email<br>Telefone: $telefone<br>Mensagem: $mensagem";

            $mail->send();
            $response['success'] = true;
        } catch (Exception $e) {
            error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
        }
    }
}

echo json_encode($response);
