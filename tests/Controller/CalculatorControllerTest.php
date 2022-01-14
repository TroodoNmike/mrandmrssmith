<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public const ENTRY_FIELD = 'calculator[entry]';
    public const RESULT_SELECTOR = 'h1.display-1';

    private KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testCalculatorSetup(): void
    {
        $crawler = $this->client->request('GET', '/calculator');

        // check if input field exist
        $this->assertEquals(0, $crawler->filter('input[name="' . self::ENTRY_FIELD . '"]')->attr('value'));

        // check if buttons exist
        $this->assertSelectorTextContains('button[name="calculator[calculationType]"]:nth-child(1)', '+');
        $this->assertSelectorTextContains('button[name="calculator[calculationType]"]:nth-child(2)', '-');
        $this->assertSelectorTextContains('button[name="calculator[calculationType]"]:nth-child(3)', '*');
        $this->assertSelectorTextContains('button[name="calculator[calculationType]"]:nth-child(4)', '/');
        $this->assertCount(4, $crawler->filter('button[name="calculator[calculationType]"]'));

        $this->assertSelectorTextContains('a[role="button"]', 'Reset');
        $this->assertSelectorTextContains(self::RESULT_SELECTOR, 0);
        $this->assertResponseIsSuccessful();
    }

    /**
     * @dataProvider values
     */
    public function testCalculatorMix($signs, $numbers, $expectedResult): void
    {
        $crawler = $this->client->request('GET', '/calculator');

        for ($i = 0; $i < count($numbers); $i++) {
            $form = $crawler->selectButton($signs[$i])->form();
            $form->get(self::ENTRY_FIELD)->setValue($numbers[$i]);
            $this->client->click($form);
            $this->assertResponseIsSuccessful();
        }

        $this->assertSelectorTextContains(self::RESULT_SELECTOR, $expectedResult);
        $this->assertResponseIsSuccessful();
    }

    public function values(): array
    {
        return [
            // adding (+)
            [['+', '+'], [2, 2], 4],
            [['+', '+', '+'], [10, 5, 1], 16],
            [['+', '+', '+'], [10, 5, 5], 20],

            // subtracting (-)
            [['-', '-', '-'], [10, 5, 2], -17],
            [['+', '-', '-'], [10, 5, 2], 3],

            // multiply (*)
            [['+', '*', '*'], [1, 3, 3], 9],

            // divide (/)
            [['+', '/'], [10, 2], 5],

            // mix
            [['+', '-', '*', '/'], [12, 2, 10, 2], 50],
        ];
    }

    public function testExpectProblem(): void
    {
        $crawler = $this->client->request('GET', '/calculator');

        $form = $crawler->selectButton('/')->form();
        $this->client->click($form);

        $this->assertSelectorTextContains('div', 'Something went wrong');
    }
}
