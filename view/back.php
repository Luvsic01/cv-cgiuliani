<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interface de gestion du CV</title>
</head>
<body>
    <?php if (isset($_SESSION['email'])) : ?>
        <section>
            <h1>logé</h1>
        </section>
    <?php else: ?>
        <section>
            <div>
                <h1>Login</h1>
                <form method="post" action="">
                    <input type="hidden" name="login" value="true" />
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email" class="validate">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password">
                    <input type="submit" value="Connection">
                </form>
            </div>
        </section>
    <?php endif; ?>
</body>
</html>