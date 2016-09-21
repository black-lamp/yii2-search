<?php
namespace bl\search\data;

/**
 * Class for contain of search result
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SearchResult
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
     * SearchResult constructor.
     * @param string $title
     * @param string $description
     * @param string $url
     */
    public function __construct($title, $description, $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
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
}