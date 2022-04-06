//Charger les compétition de la saison actuelle
let data = new FormData();
data.append('year', '');
fetch("?api=getCompetition", {method: "post", body: data})
    .then(rep => {
        rep.json()
            .then(datas => {
                let articles = document.querySelector('.articles')
                let saison = document.querySelector('main h2')
                let year = datas.year
                saison.innerHTML = 'Saison '+year+'-'+ (parseInt(year)+1)

                datas.etape.forEach(data => {
                    let article = document.createElement('article')
                    article.innerHTML = `
                        <div>
                            <h3>${data.titre}</h3>
                            <span>-</span>
                            <h4>${data.date}</h4>
                        </div>
                        
                        <p>${data.description}</p>
                    `
                    articles.appendChild(article)

                    //console.log(article.querySelectorAll(':scope > ul > li'));


                    let div = document.createElement('div')
                    div.classList.add('links')
                    article.appendChild(div)
                    for(let li of article.querySelectorAll(':scope > ul > li')){
                        let link = li.querySelector('li').textContent
                        let name = li.textContent.replace(link , '');
                        div.innerHTML += `<a href="${link}" title="${name}">${name}</a>`

                        div.innerHTML += `<span>|</span>`
                    }

                    let del = div.querySelector('span:last-of-type')
                    if(del)
                        del.remove()
                    del = article.querySelector('p')
                    if(del)
                        del.remove()
                    del = article.querySelector('ul')
                    if(del)
                        del.remove()
                })

                let before = document.querySelector('#competition .next:first-of-type')
                before.querySelector('p').innerHTML = 'Saison '+year+'-'+ (parseInt(year)+1)
                console.log(before)
            })
    })
    .catch(err => {
        console.log(err)
    });

