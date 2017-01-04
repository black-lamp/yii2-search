<?php
namespace bl\search\interfaces;

/**
 * Interface for building the search result
 * @see \bl\search\data\SearchResult
 *
 * You should to implement this interface in your Active Record model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
interface SearchInterface
{
    /**
     * Getting title
     *
     * @return string this string will be inserted to the search result
     * to `title` field
     */
    public function getSearchTitle();

    /**
     * Getting description
     *
     * @return string this string will be inserted to the search result
     * to `description` field
     */
    public function getSearchDescription();

    /**
     * Getting route
     *
     * @return string this string will be inserted to the search result
     * to `url` field
     */
    public function getSearchUrl();

    /**
     * @return string[] array of the field names
     * where will be implemented search in model
     */
    public function getSearchFields();
}