function markRisk(studID) {
    const chart = document.getElementById("pngChart");
    const container = document.getElementsByClassName("intervention-container");
    chart.addEventListener("click", function() {
        const session = prompt("Sila masukkan SESI prestasi berdasarkan label untuk menandakan risiko (Cth: 2/20252026)");
        fetch("warning_risk.php?stud_id=" + studID + "&session=" + session)
        .then(response=>response.text())
        .then(text => {
            if (text == "") {
                container.innerHTML = text;
                message = `Peringatan telah dihantar kepada pelajar ${studID} bagi prestasi ${session}`;
            } else if (text == "Berisiko"){
                message = `Prestasi pelajar ${studID} bagi sesi ${session} SUDAH dinilai sebagai berisiko.`;
            } else {
                message = `Ralat ${text}`;
            }
            alert(message);
        });
    });
};

function planIntervention(studID) {
    const chart = document.querySelector("#pngChart");
    const container = document.querySelector(".intervention-container");
    chart.addEventListener("click", function() {
        let message = "";
        let session = prompt("Sila masukkan SESI prestasi berdasarkan label untuk menandakan risiko (Cth: 2/20252026)");
        fetch("warning_risk.php?stud_id=" + studID + "&session=" + session)
        .then(response=>response.text())
        .then(text => {
            if (text == "") {
                container.innerHTML = text;
                message = `Peringatan telah dihantar kepada pelajar ${studID} bagi prestasi ${session}`;
            } else if (text == "Berisiko"){
                message = `Prestasi pelajar ${studID} bagi sesi ${session} SUDAH dinilai sebagai berisiko.`;
            } else {
                message = `Ralat ${text}`;
            }
            alert(message);
            const makePlan = prompt("Adakah perancangan intervensi diperlukan? (Ya/Tidak)");
            if (makePlan.toLowerCase() === "ya") {
                if (message === "" || message.substring(0, 5) === "Ralat") {
                    session = prompt("Sila masukkan SESI prestasi berdasarkan label untuk merancang intervensi (Cth: 2/20252026)");
                }
                if (session.trim().match(/^\d+\/\d{4}\d{4}$/)) {
                    fetch("plan_intervention.php?stud_id=" + studID + "&session=" + session + "&plan_filled=false")
                    .then(response => response.text())
                    .then(form => {
                        container.innerHTML = form;
                    });
                }
            }
        });
    });
};

function notifyRisk(id) {
    const list = document.querySelector(".notifications-list");
    fetch("warning_risk.php?id=" + id)
    .then(response => response.text())
    .then(text => {
        list.innerHTML = text;
    });
}

function markRead(button, no, id) {
    const list = document.querySelector(".notifications-list");
    fetch("warning_risk.php?no=" + no + "&id=" + id)
    .then(response=>response.text())
    .then(text => {
        list.innerHTML = text;
    });
    notifyRisk(id);
    alert("Peringatan telah ditandai sebagai dibaca.");
}
/*const button = document.querySelector(".notifications");
button.addEventListener("mouseover", function() {
    fetch("/src/warning_risk.php")
    .then(response=>response.text())
    .then(list => {
        list.innerHTML = list;
    });
});
*/
