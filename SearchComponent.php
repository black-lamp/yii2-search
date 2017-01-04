<?php
namespace bl\search;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;

use bl\search\data\SearchResult;
use bl\search\interfaces\SearchInterface;

/**
 * Component for search on site in Active Record models
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SearchComponent extends Component
{
    /**
     * @var array of the models
     * Example:
     * ```php
     * 'models' => [
     *      'articles' => [
     *          'class' => Article::class,
     *          'label' => 'Articles'
     *      ],
     *      'products' => [
     *          'class' => Product::class,
     *          'label' => 'Shop products'
     *      ]
     * ]
     * ```
     */
    public $models = [];

    /**
     * @var string current model class
     */
    protected $_currentModel;
    /**
     * @var SearchResult[] array of the search results
     */
    protected $_result = [];

    /**
     * Method for searching
     *
     * Example
     * ```php
     * $result = Yii::$app->searcher->search("black lamp yii2");
     * ```
     *
     * @param string $query keyword for search
     * @return SearchResult[] array of the result objects
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function search($query) {
        foreach($this->models as $model) {
            /** @var ActiveRecordInterface|SearchInterface $ar */
            $ar = Yii::createObject($model['class']);

            if($ar instanceof SearchInterface && $ar instanceof ActiveRecordInterface) {
                $searchFields = $ar->getSearchFields();
                $activeQuery = $ar::find()->select($searchFields);

                foreach($searchFields as $field) {
                    if($ar->hasAttribute($field)) {
                        $activeQuery = $activeQuery->orWhere(['like', $field, $query]);
                    }
                    else {
                        $message = sprintf("Field `%s` not found in `%s` model", $field, $ar);
                        throw new Exception($message);
                    }
                }

                $modelObjects = $activeQuery->all();
                if($modelObjects != null) {
                    $this->_currentModel = $ar;
                    $this->addToResult($modelObjects);
                }
            }
            else {
                $message = sprintf("%s should be instance of `%s` and `%s`", $ar, SearchInterface::class, ActiveRecordInterface::class);
                throw new InvalidConfigException($message);
            }
        }

        return $this->_result;
    }

    /**
     * Method for getting model label by model name
     *
     * @param string $modelName
     * @return null|string
     */
    public function getModelLabel($modelName)
    {
        foreach($this->models as $model) {
            if($model['class'] == $modelName) {
                return $model['label'];
            }
        }

        return null;
    }

    /**
     * Method for adding search result to the array of the results
     *
     * @param \yii\db\ActiveRecord[] $modelObjects
     */
    protected function addToResult($modelObjects) {
        foreach ($modelObjects as $object) {
            $this->_result[] = SearchResult::build($object);
        }
    }
}