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

// Vérification de l'extension du fichier avec un tableau d'extension
function checkExtension($arrayExtension, $fileName){
    $dotPosition = strrpos($fileName, '.');
    $extension = substr($fileName, $dotPosition+1);
    return in_array($extension, $arrayExtension) ? true : false;
}

// Création d'un nouveau nom de fichier avec la bonne extension
function newFileName($nameOriginal, $salt=''){
    $dotPosition = strrpos($nameOriginal, '.');
    $extension = substr($nameOriginal, $dotPosition+1);
    $newFileName = md5(uniqid().$salt) . '.' . $extension ;
    return $newFileName;
}

// Fonction d'ajout de projet dans la database
function addProject($nameProject, $urlProject, $description, $dateStart, $dateEnd, $urlImgGalery, $urlImgGlobal){
    global $pdo;
    $requestSqlAddProject = "
        INSERT INTO project (pro_name, pro_description, pro_url, pro_date_start, pro_date_end, pro_img_galery, pro_img)
        VALUES (:name_project, :description, :url, :date_start, :date_end, :img_galery, :img_global)
    ";
    $pdoStatementAddProject = $pdo->prepare($requestSqlAddProject);
    $pdoStatementAddProject->bindValue(":name_project", $nameProject, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":description", $urlProject, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":url", $description, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":date_start", $dateStart, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":date_end", $dateEnd, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":img_galery", $urlImgGalery, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":img_global", $urlImgGlobal, PDO::PARAM_STR);

    if ($pdoStatementAddProject->execute() === false){
        print_r($pdoStatementAddProject->errorInfo());
        return $pdoStatementAddProject->errorInfo();
    }else{
        return true;
    }
}

// Fonction d'update de projet dans la database
function updateProject($id, $nameProject, $urlProject, $description, $dateStart, $dateEnd){
    global $pdo;
    $requestSqlAddProject = "
        UPDATE project
        SET pro_name = :name_project, pro_description = :description, pro_url = :url, pro_date_start = :date_start, pro_date_end = :date_end
        WHERE pro_id = :id
    ";
    $pdoStatementAddProject = $pdo->prepare($requestSqlAddProject);
    $pdoStatementAddProject->bindValue(":id", $id, PDO::PARAM_INT);
    $pdoStatementAddProject->bindValue(":name_project", $nameProject, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":description", $urlProject, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":url", $description, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":date_start", $dateStart, PDO::PARAM_STR);
    $pdoStatementAddProject->bindValue(":date_end", $dateEnd, PDO::PARAM_STR);
    //$pdoStatementAddProject->bindValue(":img_galery", $urlImgGalery, PDO::PARAM_STR);
    //$pdoStatementAddProject->bindValue(":img_global", $urlImgGlobal, PDO::PARAM_STR);

    if ($pdoStatementAddProject->execute() === false){
        print_r($pdoStatementAddProject->errorInfo());
        return $pdoStatementAddProject->errorInfo();
    }else{
        return true;
    }
}

// Récupéré les projet
function getProjects($limit=false){
    global $pdo;
    $requestSqlProject = "
        SELECT * 
        FROM project
    ";
    if ($limit === false){
        $pdoStatementProject = $pdo->prepare($requestSqlProject);
    }else{
        $pdoStatementProject = $pdo->prepare($requestSqlProject." LIMIT :limit");
        $pdoStatementProject->bindValue(":limit", $limit, PDO::PARAM_INT);
    }

    if ($pdoStatementProject->execute() === false){
        print_r($pdoStatementProject->errorInfo());
        exit();
    }
    $arrayResult = $pdoStatementProject->fetchAll(PDO::FETCH_ASSOC);
    return $arrayResult;
}

// Récupéré les objet timeline
function getTimeLineItems($limit=false){
    global $pdo;
    $requestSqlTimeline = "
        SELECT * 
        FROM timeline
        ORDER BY tim_id DESC 
    ";
    $pdoStatementtimeline = $pdo->prepare($requestSqlTimeline);


    if ($pdoStatementtimeline->execute() === false){
        print_r($pdoStatementtimeline->errorInfo());
        exit();
    }
    $arrayResult = $pdoStatementtimeline->fetchAll(PDO::FETCH_ASSOC);
    return $arrayResult;
}

// Récupéré un projet avec son id
function getProjectById($id){
    global $pdo;
    $requestSqlProject = "
        SELECT * 
        FROM project
        WHERE pro_id = :id
    ";
    $pdoStatementProject = $pdo->prepare($requestSqlProject);
    $pdoStatementProject->bindValue(":id", $id, PDO::PARAM_INT);

    if ($pdoStatementProject->execute() === false){
        print_r($pdoStatementProject->errorInfo());
        exit();
    }
    $arrayResult = $pdoStatementProject->fetch(PDO::FETCH_ASSOC);
    return $arrayResult;
}


