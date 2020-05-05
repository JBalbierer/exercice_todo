<?php 

namespace App\Tests\Unit;

use App\Service\FrequenceMots;
use App\Entity\Todo;
use PHPUnit\Framework\TestCase;

class FrequenceMotsTest extends TestCase
{
    public function testgetAllTodosInOneString()
    {
        $frequencemots = new FrequenceMots();

        $expect = "mise en place de la base de données";

        $todo1 = new Todo();
        $todo2 = new Todo();
        $todo1->setTodoTitre("Mise en place");
        $todo2->setTodoTitre("de la base de données");

        $result = $frequencemots->getAllTodosInOneString(array($todo1, $todo2));

        $this->assertEquals($expect, $result);
    }

    public function testgetAllWordsInAnArray()
    {
        $frequencemots = new FrequenceMots();

        $expect = array("mise", "en", "place", "de", "la", "base", "de", "données");
        
        $result = $frequencemots->getAllWordsInAnArray("mise en place de la base de données");

        $this->assertEquals($expect, $result);
    }

    public function testgetWordsCount()
    {
        $frequencemots = new FrequenceMots();

        $expect = array("mise"=>1, "en"=>1, "place"=>1, "de"=>2, "la"=>1, "base"=>1, "données"=>1);
        
        $result = $frequencemots->getWordsCount(array("mise", "en", "place", "de", "la", "base", "de", "données"));

        $this->assertEquals($expect, $result);
    }

    public function testgetWordMax()
    {
        $frequencemots = new FrequenceMots();

        $expect = "de";
        
        $result = $frequencemots->getWordMax(array("mise"=>1, "en"=>1, "place"=>1, "de"=>2, "la"=>1, "base"=>1, "données"=>1));

        $this->assertEquals($expect, $result);
    }
}