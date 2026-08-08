//Async/Promise-based
import { readFile} from 'node:fs/promises';
import { join } from 'node:path';

async function getHtmlFile() {
    try {
        // Construct file path to the HTML file
        const filePath = join(process.cwd(), 'views', 'index.html');
        // Read file contents as UTF-8 encoded string
        const htmlContent = await readFile(filePath, 'utf-8');

        console.log(htmlContent);
        return htmlContent;
    } catch (error) {
        console.error('Error reading HTML file:', error);
    }
}

getHtmlFile();

import { pathToFileURL} from 'node:url';
import { join } from 'node:path';

async function fetchLocalHtml() {
    // Convert local file path to a file URL
    const filePath = join(process.cwd(), 'index.html');
    const fileUrl = pathToFileURL(filePath);

    const response = await fetch(fileUrl);
    const html = await response.text();

    console.log(html);
}

fetchLocalHtml();