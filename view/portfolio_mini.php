<section id="portfolio">
    <h2>Portfolio</h2>
    <?php foreach ($arrayMiniPortfolio as $project): ?>
        <div class="project">
            <?= $project['pro_name'] ?>
            <?= $project['pro_description'] ?>
            <?= $project['pro_url'] ?>
            <?= $project['pro_date_start'] ?>
            <?= $project['pro_date_end'] ?>
            <?= $project['pro_img_galery'] ?>
            <?= $project['pro_img'] ?>
        </div>
    <?php endforeach; ?>
</section>