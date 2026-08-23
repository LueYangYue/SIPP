async function chooseInput() {
  const input = document.getElementById('roleSelect');

  input.addEventListener('change', async (event)=> {
    const selectedValue = event.target.value;
    switch (selectedValue) {
      case 1:
        document.getElementById('lecturer').style.display = 'block';
        document.getElementById('student').style.display = 'none';
        break;
    }
  })
}
  
  document.getElementById('htmlInput').addEventListener('change', async(event) => {
    const file = event.target.files[0];
    if (file) {
      // Read text using File Blob API
      const htmlContent = await file.text();
      console.log(htmlContent);
    }
  });