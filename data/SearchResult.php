<?php
namespace bl\search\data;

use Yii;
use yii\base\Configurable;
use yii\db\BaseActiveRecord;

use bl\search\interfaces\SearchInterface;

/**
 * Class for contain of search result
 *
 * @property string $title
 * @property string $description
 * @property string $url
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SearchResult implements Configurable
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $url;
    /**
     * @var integer
     */
    public $modelId;
    /**
     * @var string
     */
    public $modelName;


    /**
     * SearchResult constructor.
     *
     * @param integer $modelId
     * @param string $modelName
     * @param array $options
     */
    public function __construct($modelId, $modelName, array $options = [])
    {
        $this->modelId = $modelId;
        $this->modelName = $modelName;

        Yii::configure($this, $options);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * Method for building the class object from Active Record object
     *
     * @param BaseActiveRecord|SearchInterface $modelObject
     * @return SearchResult
     */
    public static function build($modelObject)
    {
        $options = [
            'title' => $modelObject->getSearchTitle(),
            'description' => $modelObject->getSearchDescription(),
            'url' => $modelObject->getSearchUrl()
        ];

        return new SearchResult(
            $modelObject->getPrimaryKey(),
            $modelObject::className(),
            $options
        );
    }

    /**
     * Method for sorting results of search by model name
     *
     * @param SearchResult[] $searchResult
     * @return SearchResult[]
     */
    public static function sortByModel($searchResult)
    {
        $sortedResult = [];
        foreach($searchResult as $obj) {
            $sortedResult[$obj->modelName][] = $obj;
        }

        return $sortedResult;
    }
}