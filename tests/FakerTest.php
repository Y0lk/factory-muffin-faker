<?php

use League\FactoryMuffin\Faker\Facade as Faker;

/**
 * @group faker
 */
class FakerTest extends PHPUnit_Framework_TestCase
{
    public function testGetGenerator()
    {
        $original = Faker::getGenerator();
        $new = Faker::setLocale('en_GB')->getGenerator();

        $this->assertInstanceOf('Faker\Generator', $original);
        $this->assertInstanceOf('Faker\Generator', $new);

        $this->assertFalse($original === $new);
    }

    public function testProviders()
    {
        $this->assertInternalType('array', $array = Faker::getProviders());
        $this->assertSame(Faker::getGenerator(), Faker::addProvider($array[0])->getGenerator());
    }

    public function testFormat()
    {
        $this->assertInstanceOf('Closure', Faker::format('foo'));
        $this->assertInstanceOf('Closure', $sentence = Faker::word());
        $this->assertInternalType('string', $sentence());
        $formatter = Faker::getFormatter('numberBetween');
        $this->assertSame(5, $formatter(5, 5));
    }

    public function testReset()
    {
        $original = Faker::instance();
        $new = Faker::reset();
        $this->assertInstanceOf('League\FactoryMuffin\Faker\Faker', $original);
        $this->assertInstanceOf('League\FactoryMuffin\Faker\Faker', $new);
        $this->assertNotEquals($original, $new);
    }
}
