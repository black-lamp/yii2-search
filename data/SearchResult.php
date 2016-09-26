<?php
namespace bl\search\data;

/**
 * Class for contain of search result
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @property string $title
 * @property string $description
 * @property string $url
 */
class SearchResult
{
    public $title;
    public $description;
    public $url;
    protected $modelName;

    /**
     * SearchResult constructor.
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $modelName
     */
    public function __construct($title, $description, $url, $modelName)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->modelName = $modelName;
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
     * @param SearchResult[] $searchResult
     * @return SearchResult[]
     */
    public static function sortByModel($searchResult)
    {
        $result = [];
        foreach($searchResult as $obj) {
            $result[$obj->modelName][] = $obj;
        }

        return $result;
    }
}