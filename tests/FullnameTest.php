<?php
namespace Grobmeier\PHPUnit;

class FullnameTest extends \PHPUnit_Framework_TestCase
{
	public function testCompare_1_1()
	{
        //should be valid when the word is equal
        $fname1 = new Fullname("OLISEMEKA");
        $fname2 = new Fullname("OLISEMEKA");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be valid when the case not same
        $fname1 = new Fullname("olisemeka");
        $fname2 = new Fullname("OLISEMEKA");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be invalid when the word is not same
        $fname1 = new Fullname("OLISEMEK");
        $fname2 = new Fullname("OLISEMEKA");
		$result = $fname1->compare($fname2);
        $this->assertEquals(false, $result);
    }

    public function testCompare_1_2()
	{
        //should be valid when it has 50% match
        $fname1 = new Fullname("OLISEMEKA");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);
        
        //should be valid when it has 50% match
        $fname1 = new Fullname("ADLINE");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);
    }

    public function testCompare_2_2()
	{
        //should be valid when words are same
        $fname1 = new Fullname("OLISEMEKA ADLINE");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be valid when contains comma
        $fname1 = new Fullname("OLISEMEKA, ADLINE");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be valid when contains dot
        $fname1 = new Fullname("OLISEMEKA. ADLINE");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be valid when contains extra space
        $fname1 = new Fullname("OLISEMEKA    ADLINE");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be valid when the words are swapped
        $fname1 = new Fullname("ADLINE OLISEMEKA");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be invalid when any one word are not same
        $fname1 = new Fullname("OLISEMEK ADLINE");
        $fname2 = new Fullname("OLISEMEKA ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(false, $result);
    }

    public function testCompareBiggerThan2()
	{
        //should be valid when count of words are same is 2
        $fname1 = new Fullname("OLISEMEKA ADLINE");
        $fname2 = new Fullname("OLISEMEKA SARAH ADLINE");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);
        
        //should be valid when count of words are same is 2
        $fname1 = new Fullname("OLISEMEKA ADLINE");
        $fname2 = new Fullname("ADLINE SARAH OLISEMEKA");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be valid when count of words are same is 2
        $fname1 = new Fullname("OLISEMEKA OLABISI ADLINE");
        $fname2 = new Fullname("ADLINE SARAH OLISEMEKA");
		$result = $fname1->compare($fname2);
        $this->assertEquals(true, $result);

        //should be invalid when count of words are same is less than 2
        $fname1 = new Fullname("OLISEMEK OLABISI ADLINE");
        $fname2 = new Fullname("ADLINE SARAH OLISEMEKA");
		$result = $fname1->compare($fname2);
        $this->assertEquals(false, $result);
    }
}
