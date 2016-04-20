<?php

namespace Nexy\PayboxDirect\Tests;

use Nexy\PayboxDirect\Paybox;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
class PayboxTest extends \PHPUnit_Framework_TestCase
{
    public function testValidOptions()
    {
        $client = new Paybox([
            'paybox_version' => Paybox::VERSION_DIRECT_PLUS,
            'paybox_site' => '1999888',
            'paybox_rang' => '32',
            'paybox_identifiant' => '107904482',
            'paybox_cle' => '1999888I',
        ]);

        $this->assertAttributeSame([
            'timeout' => 10,
            'production' => false,
            'paybox_devise' => 978,
            'paybox_version' => Paybox::VERSION_DIRECT_PLUS,
            'paybox_site' => '1999888',
            'paybox_rang' => '32',
            'paybox_identifiant' => '107904482',
            'paybox_cle' => '1999888I',
        ], 'options', $client);
    }

    public function testOverrideDefaultOptions()
    {
        $client = new Paybox([
            'timeout' => 5,
            'production' => true,
            'paybox_version' => Paybox::VERSION_DIRECT_PLUS,
            'paybox_site' => '1999888',
            'paybox_rang' => '32',
            'paybox_identifiant' => '107904482',
            'paybox_cle' => '1999888I',
        ]);

        $this->assertAttributeSame([
            'timeout' => 5,
            'production' => true,
            'paybox_devise' => 978,
            'paybox_version' => Paybox::VERSION_DIRECT_PLUS,
            'paybox_site' => '1999888',
            'paybox_rang' => '32',
            'paybox_identifiant' => '107904482',
            'paybox_cle' => '1999888I',
        ], 'options', $client);
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     *
     * @dataProvider getMissingOptionKeys
     */
    public function testMissingOption($option)
    {
        $requiredOptionsData = [
            'paybox_version' => Paybox::VERSION_DIRECT_PLUS,
            'paybox_site' => '1999888',
            'paybox_rang' => '32',
            'paybox_identifiant' => '107904482',
            'paybox_cle' => '1999888I',
        ];

        unset($requiredOptionsData[$option]);

        new Paybox($requiredOptionsData);
    }

    public function getMissingOptionKeys()
    {
        return [
            ['paybox_version'],
            ['paybox_site'],
            ['paybox_rang'],
            ['paybox_identifiant'],
            ['paybox_cle'],
        ];
    }
}
