import { useState, useEffect, useRef, useCallback } from 'react';

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