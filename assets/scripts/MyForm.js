let formData;

function handleSubmit(event) {
  event.preventDefault();
  formData = new FormData(this);

  $('#submitIcon')
    .removeClass('bi-save bi-check-circle')
    .addClass('spinner-border spinner-border-sm');

  $('#submitText').text('Saving...');

  $('#submitButton').attr('disabled', true);

  $.ajax({
    type: 'POST',
    url: '/../../src/index.php', 
    data: formData,
    processData: false,
    contentType: false,

    success: function(response) {

      $('#output').html(response);

      $('#submitIcon')
        .removeClass('spinner-border spinner-border-sm')
        .addClass('bi bi-check-circle');

      $('#submitText').text('Saved');

      $('#submitButton').attr('disabled', false);
    },

    error: function(xhr, status, error) {
      $('#output').html('Error: failed to connect: ' + error);

      $('#submitIcon')
        .removeClass('spinner-border spinner-border-sm bi-check-circle')
        .addClass('bi bi-save');

      $('#submitText').text('Save');
      $('#submitButton').attr('disabled', false);
    }
  });
}

$('#MyForm').submit(handleSubmit);
