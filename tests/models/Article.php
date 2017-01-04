<?php
/**
 * @link https://github.com/black-lamp/yii2-search
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\models;

use yii\db\ActiveRecord;

use bl\search\interfaces\SearchInterface;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $shortText
 * @property string $fullText
 * @property string $socialNetworksText
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Article extends ActiveRecord implements SearchInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function getSearchTitle()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription()
    {
        return $this->shortText;
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl()
    {
        return "/articles/$this->id";
    }

    /**
     * @inheritdoc
     */
    public function getSearchFields()
    {
        return [
            'title',
            'shortText',
            'fullText'
        ];
    }
}