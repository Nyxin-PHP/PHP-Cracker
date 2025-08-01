const output = document.getElementById('output');
let isLoading = false;
const streamUrl = 'src/index.php';

async function fetchDataStreamSingleItem() {
  if (isLoading) {
    console.log("Already loading data, skipping new request.");
    return;
  }

  isLoading = true;
  output.innerHTML = '<p>showing password attempts feature has been disabled by the user ...</p>';

  try {
    const response = await fetch(`${streamUrl}?crack=true`, {
      method: 'GET',
      headers: {
        'Content-Type': 'text/plain; charset=utf-8'
      },
    });

    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(`HTTP error! Status: ${response.status} - ${errorText}`);
    }

    const reader = response.body.getReader();
    const decoder = new TextDecoder('utf-8');
    let result = '';

    while (true) {
      const {
        done,
        value
      } = await reader.read();
      if (done) {
        console.log('Stream complete.');
        output.innerHTML = 'All specified passwords have been tried.';
        break;
      }

      result += decoder.decode(value, {
        stream: true
      });

      const lines = result.split('\n');

      for (let i = 0; i < lines.length - 1; i++) {
        if (lines[i].trim() !== '') {
          output.innerHTML = `<p>${lines[i].trim()}</p>`;
        }
      }
      result = lines[lines.length - 1];
    }

    if (result.trim() !== '') {
      output.innerHTML = `<p>${result.trim()}</p>`;
    }

  } catch (error) {
    console.error("Error failed to connect:", error);
    output.innerHTML = `<p style="color:red;">Error: ${error.message || error}</p>`;
  } finally {
    isLoading = false;
  }
}

const stream = document.getElementById('stream');

if (stream) {
  stream.addEventListener('submit', function(event) {
    event.preventDefault();
    fetchDataStreamSingleItem();
  });
} else {
  console.error("Form not found. Please check your HTML ID 'stream'.");
}