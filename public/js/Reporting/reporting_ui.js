

// const weeklyChart = document.querySelector('#weeklyChart')


// const weeklyChartCanvas = new Chart(ctx, {

    
// })



window.onload = async () => {
    weeklyReport()
}




async function weeklyReport() {

    const tempResult = await fetch('/Reporting/GetReporting', {method:'GET'})
    const result = await tempResult.json()
    console.log(await result)
    return result
}