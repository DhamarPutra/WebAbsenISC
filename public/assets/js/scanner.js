let scanning = true;

function startScanner() {
    const pertemuan = localStorage.getItem("pertemuan");
    if (pertemuan) {
        document.getElementById("pertemuan").value = pertemuan;
        document.getElementById("pertemuanTerakhir").innerText = pertemuan;
        document.getElementById("akhiriPertemuan").value = pertemuan;
    }

    Quagga.init(
        {
            inputStream: {
                type: "LiveStream",
                target: document.querySelector("#interactive"),
                constraints: {
                    width: 640,
                    height: 480,
                    facingMode: "environment",
                },
            },
            decoder: {
                readers: [
                    "code_128_reader",
                    "ean_reader",
                    "ean_8_reader",
                    "code_39_reader",
                    "upc_reader",
                    "upc_e_reader",
                ],
            },
        },
        function (err) {
            if (err) {
                console.error(err);
                alert("Error initializing scanner");
                return;
            }
            Quagga.start();
        }
    );

    Quagga.onDetected(handleDetected);
}

function handleDetected(result) {
    if (!scanning) return;
    scanning = false;

    const code = result.codeResult.code;

    Quagga.stop();

    document.getElementById("scanning").classList.add("hidden");

    const pertemuan = document.getElementById("pertemuan").value;
    localStorage.setItem("pertemuan", pertemuan);

    const csrfToken = document.querySelector('input[name="_token"]').value;

    fetch("/api/absen", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            id_isc: code,
            pertemuan: pertemuan,
            status: "Hadir",
        }),
    })
        .then(async (response) => {
            if (response.ok) {
                const data = await response.json();
                showResult(
                    "success",
                    `Absen berhasil untuk ${data.nama_mahasiswa}`
                );
            } else {
                const errorData = await response.json();
                showResult("error", errorData.message || "Terjadi kesalahan");
            }
        })
        .catch((error) => {
            console.error("Fetch error:", error);
            showResult("error", "Gagal mengirim data.");
        });
}

function showResult(type, message) {
    const resultArea = document.getElementById("resultArea");
    const statusIcon = document.getElementById("statusIcon");
    const statusMessage = document.getElementById("statusMessage");
    const pertemuanSelect = document.getElementById("pertemuan");

    resultArea.classList.remove("hidden");
    statusIcon.innerHTML = "";
    statusMessage.textContent = message;
    pertemuanSelect.value = pertemuan;

    if (type === "success") {
        statusIcon.innerHTML = `<svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`;
        statusMessage.className = "text-green-600 font-bold";
    } else {
        statusIcon.innerHTML = `<svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`;
        statusMessage.className = "text-red-600 font-bold";
    }

    setTimeout(() => {
        window.location.reload();
    }, 2500);
}

startScanner();
