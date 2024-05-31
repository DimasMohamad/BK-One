<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        #controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }

        #pdfViewerContainer {
            flex: 1;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        canvas {
            border: 1px solid black;
            transition: transform 0.3s ease;
            /* Add smooth transition */
        }
    </style>
</head>

<body>
    <div id="controls">
        <button onclick="zoomOut()">-</button>
        <button onclick="zoomIn()">+</button>
    </div>
    <div id="pdfViewerContainer">
        <canvas id="pdfCanvas"></canvas>
    </div>

    <script>
        let pdfDoc = null;
        let pageNum = 1;
        let scale = 1.0;
        const urlParams = new URLSearchParams(window.location.search);
        const url = urlParams.get('file');
        const pdfCanvas = document.getElementById('pdfCanvas');

        function renderPage(num, scale) {
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({
                    scale: scale
                });
                const context = pdfCanvas.getContext('2d');

                pdfCanvas.height = viewport.height;
                pdfCanvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                page.render(renderContext);
            });
        }

        function zoomIn() {
            scale += 0.2;
            pdfCanvas.style.transform = `scale(${scale})`;
            renderPage(pageNum, scale);
        }

        function zoomOut() {
            if (scale > 0.4) {
                scale -= 0.2;
                pdfCanvas.style.transform = `scale(${scale})`;
                renderPage(pageNum, scale);
            }
        }

        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdfDoc = pdf;
            renderPage(pageNum, scale);
        });
    </script>
</body>

</html>