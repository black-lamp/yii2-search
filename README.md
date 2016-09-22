Component for search on site for Yii2
=====================================
Installation
------------
#### Run command
```
composer require black-lamp/yii2-search
```
or add
```json
"black-lamp/yii2-search": "*"
```
to the require section of your composer.json.
#### Add 'SiteSearch' component to application config
```php
'components' => [
      // ...
      'search' => [
            'class' => bl\search\SiteSearch::className(),
            // models where you need the search
            'models' => [
                'blog' => [
                    'class' => frontend\models\Article::className()
                 ],
                // ...
            ]
      ],
]
```
#### Implement interface in the models where you need the search
```php
/**
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $text
 * @property string $short_text
 * @property string $key_words
 */
class Article extends ActiveRecord implements \bl\search\interfaces\SearchInterface
{
    // ...

        /**
         * @inheritdoc
         */
        public function getSearchTitle() {
            return 'title';
        }

        /**
         * @inheritdoc
         */
        public function getSearchDescription() {
            // $model - current model class object
            $description = function($model) {
                $textWithKeywords = $model->short_text . ' ' . $model->key_words;
                return $textWithKeywords;
            };
            
            return $description;
        }

        /**
         * @inheritdoc
         */
        public function getSearchUrl() {
           return [
               'route' => 'blog/article/{categoryId}/{id}', // url pattern
               'categoryId' => 'category_id', // field name in the model
               'id' => 'id'
           ];
        }

       /**
        * @inheritdoc
        */
        public function getSearchFields() {
            return [
                'title',
                'short_text',
                'text',
                'key_words'
            ];
        }
}
```
Using
-----
Call method for get search results
```php
/**
 * @var \bl\search\SearchResult[] $result
 */
$result = Yii::$app->search->s('Black lamp');

foreach($result as $res) {
    $res->title;
    $res->description;
    $res->url;
}
```