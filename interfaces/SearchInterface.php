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
     * ```php
     * // $model - current model class object
     * $title = function($model) {
     *      $fullname = $model->firstname . ' ' . $model->lastname;
     *      return $fullname;
     * };
     * ```
     * @return string title - field name in the model, static string or anonymous function
     */
    public function getSearchTitle();

    /**
     * ```php
     * // $model - current model class object
     * $title = function($model) {
     *      $text = $model->text . ' ' . $model->keywords;
     *      return $text;
     * };
     * ```
     * @return string description - field name in the model, static string or anonymous function
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