<?php
/**
 * @link https://github.com/black-lamp/yii2-search
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit\data;

use yii\base\Configurable;

use tests\models\Article;
use tests\unit\TestCase;

use bl\search\data\SearchResult;

/**
 * Test case for SearchResult class
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SearchResultTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf(Configurable::class, new SearchResult(null, null),
            'Class should be instance of `yii\base\Configurable`');
    }

    public function testBuild()
    {
        $expectedModelId = 1;
        $expectedModelName = 'tests\models\Article';
        $expectedTitle = 'Test title';
        $expectedDescription = 'Test description';
        $expectedUrl = '/articles/1';

        $model = new Article([
            'id' => $expectedModelId,
            'title' => $expectedTitle,
            'shortText' => $expectedDescription
        ]);

        $object = SearchResult::build($model);

        $this->assertEquals($expectedModelId, $object->getModelId(), 'Model id is wrong');
        $this->assertEquals($expectedModelName, $object->getModelName(), 'Model name is wrong');
        $this->assertEquals($expectedTitle, $object->title, 'Title is wrong');
        $this->assertEquals($expectedDescription, $object->description, 'Description is wrong');
        $this->assertEquals($expectedUrl, $object->url, 'URL is wrong');
    }
}