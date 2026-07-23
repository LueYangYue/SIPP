function markRisk(studID, gpCode) {
    const chart = document.getElementById("pngChart");
    const container = document.getElementsByClassName("intervention-container");
    chart.addEventListener("click", function() {
        const session = prompt("Sila masukkan SEM/SESI prestasi berdasarkan label untuk menandakan risiko (Cth: 2/20252026)");
        fetch("warning_risk.php?stud_id=" + studID + "&gp_code=" + gpCode + "&session=" + session)
        .then(response=>response.text())
        .then(text => {
            if (text == "") {
                container.innerHTML = text;
                message = `Peringatan telah dihantar kepada pelajar ${studID} bagi prestasi ${session}`;
            } else if (text == "Berisiko") {
                message = `Prestasi pelajar ${studID} bagi ${session} SUDAH dinilai sebagai berisiko.`;
            } else {
                message = `Ralat: Semester/Sesi prestasi tidak dikenal pasti, gagal menandakan risiko.`;
                console.log(text);
            }
            alert(message);
        });
    });
};

function planIntervention(studID, gpCode) {
    const chart = document.querySelector("#pngChart");
    const container = document.querySelector(".intervention-container");
    chart.addEventListener("click", function() {
        let message = "";
        let session = prompt("Sila masukkan SEM/SESI prestasi berdasarkan label untuk menandakan risiko (Cth: 2/20252026)");
        fetch("warning_risk.php?stud_id=" + studID + "&gp_code=" + gpCode + "&session=" + session)
        .then(response=>response.text())
        .then(text => {
            if (text == "") {
                container.innerHTML = text;
                message = `Peringatan telah dihantar kepada pelajar ${studID} bagi prestasi ${session}`;
            } else if (text == "Berisiko") {
                message = `Prestasi pelajar ${studID} bagi ${session} SUDAH dinilai sebagai berisiko.`;
            } else {
                message = `Ralat: Semester/Sesi prestasi tidak dikenal pasti, gagal menandakan risiko.`;
                console.log(text);
            }
            alert(message);
            const makePlan = prompt("Adakah perancangan intervensi diperlukan? (Ya/Tidak)");
            if (makePlan.toLowerCase() === "ya") {
                if (message === "" || message.substring(0, 5) === "Ralat") {
                    session = prompt("Sila masukkan SEM/SESI prestasi berdasarkan label untuk merancang intervensi (Cth: 2/20252026)");}
                if (session.trim().match(/^\d+\/\d{4}\d{4}$/)) {
                    fetch("plan_intervention.php?stud_id=" + studID + "&gp_code=" + gpCode + "&session=" + session + "&plan_filled=false")
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
    }); notifyRisk(id);
    alert("Peringatan telah ditandai sebagai dibaca.");
}
