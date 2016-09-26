<?php
namespace bl\search;

use yii;
use yii\base\Component;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

use bl\search\data\SearchResult;
use bl\search\interfaces\SearchInterface;

/**
 * Component for search on site
 *
 * Installation
 * Add this component to application config
 * ```php
 * 'components' => [
 *      // ...
 *      'search' => [
 *          'class' => bl\search\SiteSearch::className(),
 *           'models' => [
 *                'chat-message' => [
 *                   'class' => frontend\components\chat\entities\ChatMessage::className()
 *               ],
 *           ]
 *      ],
 * ]
 * ```
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @link https://github.com/black-lamp/yii2-search
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 */
class SiteSearch extends Component
{
    /**
     * @var array of the entities
     */
    public $models = [];

    /**
     * @var ActiveRecord|SearchInterface current entity
     */
    protected $_entity;

    /**
     * @var SearchResult[] array of the result
     */
    protected $_result = [];

    /**
     * Method for search
     *
     * Usage example
     * ```php
     * $result = Yii::$app->search->s("black lamp yii2");
     * ```
     *
     * @param string $keyword keyword for search
     * @return SearchResult[] array of the result objects
     * @throws Exception
     * @throws InvalidConfigException
     * @see SiteSearch::addToResult()
     */
    public function s($keyword) {
        foreach($this->models as $key => $model) {
            /** @var ActiveRecord|SearchInterface $entity */
            $entity = Yii::createObject($model['class']);
            /** @var ActiveRecord $modelName */
            $modelName = $entity::className();

            if($entity instanceof SearchInterface) {
                $query = $modelName::find();

                $searchFields = $entity->getSearchFields();
                foreach($searchFields as $field) {
                    if($entity->hasAttribute($field)) {
                        $query = $query->orWhere(['like', $field, $keyword]);
                    }
                    else {
                        $message = sprintf("Field '%s' not found in '%s'", $field, $modelName);
                        throw new Exception($message);
                    }
                }

                $query = $query->all();
                if($query != null) {
                    $this->_entity = $entity;
                    foreach($query as $object) {
                        $this->addToResult($object);
                    }
                }
            }
            else {
                $message = sprintf("'%s' not implement '%s' interface", $modelName, SearchInterface::class);
                throw new Exception($message);
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
     * @param ActiveQuery $queryRes
     * @see SiteSearch::getSearchItem()
     * @see SiteSearch::parseRouteConfig()
     */
    protected function addToResult($queryRes) {
        $title = $this->_entity->getSearchTitle();
        $titleVal = (is_callable($title)) ? $title($queryRes) : $this->getSearchItem($queryRes, $title);

        $description = $this->_entity->getSearchDescription();
        $descriptionVal = (is_callable($description)) ? $description($queryRes) : $this->getSearchItem($queryRes, $description);

        $url = $this->_entity->getSearchUrl();
        $urlVal = (is_callable($url)) ? $url($queryRes) : $this->parseRouteConfig($url, $queryRes);

        $resObject = new SearchResult($titleVal, $descriptionVal, $urlVal, $queryRes->className());
        $this->_result[] = $resObject;
    }

    /**
     * Method to verify the existence of field in the model
     *
     * @param ActiveQuery $queryRes
     * @param string $itemName
     * @return string
     */
    protected function getSearchItem($queryRes, $itemName) {
        return ($this->_entity->hasAttribute($itemName)) ? $queryRes->$itemName : $itemName;
    }

    /**
     * Method for parse route configuration from array
     *
     * @param array $config
     * @param ActiveQuery $queryRes
     * @return string
     * @throws Exception
     */
    protected function parseRouteConfig($config, $queryRes) {
        $url = '';

        // get route
        $route = $config['route'];
        unset($config['route']);

        // insert values on the route
        foreach($config as $key => $value) {
            if(!$this->_entity->hasAttribute($value)) {
                $message = sprintf("Field '%s' not found in '%s'", $value, $this->_entity->className());
                throw new Exception($message);
            }

            $url = strtr($route, [$key => $queryRes->$value]);
            $url = str_replace('{', '', $url);
            $url = str_replace('}', '', $url);
        }

        return $url;
    }
}