<?php
return [
    'definitions' => [
        \yii\widgets\ListView::class => [
            'itemOptions' => [
                'tag' => false,
            ],
            'options' => [
                'tag' => false,
            ],
            'layout' => <<<LAYOUT
    <article>
        <div class="entry-content">
            <div class="elementor">
                <div class="elementor-inner">
                    <div class="elementor-section-wrap">
                        <section class="elementor-section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="elementor-column">
                                        <div class="elementor-column-wrap">
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element">
                                                    <div class="elementor-widget-container">
                                                        <div class="gen-style-1">
                                                            <div class="row">{items}</div>
                                                            <div class="row">
                                                                <div class="page-post-pagination-data">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="gen-pagination">
                                                                            {pager}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                           </div>
                                       </div>
                                   </div>
                              </div>
                          </section>
                      </div>
                  </div>
            </div>
         </div>
    </article>
LAYOUT,
        ],
        \yii\grid\GridView::class => [
            'options' => [
                'tag' => false,
            ],
            'layout' => <<<LAYOUT
    <article>
        <div class="entry-content">
            <div class="elementor">
                <div class="elementor-inner">
                    <div class="elementor-section-wrap">
                        <section class="elementor-section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="elementor-column">
                                        <div class="elementor-column-wrap">
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element">
                                                    <div class="elementor-widget-container">
                                                        <div class="gen-comparison-table table-style-1 table-responsive">
                                                            <div class="row">{items}</div>
                                                            <div class="row">
                                                                <div class="page-post-pagination-data">
                                                                    <div class="col-lg-12 col-md-12">
                                                                        <div class="gen-pagination">
                                                                            {pager}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                           </div>
                                       </div>
                                   </div>
                              </div>
                          </section>
                      </div>
                  </div>
            </div>
         </div>
    </article>
LAYOUT,
        ],
        \yii\widgets\LinkPager::class => [
            'pageCssClass' => 'page-numbers',
            'activePageCssClass' => 'current',
            'nextPageCssClass' => 'next',
            'nextPageLabel' => 'Next page',
            'prevPageCssClass' => 'prev',
            'prevPageLabel' => 'Previous page',
            'linkOptions' => [
                'class' => 'page-link',
            ],
            'disabledPageCssClass' => 'disabled',
        ],
        \yii\grid\ActionColumn::class => [
            'buttons'  => [
                'restore' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-arrow-up"></i>', $url, [
                        'class' => 'btn btn-icon btn-primary btn-azure',
                        'title' => Yii::t('yii', 'Restore')
                    ]);
                },
            ]
        ],
    ]
];