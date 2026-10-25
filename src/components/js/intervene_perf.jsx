//Async/Promise-based
import { useState, useEffect, useRef, useCallback } from 'react';
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

async function loadTemplate() {
    try {
        const response = await fetch('/SIPP/landing.html');
        const html = await response.text();

        // Inject it into the DOM
        document.getElementById('content').innerHTML = html;
    } catch (err) {
        console.error('Error loading template:', err);;
    }
}

export function ReminderItem({ tab, isActive, isCompact}) {
    const onLeave = useCallback(() => setHovered(false), []);
}
//type ResizeCallback = (entry: ResizeObserverEntry) => void;
/*useNotif(() => {
const pinnedIconSize = isCompact ? 10 : 14;
const pinnedButtonSizeClass = isCompact ? "h-5 w-5" : "h-6 w-6";
return { iconSize: pinnedIconSize, buttonSizeClass: pinnedButtonSizeClass };
const iconSize = isCompact ? 10 : 14;
const buttonSizeClass = isCompact ? "w-6 h-6" : "w-7 h-7";
return { iconSize, buttonSizeClass };   
})*/

/*const button = document.querySelector(".notifications");
button.addEventListener("mouseover", function() {
    fetch("/sipp/warning_risk.php")
    .then(response=>response.text())
    .then(list => {
        list.innerHTML = list;
    });
});
*/
//Look for Dependency & Configuration Files
//node -v
//npm -v