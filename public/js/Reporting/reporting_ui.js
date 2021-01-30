import { getDataReporting, dataFromReporting } from "./reporting_setter.js";

const dateForReporting = document.querySelector("#dateForReporting");
let financialData = {};
window.onload = async () => {
    dataFromReporting.setDataFromReporting(await getDataReporting(null));
    financialData = dataFromReporting.getDataFromReporting();
    console.log;
    weeklyChartCanvas(financialData);
    monthlyChartCanvas(financialData);
    PoidPromoCanvas(financialData);
    diffVenteCanvas(financialData);
};

const weeklyChart = document.querySelector("#weeklyChart");
const weeklyChartCanvas = data => {
    new Chart(weeklyChart, {
        type: "bar",
        data: {
            labels: ["Vente Semaine", "Vente Mois"],
            datasets: [
                {
                    label: "Nombre de Vente)",
                    backgroundColor: ["#3490dc", "#27A599"],
                    data: [data.nombreVenteWeek, data.nombreVenteMonth],
                    pointBorderColor: "#fff",
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "Aperçu des ventes"
            },
            scales: {
                yAxes: [
                    {
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            max: 100,
                            min: 0
                        }
                    }
                ]
            }
        }
    });
};
const monthlyChart = document.querySelector("#monthlyChart").getContext("2d");
const monthlyChartCanvas = data => {
    console.log(data.nombreVenteMonth, data.RevenueMonth);
    new Chart(monthlyChart, {
        type: "bar",
        data: {
            labels: ["Revenue Semaine", "Revenue Mois"],
            datasets: [
                {
                    label: "Revenue en €",
                    backgroundColor: ["#3490dc", "#27A599"],
                    data: [data.RevenueWeek, data.RevenueMonth]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "Evolution du Chiffre d'affaire"
            },
            scales: {
                yAxes: [
                    {
                        display: true,
                        ticks: {
                            beginAtZero: true,
                          
                        }
                    }
                ]
            }
        }
    });
};

const PoidPromo = document.querySelector("#promoChart");
const PoidPromoCanvas = data => {
    new Chart(PoidPromo, {
        type: "bar",
        data: {
            labels: ["Panier Moyen", "Poids Promo"],
            datasets: [
                {
                    label: "Valeur en €",
                    backgroundColor: ["#3490dc", "#27A599"],
                    data: [data.panierMoyen, data.poidsPromo]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "Panier Moyen et Poids Promo"
            },
            scales: {
                yAxes: [
                    {
                        display: true,
                        ticks: {
                            beginAtZero: true,
                          
                        }
                    }
                ]
            }
        }
    });
};

const diffVente = document.querySelector("#vueDesVentes");

const diffVenteCanvas = data => {
    return new Chart(diffVente, {
        type: "bar",
        data: {
            labels: ["Unité vendue Semaine", "Unité vendue Mois"],
            datasets: [
                {
                    label: "Unité vendu",
                    backgroundColor: ["#3490dc", "#27A599"],
                    data: [data.unitSellWeek, data.unitSellMonth]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: "2volution du nombre d'unité vendu"
            },
            scales: {
                yAxes: [
                    {
                        display: true,
                        ticks: {
                            beginAtZero: true,
                          
                        }
                    }
                ]
            }
        }
    });
};

dateForReporting.onchange = async event => {
    dataFromReporting.setDataFromReporting(
        await getDataReporting(event.target.value)
    );
    financialData = dataFromReporting.getDataFromReporting();
    weeklyChartCanvas(financialData);
    monthlyChartCanvas(financialData);
    PoidPromoCanvas(financialData);
    diffVenteCanvas(financialData);
};

