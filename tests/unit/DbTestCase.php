<?php
/**
 * @link https://github.com/black-lamp/yii2-search
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit;

/**
 * Base test case for unit tests with database
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class DbTestCase extends TestCase
{
    public function _before()
    {
        $this->loadFixtures();
    }

    public function _after()
    {
        $this->unloadFixtures();
    }
}