// const arabicWords = document.querySelectorAll('.--arabic-word');
// let counter = -1;
// let completed = false;
// let paused = false;
//
// const intervalFunction = setInterval(function () {
//     if (paused) {
//         clearInterval(interval);
//     }
//
//     if ((arabicWords.length > 2 && Math.random() < 0.5 && counter > -1)) {
//         console.log("Paused!")
//         clearInterval(intervalFunction);
//     }
//
//     counter = (counter + 1) % arabicWords.length;
//     const currentWord = arabicWords[counter];
//
//     const arabicValue = currentWord.getAttribute('data-selected-word-arabic-value');
//     const transliterationValue = currentWord.getAttribute('data-selected-word-transliteration-value');
//     // Set the html content of the elements with the "quranic-arabic" and "quranic-transliteration" ids
//     document.getElementById('quranic-arabic').innerHTML = arabicValue;
//     document.getElementById('quranic-transliteration').innerHTML = transliterationValue;
//
//     if (counter === arabicWords.length) {
//         completed = true;
//         clearInterval(intervalFunction);
//     }
// });
//
// var intervalId = intervalFunction;
//
// var restartInterval = function() {
//     intervalId = intervalFunction;
//     console.log(intervalId)
//
// };
//
// const button = document.querySelector('#continue-button');
// button.addEventListener('click', function () {
//     restartInterval();
// });