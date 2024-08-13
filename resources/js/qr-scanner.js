import { Html5Qrcode } from "html5-qrcode";

document.addEventListener("DOMContentLoaded", function() {
    let scanner;

    function startScanner() {
        // Create a new instance of Html5Qrcode
        const qrScanner = new Html5Qrcode("camera-stream");

        // Start the QR scanner
        qrScanner.start(
            { facingMode: "environment" }, // Use the back camera
            { fps: 10, qrbox: 250 },
            (decodedText, decodedResult) => {
                // Handle successful scan
                document.getElementById("scan-result").textContent = `QR Code: ${decodedText}`;
                qrScanner.stop().then(() => {
                    console.log("QR Code scanning stopped.");
                }).catch(err => {
                    console.error("Error stopping the scanner:", err);
                });
            },
            (error) => {
                // Handle scan errors
                console.error("Scan error:", error);
                document.getElementById("scanning-status").textContent = "Error scanning QR code.";
            }
        ).catch(err => {
            console.error("Error starting the scanner:", err);
            document.getElementById("scanning-status").textContent = "Failed to start camera.";
        });

        // Assign to a global variable if needed
        scanner = qrScanner;
    }

    // Start scanning when the button is clicked
    document.getElementById("scan-button").addEventListener("click", function() {
        startScanner();
    });
});
