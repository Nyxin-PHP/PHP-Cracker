const delayRange = document.getElementById("delayRange");
  const rangeBullet = document.getElementById("rs-bullet");
  const delayMicrosecondsInput = document.getElementById("delayMicroseconds");

  function updateUI() {
    const value = parseInt(delayRange.value, 10);
    const seconds = (value * 0.5).toFixed(1);
    const microseconds = value * 500000;

    rangeBullet.textContent = seconds;
    delayMicrosecondsInput.value = microseconds;

    // Position bullet above thumb
    const sliderWidth = delayRange.offsetWidth;
    const percent = value / delayRange.max;
    const offset = percent * sliderWidth;

    rangeBullet.style.left = `calc(${offset}px + 45px)`;
  }

  delayRange.addEventListener("input", updateUI);
  window.addEventListener("load", updateUI);
