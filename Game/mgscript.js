let currentProblem;
let correctAnswers = 0; // Track the number of correct answers
let timerInterval; // To store the timer interval
let timeLeft = 5; // Time limit for each question (5 seconds)

// Function to generate a random math problem with simpler numbers
function generateProblem() {
  const operations = ["+", "-", "*", "/"];
  const operation = operations[Math.floor(Math.random() * operations.length)];
  let num1, num2;

  if (operation === "/") {
    // Ensure division problems result in whole numbers
    num2 = Math.floor(Math.random() * 5) + 1; // Smaller numbers for simplicity
    num1 = num2 * (Math.floor(Math.random() * 5) + 1); // num1 is a multiple of num2
  } else {
    num1 = Math.floor(Math.random() * 10) + 1; // Smaller numbers for simplicity
    num2 = Math.floor(Math.random() * 10) + 1;
  }

  const correctAnswer = calculateAnswer(num1, num2, operation);
  const options = generateOptions(correctAnswer);

  return { num1, num2, operation, correctAnswer, options };
}

// Function to calculate the correct answer
function calculateAnswer(num1, num2, operation) {
  switch (operation) {
    case "+":
      return num1 + num2;
    case "-":
      return num1 - num2;
    case "*":
      return num1 * num2;
    case "/":
      return num1 / num2;
    default:
      return null;
  }
}

// Function to generate multiple-choice options
function generateOptions(correctAnswer) {
  const options = new Set([correctAnswer]);

  while (options.size < 4) {
    const randomOption = correctAnswer + Math.floor(Math.random() * 5) - 2; // Add some variation
    if (randomOption !== correctAnswer) {
      options.add(randomOption);
    }
  }

  return shuffleArray(Array.from(options));
}

// Function to shuffle an array
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

// Function to start the game
function startGame() {
  currentProblem = generateProblem();
  document.getElementById(
    "problem"
  ).innerText = `${currentProblem.num1} ${currentProblem.operation} ${currentProblem.num2} = ?`;
  document.getElementById("result").innerText = "";
  document.getElementById("continue").style.display = "none";

  // Display options
  const optionsElement = document.getElementById("options");
  optionsElement.innerHTML = "";
  currentProblem.options.forEach((option) => {
    const button = document.createElement("button");
    button.className = "option";
    button.innerText = option;
    button.onclick = () => checkAnswer(option);
    optionsElement.appendChild(button);
  });

  // Reset and start the timer
  timeLeft = 5;
  document.getElementById("timer").innerText = timeLeft;
  startTimer();
}

// Function to start the countdown timer
function startTimer() {
  clearInterval(timerInterval); // Clear any existing timer
  timerInterval = setInterval(() => {
    timeLeft--;
    document.getElementById("timer").innerText = timeLeft;

    // If time runs out
    if (timeLeft <= 0) {
      clearInterval(timerInterval);
      document.getElementById(
        "result"
      ).innerText = `Time's up! The correct answer was ${currentProblem.correctAnswer}. You answered ${correctAnswers} questions correctly.`;
      document.getElementById("continue").style.display = "block";
    }
  }, 1000); // Update every second
}

// Function to end the game
function endGame() {
  clearInterval(timerInterval); // Stop the timer
  document.getElementById("problem").innerText = "Thank you for playing!";
  document.getElementById("options").innerHTML = "";
  document.getElementById("continue").style.display = "none";
  document.getElementById(
    "result"
  ).innerText = `You answered ${correctAnswers} questions correctly.`;
  document.getElementById("timer").style.display = "none"; // Hide the timer
}

// Function to check the user's answer
function checkAnswer(selectedOption) {
  clearInterval(timerInterval); // Stop the timer
  if (parseInt(selectedOption) === currentProblem.correctAnswer) {
    // Use parseInt for strict comparison
    document.getElementById("result").innerText = "Correct!";
    document.getElementById("result").style.color = "green";
    correctAnswers++; // Increment the correct answer counter
    setTimeout(() => {
      startGame(); // Generate a new problem after a short delay
    }, 1000); // Delay for 1 second before showing the next question
  } else {
    document.getElementById(
      "result"
    ).innerText = `Incorrect. The correct answer is ${currentProblem.correctAnswer}. You answered ${correctAnswers} questions correctly.`;
    document.getElementById("result").style.color = "red";
    // Show the continue options
    document.getElementById("continue").style.display = "block";
  }
}

// Event listeners for continue buttons
document.getElementById("yes-button").addEventListener("click", startGame);
document.getElementById("no-button").addEventListener("click", endGame);

// Start the game when the page loads
startGame();
