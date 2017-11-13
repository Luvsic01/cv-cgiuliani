<main class="ui container">
    <!--Ajout d'un projet-->
    <section id="addProject">
        <h2 class="ui center aligned header">Ajouter un projet</h2>

        <?php if (!empty($infoForm)): ?>
            <?php if ($saisieOk && $fileOk):?>
                <div class="ui positive message">
                    <div class="header"><?= $infoForm ?></div>
                </div>
            <?php else: ?>
                <div class="ui negative message">
                    <div class="header">Problème lors de la soumission du formulaire</div>
                    <ul class="list"><?= $infoForm ?></ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!--Formulaire d'ajout-->
        <form method="post" action="" enctype="multipart/form-data" class="ui form attached fluid segment">
            <!--nameProject-->
            <div class="field">
                <label for="nameProject">Nom du projet</label>
                <input type="text" id="nameProject" name="nameProject" placeholder="Nom du projet" value="<?= $nameProject ?? ''?>">
            </div>
            <!--urlProject-->
            <div class="field">
                <label for="urlProject">URL du projet</label>
                <div class="ui labeled input">
                    <div class="ui label">http:// </div>
                    <input type="text" id="urlProject" name="urlProject" placeholder="URL du projet" value="<?= $urlProject ?? ''?>">
                </div>
            </div>
            <!--description-->
            <div class="field">
                <label for="description">Description du projet</label>
                <textarea name="description" id="description" placeholder="Description"><?= $description ?? ''?></textarea>
            </div>
            <!--date du projet-->
            <div class="ui two column stackable grid">
                <div class="row">
                    <!--dateStart-->
                    <div class="column field">
                        <label for="dateStart">Début du projet</label>
                        <input type="text" id="dateStart" name="dateStart" value="<?= $dateStart ?? ''?>">
                    </div>
                    <!--dateEnd-->
                    <div class="column field">
                        <label for="dateEnd">Fin du projet</label>
                        <input type="text" id="dateEnd" name="dateEnd" value="<?= $dateEnd ?? ''?>">
                    </div>
                </div>
                <!--Image-->
                <div class="row">
                    <!--imgGalery-->
                    <div class="column field">
                        <label for="imgGalery">Image galery</label>
                        <input type="file" id="imgGalery" name="imgGalery">
                    </div>
                    <!--imgGlobal-->
                    <div class="column field">
                        <label for="imgGlobal">Image global</label>
                        <input type="file" id="imgGlobal" name="imgGlobal">
                    </div>
                </div>
            </div>
            <!--Submit-->
            <div class="ui right aligned grid">
                <div class="column">
                    <button class="ui button" type="submit">Ajouter</button>
                </div>
            </div>
        </form>
    </section> <!--fin addProject-->
</main>