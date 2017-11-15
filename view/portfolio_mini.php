<section id="portfolio">
    <h2>Portfolio</h2>
    <div class="grid-3-small-2">
        <?php foreach ($arrayMiniPortfolio as $project): ?>
            <a href="#modal-<?= $project['pro_id'] ?>">
                <div class="project" style="background-image: url('./<?= $project['pro_img_galery'] ?>')"></div>
            </a>
            <div class="remodal" data-remodal-id="modal-<?= $project['pro_id'] ?>">
                <button data-remodal-action="close" class="remodal-close"></button>
                <div class="grid-2-small-1">
                    <div>
                        <h3><?= $project['pro_name'] ?></h3>
                        <p class="project description"><?= $project['pro_description'] ?></p>
                        <a href="<?= $project['pro_url'] ?>">Voir le site</a>
                        <p class="date-start"><?= $project['pro_date_start'] ?></p>
                        <p class="date-end"><?= $project['pro_date_end'] ?></p>
                    </div>
                    <div>
                        <img  src=".<?= $project['pro_img'] ?>" alt="" style="max-height: 80vh; max-width: 100%">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>