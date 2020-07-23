<?php
namespace Grobmeier\PHPUnit;

class Fullname 
{
	private $fname; 
    private $words;

	public function __construct($fname)
	{
        $this->ensureIsValidFullname($fname);
        $this->fname = $fname;
        $this->words = $this->removeEmptyWords($this->multiexplode(array(",", " ", "."), strtoupper($this->fname)));
	}

    //To check fullname is valid
    private function ensureIsValidFullname(string $fname)
    {
        if ($fname == "") {
            throw new \InvalidArgumentException(
                sprintf(
                    'fullname is empty.'
                )
            );
        }
    }

    //To explode by multi charactor
    private function multiexplode($delimiters,$string)
    {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }

    //To remove empty words
    private function removeEmptyWords($words)
    {
        for($i = 0; $i < count($words); $i++){
            if($words[$i] == ""){
                array_splice($words, $i, 1);
                $i--;
            }
        }
        return $words;
    }

    public function getWords()
    {
        return $this->words;
    }

    //To compare function
    public function compare($ofname)
    {
        //get words from other fullname
        $owords = $ofname->getWords();
        if(count($owords) == 0 || count($this->words) == 0)
        {
            return false;
        }
        //check is valid when the percentage of match is bigger than 50%
        if(count($owords) + count($this->words) <= 3)
        {
            foreach($this->words as $word)
            {
                if(in_array($word, $owords, TRUE))
                {
                    return true;
                }
            }
        }
        //check is valid when the length of string longer than 2
        else
        {
            $matchCnt = 0;
            foreach($this->words as $word)
            {
                if(in_array($word, $owords, TRUE))
                {
                    $matchCnt ++;
                }
                if($matchCnt >=2){
                    return true;
                }
            }
        }
        return false;
    }
}
