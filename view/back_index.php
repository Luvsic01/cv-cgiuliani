<main>
    <h1 class="ui center aligned header">CV de Cyril Giuliani</h1>
    <section class="ui fluid container">
        <div class="ui styled fluid accordion">
            <!--Mes projets-->
            <div class="title active"><i class="dropdown icon"></i>Mes projets</div>
            <div class="content active">
                <div class="ui fluid container">
                    <table class="ui celled padded table">
                        <thead>
                            <tr>
                                <th class="left aligned">Nom du projet</th>
                                <th>URL</th>
                                <th>Description</th>
                                <th>Date start</th>
                                <th>Date End</th>
                                <th>URL img galery</th>
                                <th>URL img global</th>
                                <th>Gérer</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($arrayProject as $project): ?>
                            <tr>
                                <td class="left aligned"><?= $project['pro_name'] ?></td>
                                <td><?= $project['pro_url'] ?></td>
                                <td><?= $project['pro_description'] ?></td>
                                <td><?= $project['pro_date_start'] ?></td>
                                <td><?= $project['pro_date_end'] ?></td>
                                <td><?= $project['pro_img_galery'] ?></td>
                                <td><?= $project['pro_img'] ?></td>
                                <td>
                                    <a href="back_add.php?id=<?= $project['pro_id'] ?>">
                                        <button class="ui blue basic icon button"><i class="pencil icon"></i></button>
                                    </a>
                                    <a href="back_delete.php?id=<?= $project['pro_id'] ?>">
                                        <button class="ui red basic icon button"><i class="trash icon"></i></button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--Section a venir-->
            <div class="title"><i class="dropdown icon"></i>coming soon</div>
            <div class="content">
                <p class="transition hidden">...</p>
                <table class="ui striped right aligned table">
                    <thead>
                    <tr><th class="left aligned">Person</th>
                        <th>Calories</th>
                        <th>Fat</th>
                        <th>Protein</th>
                    </tr></thead>
                    <tbody>
                    <tr>
                        <td class="left aligned">Rosaline</td>
                        <td>5</td>
                        <td>35g</td>
                        <td>6g</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
