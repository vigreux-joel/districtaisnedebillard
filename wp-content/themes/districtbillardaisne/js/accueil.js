

//display more
let buttons = document.querySelectorAll('article div.display')


//scroll des modales
var isScrolling;
//scroll des modales
var isForcing;
buttons.forEach(button => {
    button.onclick = () => {
        let article = button.parentNode
        let col = article.querySelector('.col')
        if(window.innerWidth < 799){
            let height = col.clientHeight

            //ouvrir
            let hidden = !article.classList.contains('display')
            if(hidden) {
                modaleCreator.add(article)
                modaleCreator.on()
                article.classList.toggle('display')
                button.querySelector('p').textContent = 'Masquer'
            } else {
                modaleCreator.off()
                button.querySelector('p').textContent = 'En savoir plus'
            }

            //scroll top
            if(!hidden){
                //temporaire
                var bodyRect = document.body.getBoundingClientRect(),
                    elemRect = col.getBoundingClientRect(),
                    offset   = elemRect.top - bodyRect.top;
                window.scrollTo({
                    top: offset-130,
                    left: 0,
                    behavior: 'smooth'
                });
            }

            //donner la valeur de base
            col.style.height = height+"px";
            if(hidden) {
                height = col.clientHeight + 400
            } else {
                height = col.querySelector('p:nth-of-type(2)').offsetTop
            }
            col.style.height = height+"px";

            const resize_ob = new ResizeObserver(function(entries) {
                col.classList.add('scroll')

                let rect = entries[0].contentRect;
                let currentHeight = rect.height;


                let finish = false
                if(hidden && currentHeight >= height-200){
                    height = height+400
                    col.style.height = (height)+"px";
                }
                if(hidden && currentHeight >= col.scrollHeight){
                    finish = true
                }
                if(!hidden && currentHeight === height){
                    finish = true
                }
                if(finish){
                    if(!hidden)
                        article.classList.toggle('display')

                    col.style.height = '';
                    col.classList.remove('scroll')
                    resize_ob.unobserve(col);
                }
            });
            resize_ob.observe(col);
        } else {
            modaleCreator.add(article)
            modaleCreator.on()


            //ouvrir
            let hidden = !article.classList.contains('display')
            article.classList.toggle('display')

            if(hidden)
                modaleCreator.get().querySelector('div.display p').textContent = 'Masquer'

            modaleCreator.onOff(()=>{
                article.classList.remove('display')
            })

            modaleCreator.get().querySelector('div.display').onclick = () => {
                modaleCreator.off()
            }
        }
    }
})

