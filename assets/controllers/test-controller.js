// const arabicWords = document.querySelectorAll('.--arabic-word');
// const container = document.getElementById("quranic-questions");
// const lastverse = document.getElementById("last-verse-warning");
//
// const labels = container.querySelectorAll('label');
// const inputs = container.querySelectorAll('input');
//
// let counter = 1;
// let selector = 0;
// let completed = false;
// let paused = false;
// let started = false;
// const period = 750;
// let lastWasPaused = false;
// let currentValues = [];
//
// function initValues() {
//     let option;
//     for (let i = 0; i < arabicWords.length; i++) {
//         option = get_text(i);
//         currentValues.push(option["transliteration"]);
//     }
// }
//
// const continueButton = document.querySelector('#continue-button');
// continueButton.addEventListener('click', function () {
//     let checked = false;
//
//     for (let i = 0; i < inputs.length; i++) {
//         if (inputs[i].checked === true) {
//             checked = true;
//             inputs[i].checked = false;
//         }
//     }
//
//     if (checked) {
//         hide_options();
//         lastWasPaused = true;
//         fill_text(selector);
//         do_exercise(function () {
//             load()
//         }, period, (arabicWords.length - (counter - 1)));
//     }
//
// });
//
// const start = document.querySelector('#start-button');
// start.addEventListener('click', function () {
//     start.innerHTML = "Restart";
//     counter = 1;
//     selector = 0;
//
//     lastverse.classList.add("d-none");
//     lastverse.classList.remove("d-block");
//
//     do_exercise(function () {
//         load()
//     }, period, (arabicWords.length - (counter - 1)));
// });
//
// /* Randomize array in-place using Durstenfeld shuffle algorithm */
// function shuffleArray(array) {
//     for (let i = array.length - 1; i > 0; i--) {
//         const j = Math.floor(Math.random() * (i + 1));
//         [array[i], array[j]] = [array[j], array[i]];
//     }
// }
//
// function getRandomWord(current) {
//     const CurrentWord = arabicWords[current].getAttribute('data-selected-word-transliteration-value');
//
//     let randomWord;
//     let random = randomIntFromInterval(0, (arabicWords.length - 1));
//     randomWord = arabicWords[random];
//     randomWordCompare = randomWord.getAttribute('data-selected-word-transliteration-value');
//
//     if (arabicWords.length >= 4) {
//         if (randomWordCompare === CurrentWord) {
//             console.log(randomWordCompare === CurrentWord);
//             getRandomWord(current);
//         }
//     }
//
//     return randomWord;
// }
//
// let globalInterval;
//
// function do_exercise(callback, delay, repetitions) {
//     var x = 0;
//     var intervalID = window.setInterval(() => {
//
//         callback();
//
//         if (++x === repetitions) {
//             window.clearInterval(intervalID);
//         }
//     }, delay);
//
//     globalInterval = intervalID;
// }
//
// initValues();
//
// function show_options() {
//     document.getElementById('quranic-arabic').innerHTML = "[...]";
//     document.getElementById('quranic-arabic').style.fontFamily = "var(--bs-body-font-family)";
//     document.getElementById('quranic-transliteration').innerHTML = "[...]";
//
//     container.classList.remove("d-none");
//     container.classList.add("d-block");
// }
//
// function hide_options() {
//     container.classList.add("d-none");
//     container.classList.remove("d-block");
// }
//
// function get_text(word) {
//     let array = [];
//     const currentWord = arabicWords[word];
//
//     array["arabic"] = currentWord.getAttribute('data-selected-word-arabic-value');
//     array["transliteration"] = currentWord.getAttribute('data-selected-word-transliteration-value');
//     array["font"] = currentWord.getAttribute('data-selected-word-font-value');
//
//     return array;
// }
//
// function fill_text(word) {
//     var currentWord = get_text(word);
//
//     document.getElementById('quranic-arabic').innerHTML = currentWord["arabic"];
//     document.getElementById('quranic-transliteration').innerHTML = currentWord["transliteration"];
//     document.getElementById('quranic-arabic').style.fontFamily = currentWord["font"];
// }
//
// function get_option() {
//     var randomSelectedNumber = randomIntFromInterval(0, (arabicWords.length - 1));
//     let array = [];
//     const currentWord = arabicWords[randomSelectedNumber];
//
//     array["arabic"] = currentWord.getAttribute('data-selected-word-arabic-value');
//     array["transliteration"] = currentWord.getAttribute('data-selected-word-transliteration-value');
//     array["font"] = currentWord.getAttribute('data-selected-word-font-value');
//
//     return array;
// }
//
// function fill_options(word) {
//     var randomSelectedNumber = randomIntFromInterval(0, 3);
//     var currentWord = get_text(word);
//     var maximizer = 4;
//
//     labels[randomSelectedNumber].innerHTML = currentWord["transliteration"];
//     inputs[randomSelectedNumber].value = currentWord["transliteration"];
//
//     shuffleArray(currentValues);
//
//     for (let i = 0; i < maximizer; i++) {
//         if (randomSelectedNumber !== i) {
//             labels[i].innerHTML = currentValues[i];
//             inputs[i].value = currentValues[i];
//         }
//     }
// }
//
//
// function load() {
//     if (counter === 1) {
//         fill_text(selector);
//     } else if (counter >= 1 && !(counter === arabicWords.length)) {
//         if (!lastWasPaused && (arabicWords.length >= 4 && Math.random() < 0.80 && counter >= -1)) {
//             console.log("Random found");
//
//             fill_options(selector);
//             show_options();
//
//             lastWasPaused = true;
//             window.clearInterval(globalInterval);
//         }
//     } else if (counter >= 1 && (counter === arabicWords.length)) {
//         fill_text(selector);
//         lastverse.classList.remove("d-none");
//         lastverse.classList.add("d-block");
//     }
//
//     lastWasPaused = false;
//     counter = (counter + 1);
//     selector = (selector + 1);
// }
//
// // // the function to run each interval
// // var intervalFunction = function () {
// //     if (counter === -1) {
// //         // Ga verder
// //         console.log("Eerste");
// //     } else if (counter >= 0 && ((counter + 1) - arabicWords.length)) {
// //         // Start de randomizer
// //
// //
// //         console.log("Niet meer de eerste");
// //     } else if (counter === (arabicWords.length - 1)) {
// //         clearInterval();
// //     }
// //
// //
// //     lastverse.classList.add("d-none");
// //     lastverse.classList.remove("d-block");
// //
// //     started = true;
// //
// //     counter = (counter + 1) % arabicWords.length;
// //     const currentWord = arabicWords[counter];
// //
// //     const arabicValue = currentWord.getAttribute('data-selected-word-arabic-value');
// //     const transliterationValue = currentWord.getAttribute('data-selected-word-transliteration-value');
// //     const fontValue = currentWord.getAttribute('data-selected-word-font-value');
// //
// //     if (!lastWasPaused) {
// //         if ((arabicWords.length >= 4 && Math.random() < 0.30 && counter >= 0)) {
// //             paused = true;
// //
// //             document.getElementById('quranic-arabic').innerHTML = "[...]";
// //             document.getElementById('quranic-arabic').style.fontFamily = "var(--bs-body-font-family)";
// //             document.getElementById('quranic-transliteration').innerHTML = "[...]";
// //
// //             container.classList.remove("d-none");
// //             container.classList.add("d-block");
// //
// //             var randomSelectedNumber = randomIntFromInterval(0, 3);
// //
// //             for (let i = 0; i < labels.length; i++) {
// //                 if (i === randomSelectedNumber) {
// //                     labels[i].innerHTML = transliterationValue;
// //                     inputs[i].value = transliterationValue;
// //
// //                 } else {
// //                     var randomWord = arabicWords[randomIntFromInterval(0, arabicWords.length - 1)];
// //                     var randomTransliterationValue = randomWord.getAttribute('data-selected-word-transliteration-value')
// //
// //                     while (randomTransliterationValue === transliterationValue) {
// //                         randomWord = arabicWords[randomIntFromInterval(0, arabicWords.length - 1)];
// //                         randomTransliterationValue = randomWord.getAttribute('data-selected-word-transliteration-value')
// //                     }
// //
// //                     labels[i].innerHTML = randomTransliterationValue;
// //                     inputs[i].value = randomTransliterationValue;
// //
// //                 }
// //             }
// //
// //             lastWasPaused = true;
// //
// //             container.classList.remove("d-none");
// //             container.classList.add("d-block");
// //
// //             clearInterval(intervalID);
// //             return;
// //         }
// //     }
// //
// //     document.getElementById('quranic-arabic').innerHTML = arabicValue;
// //     document.getElementById('quranic-transliteration').innerHTML = transliterationValue;
// //     document.getElementById('quranic-arabic').style.fontFamily = fontValue;
// //     lastWasPaused = false;
// //
// //     for (let i = 0; i < inputs.length; i++) {
// //         inputs[i].checked = false;
// //     }
// //
// //     if (counter === (arabicWords.length - 1)) {
// //         counter = -1;
// //         completed = true;
// //         paused = false;
// //
// //         lastverse.classList.remove("d-none");
// //         lastverse.classList.add("d-block");
// //
// //         clearInterval(intervalID);
// //     }
// // }
//
// function randomIntFromInterval(min, max) { // min and max included
//     return Math.floor(Math.random() * (max - min + 1) + min)
// }