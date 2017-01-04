<?php
namespace tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Fixture for Article model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class ArticleFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'tests\models\Article';
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/article.php';
}