<?php $title = 'section-simple'; ?>

<?php ob_start(); ?>

<article class="field-flex">

    <div class="item">
        <div class="item_image">
            <img src="" alt="image 1">
        </div>
        <div class="item_body">
            <div class="item_title">
                titre image 1
            </div>
            <div class="item_description">
                ici description de l'image
            </div>
        </div>
    </div>
    <div class="item">
        <div class="item_image">
            <img src="" alt="image 1">
        </div>
        <div class="item_body">
            <div class="item_title">
                titre image 1
            </div>
            <div class="item_description">
                ici description de l'image
            </div>
        </div>
    </div>
    <div class="item">
        <div class="item_image">
            <img src="" alt="image 1">
        </div>
        <div class="item_body">
            <div class="item_title">
                titre image 1
            </div>
            <div class="item_description">
                ici description de l'image
            </div>
        </div>
    </div>
</article>






<?php $content = ob_get_clean(); ?>
<?php
// require('template.php'); ?>