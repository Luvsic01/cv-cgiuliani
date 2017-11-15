<section id="contact">
    <div class="wrapper">
        <h2>Contact</h2>
        <form method="post" action="index.php#contact">
            <div id="infoForm" class="<?php if ($returnEmail): ?>valide<?php else: ?>invalide<?php endif; ?>">
                <p><?= $infoForm ?></p>
            </div>
            <div>
                <label for="name">Nom :</label>
                <input id="name" name="name" type="text" placeholder="* Votre nom" value="<?= $name ?? '' ?>">
            </div>
            <div>
                <label for="email">Email :</label>
                <input id="email" name="email" type="email" placeholder="* Votre email " value="<?= $email ?? '' ?>">
            </div>
            <div>
                <label for="subject">Sujet :</label>
                <input id="subject" name="subject" type="text" placeholder="* Sujet de votre demande" value="<?= $subject ?? '' ?>">
            </div>
            <div>
                <label for="msg">Message :</label>
                <textarea id="msg" name="msg" placeholder="* Votre message" rows="10"><?= $msg ?? '' ?></textarea>
            </div>
            <div class="g-recaptcha" data-sitekey="6LedsjgUAAAAAARQNzGs-qY2wOfymN337gNGYEbs"></div>
            <input  type="submit" value="Envoyer">
        </form>
    </div>
</section>