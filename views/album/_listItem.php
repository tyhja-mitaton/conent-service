<?php
/* @var \app\models\search\Album $model */
?>
<div class="col-xl-3 col-lg-4 col-md-6">
    <article class="video type-video status-publish has-post-thumbnail">
        <div class="gen-carousel-movies-style-1 movie-grid style-1">
            <div class="gen-movie-contain">
                <div class="gen-movie-img">
                    <?=\yii\helpers\Html::img($model->cover_link)?>
                    <div class="gen-movie-add"></div>
                    <div class="gen-movie-action">
                        <?=\yii\helpers\Html::a('<i class="fa fa-play"></i>', ['/album/videos', 'id' => $model->id], ['class' => 'gen-button'])?>
                    </div>
                </div>
                <div class="gen-info-contain">
                    <div class="gen-movie-info"><h3><?=$model->name?></h3></div>
                    <div class="gen-movie-meta-holder"><ul></ul></div>
                </div>
            </div>
        </div>
    </article>
</div>
