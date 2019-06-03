<?php use yii\helpers\Url;?>

<li>
    <a itemprop="url"
       href="<?= Url::to('?id='.$category['id_cat'],0) ?>"
       data-toggle="modal" data-target="#w1" data-id="<?= $category['id_cat']?>"
    >
        <?= $category['id_cat'] ?>
    </a>
    <?php if (isset($category['childs'])) { ?>

        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>

    <?php } ?>
</li>
