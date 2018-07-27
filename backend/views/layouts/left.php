<aside class="main-sidebar">
    <section class="sidebar">
        <?php echo dmstr\widgets\Menu::widget(
            [

                'items' => [
                    ['label' => 'Меню Блога', 'options' => ['class' => 'header']],
                    ['label' => 'Селяни', 'icon' => 'group', 'url' => ['#'],
                        'items' => [

                            ['label' => 'Селяни', 'icon' => 'users', 'url' => ['/user'],],
                            ['label' => 'Новий Селянин', 'icon' => 'user', 'url' => ['/user/create'],],
                        ],
                    ],
                    ['label' => 'Типи блога', 'icon' => 'book', 'url' => ['#'],
                        'items' => [

                            ['label' => 'Типи', 'icon' => 'book', 'url' => ['/blog/type'],],
                            ['label' => 'Новий Тип блога', 'icon' => 'book', 'url' => ['/blog/type/create'],],
                        ],
                    ],

                    ['label' => 'Настройки Блога', 'options' => ['class' => 'header']],
                    ['label' => 'Генератор', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Дебагер', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Some tools', 'icon' => 'share', 'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                ],
            ]
        ) ?>
    </section>
</aside>
