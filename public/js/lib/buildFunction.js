
export function buildArray(array,cible,functionOnClick,ignoreString) {
    cible.innerHTML = "";
    let thead = document.createElement("thead");
    let tbody = document.createElement("tbody");
    let i = 0;
    let index = 1;
    for (let ref of array) {
        
        let tr = document.createElement("tr");
        tr.onclick = () => functionOnClick(ref);
        let y = 0;
        for (let propriete in ref) {
            if (i === 0) {
                // limit 1 header
                if (!propriete.includes(ignoreString)) {
                    let th = document.createElement("th");
                    let thText = document.createTextNode(propriete);
                    th.appendChild(thText);
                    thead.appendChild(th);
                } else if (y === 0) {
                    let th = document.createElement("th");
                    let thText = document.createTextNode("Index");
                    th.appendChild(thText);
                    thead.appendChild(th);
                }
            }
            if (!propriete.includes(ignoreString)) {
                let td = document.createElement("td");
                let tdText = document.createTextNode(ref[propriete]);
                td.appendChild(tdText);
                tr.appendChild(td);
            } else if (y === 0) {
                let td = document.createElement("td");
                let tdText = document.createTextNode(index);
                td.appendChild(tdText);
                tr.appendChild(td);
            }
            y++;
        }
        tbody.appendChild(tr);
        i++;
        index++;
    }
    cible.appendChild(thead);
    cible.appendChild(tbody);
    console.log("------- Array Build --------");
}

/**
 * IMPORTANT Don't call immediatly this function
 * build modal with propriety of item .
 * @param {*} item - object set in the building array tr
 * @param {*} title - DOM element where title will be insert
 * @param {*} cible - DOM element where input will be insert (form)
 * @param {*} ignore - string include who will be use for generate hidden input
 */
export function buildModalOnClick(item,title,cible,ignore) {
    title.innerHTML = "Action concernant : ";
    title.insertAdjacentHTML(
        "beforeend",
        item.brandName || item.categoryName || item.product_name
    );
    cible.innerHTML = "";
    for (let ref in item) {
        if (ref.includes(ignore)) {
            cible.insertAdjacentHTML(
                "afterbegin",
                '<input type="hidden" name="' +
                    ref +
                    '"value="' +
                    item[ref] +
                    '">'
            );
        } else {
            cible.insertAdjacentHTML(
                "afterbegin",
                '<input type="text" name="' +
                    ref +
                    '" value="' +
                    item[ref] +
                    '" placeholder="' +
                    item[ref] +
                    '" >'
            );
            cible.insertAdjacentHTML(
                "afterbegin",
                "<label>Modifier " + ref + "</label>"
            );
        }
    }
}

export function buildNotification(arrayNotification,cible,doItFunction){
const ignoreProp ='_id'
    cible.innerHTML=''
    for (const notification of arrayNotification){
       let row = document.createElement('tr')
       let actionTd =document.createElement('td')
       let actionTdButton = document.createElement('input')
       actionTdButton.type='button'
       actionTdButton.value='Traité'

       actionTdButton.onclick = () => {
           doItFunction(notification)
       }
       for (const prop in notification){
           if(!prop.includes(ignoreProp)){
               let td = document.createElement('td')
               let tdText = document.createTextNode(notification[prop])
               td.append(tdText)
               row.append(td)
           }
       }
       actionTd.append(actionTdButton)
       row.append(actionTd)
       cible.append(row)
    }
}


