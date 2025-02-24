import Chart from 'chart.js/auto';
window.Chart = Chart;

times = times.slice(0, -1);
average_prices = average_prices.slice(0, -1);

let times_list = times.split(",");
let average_prices_list = average_prices.split(",").map(Number);

const xValues = times_list;
const yValues = average_prices_list;
// setup
const data = {
    labels: xValues,
    datasets: [
        {
            label: "Fuel Price",
            data: yValues,
            backgroundColor: [
                //"rgba(255, 26, 104, 1)", //pink
                "rgba(54, 162, 235, 1)", //blue
                //"rgba(255, 206, 86, 0.2)", //yellow
                //"rgba(75, 192, 192, 0.2)", //torquioze
                //"rgba(153, 102, 255, 0.2)", //purple
                //"rgba(255, 159, 64, 0.2)", //orange
            ],
            borderColor: [
                //"rgba(255, 26, 104, 1)",
                "rgba(54, 162, 235, 1)",
                //"rgba(255, 206, 86, 1)",
                //"rgba(75, 192, 192, 1)",
                //"rgba(153, 102, 255, 1)",
                //"rgba(255, 159, 64, 1)",
            ],
           
        },
    ],
};

// zoomRangeSlider plugin block
let isDragging = false;
let circlePosition = undefined;
let min = 0;
const zoomRangeSlider = {
    id: "zoomRangeSlider",
    afterDatasetsDraw(chart, args, plugins) {
        const {
            ctx,
            chartArea: { left, top, bottom, right, width },
        } = chart;

        circlePosition = circlePosition || left;
        const angle = Math.PI / 180;

        ctx.beginPath();
        ctx.fillStyle = "lightgrey";
        ctx.roundRect(left, bottom + 75, width, 10, 10);
        ctx.fill();

        ctx.beginPath();
        ctx.fillStyle = "black";
        ctx.arc(circlePosition, bottom + 80, 10, 0, 360 * angle, false);
        ctx.fill();
    },
    afterUpdate(chart, args, plugins) {
        chart.options.scales.x.min = min;
    },
    afterEvent(chart, args, plugins) {
        const {
            ctx,
            canvas,
            chartArea: { left, top, right, width },
        } = chart;

        canvas.addEventListener("pointerdown", (e) => {
            isDragging = true;
        });

        window.addEventListener("pointerup", (e) => {
            isDragging = false;
        });

        if (args.event.type === "pointerout") {
            isDragging = false;
        }

        if (args.event.type === "mousemove" && isDragging === true) {
            const val = args.event.x / (width + left);
            min = val * data.labels.length - 1;
            args.changed = true;
            circlePosition =
                args.event.x < left
                    ? left
                    : args.event.x > right
                    ? right
                    : args.event.x;
            chart.update();
        }
    },
};

// config
const config = {
    type: "bar",
    data,
    options: {
        normalized: true,
        responsive: true,
        maintainAspectRatio: false,
        animation: false,
        layout: {
            padding: {
                right: 20,
                bottom: 65,
            },
        },
        scales: {
            y: {
                title: {
                    display: true,
                    text: "Fuel price (AU Cents)",
                },
                beginAtZero: false,
            },
        },
        
    },
    plugins: [zoomRangeSlider],
};

// render init block
const myChart = new Chart(document.getElementById("myChart"), config);
