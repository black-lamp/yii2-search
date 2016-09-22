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
     * @return string|object title - field name in the model, static string or anonymous function
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
     * @return string|object description - field name in the model, static string or anonymous function
     */
    public function getSearchDescription();

    /**
     * Array of route configuration
     * ```php
     * return [
     *      'route' => 'blog/article/{categoryId}/{id}', // url pattern
     *      'categoryId' => 'category_id', // field name in the model
     *      'id' => 'id'
     * ];
     * ```
     *
     * Anonymous function
     * ```php
     * // $model - current model class object
     * $url = function($model) {
     *      return Url::toRoute(['articles/article/index', 'id' => $model->article_id]);
     * };
     * ```
     *
     * @return array|object route configuration or anonymous function
     */
    public function getSearchUrl();

    /**
     * @return string[] array of the fields names where you need the search
     */
    public function getSearchFields();
}