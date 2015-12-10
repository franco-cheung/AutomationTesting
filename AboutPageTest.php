<?php
require_once 'vendor/autoload.php';

class AboutPageTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://www.achievers.com/about/');
    }

    //test if I can access the about page from the home page
    public function testLocation()
    {
        $this->open('http://www.achievers.com/');
        $this->assertElementContainsText('class=navbar-menu', 'Who We Are');
        $this->click('//*[@id="navbar-collapse-1"]/ul/li[2]/a');
        $this->waitForPageToLoad(5000);
        $title = $this->getTitle();
        $this->assertContains('Who We Are', $title);
        $this->close();

    }

    //test if the 'who we are' is active when on the about page
    public function testActiveMenu()
    {
        $this->open('http://www.achievers.com/about/');
        $this->assertElementContainsText('class=active-trail active', 'Who We Are');
        $this->close();

    }

    //test content on 'Our Mission' whether the content exist or not
    public function testMissionContent()
    {
        $this->open('http://www.achievers.com/about/');
        $this->assertElementPresent('id=mission');
        $text = $this->getText('id=mission');

        //would of been suitable if i had compared the metadata text with the text pulled from webpage
        $this->assertElementContainsText('id=mission', $text);
        $this->assertTextPresent($text);
        $this->close();
    }

    //test if popup shows up when you click on '+' sign
    public function testLeaderShipPopup()
    {
        $this->open('http://www.achievers.com/about/');
        $this->assertNotVisible('id=people_card');

        //had to hard code because I couldnt find the proper $locator
        $this->click('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[1]/span');
        $this->pause(5000);

        //could also check if an event have triggered as well
        $this->assertVisible('id=people_card');

        //check style if it is a block
        $this->assertAttribute('css=#people_card_wrapper@style', '*display: block*');
        $this->close();
    }

    //test if image loaded on leadership
    public function testImageLoad()
    {
        $this->open('http://www.achievers.com/about/');

        //check if the image on the leader section is loaded
        for($i = 1; $i <= 14; $i++)
        {
            $img = $this->getAttribute('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[' . $i . ']/div/img/@src');

            //assert image is not empty
            $this->assertNotEmpty($img);

            //assert that the image is not broken
            $this->assertNotContains('missing', $img);
        }
        
        
        $this->close();
    }

    //test if popup shows content and matched the name of the person you've clicked
    public function testLeaderShipPopupContent()
    {
        $this->open('http://www.achievers.com/about/');

        for($i = 1; $i <= 14; $i++)
        {
            $name = $this->getText('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[' . $i . ']/h5');
            $title = $this->getText('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[' . $i . ']/p/span[1]');
            $department = $this->getText('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[' . $i . ']/p/span[2]');
            $img = $this->getAttribute('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[' . $i . ']/div/img/@src');
            $this->click('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[' . $i . ']/span');
            $this->pause(3000);
            $this->assertVisible('id=people_card');
            $this->assertElementContainsText('//*[@id="people_card"]/div/div[2]/div[2]', $name);
            $this->assertElementContainsText('//*[@id="people_card"]/div/div[3]/div[1]', $title);

            //some leaders dont have a department
            if(!empty($department))
            {
                $department = substr($department, 2);
                $this->assertElementContainsText('//*[@id="people_card"]/div/div[3]/div[2]', $department);
            }
            
            $popupImg = $this->getAttribute('//*[@id="people_card"]/div/div[2]/div[1]/img/@src');
            $this->assertContains($popupImg, $img);
            $description = $this->getText('//*[@id="people_card"]/div/div[4]');
            $this->assertTextPresent($description);
            $this->click('id=close-button');
        }
        $this->close();
        
    }

    //test if leadership popup closes if you click outside the popup
    public function testClickOutsidePopup()
    {
        $this->open('http://www.achievers.com/about/');
        $this->assertNotVisible('id=people_card');

        //had to hard code because I couldnt find the proper $locator
        $this->click('//*[@id="leadership"]/div/div[2]/div/div/div/div/ul/li[1]/span');
        $this->pause(5000);

        //could also check if an event have triggered as well
        $this->assertVisible('id=people_card');

        $this->click('id=values');

        $this->assertVisible('id=people_card');
        $this->close();
    }



    //test values's content
    public function testValueContent()
    {
        $this->open('http://www.achievers.com/about/');
        $this->assertElementPresent('id=values_intro');
        $text = $this->getText('id=values_intro');
       
        //would of been suitable if i had compared the metadata text with the text pulled from webpage
        $this->assertElementContainsText('id=values_intro', $text);
        $this->assertTextPresent($text);
        $this->close();
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //test mouse hover over the value's content
    public function testValuesMouseHover()
    {
        $this->open('http://www.achievers.com/about/');

        for($i = 1; $i <= 8; $i++)
        {
            $this->assertNotVisible('//*[@id="values"]/div/div/div[' . $i . ']/div/div[2]');
            $this->mouseOver('//*[@id="values"]/div/div/div[' . $i . ']');
            //$this->assertVisible('//*[@id="values"]/div/div/div[1]/div/div[2]');   

        }

        $this->close();
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //test value definition and its description
    public function testValueDefinition()
    {
        $this->open('http://www.achievers.com/about/');

        for($i = 1; $i <= 8; $i++)
        {
            $definition = $this->getText('//*[@id="values"]/div/div/div[' .  $i . ']/div/div[1]');
            $description = $this->getText('//*[@id="values"]/div/div/div[' . $i . ']/div/div[2]');
            $this->assertElementContainsText('//*[@id="values"]/div/div/div[' . $i . ']', $definition);
            $this->assertElementContainsText('//*[@id="values"]/div/div/div[' . $i . ']', $description);

            //output value and its definition
            print($definition . "\n\n");
            print($description . "\n\n");
        }
        $this->close();
        
    }

    // //test to see if i have a token/id (ie check if i am a user on the page)
    //  public function testToken()
    // {
    //     $this->open('http://www.achievers.com/about/');
    //     $token = $this->getCookie();
    //     if(!empty($token))
    //     {
    //         return true;
    //     }
    //     else
    //     {
    //         return false;
    //     }

    //     $this->close();
    // }

    // //test content of leadership (ie. the total of people present should match with the number of leaders in the database) 
    // // public function testLeaderShipContent()
    // // {
    // //     $this->open('http://www.achievers.com/about/');
    // //     $this->assertElementPresent('id=leadership');
    // //     $indexes = $this->getTable('people.3.6');
    // //     print($indexes);
    // // }

    

    //test latency

    //test network traffic

    //test triggering event handler when clicking on leadership bio
}
?>