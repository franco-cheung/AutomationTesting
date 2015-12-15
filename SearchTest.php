<?php
require_once 'vendor/autoload.php';

class SearchTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://www.achievers.com/');
    }

    //simple test to check if search button is there
    public function testSearchButton()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->assertElementPresent('id=search_keyword');
        $this->close();
    }

    //test if the link from search result takes us to a new page
    public function testResultSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'award');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $beforeLocation = $this->getLocation();
        $this->click('//*[@id="search-results-wrapper"]/ul/li[1]/h4/a');
        $this->waitForPageToLoad(5000);
        $this->assertNotLocation($beforeLocation);
        $this->close();
    }

    //test with only a single word
    public function testShortSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'award');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementPresent('id=search_totals');
        $this->close();
    }

    //test with single character
    public function testSingleCharSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'a');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test with incomplete name
    public function testIncompleteSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'David Brenna');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test with complete name
    public function testCompleteSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'David Brennan');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000); 
        $this->assertElementPresent('id=search_totals');
        $this->close();
    }

    //test with upper and lower case characters
    public function testCaseSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'OuR MisSiOn');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementPresent('id=search_totals');
        $this->close();
    }

    //test for empty input
    public function testEmptySearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementNotPresent('id=search_totals');
        $this->close();
    }

    //test with numbers
    public function testNumberSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '2015');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementPresent('id=search_totals');
        $this->close();
    }

    //test with a combination of special characters and words
    public function testComboSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'memberexperience@achievers.com');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test with max character limit
    public function testMaxLimitSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'Toronto & San Francisco, September 9, 2015 — Achievers, a Blackhawk Network company and a leading provider of employee recognition and rewards solutions designed to help companies increase employee engagement, today released The Greatness Gap: The State of Employee Disengagement report. The report reveals that a large number of employees in North America and the United Kingdom (U.K.) are unhappy at work, disenchanted with the company’s mission and demotivated by lack of positive feedback from superiors. In December 2014, Achievers surveyed 397 employed people in North America (U.S. and Canada) and 391 employed people in the U.K. All surveyed were employed and between the ages of 18 and 60.');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementPresent('id=search_totals');
        $this->close();
    }

    //test precise search with double quote
    public function testPreciseSearch()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '""');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }


    //test a series of searches part 1
    public function testSeriesSearch1()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'memberexperience@achievers.com');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->assertElementNotPresent('id=search_totals');
        $this->type('id=search_keyword', 'award');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementPresent('id=search_totals');
        $this->assertElementNotContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.", "We couldn't find any results for your search.");
        $this->close();
    }

    //test a series of searches part 2
    public function testSeriesSearch2()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'award');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementPresent('id=search_totals');
        $this->assertElementNotContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.", "We couldn't find any results for your search.");
        $this->type('id=search_keyword', 'memberexperience@achievers.com');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->assertElementNotPresent('id=search_totals');
        $this->close();
    }

///////////////////////////////////////////////////////Test Special Characters/////////////////////////////////////////////////////////////////////////////////////////////////////////

    //test to only search for special character '&'
    public function testSpecialCharacterSearch0()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '&');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '>'
    public function testSpecialCharacterSearch1()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '>');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '<'
    public function testSpecialCharacterSearch2()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '<');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }


    //test to only search for special character '('
    public function testSpecialCharacterSearch3()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '(');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character ')'
    public function testSpecialCharacterSearch4()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', ')');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '{'
    public function testSpecialCharacterSearch5()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '{');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '}'
    public function testSpecialCharacterSearch6()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '}');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }

    //test to only search for special character '['
    public function testSpecialCharacterSearch7()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '[');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }

    //test to only search for special character ']'
    public function testSpecialCharacterSearch8()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', ']');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }

    //test to only search for special character '''
    public function testSpecialCharacterSearch9()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', "'");
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }

    //test to only search for special character '`'
    public function testSpecialCharacterSearch10()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', "`");
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '~'
    public function testSpecialCharacterSearch11()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', "~");
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }


    //test to only search for special character '"'
    public function testSpecialCharacterSearch12()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '"');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }


    //test to only search for special character '/'
    public function testSpecialCharacterSearch13()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '/');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementNotPresent('id=search_totals');
        $this->close();
    }

    //test to only search for special character '!'
    public function testSpecialCharacterSearch14()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '!');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '@'
    public function testSpecialCharacterSearch15()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '@');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }


    //test to only search for special character '#'
    public function testSpecialCharacterSearch16()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '#');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }

    //test to only search for special character '$'
    public function testSpecialCharacterSearch17()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '$');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();

    }

    //test to only search for special character '%'
    public function testSpecialCharacterSearch18()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '%');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }
    
    //test to only search for special character '^'
    public function testSpecialCharacterSearch19()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '^');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '*'
    public function testSpecialCharacterSearch20()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '*');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '-'
    public function testSpecialCharacterSearch21()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '-');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '_'
    public function testSpecialCharacterSearch22()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '_');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character +'
    public function testSpecialCharacterSearch23()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '+');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '?'
    public function testSpecialCharacterSearch24()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '?');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '.'
    public function testSpecialCharacterSearch25()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '.');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementNotPresent('id=search_totals');
        $this->close();
    }

    //test to only search for special character ','
    public function testSpecialCharacterSearch26()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', ',');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character ':'
    public function testSpecialCharacterSearch27()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', ':');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character ';'
    public function testSpecialCharacterSearch28()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', ';');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for special character '\'
    public function testSpecialCharacterSearch29()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', '\\');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(5000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

////////////////////////////////////////////////Special characters End////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////Test French Characters//////////////////////////////////////////////////////////////////////////////

    //test to only search for french character 'ë'
    public function testFrenchCharacter0()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ë');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ê'
    public function testFrenchCharacter1()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ê');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'è'
    public function testFrenchCharacter2()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'è');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'é'
    public function testFrenchCharacter3()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'é');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ô'
    public function testFrenchCharacter4()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ô');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'î'
    public function testFrenchCharacter5()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'î');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ï'
    public function testFrenchCharacter6()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ï');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ç'
    public function testFrenchCharacter7()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ç');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'â'
    public function testFrenchCharacter8()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'â');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'à'
    public function testFrenchCharacter9()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'à');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ÿ'
    public function testFrenchCharacter10()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ÿ');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ü'
    public function testFrenchCharacter11()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ü');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'û'
    public function testFrenchCharacter12()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'û');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

    //test to only search for french character 'ù'
    public function testFrenchCharacter13()
    {
        $this->open('http://www.achievers.com/');
        $this->click('id=option-search');
        $this->type('id=search_keyword', 'ù');
        $this->keyPress('id=search_keyword','\13');
        $this->pause(3000);
        $this->assertElementContainsText( 'id=search-results-wrapper', "We couldn't find any results for your search.");
        $this->close();
    }

/////////////////////////////////////////////////End of Test//////////////////////////////////////////////////////////////////////////////////////////
}
?>