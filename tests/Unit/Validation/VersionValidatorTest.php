<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 project  - inspiring people to share!
 * (c) 2020 Oliver Bartsch & Benni Mack
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace TYPO3\Tailor\Tests\Unit\Validation;

use PHPUnit\Framework\TestCase;
use TYPO3\Tailor\Validation\VersionValidator;

class VersionValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function isInvalidIfNoFileFound()
    {
        $subject = new VersionValidator(__DIR__ . '/no-file');
        self::assertFalse($subject->isValid('1.2.0'));
    }

    /**
     * @test
     */
    public function isInvalidIfFileDoesNotMatchEmConfStructure()
    {
        $subject = new VersionValidator(__DIR__ . '/../Fixtures/EmConf/emconf_invalid.php');
        self::assertFalse($subject->isValid('1.0.0'));
    }

    /**
     * @test
     */
    public function isInvalidIfNoVersionGiven()
    {
        $subject = new VersionValidator(__DIR__ . '/../Fixtures/EmConf/emconf_no_version.php');
        self::assertFalse($subject->isValid('1.0.0'));
    }

    /**
     * @test
     */
    public function isValidMatchesVersion()
    {
        $subject = new VersionValidator(__DIR__ . '/../Fixtures/EmConf/emconf_valid.php');
        self::assertFalse($subject->isValid('1.2.0'));
        self::assertTrue($subject->isValid('1.0.0'));
    }
}
