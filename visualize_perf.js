function filterYear(year) {
    const tPerf = this.document.querySelector("div#table-container");
    fetch("/src/filter_perf.php?year=" + year)
        .then(response => response.text())
        .then(text => tPerf.innerHTML = text);
}

function listXValues(session, semester) {
    let next_session = session, sem, year;
    let xValues = [];
    xValues.unshift(next_session);
    for (let i = 0; i < semester - 1; i++) {
        console.log("Counter:", i);
        console.log("For loop iteration:", next_session);
        sem = next_session.substring(0, 2);
        if (sem === "1/") {
            next_session = next_session.replace(sem, "2/");
            year = Number(next_session.substring(8, 10));
            next_session = next_session.replace(year, year - 1).replace(year - 1, year - 2); 
            xValues.unshift(next_session);
        } else if (sem === "2/") {
            next_session = next_session.replace(sem, "1/");
            xValues.unshift(next_session);
        }
        console.log("Updated next_session:", next_session);
    }
    return xValues;
}

function visualizePNG(session = "2/20252026", semester = 6, name = "Pelajar", points = [3.93, 3.76, 3.29, 3.51, 3.23, 3.28], sessions = null) {
    const xValues = sessions ? sessions : listXValues(session, semester);
    const yValues = points; // Array object
    const ctx = document.getElementById("pngChart");
    new Chart(ctx, {
        type: "line", 
        data: {
            labels: xValues, 
            datasets: [{
                backgroundColor: "rgba(25,0,255,1.0)", 
                borderColor: "rgba(25,0,255,0.1)",
                data: yValues
            }]
        },  
        options: {
            plugins: {
                legend: {display: false}, 
                title: {
                    display: true,
                    text: "Carta PNG " + name, 
                    font: {size: 12}
                }
            }
        }
    });
}

function analyzePerf(button) {
    const xhttp = new XMLHttpRequest();
    const id = button.parentNode.parentNode.children[0].textContent; 
    const name = button.parentNode.parentNode.children[1].textContent;
    xhttp.open("GET", "/src/analysis_perf.php?id=" + id + "&name=" + name, true);
    xhttp.send();
    document.location="/src/analysis_perf.php?id=" + id + "&name=" + name;
}
//Please use session and semester
//Assume short semester is not counted, functions below are not used
function calcStartSession(session, year) {
    let year1 = Number(session.substring(4, 6));
    let year2 = Number(session.substring(8, 10));
    let start_session = session.replace("2/", "1/");
    start_session = start_session.replace(year1, year1 - year + 1);
    start_session = start_session.replace(year2, year2 - year + 1);
    return start_session;
}

//Assume there is no deferment
function countXValues(session, year) {
    let xValues = []; xValues.push(start_session);
    let next_session = start_session;
    let semester;
    let year1;
    let year2;
    let counter = 0;
    while (next_session !== session) {
        if (counter > 8) {
            return xValues; // Prevent infinite loop
        }
        console.log("Counter:", counter);
        counter++;
        console.log("While loop iteration:", next_session);
        semester = next_session.substring(0, 2);
        if (semester === "1/") {
            next_session = next_session.replace(semester, "2/");
            xValues.push(next_session);
        } else if (semester === "2/") {
            next_session = next_session.replace(semester, "1/");
            year1 = Number(next_session.substring(4, 6));
            year2 = Number(next_session.substring(8, 10));
            next_session = next_session.replace(year2, year2 + 1);
            next_session = next_session.replace(year1, year1 + 1); 
            //Order is changed to prevent replacing the wrong year first
            console.log(year1, year2);
            xValues.push(next_session);
        }
        console.log("Updated next_session:", next_session);
    }
    console.log("Final xValues:", xValues);
    return xValues;
}