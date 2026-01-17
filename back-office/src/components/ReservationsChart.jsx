import 'chart.js/auto';
import { Bar } from "react-chartjs-2";

export const ReservationsChart = ({ chartTitle, reservationsData }) => { 
    //calculate total of places reserved
    const totalCount = Object.values(reservationsData).map((d) => {
        let total = 0;
        d.map(r => total = total + (r.child_tickets + r.student_tickets + r.adult_tickets))
        return total;
    });

    //chart configuration
    const options = {
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                suggestedMax: 20,
                ticks: {
                    stepSize: 2,
                    font: {
                        family: "'Outfit', sans-serif",
                    },
                }
            },
            x: {
                ticks: {
                    font: {
                        family: "'Outfit', sans-serif",
                    },
                }
            }
          },
        plugins: {
            legend: {
                position: 'top',
                onClick: null,
                labels: {
                    font: {
                        family: "'Outfit', sans-serif",
                    },
                }
            },
            title: {
                display: true,
                text: chartTitle,
                font: {
                    family: "'Outfit', sans-serif",
                }
            },
        },
    };
    const labels = Object.keys(reservationsData);
    const data = {
        labels,
        datasets: [
            {
                label: 'Reservations',
                data: totalCount,
                backgroundColor: '#AFBF75',
            },
        ],
    };
          
    return (
        <div className="chart">
            <Bar data={data} options={options} height={420}/>
        </div>
    )
}