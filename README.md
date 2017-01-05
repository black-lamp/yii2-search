Component for search in Active Record model
===========================================

[![Build Status](https://travis-ci.org/black-lamp/yii2-search.svg?branch=master)](https://travis-ci.org/black-lamp/yii2-search)
[![Latest Stable Version](https://poser.pugx.org/black-lamp/yii2-search/v/stable)](https://packagist.org/packages/black-lamp/yii2-search)
[![Latest Unstable Version](https://poser.pugx.org/black-lamp/yii2-search/v/unstable)](https://packagist.org/packages/black-lamp/yii2-search)
[![License](https://poser.pugx.org/black-lamp/yii2-search/license)](https://packagist.org/packages/black-lamp/yii2-search)

Installation
------------
Run command
```
composer require black-lamp/yii2-search
```
or add
```json
"black-lamp/yii2-search": "2.0.0"
```
to the require section of your composer.json.
#### Add 'SiteSearch' component to application config
```php
'components' => [
      // ...
      'search' => [
            'class' => bl\search\SearchComponent::class,
            // models where you need the search
            'models' => [
                'article' => [
                    'class' => frontend\models\Article::class,
                    'label' => 'Articles'
                 ],
                // ...
            ]
      ],
]
```
To models array you should to add the active record models where component will be make a search.

`class` it's a model's name.

`label` it's a title for displaying in view.
#### Implement [interface](https://github.com/black-lamp/yii2-search/blob/master/interfaces/SearchInterface.php) in the models where you need a search
```php
/**
 * @property integer $id
 * @property string $title
 * @property string $shortText
 * @property string $fullText
 * @property string $socialNetworksText
 */
class Article extends ActiveRecord implements \bl\search\interfaces\SearchInterface
{
    // ...

    /**
     * @inheritdoc
     */
    public function getSearchTitle() {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription() {
        return $this->shortText;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl() {
       return Url::toRoute["/articles/$this->id"];
    }

   /**
    * @inheritdoc
    */
    public function getSearchFields() {
        return [
            'title',
            'shortText',
            'fullText'
        ];
    }
}
```
Using
-----
Call method for getting a search results.
This method return a [SearchResult](https://github.com/black-lamp/yii2-search/blob/master/data/SearchResult.php) objects in array.
```php
/**
 * @var \bl\search\data\SearchResult[] $result
 */
$result = Yii::$app->searcher->search('Black lamp');

foreach($result as $res) {
    $res->title;
    $res->description;
    $res->url;
}
```