<aside class="main-sidebar">
    <section class="sidebar">
        <?php echo dmstr\widgets\Menu::widget(
            [
                'items' => [
                    ['label' => 'Меню Користувачів', 'options' => ['class' => 'header']],
                    ['label' => 'Селяни', 'icon' => 'group', 'url' => ['#'],
                        'items' => [
                            ['label' => 'Селяни', 'icon' => 'users', 'url' => ['/user'],],
                            ['label' => 'Новий Селянин', 'icon' => 'user', 'url' => ['/user/create'],],
                        ],
                    ],

                    ['label' => 'Меню Блога', 'options' => ['class' => 'header']],
                    ['label' => 'Пости блога', 'icon' => 'book', 'url' => ['#'],
                        'items' => [
                            ['label' => 'Пости', 'icon' => 'book', 'url' => ['/blog/post'],],
                            ['label' => 'Новий Пост', 'icon' => 'book', 'url' => ['/blog/post/create'],],
                        ],
                    ],
                    ['label' => 'Типи блога', 'icon' => 'book', 'url' => ['#'],
                        'items' => [
                            ['label' => 'Типи', 'icon' => 'book', 'url' => ['/blog/type'],],
                            ['label' => 'Новий Тип блога', 'icon' => 'book', 'url' => ['/blog/type/create'],],
                        ],
                    ],
                    ['label' => 'Теги блога', 'icon' => 'book', 'url' => ['#'],
                        'items' => [
                            ['label' => 'Теги', 'icon' => 'book', 'url' => ['/blog/tag'],],
                            ['label' => 'Новий Тег блога', 'icon' => 'book', 'url' => ['/blog/tag/create'],],
                        ],
                    ],
                    ['label' => 'Категорії блога', 'icon' => 'book', 'url' => ['#'],
                        'items' => [
                            ['label' => 'Категорії', 'icon' => 'book', 'url' => ['/blog/category'],],
                            ['label' => 'Нова Категорія блога', 'icon' => 'book', 'url' => ['/blog/category/create'],],
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
