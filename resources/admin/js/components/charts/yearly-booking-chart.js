import ApexCharts from "apexcharts";

// ===== chartOne
const yearlyBookingChart = async () => {
    const chartEl = document.querySelector("#chartOne");
    if (!chartEl) return;

    try {
        // 👇 Fetch data from your Laravel API endpoint
        const response = await fetch("/admin/yearly-bookings");
        const result = await response.json();

        // Expecting response like: { data: [168, 385, 201, ...] }
        // Or: { labels: ["Jan", "Feb", ...], data: [168, 385, ...] }

        const months = result.labels || [
            "Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec",
        ];

        const values = result.data || [];

        const chartOptions = {
            series: [
                {
                    name: "Bookings",
                    data: values,
                },
            ],
            colors: ["#465fff"],
            chart: {
                fontFamily: "Outfit, sans-serif",
                type: "bar",
                height: 180,
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "39%",
                    borderRadius: 5,
                    borderRadiusApplication: "end",
                },
            },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 4, colors: ["transparent"] },
            xaxis: {
                categories: months,
                axisBorder: { show: false },
                axisTicks: { show: false },
            },
            legend: {
                show: true,
                position: "top",
                horizontalAlign: "left",
                fontFamily: "Outfit",
                markers: { radius: 99 },
            },
            yaxis: { title: false },
            grid: { yaxis: { lines: { show: true } } },
            fill: { opacity: 1 },
            tooltip: {
                x: { show: false },
                y: {
                    formatter: (val) => val,
                },
            },
        };

        const chart = new ApexCharts(chartEl, chartOptions);
        chart.render();
    } catch (error) {
        console.error("Failed to load chart data:", error);
    }
};

export default yearlyBookingChart;
