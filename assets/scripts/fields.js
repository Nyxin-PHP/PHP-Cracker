document.addEventListener('DOMContentLoaded', function () {
  function DynamicToggles(configurations) {
    configurations.forEach(config => {
      const containerElement = document.getElementById(config.containerId);
      const childInputs = containerElement.querySelectorAll('input, select, textarea');

      const handleToggle = () => {
        let shouldShow = false;


        if (config.radioGroupName) {
          const selectedRadio = document.querySelector(`input[name="${config.radioGroupName}"]:checked`);
          if (selectedRadio && selectedRadio.value === config.triggerValue) {
            shouldShow = true;
          }
        } else {
          const selectElement = document.getElementById(config.selectId);
          if (!selectElement || !containerElement) return;

          if (selectElement.type === 'radio') {
            shouldShow = selectElement.checked && config.triggerValue === 'checked';
          } else {
            shouldShow = selectElement.value === config.triggerValue;
          }
        }

        containerElement.style.display = shouldShow ? 'block' : 'none';
        childInputs.forEach(input => input.disabled = !shouldShow);

      
        if (config.updateHiddenField) {
          const hiddenField = document.getElementById(config.updateHiddenField.id);
          if (hiddenField) {
            hiddenField.disabled = !shouldShow;
            hiddenField.value = shouldShow ? config.updateHiddenField.value : '';
          }
        }

      
        if (config.radioGroupName === 'Formation') {
          const charSelect = document.getElementById('Characters');
          if (charSelect) {
            const wrapper = charSelect.closest('.form-floating');
            if (wrapper) {
              wrapper.style.display = shouldShow ? 'none' : '';
              charSelect.disabled = shouldShow;
            }
          }
        }
      };

      handleToggle(); 

  
      if (config.radioGroupName) {
        const radios = document.querySelectorAll(`input[type="radio"][name="${config.radioGroupName}"]`);
        radios.forEach(radio => radio.addEventListener('change', handleToggle));
      } else {
        const selectElement = document.getElementById(config.selectId);
        if (selectElement) selectElement.addEventListener('change', handleToggle);
      }
    });
  }

  const formToggleConfigurations = [
    {
      radioGroupName: 'Formation',
      containerId: 'hiddenOne',
      triggerValue: 'matrix'
    },
    {
      radioGroupName: 'Formation',
      containerId: 'hiddenTwo',
      triggerValue: 'wordslist'
    },
    {
      radioGroupName: 'Formation',
      containerId: 'nestedHidden',
      triggerValue: 'unique',
      updateHiddenField: {
        id: 'CharactersHidden',
        value: 'unique'
      }
    }
  ];

  DynamicToggles(formToggleConfigurations);
});
