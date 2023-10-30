<?php
/** @var yii\web\View $this */
/* @var array $model */

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <article class="episode type-episode status-publish has-post-thumbnail hentry">
                <div class="gen-episode-wrapper style-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="gen-video-holder">
                                <iframe src="<?=$model['player_embed_url']?>"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="gen-single-tv-show-info">
                                <h2 class="gen-title"><?=$model['name']?></h2>
                                <div class="gen-single-meta-holder">
                                    <ul>
                                        <li><?=round($model['duration']/60)?>min</li>
                                        <li><i class="fas fa-eye"></i><span><?=$model['stats']['plays']?> Views</span></li>
                                    </ul>
                                </div>
                                <div class="gen-excerpt"><?=$model['description']?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>

