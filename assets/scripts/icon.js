document.addEventListener("DOMContentLoaded", function () {
  const collapseButtons = document.querySelectorAll('.collapse-toggle');

  collapseButtons.forEach(button => {
    const targetSelector = button.getAttribute('data-bs-target');
    const targetElement = document.querySelector(targetSelector);
    const icon = button.querySelector('i');

    if (!targetElement || !icon) return;

    targetElement.addEventListener('show.bs.collapse', () => {
      icon.classList.remove('bi-chevron-double-down');
      icon.classList.add('bi-chevron-double-up');
    });

    targetElement.addEventListener('hide.bs.collapse', () => {
      icon.classList.remove('bi-chevron-double-up');
      icon.classList.add('bi-chevron-double-down');
    });
  });
});