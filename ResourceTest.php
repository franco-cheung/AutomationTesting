<?php
require_once 'vendor/autoload.php';

class ResourcePageTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://www.achievers.com/resource/');
    }

    //test if I can access the resource page from home page
    public function testLocation()
    {
        $this->open('http://www.achievers.com/');
        $this->assertElementContainsText('class=navbar-menu', 'Resources');
        $this->click('//*[@id="navbar-collapse-1"]/ul/li[4]/a');
        $this->waitForPageToLoad(5000);

        //get title of current page
        $title = $this->getTitle();
        $this->assertContains('Resources', $title);

        //get current url
        // $url = $this->getLocation();
        // $this->assertLocation('www.achievers.com/resource', $url);
        $this->close();

    }

    //test if the resources tab is active when on the resources page
    public function testActiveTab()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->assertElementContainsText('class=active-trail active', 'Resources');
        $this->close();
    }



////////////////////////////////////The Following Tests have empty keyword////////////////////////////////////////////
    //test drop-down with 'All' selected
    public function testAllDropDown()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(5000);
        //check if there are search results
        $this->assertElementPresent('class=view-content');
        $this->close();
    }

    //test drop-down with 'Analyst Insight' selected
    public function testAnalystDropDown()
    {
        $this->open('http://www.achievers.com/resource/');

        $select = $this->getSelectOptions('id=resource_search_contenttype');
        //var_dump($select);
        $this->select('id=resource_search_contenttype', $select[1]);
        $this->pause(3000);

        //check heading if I am searching the right tag
        $this->assertSelectedLabel('id=resource_search_contenttype', $select[1]);

        //check if the search result tag contains 'Analyst Insight'
        for($i = 1; $i <= 3; $i++)
        {
            if($this->isElementPresent('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']'))
            {
                $this->assertElementContainsText('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']', $select[1]);
            }
            else
            {
                break;
            }
        }

        //check url if type matches the current search
        $this->assertLocation('*Analyst*Insight*');

        $this->close();
    }

    //test drop-down with 'Case Study' selected
    public function testCaseDropDown()
    {
        $this->open('http://www.achievers.com/resource/');

        $select = $this->getSelectOptions('id=resource_search_contenttype');
        //var_dump($select);
        $this->select('id=resource_search_contenttype', $select[2]);
        $this->pause(3000);

        //check heading if I am searching the right tag
        $this->assertSelectedLabel('id=resource_search_contenttype', $select[2]);

        //check if the search result tag contains 'Case Study'
        for($i = 1; $i <= 3; $i++)
        {
            if($this->isElementPresent('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']'))
            {
                $this->assertElementContainsText('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']', $select[2]);
            }
            else
            {
                break;
            }
        }

        //check url if type matches the current search
        $this->assertLocation('*Case*Study*');

        $this->close();
    }

    //test drop-down with 'On-Demand Webinar' selected
    public function testOnDemandDropDown()
    {
        $this->open('http://www.achievers.com/resource/');

        $select = $this->getSelectOptions('id=resource_search_contenttype');
        //var_dump($select);
        $this->select('id=resource_search_contenttype', $select[3]);
        $this->pause(3000);

        //check heading if I am searching the right tag
        $this->assertSelectedLabel('id=resource_search_contenttype', $select[3]);

        //check if the search result tag contains 'On-Demand Webinar'
        for($i = 1; $i <= 3; $i++)
        {
            if($this->isElementPresent('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']'))
            {
                $this->assertElementContainsText('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']', $select[3]);
            }
            else
            {
                break;
            }
        }

        //check url if type matches the current search
        $this->assertLocation('*On*Demand*Webinar*');

        $this->close();
    }


    //test drop-down with 'report' selected
    public function testReportDropDown()
    {
        $this->open('http://www.achievers.com/resource/');

        $select = $this->getSelectOptions('id=resource_search_contenttype');
        //var_dump($select);
        $this->select('id=resource_search_contenttype', $select[4]);
        $this->pause(3000);

         //check heading if I am searching the right tag
        $this->assertSelectedLabel('id=resource_search_contenttype', $select[4]);

        //check if the search result tag contains 'Report'
        for($i = 1; $i <= 3; $i++)
        {
            if($this->isElementPresent('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']'))
            {
                $this->assertElementContainsText('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']', $select[4]);
            }
            else
            {
                break;
            }
        }

        //check url if type matches the current search
        $this->assertLocation('*Report*');

        $this->close();
    }


    //test drop-down with 'Whitepaper' selected
    public function testWhitepaperDropDown()
    {
        $this->open('http://www.achievers.com/resource/');

        $select = $this->getSelectOptions('id=resource_search_contenttype');
        //var_dump($select);
        $this->select('id=resource_search_contenttype', $select[5]);
        $this->pause(3000);

        //check heading if I am searching the right tag
        $this->assertSelectedLabel('id=resource_search_contenttype', $select[5]);

        //check if the search result tag contains 'Whitepaper'
        for($i = 1; $i <= 3; $i++)
        {
            if($this->isElementPresent('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']'))
            {
                $this->assertElementContainsText('//*[@id="asset_list"]/div/div[2]/div[' . $i . ']', $select[5]);
            }
            else
            {
                break;
            }
        }

        //check url if type matches the current search
        $this->assertLocation('*Whitepaper*');

        $this->close();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //test drop down if they are sorted in order
    public function testSortedDropDown()
    {
        $this->open('http://www.achievers.com/resource/');

        $unsorted = $this->getSelectOptions('id=resource_search_contenttype');
        $sorted = $this->getSelectOptions('id=resource_search_contenttype');
        sort($sorted);
        $this->assertEquals($unsorted, $sorted);
        $this->close();
    }

    //test for input with no search result
    public function testNoSearchResult()
    {
            $this->open('http://www.achievers.com/resource/');
            $this->type('id=resource_search_keyword','no search result');
            $this->click('id=resource_search_submit');
            $this->waitForPageToLoad(5000);

            //check if there are no search results
            $this->assertElementPresent('class=view-empty');
            $this->close();
    }

    //test for result in one drop down option, but not found in another drop down option
    public function testResultDropDownOption()
    {
            $this->open('http://www.achievers.com/resource/');
            $select = $this->getSelectOptions('id=resource_search_contenttype');

            //select 'Report' tag option in drop down
            $this->select('id=resource_search_contenttype', $select[4]);
            $this->type('id=resource_search_keyword','gartner');
            $this->click('id=resource_search_submit');
            $this->waitForPageToLoad(5000);

            //check if there are search results
            $this->assertElementPresent('class=view-content');

            //Switch to 'Case Study' tag option in drop down
            $this->select('id=resource_search_contenttype', $select[2]);
            $this->click('id=resource_search_submit');
            $this->waitForPageToLoad(5000);

            //check if there are no search result
            $this->assertElementPresent('class=view-empty');

            //Switch to 'All' tag option in drop down
            $this->select('id=resource_search_contenttype', $select[0]);
            $this->click('id=resource_search_submit');
            $this->waitForPageToLoad(5000);

            //check that the result exist
            $this->assertElementPresent('class=view-content');

            $this->close();
    }

    //Test simple search with results
    public function testSimpleSearch()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword', 'art');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(5000);

        //assert that the keyword 'art' is actually searched
        $this->assertElementContainsText('id=resource_search_criteria', '\'art\'');
        $this->assertElementPresent('class=view-content');
        $this->close();
    }

    //Test for number input search result
    public function testNumSearch()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword', '13');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(5000);

        $this->assertElementContainsText('id=resource_search_criteria', '\'13\'');
        $this->assertElementPresent('class=view-content');

        $this->close();    
    }

    //Test input that exceeds limit
    public function testExceedLimit()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword', 'The customer experience is an important factor in the race to becoming a winning brand. But disengaged front-line employees often create negative customer experiences—and they’re driving away your customers. In 2013, the U.S. economy left $1.9 trillion on table by failing to improve customer satisfaction rates, and subsequently losing customers. Your front-line employees have a direct connection with your customers, and a powerful impact on customer satisfaction.');
        $this->keyPress('id=resource_search_keyword','\13');
        $this->waitForPageToLoad(5000);

        //assert an error messag will appear if character exceeds 128 character 
        $this->assertElementPresent('class=element-invisible');
        $this->assertElementPresent('class=view-empty');

        $this->close();    
    }

    //Test input that is exactly 128 character long
    public function testMaxLimit()
    {
        $this->open('http://www.achievers.com/resource/');

        //the keyword is exactly 128 characters
        $this->type('id=resource_search_keyword', 'The customer experience is an important factor in the race to becoming a winning brand. But disengaged front-line employees ofte');
        $this->keyPress('id=resource_search_keyword','\13');
        $this->waitForPageToLoad(5000);

        //assert an error messag will appear if character exceeds 128 character 
        $this->assertElementNotPresent('class=element-invisible');
        $this->assertElementPresent('class=view-content');

        $this->close();    
    }

/////////////////////////////////////////Testing Special Characters As Input Keyword////////////////////////////////////////////////////////////
    //Test special character &
    public function testSpecialCharacterSearch0()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','&');
        $this->keyPress('id=resource_search_keyword','\13');
        $this->waitForPageToLoad(7000);

        //did not search for the keyword
        $this->assertElementNotContainsText('id=resource_search_criteria','*&*');

        //assert that no error msg was shown;
        $this->assertElementNotPresent('class=element-invisible');

        //however url link changes to searched keyword
        $this->assertLocation('*body=&*title=&');
        $this->close();
    }

    //Test special character <
    public function testSpecialCharacterSearch1()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','<');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'<\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character >
    public function testSpecialCharacterSearch2()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','>');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'>\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character (
    public function testSpecialCharacterSearch3()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','(');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'(\'');

   
   //assert that no error msg was shown         $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character )
    public function testSpecialCharacterSearch4()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword',')');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\')\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character {
    public function testSpecialCharacterSearch5()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','{');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'{\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character }
    public function testSpecialCharacterSearch6()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','}');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'}\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character }
    public function testSpecialCharacterSearch7()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','[');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'[\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character ]
    public function testSpecialCharacterSearch8()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword',']');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\']\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character [
    public function testSpecialCharacterSearch9()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','[');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'[\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character '
    public function testSpecialCharacterSearch10()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','\'');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'\'\'');

        //assert that no error msg was shown;
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character `
    public function testSpecialCharacterSearch11()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','`');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'`\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character ~
    public function testSpecialCharacterSearch12()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','~');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'~\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character "
    public function testSpecialCharacterSearch13()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','"');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'"\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character /
    public function testSpecialCharacterSearch14()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','/');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'/\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character \
    public function testSpecialCharacterSearch15()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','\\');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'\\\'');

        //assert that no error msg was shown;
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character !
    public function testSpecialCharacterSearch16()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','!');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'!\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character @
    public function testSpecialCharacterSearch17()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','@');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'@\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character #
    public function testSpecialCharacterSearch18()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','#');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        $this->assertElementNotContainsText('id=resource_search_criteria','\'#\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        //however url link changes to searched keyword
        $this->assertLocation("*body=#*title=#");
        $this->close();
    }

    //Test special character $
    public function testSpecialCharacterSearch19()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','$');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'$\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character %
    public function testSpecialCharacterSearch20()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','%');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'%\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character ^
    public function testSpecialCharacterSearch21()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','^');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //ssert that the keyword is being searched
        //$this->assertElementNotContainsText('id=resource_search_criteria','^');
        
        $this->assertElementPresent('class=view-empty');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');

        $this->close();
    }

    //Test special character *
    public function testSpecialCharacterSearch22()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','*');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'*\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character ;
    public function testSpecialCharacterSearch23()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword',';');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\';\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character :
    public function testSpecialCharacterSearch24()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword',':');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\':\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character -
    public function testSpecialCharacterSearch25()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','-');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'-\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character _
    public function testSpecialCharacterSearch26()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','_');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'_\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character +
    public function testSpecialCharacterSearch27()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','+');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        //for some reason its an empty search

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->assertElementContainsText('id=resource_search_criteria', '\'');
        $this->close();
    }

    //Test special character =
    public function testSpecialCharacterSearch28()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','=');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'=\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character ?
    public function testSpecialCharacterSearch29()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','?');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'?\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character .
    public function testSpecialCharacterSearch30()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','.');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\'.\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }

    //Test special character ,
    public function testSpecialCharacterSearch31()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword',',');
        $this->click('id=resource_search_submit');
        $this->waitForPageToLoad(7000);

        //assert that the keyword is being searched
        $this->assertElementContainsText('id=resource_search_criteria','\',\'');

        //assert that no error msg was shown
        $this->assertElementNotPresent('class=element-invisible');
        $this->close();
    }    

    //test result link by clicking image
    public function testResultImageLink()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','award');
        $this->click('id=resource_search_submit');
        $this->pause(5000);

        //assert that there are search results
        $this->assertElementContainsText('id=resource_search_criteria', '\'award\'');
        $this->assertElementPresent('class=view-content');
        $currentLocation = $this->getLocation();

        $this->click('//*[@id="asset_list"]/div/div[2]/div[1]/div/div[1]/a/img');
        $this->pause(5000);

        //check that I have been redirected to a new link
        $this->assertNotLocation($currentLocation);

        $this->close();
    }

    //test result link by clicking on text
    public function testResultTextLink()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','award');
        $this->click('id=resource_search_submit');
        $this->pause(5000);

        //assert that there are search results
        $this->assertElementContainsText('id=resource_search_criteria', '\'award\'');
        $this->assertElementPresent('class=view-content');
        $currentLocation = $this->getLocation();

        $this->click('//*[@id="asset_list"]/div/div[2]/div[1]/div/p[1]/a');
        $this->pause(5000);

        //check that I have been redirected to a new link
        $this->assertNotLocation($currentLocation);

        $this->close();
    }

    //test if a image exist (no 404 or broken images)
    public function testSimpleImage()
    {
        $this->open('http://www.achievers.com/resource/');
        $this->type('id=resource_search_keyword','award');
        $this->click('id=resource_search_submit');
        $this->pause(5000);

        //assert that there are search results
        $this->assertElementPresent('class=view-content');
        
        $img = $this->getAttribute('//*[@id="asset_list"]/div/div[2]/div[1]/div/div[1]/a/img/@src');
        
        //check if the image is not empty
        $this->assertNotEmpty($img);

        //check if image is not missing.jpg
        $this->assertNotContains('missing', $img);
        $this->close();
    }



            

    // //test up/down key when seleting from drop Down
    // public function testArrowKeyDropDown()
    // {
    //     $this->open('http://www.achievers.com/resource/');

    //     $select = $this->getSelectOptions('id=resource_search_contenttype');
    //     $numList = count($select);
    //     $this->click('id=resource_search_contenttype');
        
    //     //test down key
    //     for($i = 1; $i <= $numList; $i++)
    //     {
    //         $this->click('id=resource_search_contenttype');
    //         $this->keyPress('id=resource_search_contenttype', '\40');
    //         $this->keyPress('id=search_keyword','\13');
    //         $this->assertSelectedLabel('id=resource_search_contenttype', $select[$i]);
            
    //     }

    //     //test up key
    //     for($i = $numList; $i >= 0; $i--)
    //     {
    //         $this->click('id=resource_search_contenttype');
    //         $this->keyPress('id=resource_search_contenttype', '\38');
    //         $this->keyPress('id=search_keyword','\13');
    //         $this->assertSelectedLabel('id=resource_search_contenttype', $select[$i]);
            
    //     }


    //     $this->close();
    // }

    // //test if clicking on a key on the keyboard will guide to closest selection
    // public function testShortcutDropdown()
    // {
    //     $this->open('http://www.achievers.com/resource/');

    //     $select = $this->getSelectOptions('id=resource_search_contenttype');
    //     $numList = count($select);
    //     $this->click('id=resource_search_contenttype');
    //     $this->keyPress('id=resource_search_contenttype', '\114');
    //     $this->keyPress('id=resource_search_contenttype', '\13');
    //     $this->assertSelectedLabel('id=resource_search_contenttype', 'Report');

    //     $this->close();
    // }

    //test if drop down can accomondate a very long tag

    //test event trigger when changing from one drop down option to the next

    //test result view count

    //test date of publish of result
}   
?>