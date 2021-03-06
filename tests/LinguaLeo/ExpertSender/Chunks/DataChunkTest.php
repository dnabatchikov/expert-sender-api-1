<?php
namespace LinguaLeo\ExpertSender\Chunks;

class DataChunkTest extends \PHPUnit_Framework_TestCase
{
    public function testGetText()
    {
        $bodyChunk1 = $this->getMock('LinguaLeo\ExpertSender\Chunks\SimpleChunk', ['getText'], [], '', false);
        $bodyChunk1->expects($this->once())->method('getText')->will($this->returnValue('data1'));
        $bodyChunk2 = $this->getMock('LinguaLeo\ExpertSender\Chunks\SimpleChunk', ['getText'], [], '', false);
        $bodyChunk2->expects($this->once())->method('getText')->will($this->returnValue('data2'));

        $dataChunk = new DataChunk('subscriber');
        $dataChunk->addChunk($bodyChunk1);
        $dataChunk->addChunk($bodyChunk2);

        $text = $dataChunk->getText();
        $this->assertRegExp('~subscriber~', $text);
        $this->assertRegExp('~data1~', $text);
        $this->assertRegExp('~data2~', $text);
    }
}