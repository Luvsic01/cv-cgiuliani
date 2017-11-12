<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.css" />
    <title>Login</title>
</head>
<body>

    <main>
        <div class="ui raised very padded text container segment" style="margin: 20px;">
            <h1>Login</h1>
            <form class="ui form" method="post" action="">
                <div class="field">
                    <label for="email">email</label>
                    <input id="email" type="email" name="email" placeholder="email">
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="password">
                </div>
                <?php if (!empty($infoForm)): ?>
                    <div class="ui visible error message">
                        <div class="header">Saisie invalide</div>
                        <p><?= $infoForm ?></p>
                    </div>
                <?php endif; ?>
                <button class="ui button" type="submit">Connection</button>
            </form>
        </div>
    </main>
</body>
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.js"></script></body>
</html>