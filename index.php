<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nyxin - PHP BruteForce & Cracking Tool</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
  <link href="assets/styles/css/style.css" rel="stylesheet">
  <link href="assets/styles/css/fonts.css" rel="stylesheet">
  <link href="assets/styles/css/eye.css" rel="stylesheet">
  <link href="assets/styles/css/range.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceberg&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Iceberg&family=Rationale&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Stalinist+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand mb-0 logo">
        <img src="assets/images/nav.png" alt="Logo" width="45 vw" height="36 hw" class="d-inline-block align-text-center">

      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="USER-INTERFACE.txt">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Website</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="scan-line"></div>

  <h1 class="text-center mt-3 mb-5 intro">Nyxin - PHP Cracker</h1>

  <section>
    <div class="main" id="output">
      <img src="assets/images/logo.png" class="img-fluid w-100 d-block" alt="Nyxin Brute Force" style="height: auto;object-fit: fill;">
      <div class="circle"></div>
    </div>
  </section>

  <form id="MyForm">
    <section>
      <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="eye-toggle">
          <input type="checkbox" id="show" class="btn-check my-switch" role="switch" data-target-hidden="showHide" autocomplete="off" checked>
          <label for="show">
            <span class="track"></span>
            <span class="thumb">
              <span class="eye"></span>
            </span>
          </label>
        </div>
      </div>
      <input type="hidden" id="showHide" name="ShowPasswords" value="true">
    </section>

    <hr class="divider">

    <section>
      <div class="custom-range-wrapper">
        <div class="custom-range-slider">
          <span id="rs-bullet" class="range-circle-label">0.0</span>
          <input id="delayRange" class="custom-range" type="range" value="0" min="0" max="10" step="1">
          <input type="hidden" name="Delay" id="delayMicroseconds">
        </div>
      </div>
    </section>

    <hr class="divider">

    <div class="centered">
      <div class="wrap">

        <div class="box">
          <button type="button" class="btn-t collapse-toggle" data-bs-toggle="collapse" data-bs-target="#collapseA">
            <i class="bi bi-chevron-double-down"></i> PASSWORD
          </button>

        </div>

        <div class="box">
          <button type="button" class="btn-t collapse-toggle" data-bs-toggle="collapse" data-bs-target="#collapseB">
            <i class="bi bi-chevron-double-down"></i> SERVERS
          </button>

        </div>

      </div>
    </div>

    <div id="collapseA" class="collapse collapse-content">
      <hr class="divider"></hr>
      <hr class="divider"></hr>
      <h5>Password Configuration</h5>
      <hr class="divider"></hr>
      <hr class="divider"></hr>
      <span class="label label-default mt-3" style="font-family: 'Times New Roman', serif;font-size:3vw;">Password Formation Method</span>
      <div class="form-check mt-2 mb-2">
        <input class="form-check-input" type="radio" name="Formation" value="matrix" id="matrix" checked>
        <label class="form-check-label iceland" for="matrix">
          Systematically
        </label>
      </div>
      <div class="form-check mb-4">
        <input class="form-check-input" type="radio" name="Formation" value="wordslist" id="wordslist">
        <label class="form-check-label iceland" for="wordslist">
          Dictionary Attacks
        </label>
      </div>

      <div class="form-check mb-2">
        <input class="form-check-input" type="radio" name="Formation" value="unique" id="formationUnique">
        <label class="form-check-label iceland" for="formationUnique">Custom Characters</label>
      </div>
      <input type="hidden" name="Characters" id="CharactersHidden" value="" disabled>


      <div id="hiddenOne" class="hidden">
        <div class="mb-3">
          <label for="Length" class="form-label iceland">Password Length</label>
          <div class="input-group">
            <span class="input-group-text calm">Min</span>
            <input type="number" class="form-control" name="MinLen" id="minLength" placeholder="2" min="1" value="2" required>
            <span class="input-group-text last">Max</span>
            <input type="number" class="form-control" name="MaxLen" id="maxLength" placeholder="6" max="" value="3" required>
          </div>
        </div>

        <hr></hr>

        <div class="form-floating">
          <select class="form-select mb-3" name="Characters" id="Characters" aria-label="Select Password Combination">
            <option value="Numbers" selected>Numbers</option>
            <option value="lowercase">Lowercase</option>
            <option value="uppercase">Uppercase</option>
            <option value="Symbols">Symbols</option>
            <option value="Numbers_lowercase">Numbers & Lowercase</option>
            <option value="Numbers_uppercase">Numbers & Uppercase</option>
            <option value="Numbers_Symbols">Numbers & Symbols</option>
            <option value="lowercase_uppercase">Lowercase & Uppercase</option>
            <option value="lowercase_Symbols">Lowercase & Symbols</option>
            <option value="uppercase_Symbols">Uppercase & Symbols</option>
            <option value="Numbers_lowercase_uppercase">Numbers & Lowercase & Uppercase</option>
            <option value="Numbers_lowercase_Symbols">Numbers & Lowercase & Symbols</option>
            <option value="Numbers_uppercase_Symbols">Numbers & Uppercase & Symbols</option>
            <option value="lowercase_uppercase_Symbols">Lowercase & Uppercase & Symbols</option>
            <option value="Numbers_lowercase_uppercase_Symbols">Numbers & Lowercase & Uppercase & Symbols</option>
          </select>
          <label for="Characters" class="calm">Password Combination</label>
        </div>

        <hr></hr>



        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="StartPoint" id="SetPoint">
          <label for="SetPoint" class="form-label calm">Start Point</label>
        </div>

      </div>

      <div id="hiddenTwo" class="hidden">
        <label class="collapse-content"><p>
          To use this feature, upload your file to the path etc/wordslist/ and rename it to wordslist.txt."
        </p>
        </label>
      </div>

      <div id="nestedHidden" class="hidden">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="UniqueChars" id="UniqueChars" aria-describedby="Unique Letters">
          <label for="uniqueLetters" class="form-label iceland">Inter Your Own Letters</label>
        </div>
        <hr></hr>
      </div>

      <hr class="divider"></hr>
      <hr class="divider"></hr>

      <div class="form-check form-switch mt-3 mb-2">
        <input type="checkbox" class="form-check-input my-switch" role="switch" id="ignore" data-target-hidden="Abort">
        <label class="form-check-label iceland" for="ignore" style="color: #dc3545;"> ⚠  Ignore User Abort </label>
      </div>
      <input type="hidden" id="Abort" name="ignoreAbort" value="false">

      <div class="form-check form-switch mb-2">
        <input type="checkbox" class="form-check-input my-switch" role="switch" id="storeLast" data-target-hidden="store">
        <label class="form-check-label iceland" for="storeLast">PAUSE</label>
      </div>
      <input type="hidden" id="store" name="Pause" value="false">

      <div class="form-check form-switch mb-2">
        <input type="checkbox" class="form-check-input my-switch" role="switch" id="lastHash" data-target-hidden="useLast">
        <label class="form-check-label iceland" for="lastHash">RESUME</label>
      </div>
      <input type="hidden" id="useLast" name="Resume" value="false">

      <hr class="divider"></hr>
      <hr class="divider"></hr>
      <hr class="divider"></hr>

      <section>
        <button type="submit" class="save" id="submitButton">
          <i id="submitIcon" class="bi bi-save" style="font-size: 4vw;"></i> <span id="submitText">SAVE</span>
        </button>
      </section>
    </form>


    <hr class="divider"></hr>

    <div class="text-center mt-3">
      <button type="button" class="btn-close" aria-label="Close" data-bs-toggle="collapse" data-bs-target="#collapseA"></button>
    </div>
  </div>

  <div id="collapseB" class="collapse collapse-content">
    <hr class="divider"></hr>
    <hr class="divider"></hr>
    <h5>Server Configuration</h5>
    <hr class="divider"></hr>
    <hr class="divider"></hr>
    <p>
      The server connection feature is disabled in the public version of this tool for security and ethical reasons.
    </p>

    <p>
      However, advanced users can enable it manually by editing the file:<br>
      <code>Systems/Dojo.php</code>
    </p>

    <p>
      Once configured, PHP can connect to a wide range of services and protocols, such as:
    </p>

    <p>
      - HTTP, FTP, SMTP, IMAP, POP3<br>
      - Databases (MySQL, PostgreSQL, etc.)<br>
      - SFTP, SCP, TFTP, Telnet, WebSocket, and more
    </p>

    <p>
      This functionality can also be extended for:
    </p>

    <p>
      - Executing XSS payloads<br>
      - Generating custom wordlists<br>
      - Conducting controlled penetration tests
    </p>

    <p>
      <strong>Disclaimer:</strong> This tool is intended strictly for educational and legal testing purposes.<br>
      Misuse of this feature is strictly prohibited. The developer assumes no responsibility for any illegal or unethical use.
    </p>

    <hr class="divider"></hr>
    <hr class="divider"></hr>
    <hr class="divider"></hr>
    <hr class="divider"></hr>

    <div class="text-center mt-3">
      <button type="button" class="btn-close" aria-label="Close" data-bs-toggle="collapse" data-bs-target="#collapseB"></button>
    </div>
  </div>

  <hr class="divider">
  <hr class="divider">

  <section>
    <form id="stream">
      <button type="submit" class="start"><i class="bi bi-arrow-right-circle"></i> START </button>
    </form>
  </section>

  <hr class="divider">
  <hr class="divider">

  <section>
    <footer class="footer text-center mt-5">
      <div class="container">
        <p class="mb-2 custom-footer">
          © Nyxin Projects - All rights reserved.
        </p>
        <div class="social-icons">
          <a href="https://github.com/Nyxin-PHP/PHP-Cracker" class="mx-2"><i class="bi bi-github" style="font-size: 5vw;color: cyan;"></i></a>
        </div>
      </div>
    </footer>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script src="assets/scripts/jquery/jquery-3.7.1.min.js"></script>
  <script src="assets/scripts/streamer.js"></script>
  <script src="assets/scripts/MyForm.js"></script>
  <script src="assets/scripts/switch.js"></script>
  <script src="assets/scripts/fields.js"></script>
  <script src="assets/scripts/range.js"></script>
  <script src="assets/scripts/icon.js"></script>
</body>
</html>
