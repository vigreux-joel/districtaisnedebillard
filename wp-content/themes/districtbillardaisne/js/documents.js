menuBackgroundOn()

let input = document.querySelector('main input')
input.oninput = () => {
    if(input.value.trim().length > 0){
        for(let article of document.querySelectorAll('main article')){
            let content = article.querySelector('h3').textContent;
            content += article.querySelector('h4').textContent;

            article.classList.remove('hidden')
            input.value.toLowerCase().split(' ').forEach(arg=>{
                console.log(arg)
                if(!content.toLowerCase().includes(arg)){
                    article.classList.add('hidden')
                }
            })
        }
    } else {
        for(let article of document.querySelectorAll('main article')){
            article.classList.remove('hidden')
        }
    }
}