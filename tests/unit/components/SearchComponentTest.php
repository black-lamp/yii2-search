<?php
namespace tests\unit\components;

use Yii;

use tests\unit\DbTestCase;
use tests\fixtures\ArticleFixture;

use bl\search\data\SearchResult;

/**
 * Test case for Search component
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SearchComponentTest extends DbTestCase
{
    /**
     * @var \bl\search\SearchComponent
     */
    private $component = null;


    public function fixtures()
    {
        return [
            'article' => [
                'class' => ArticleFixture::className()
            ]
        ];
    }

    public function _before()
    {
        parent::_before();

        $this->component = Yii::$app->get('searcher');
    }

    public function testSearch()
    {
        $query = 'Test article #1';

        /** @var SearchResult[] $result */
        $result = $this->component->search($query);

        $expected = $query;
        $actual = $result[0]->title;

        $this->assertEquals($expected, $actual, 'Method must find string in database');
    }

    public function testGetModelLabel()
    {
        $expected = 'Test label';
        $actual = $this->component->getModelLabel('tests\models\Article');

        $this->assertEquals($expected, $actual, 'Method must return model label');
    }
}