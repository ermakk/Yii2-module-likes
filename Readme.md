# yii2-module-likes
[![Build Status](https://travis-ci.org/ermakk/yii2-module-likes.svg?branch=master)](https://travis-ci.org/ermakk/yii2-module-likes)
[![Latest Stable Version](https://poser.pugx.org/ermakk/yii2-module-likes/v/stable)](https://packagist.org/packages/ermakk/yii2-module-likes)
[![Latest Unstable Version](https://poser.pugx.org/ermakk/yii2-module-likes/v/unstable)](https://packagist.org/packages/ermakk/yii2-module-likes)
[![Total Downloads](https://poser.pugx.org/ermakk/yii2-module-likes/downloads)](https://packagist.org/packages/ermakk/yii2-module-likes)
[![License](https://poser.pugx.org/ermakk/yii2-module-likes/license)](https://packagist.org/packages/ermakk/yii2-module-likes)

## Информация о модуле

Простой модуль для добавления системы лайков на записи любых моделей. Модуль не требует дополнительных полей. Он создает одну таблицу в базе и ассоциирует голоса с записями по ID, модели и ID пользователя.
Повторное нажатие на лайк отменяет его.

Основными компонентами модуля являются:

- `ermakk\Yii2-module-likes\widgets\LikesButton` \- виджет для кнопки лайков;

## Установка

Устанавливаем модуль:

```bash
composer require ermakk/yii2-module-likes 
```

Далее выполняем миграцию для создания таблицы `ermakk_likes`

```bash
$ ./yii migrate --migrationPath=@common/modules/ermakk/yii2-module-likes/src/migrations/
```

В `@common/config/bootstrap.php` добавить

```php
    Yii::setAlias('@ermakk/likes', dirname(dirname(__DIR__)) . '/common/modules/ermakk/Yii2-module-likes/src');
```

Так как для работы модуля требуются контроллеры, прописываем модуль в конфигурации Yii2 приложения:

```php
    ...
    'modules' => [
           'votes' => [
                'class' => 'ermakk\likes\LikesModule',
            ],
        ],
    ...
```

## Настройка

По умолчанию настройки модуля имеют следующие параметры:

```php
    'pluginOptions' => [
        'buttonClass' => 'like-true btn', //класс для кнопки лайка
        'buttonClassTrueState' => 'btn-outline-secondary', //дополнительный класс для кнопки в отмеченном состоянии
        'buttonClassFalseState' => 'btn-outline-primary', //дополнительный класс для кнопки в неотмеченном состоянии
        'icoTrueState' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>', //тег для изображения кнопки в отмеченном состоянии
        'icoFalseState' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>',//тег для изображения кнопки в неотмеченном состоянии
        'counterClass' => 'count-likes', //класс для счетчика на кнопке
    ];

    'behaviors' => [
        'beforeLike' => '', //js функция выполняемая перед добавления лайка
        'afterLike' => '', //js функция выполняемая после добавления лайка
    ];
```

Для того чтобы задать свои стили кнопки или виджета, измените эти настройки. Если нужна будет более серьезная доработка \- выносите модуль и изменяйте сам модуль.
