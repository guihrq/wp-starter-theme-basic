<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Content-Type");

    require './../../../wp-includes/PHPMailer/PHPMailer.php';
    require './../../../wp-includes/PHPMailer/SMTP.php';
    require './../../../wp-includes/PHPMailer/Exception.php';
    include 'base-config.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Verifica a conexão com o banco de dados
    if ($conexao->connect_error) {
        die('Erro de conexão: ' . $conexao->connect_error);
    }
    $conexao->set_charset('utf8mb4');

    // Verifica se os dados foram enviados
    if ($_POST) {
        // Captura e sanitiza os dados do formulário
        $nome = $conexao->real_escape_string(trim($_POST['nome']));
        $email = $conexao->real_escape_string(trim($_POST['email']));
        $telefone = $conexao->real_escape_string(trim($_POST['telefone']));
        $mensagem = $conexao->real_escape_string(trim($_POST['mensagem']));
        $created_at = date('Y-m-d H:i:s');

        // Prepara e executa a consulta SQL de inserção
        $sql = "INSERT INTO wp_contatos (id, nome, email, telefone, mensagem, created_at) VALUES
                (NULL, '$nome', '$email', '$telefone', '$mensagem', '$created_at')";

        if (mysqli_query($conexao, $sql)) {
            // Cria o corpo do e-mail
            $mensagem_html = "
            <html>
                <head>
                    <style>
                        body {
                            font-family: 'New Order', sans-serif;
                            color: #ffffff;
                            background-color: #000000;
                            margin: 0;
                            padding: 0;
                        }
                        
                        .container {
                            width: 80%;
                            max-width: 600px;
                            margin: 20px auto;
                            background-color: #000000;
                            border-radius: 8px;
                            box-shadow: 0 0 10px rgba(0,0,0,0.1);
                            padding: 20px;
                            text-align: center;
                        }
                        
                        .logo {
                            width: 150px;
                            margin-bottom: 20px;
                        }
                        
                        h1 {
                            color: #4CAF50;
                            font-size: 24px;
                            margin-bottom: 20px;
                            font-family: 'Alkaline', sans-serif;
                        }
                        
                        p {
                            color: #ffffff;
                            font-size: 18px;
                            line-height: 1.6;
                        }
                        
                        .footer {
                            margin-top: 40px;
                            font-size: 28px;
                            color: #ffffff;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <a href='https://newton.ag/' target='_blank'><img src='ENDEREÇO DA IMAGEM DE LOGO AQUI' alt='Logo' class='logo'></a>
                        <h1>Nova Mensagem de Contato</h1>
                        <p>Você recebeu uma nova mensagem do formulário de contato.</p>
                        <p><b>Nome:</b> " . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "</p>
                        <p><b>E-mail:</b> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</p>
                        <p><b>Telefone:</b> " . htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8') . "</p>
                        <p><b>Mensagem:</b> " . htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') . "</p>
                        <div class='footer'>
                            <p>Atenciosamente, Sua Empresa.</p>
                        </div>
                    </div>
                </body>
            </html>";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                // $mail->SMTPDebug = 4;
                $mail->Host = 'smtp.seuhost.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'seuemail@host.com';
                $mail->Password = 'suasenha';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('emailremetente', 'Notificação de Contato');
                $mail->addAddress('emaildestinatario');
                $mail->isHTML(true);
                $mail->Subject = 'Nova Mensagem de Contato';
                $mail->CharSet = 'UTF-8';
                $mail->Body = $mensagem_html;
                $mail->send();
                echo "E-mail enviado com sucesso!";
            } catch (Exception $e) {
                echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao inserir dados no banco de dados: ' . mysqli_error($conexao)]);
        }
        // Fecha a conexão
        $conexao->close();
    }
?>
