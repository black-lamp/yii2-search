<?php
namespace bl\search\interfaces;
use yii\db\ActiveQueryInterface;

/**
 * Interface for searching
 *
 * @author Gutsulyak Vadim <guts.vadim@gmail.com>
 */
interface SearcherInterface extends SearchInterface
{
    /**
     * @param string $query  keyword for search
     * @return ActiveQueryInterface
     */
    public function search($query);
}