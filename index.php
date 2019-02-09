<html>
  <head>
    <title>Random Numbers</title>
    <meta charset="UTF-8">

    <!-- bootstrap stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
    /* needed to make sure that appened numbers don't go outside of the modal */
      .modal-body {
          word-wrap: break-word;
      }

      .modal-content {
        min-height: 85%;
      }

      .digits {
      font-family: Helvetica;
      font-size: 1.3em;
      letter-spacing: 0.8ch;
    } 

    .digitEntryForm {
      min-height: 65%;
    }

    #countdownExample {
      display: block !important;
    }
    </style>
  </head>

  <body>
  
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">World of Memory</a>
    </nav> 
  </header>

  <div class="container mt-5">
    <div class="card ml-auto mr-auto col-md-8 col-lg-7 p-0">
    <div class="card-header">
      Random Number Training Session
    </div>
    <div class="card-body pb-0">
      <h5 class="card-title">Settings</h5>
      <form>
        <div class="form-group">
          <label for="numberOfDigitsInput">Number of Digits</label>
          <input type="number"  min="1" max="1000" class="form-control" id="numberOfDigitsInput" aria-describedby="number of digits"  value=600>
        </div>
        <label for="modeSelect">Mode</label>
        <select class="form-control form-control-sm" id="modeSelect">
          <option value="decimal">Decimal</option>
          <option value="binary">Binary</option>
          <option value="constant-PI">π</option>
          <option value="constant-e">e</option>
          <option value="constant-PHI">Golden Ratio φ</option>
          <option value="constant-sqrt2">√2</option>
          <option value="constant-sqrt3">√3</option>
          <option value="constant-ln2">ln2</option>
          <option value="constant-ln10">ln10</option>
        </select>
        <div class="form-row mt-3">
          <div class="col-4">
            <label for="hoursInput">Hours</label>
            <input type="number" class="form-control" id="hoursInput" value = 0  min="0" max="24">
          </div>
          <div class="col-4">
            <label for="minsInput">Minutes</label>
            <input type="number" class="form-control" id="minsInput" value = 5  min="0" max="60">
          </div>
          <div class="col-4">
            <label for="secondsInput">Seconds</label>
            <input type="number" class="form-control" id="secondsInput" value = 0 min="0" max="60">
          </div>
      </div>
      <div class="form-check mb-2 mr-sm-2">
        <input class="form-check-input" id="isTimedCheckbox" type="checkbox" id="inlineFormCheck" checked>
        <label class="form-check-label" for="inlineFormCheck">
          Timed Test
        </label>
      </div>
        <!-- Button trigger modal -->
        <button id="startTestButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        Start Test
      </button>
      </form>
    </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="currentModalTitle">Memorize The Digits</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body digits randomNumbersArea">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        <!-- this is where the randomly generated numbers will go... -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="nextButton">Next</button>
      </div>
    </div>
  </div>
</div>

<script src="MathConstants\digitsOfPi.js"></script>
<script src="MathConstants\digitsOfE.js"></script>
<script src="MathConstants\digitsOfGoldenRatio.js"></script>
<script src="MathConstants\digitsOfSqrt2.js"></script>
<script src="MathConstants\digitsOfSqrt3.js"></script>
<script src="MathConstants\digitsOfLn2.js"></script>
<script src="MathConstants\digitsOfLn10.js"></script>
<script src="BOWER_COMPONENTS\easytimer.js\dist\easytimer.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
class randomSequence {
  static _generateRandomNumber(min_value, max_value) {
      return Math.round(Math.random() * (max_value-min_value) + min_value);
  } 

  static getRandomSequence(lengthOfSequence, min_value, max_value) {
    let randomSequence = [];
    for(let i = 0; i < lengthOfSequence; i++) {
      randomSequence.push(this._generateRandomNumber(min_value, max_value));
    }

    return randomSequence;
  }

  static convertToString(sequenceArray) {
    let strSequence = "";
    for(let i = 0; i < sequenceArray.length; i++) {
      strSequence = strSequence + sequenceArray[i];
    }

    return strSequence;
  }
}
</script>


<script>

// a function which highlights text as either matching (ie successful) or not matching (ie failure) and returns html with spans marked as success or failure respectively.
function highlight(oldRandom, usersTestInput, settings) { 
   //the object which will be returned and contains the html containing the numbers appropriately highlighted
  let newHTML = ``;
  // an array that will contain the objects that indicate which ranges of indices are to be marked successful and which ones are not;
  let spanCollections = [];
  // a varible used to keep track of where a section to be highlighted starts.
  let rangeStart = 0;
  // a variable used to keep track of where a section to be highlighted ends.
  let rangeEnd = 0;
  // a variable used to keep track of whether a ranged of indices is to be marked a success or a failure.
  let rangeType = "success";
  // a variable used to keep track of what indices the function is currently checking for success of failure at.
  let currentIndex = 0;
  // a variable used to count the total number of successful numbers remembered.
  let totalSuccessCount = 0;
  // check to see if the user has specified the colors for success and failure and if not assigns defaults.
  if(settings) {
    if(!settings.successColor) {
    settings.successColor = "rgb(66, 244, 122)";
  }
    if(!settings.failureColor) {
      settings.failureColor = "rgb(255, 112, 112)";
    }
  }
  else if(!settings) {
    var settings = {
      successColor: "rgb(66, 244, 122)",
      failureColor: "rgb(255, 112, 112)"
    }
  }

  
// checks for the special case that the user did not input any text/numbers and returns and object which (in isolation) describes that situation
  if(usersTestInput.length === 0) {
    spanCollections.push({type: '', start: 0, end: 0});
  }
// if the user DID input some text/numbers then an array of objects indicating ranges of success and failure is gnerated
  else if(usersTestInput.length > 0) {
    for(let i = 0; i <= usersTestInput.length; i++) {
      // if we are at the end of the text
      if(i === oldRandom.length) {
          rangeEnd = currentIndex;
          spanCollections.push({type: rangeType, start: rangeStart, end: rangeEnd});
      }
      // if we are counting successes AND a success is detected
      else if(oldRandom[i] === usersTestInput[i] && rangeType === "success") {
        currentIndex++;
        totalSuccessCount++;
      }
      // if we are counting successes AND a failure is detected
      else if(oldRandom[i] !== usersTestInput[i] && rangeType === "success") {
        rangeEnd = currentIndex;
        spanCollections.push({type: rangeType, start: rangeStart, end: rangeEnd});
        rangeStart = rangeEnd;
        rangeType = "failure";
        currentIndex++;
      }
      // if we are counting failures AND a failure is detected
      else if(oldRandom[i] !== usersTestInput[i] && rangeType === "failure") {
        currentIndex++;
      }   
      // if we are counting failures AND a success is detected
      else if(oldRandom[i] === usersTestInput[i] && rangeType === "failure") {
        rangeEnd = currentIndex;
        spanCollections.push({type: rangeType, start: rangeStart, end: rangeEnd});
        rangeStart = rangeEnd;
        rangeType = "success";
        currentIndex++;
        totalSuccessCount++;
      } 
  }
}

// generates the html containing the sections of text which are to be highlighted and in what way.
  for(let i = 0; i < spanCollections.length; i++) {
    // newHTML += "<span class='";
    newHTML += "<span style='background-color: ";
    if(spanCollections[i].type === "success") {
      newHTML += settings.successColor;
    }
    else if(spanCollections[i].type === "failure") {
      newHTML += settings.failureColor;
    }
    newHTML += ";'>";
    newHTML += oldRandom.slice(spanCollections[i].start, spanCollections[i].end);
    newHTML += "</span>";
  }
  newHTML += oldRandom.slice(spanCollections[spanCollections.length - 1].end, oldRandom.length);


  console.log(currentIndex);
  return {
    textHTML: newHTML,
    sucessCount: totalSuccessCount,
    failureCount: usersTestInput.length - totalSuccessCount
  };
}



  class State {
    constructor(mode) {
      console.log(mode);
      this._mode = mode;
      this.currentView = "optionsView";
      this.numberOfDigits = document.getElementById("numberOfDigitsInput").value // get the number of digits to be generated
      console.log(this.numberOfDigits);
      if(mode === "binary") {
        this.randomNumbers = randomSequence.convertToString(randomSequence.getRandomSequence(this.numberOfDigits, 0, 1)); // convert the array of digits into a str
      }
      else if(mode === "decimal" || !mode) {
        this.randomNumbers = randomSequence.convertToString(randomSequence.getRandomSequence(this.numberOfDigits, 0, 9)); // convert the array of digits into a str
      }
      else if(mode === "constant-PI") {
        this.randomNumbers = PI.slice(0, Number(this.numberOfDigits) + 1);
      }
      else if(mode === "constant-e") {
        this.randomNumbers = e.slice(0, Number(this.numberOfDigits) + 1);        
      }
      else if(mode === "constant-PHI") {
        this.randomNumbers = goldenRatio.slice(0, Number(this.numberOfDigits) + 1);        
      }
      else if(mode === "constant-sqrt2") {
        this.randomNumbers = sqrt2.slice(0, Number(this.numberOfDigits) + 1); 
      }
      else if(mode === "constant-sqrt3") {
        this.randomNumbers = sqrt3.slice(0, Number(this.numberOfDigits) + 1); 
      }
      else if(mode === "constant-ln2") {
        this.randomNumbers = ln2.slice(0, Number(this.numberOfDigits) + 1); 
      }
      else if(mode === "constant-ln10") {
        this.randomNumbers = ln10.slice(0, Number(this.numberOfDigits) + 1); 
      }
      this._usersTestInput = "";
      this.nextButton = document.getElementById("nextButton");
      this.textArea = document.createElement("textarea");
      this.currentModalTitle = document.getElementById("currentModalTitle")
      this._isTimed = true;
      this._timerValue = {
        seconds: "5",
        minutes: 0,
        hours: 0
      };
      this._timer = new easytimer.Timer();
      this.highlightSettings = {
        successColor: "rgb(66, 244, 122)",
        failureColor: "rgb(255, 112, 112)"
        }
      this.fontSettings = {
        color: "black",
        fontSize: "1.3em",
        letterSpacing: "0.8ch",
        fontFamily: "helvetica"
      }
      if(mode === "binary") {
        this.fontSettings.fontFamily = "monospace";
        this.fontSettings.fontSize = "1.5em";
      }
      this.randomNumbersArea = document.getElementsByClassName("randomNumbersArea")[0]; // get the text area in the modal where the digits are to be displayed. 
      this.randomNumbersArea.style.color = this.fontSettings.color;
      this.randomNumbersArea.style.fontSize = this.fontSettings.fontSize;
      this.randomNumbersArea.style.letterSpacing = this.fontSettings.letterSpacing;
      this.randomNumbersArea.style.fontFamily = this.fontSettings.fontFamily;
    }

    get view() {
      return this.currentView;
    }

    get usersTestInput() {
      return this._usersTestInput;
    }

    set usersTestInput(usersTestInput) {
      this._usersTestInput = usersTestInput;
    }

    set mode(newMode) {
      this._mode = newMode;
      if(newMode === "decimal") {
        this.fontSettings.fontFamily = "helvetica";
      }
      else if(newMode === "binary") {
        this.fontSettings.fontFamily = "monospace";
      }
    }
  
    changePageLayout() {
      if(this.currentView === "digitsMemorizeView") {
        this.randomNumbersArea.innerHTML = this.randomNumbers; // delete any text that is currently in the modal text area

        this.currentModalTitle.innerHTML = "Memorize The Digits";
        this.nextButton.classList.remove("btn-secondary");
        this.nextButton.dataset.dismiss = ""
        this.nextButton.classList.add("btn-success");
        this.nextButton.innerHTML = "Next";
        console.log(this._isTimed);
        if(this._isTimed === true) {
          document.getElementById("currentModalTitle").innerHTML = "Memorize the Digits <span class='text-muted' style='font-size: 0.8em' id='countdownExample'>00:00:00</span>";
          this._timer.start({countdown: true, startValues: {seconds: this._timerValue.seconds, minutes: this._timerValue.minutes, hours: this._timerValue.hours}});
          this._timer.addEventListener('secondsUpdated', (e)  =>  {
            document.getElementById("countdownExample").innerHTML = this._timer.getTimeValues().toString();
          });
          this._timer.addEventListener('targetAchieved', (e) => {
              document.getElementById("countdownExample").innerHTML = '';
              this._timer.reset();
              this._timer.stop();
              document.getElementById("countdownExample").innerHTML = "";
              this.changeView("digitsInputView");
          });
        }

      $('#exampleModalLong').on('hidden.bs.modal', () => {
            // document.getElementById("countdownExample").innerHTML = '';
            this._timer.reset();
            this._timer.stop();
    });
      }
      else if(this.currentView === "digitsInputView") {
        this._timer.reset();
        this._timer.stop();
        // document.getElementById("countdownExample").innerHTML = "";
        this.randomNumbersArea.innerHTML = ""; // delete any text that is currently in the modal text area

        this.textArea.classList.add("form-control");
        this.textArea.classList.add("digitEntryForm");
        this.randomNumbersArea.appendChild(this.textArea);

        this.currentModalTitle.innerHTML = "Enter Digits";

        this.nextButton.classList.remove("btn-secondary");
        this.nextButton.classList.add("btn-success");
        this.nextButton.innerHTML = "Next";
        this.nextButton.dataset.dismiss = "";
      }
      else if(this.currentView === "testResultsView") {
        this.textArea.value = "";
        let resultsObject = highlight(this.randomNumbers, this._usersTestInput, this.highlightSettings);
        this.randomNumbersArea.innerHTML =  resultsObject.textHTML;

        this.currentModalTitle.innerHTML = "Test Results <span class='d-block text-muted' style='font-size: 0.7em'>Correct: <span class='mt-1' style='color:" + this.highlightSettings.successColor + ";'>" + resultsObject.sucessCount + "</span></span><span class='d-block text-muted' style='font-size: 0.7em'>Wrong: <span class='mt-1' style='color:" + this.highlightSettings.failureColor + ";'>" + resultsObject.failureCount + "</span></span>";

        this.nextButton.classList.remove("btn-success");
        this.nextButton.classList.add("btn-secondary");
        this.nextButton.innerHTML = "Close";

        this.nextButton.addEventListener('click', MakeCloseButton.bind(this));
        function MakeCloseButton(){
          // this.nextButton.dataset.dismiss = "modal"
          console.log("Closing in principle");

          this.nextButton.removeEventListener("click", MakeCloseButton, { passive: true });     // Succeeds
          this.nextButton.removeEventListener("click", MakeCloseButton, { capture: false });    // Succeeds
          this.nextButton.removeEventListener("click", MakeCloseButton, { capture: true });     // Fails
          this.nextButton.removeEventListener("click", MakeCloseButton, { passive: false });    // Succeeds
          this.nextButton.removeEventListener("click", MakeCloseButton, false);                 // Succeeds
          this.nextButton.removeEventListener("click", MakeCloseButton, true); 
        };
      }
    }

    changeView(newView) {
      this.currentView = newView;
      this.changePageLayout();
    }
  }

  var appState = new State();

  let hoursInput = document.getElementById("hoursInput");
  let minsInput = document.getElementById("minsInput");
  let secondsInput = document.getElementById("secondsInput");
  let isTimedCheckbox = document.getElementById("isTimedCheckbox");
  isTimedCheckbox.addEventListener('click', function(){
    if(!this.checked) {
      // appState._isTimed = false;
      hoursInput.disabled = true;
      minsInput.disabled = true;
      secondsInput.disabled = true;
    }
    else if(this.checked) {
      // appState._isTimed = true;
      hoursInput.disabled = false;
      minsInput.disabled = false;
      secondsInput.disabled = false;
    }
  });


  let startTestButton = document.getElementById("startTestButton");
  startTestButton.addEventListener('click', function() {
    sel = document.getElementById('modeSelect');
    let opt = sel.options[sel.selectedIndex];
    // console.log( opt.value );
    appState = new State(opt.value);
    appState._isTimed = isTimedCheckbox.checked;
    appState._timerValue.seconds = Number(secondsInput.value);
    appState._timerValue.minutes = Number(minsInput.value);
    appState._timerValue.hours = Number(hoursInput.value);
    appState.changeView("digitsMemorizeView")
  });

  let nextButton = document.getElementById("nextButton");
  nextButton.addEventListener('click', function() { 
    if(appState.view === "digitsMemorizeView") {
      appState.changeView("digitsInputView");
    }
    else if(appState.view === "digitsInputView") {
      appState._usersTestInput = appState.textArea.value.replace(/\s/g,'');
      appState.changeView("testResultsView");
    }
  });
</script>


<!-- scripts to make bootstrap work -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>