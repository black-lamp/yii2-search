<?php
/**
 * @link https://github.com/black-lamp/yii2-search
 * @copyright Copyright (c) 2016 Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace tests\unit;

use yii\test\FixtureTrait;

/**
 * Base test case for unit tests
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class TestCase extends \Codeception\Test\Unit
{
    use FixtureTrait;


    /**
     * @var \UnitTester
     */
    protected $tester;
}