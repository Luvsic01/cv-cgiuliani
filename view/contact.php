<section id="contact">
    <h2>Contact</h2>
    <form method="post" action="">
        <label for="name">Nom :</label>
        <input id="name" name="name" type="text" placeholder="* Votre nom" value="<?= $name ?? '' ?>">
        <label for="email">Email :</label>
        <input id="email" name="email" type="email" placeholder="* Votre email " value="<?= $email ?? '' ?>">
        <label for="subject">Sujet :</label>
        <input id="subject" name="subject" type="text" placeholder="* Sujet de votre demande" value="<?= $subject ?? '' ?>">
        <label for="msg">Message :</label>
        <textarea id="msg" name="msg" placeholder="* Votre message"><?= $msg ?? '' ?></textarea>
        <input type="submit" value="Envoyer">
    </form>
</section>