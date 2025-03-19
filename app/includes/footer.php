<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; 2024</div>
        </div>
    </div>
</footer>
<!-- Include QRCode.js library via CDN -->
<script src="assets/js/qrcode.js"></script>
    
    <script>
        function generateQRCode() {
            // Get the text input
            var text = document.getElementById("qrText").value;

            // Clear any previous QR codes
            document.getElementById("qrcode").innerHTML = "";

            // Generate a new QR code
            if (text !== "") {
                new QRCode(document.getElementById("qrcode"), {
                    text: text,         // The text/URL to encode
                    width: 128,         // Width of the QR code
                    height: 128         // Height of the QR code
                });
            } else {
                alert("Please enter some text or a URL!");
            }
        }

        // Execute the QR code generation when the page is fully loaded
        window.onload = function() {
            generateQRCode();
        };
    </script>

