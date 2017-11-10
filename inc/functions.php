<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmailContact($from, $name, $subject, $htmlContent, $texContent=''){
    global $config;
    $mail = new PHPMailer(true);    // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->isSMTP();// Set mailer to use SMTP
        $mail->Host = $config['EMAIL_HOST'];// Specify main and backup SMTP servers
        $mail->SMTPAuth = true;// Enable SMTP authentication
        $mail->Username = $config['EMAIL_ENVOIE'];// SMTP username
        $mail->Password = $config['EMAIL_PWD'];// SMTP password
        $mail->SMTPSecure = $config['EMAIL_SECURE'];// Enable TLS encryption, `ssl` also accepted
        $mail->Port = $config['EMAIL_PORT'];// TCP port to connect to

        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom($from, $name);
        $mail->addAddress($config['EMAIL_CONTACT'], 'Cyril GIULIANI');     // Add a recipient

        $htmlContent = "
            <h2>Nom: {$name}</h2>
            <h2>Sujet: {$subject}</h2>
            <h2>Email: {$from}</h2>
            <h2>Message :<br>{$htmlContent}</h2>
        ";

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Formulaire de contact cyril-giuliani.fr : ' . $subject;
        $mail->Body = $htmlContent;
        $mail->AltBody = $texContent;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    }
}

// Check si l'utilisateur existe
function usrEmailExist($email){
    global $pdo;
    $requestSql = "SELECT usr_id FROM users WHERE usr_email = :email";
    $pdoStatement = $pdo->prepare($requestSql);
    $pdoStatement->bindValue('email', $email, PDO::PARAM_STR);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        exit();
    }
    if ($pdoStatement->rowCount() > 0){
        return true;
    }else {
        return false;
    }
}

//Fonction de vérification du password
function checkPassword($email, $password){
    global $pdo;
    $requestHash = "SELECT usr_password FROM users WHERE usr_email = :email";
    $pdoStatementCheckPwd = $pdo->prepare($requestHash);
    $pdoStatementCheckPwd->bindValue(":email", $email, PDO::PARAM_STR);
    if ($pdoStatementCheckPwd->execute() === false){
        print_r($pdoStatementCheckPwd->errorInfo());
        exit();
    }
    $result = $pdoStatementCheckPwd->fetch(PDO::FETCH_ASSOC);
    $hash = $result['usr_password'];
    if (password_verify($password, $hash)) {
        return true;
    } else {
        return false;
    }
}

// Fonction de création de la session
function createSession($email){
    $_SESSION['email'] = $email;
    $_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
}