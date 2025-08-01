document.addEventListener('DOMContentLoaded', function () {
  const switches = document.querySelectorAll('.my-switch');

  switches.forEach(function (toggle) {
    const targetId = toggle.getAttribute('data-target-hidden');
    const hiddenInput = document.getElementById(targetId);

    if (hiddenInput) {
      hiddenInput.value = toggle.checked ? 'true': 'false';

      toggle.addEventListener('change', function () {
        hiddenInput.value = this.checked ? 'true': 'false';
      });
    }
  });
});