function speakWord(word) {
    let sound = new SpeechSynthesisUtterance(decodeURIComponent(word));
    sound.lang = "fr-FR";
    sound.rate = 0.9;
    sound.pitch = 0.9;
    speechSynthesis.speak(sound);
}
