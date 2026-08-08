  document.getElementById('htmlInput').addEventListener('change', async (event) => {
    const file = event.target.files[0];
    if (file) {
      // Read text using File Blob API
      const htmlContent = await file.text();
      console.log(htmlContent);
    }
  });