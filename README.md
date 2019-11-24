# yii2-block extension

The extension allows manage html content block.

### Installation

- Install with composer:

```bash
composer require abdualiym/yii2-cms
```

- **After composer install** run console command for create tables:

```bash
php yii migrate/up --migrationPath=@vendor/abdualiym/yii2-cms/migrations
```

- Setup in common config storage and language configurations.
> language indexes related with database columns.

> Admin panel tabs render by array values order 

```php
'modules' => [
    'cms' => [ // don`t change module key
        'class' => '@abdualiym\cms\Module',
        'storageRoot' => $params['staticPath'],
        'storageHost' => $params['staticHostInfo'],
        'thumbs' => [ // 'sm' and 'md' keys are reserved
            'admin' => ['width' => 128, 'height' => 128],
            'thumb' => ['width' => 320, 'height' => 320],
        ],
        'languages' => [
            'ru' => [
                'id' => 0,
                'name' => 'Русский',
            ],
            'uz' => [
                'id' => 1,
                'name' => 'O`zbek tili',
            ],
        ],
        'menuActions' => [ // for add to menu controller actions
            '' => 'Home',
            'site/contacts' => 'Contacts',
        ]
    ],
],
```

- In admin panel add belove links for manage pages, article categories, articles and menu:
```php
/cms/pages/index
/cms/article-categories/index
/cms/articles/index
/cms/menu/index
```

> CKEditor use Elfinder plugin for save files and images. Refer [Elfinder readme](https://github.com/MihailDev/yii2-elfinder) for proper configuration