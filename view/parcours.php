<section id="parcours">
    <div class="wrapper">
        <h2>Parcours</h2>
        <div id="timeline" class="grid-2-small-1 has-gutter-timeline">
            <?php foreach (getTimeLineItems() as $item): ?>
                <div class="item item-hide">
                    <span class="bullet"><i class="fa fa-<?= $item['tim_category'] ?>" aria-hidden="true"></i></span>
                    <p class="date"><?= $item['tim_date'] ?></p>
                    <h3><?= $item['tim_name'] ?></h3>
                    <p class="place"><?= $item['tim_place'] ?></p>
                    <p class="decription"><?= $item['tim_description'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
