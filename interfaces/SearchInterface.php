<?php
namespace bl\search\interfaces;

/**
 * Interface for ActiveRecord entities
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
interface SearchInterface
{
    /**
     * @return string title field name or static string
     */
    public function getSearchTitle();

    /**
     * @return string description field name or static string
     */
    public function getSearchDescription();

    /**
     * ```php
     * return [
     *      'route' => 'blog/article/{categoryId}/{id}', // url pattern
     *      'categoryId' => 'category_id', // field name in the model
     *      'id' => 'id'
     * ];
     * ```
     * @return array route configuration
     */
    public function getSearchUrl();

    /**
     * @return string[] array of the fields names where you need the search
     */
    public function getSearchFields();
}