    
    
// REAL ONE 

    // Function to handle speech synthesis


function speak(text) {
    const utterance = new SpeechSynthesisUtterance(text);
    speechSynthesis.speak(utterance);
  }

