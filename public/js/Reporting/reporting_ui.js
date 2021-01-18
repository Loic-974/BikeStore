import {getDataReporting, dataFromReporting} from './reporting_setter.js'

window.onload = async () => {
    dataFromReporting.setDataFromReporting(await getDataReporting())
    console.log(dataFromReporting.value)
}

const weeklyChart = document.querySelector('#weeklyChart')
const weeklyChartCanvas = new Chart(weeklyChart, {
    type: 'bar',
    data: {
        labels: ['Nombre Vente', 'Chiffre Affaire'],
        datasets: [{
            label: 'Nombre Vente', 
            data: [dataFromReporting.nombre,dataFromReporting.Revenue],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
               
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});









// async function weeklyReport() {

//     const tempResult = await fetch('/Reporting/GetReporting', {method:'GET'})
//     const result = await tempResult.json()
//     console.log(await result)
//     return result
// }