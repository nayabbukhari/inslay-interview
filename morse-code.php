/*
Morse Code
Overview
Morse Code is delivered in a series signals which are referred to as dashes (-) or dots (.). To keep things simple for the purposes of this challenge 
we'll only decode letters with a maximum length of three signals.
*/
class PossibilitiesSolution extends TestCase {
    public function testBasicCases() {
        $this->assertEquals(["E"], possibilities("."));
        $this->assertEquals(["A"], possibilities(".-"));
    }
  
    public function testAWordWithASingleUnknownSignal() {
        $this->assertEquals(["E","T"], possibilities("?"));
        $this->assertEquals(["I","N"], possibilities("?."));
        $this->assertEquals(["A","I"], possibilities(".?"));
    }
}


solutions:
function possibilities($signals) {
    $signals = str_replace(['.','?'], ['\.','[.-]'], $signals);
    $regexp = '~^'.$signals.'$~';

    $options = array(
        "A"=>".-",
        "B"=>"-...",
        "C"=>"-.-.",
        "D"=>"-..",
        "E"=>".",
        "F"=>"..-.",
        "G"=>"--.",
        "H"=>"....",
        "I"=>"..",
        "J"=>".---",
        "K"=>"-.-",
        "L"=>".-..",
        "M"=>"--",
        "N"=>"-.",
        "O"=>"---",
        "P"=>".--.",
        "Q"=>"--.-",
        "R"=>".-.",
        "S"=>"...",
        "T"=>"-",
        "U"=>"..-",
        "V"=>"...-",
        "W"=>".--",
        "X"=>"-..-",
        "Y"=>"-.--",
        "Z"=>"--..",
        "0"=>"-----",
        "1"=>".----",
        "2"=>"..---",
        "3"=>"...--",
        "4"=>"....-",
        "5"=>".....",
        "6"=>"-....",
        "7"=>"--...",
        "8"=>"---..",
        "9"=>"----.",
        "."=>".-.-.-",
        ","=>"--..--",
        "?"=>"..--..",
        "/"=>"-..-.",
        " "=>" "
        );

    $matches = array();
    foreach ($options as $key => $value) {
        if (preg_match($regexp, $value)) {
            array_push($matches, $key);
        }
    }
    
    return $matches;
}

$this->assertEquals(json_encode(sort(array("I","A"))), possibilities(json_encode(sort(array(".?")))));
