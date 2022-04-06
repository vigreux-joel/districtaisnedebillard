//cache le menu ou non par default
MediaQ.add(1025, () => { hidden(true); }, '<');
MediaQ.add(1024,() => { hidden(false); }, ">");

//créer les sous onglets
for(let list of document.querySelectorAll('.menu .children')){
    let parent = list.parentNode


    parent.querySelector('a').onclick = (e) => {
        e.preventDefault()
        if(document.querySelector('nav').classList.contains('hidden')){
            ongletToggle(parent)
        } else ongletToggle(parent, true)
    }

    parent.querySelector('a').onmouseenter = (e) => {
        if(document.querySelector('header nav').classList.contains('hidden'))
            return
        if(!parent.classList.contains('open'))
            ongletToggle(parent)
    }
    parent.querySelector('a').onmouseout = (e) => {
        if(document.querySelector('header nav').classList.contains('hidden'))
            return
        if(!parent.contains(e.relatedTarget)){
            ongletToggle(parent, false)
        }
        else list.onmouseout = (event) => {
            if(document.querySelector('header nav').classList.contains('hidden'))
                return
            if(!parent.contains(event.relatedTarget )){
                ongletToggle(parent, false)
            }
        }
    }

}
//ajouter les background
function menuBackgroundOn(){
    let nav = document.querySelector('header')
    if(!nav.classList.contains('background')){
        for(let onglet of document.querySelectorAll('.page_item a:not(.children a)')){
            onglet.classList.add('background')
        }
        nav.classList.add('background')
    }
}
//ajoute le background et d'une facon rapide la premiere fois pour l'onglet ciblé + l'ouvre
function ongletToggle(parent, close){
    let nav = document.querySelector('header')
    let actu = parent.querySelector('a:not(.children a)')
    if(!parent.classList.contains('open') && !actu.classList.contains('background')){
        let actu = parent.querySelector('a:not(.children a)')

        actu.style.transition = '0.15s';
        actu.classList.add('background');
        setTimeout(()=>{
            actu.style.transition = ''
        },150)

        for(let onglet of document.querySelectorAll('.page_item a:not(.children a)')){
            if(onglet !== actu){
                onglet.classList.add('background')
            }
        }
        nav.classList.add('background')
    }

    if(close !== undefined){
        if(close === false)
            parent.classList.remove('open')
        else parent.classList.add('open')
    } else{
        parent.classList.toggle('open')
    }
}

//ajout du burger
var burger = document.getElementById('burger');
burger.onclick = () => {
    toggleMenu()
};


//cacher/montrer la navbar au scroll
var scrollYOld = 0
var scrollAmount = 0
window.addEventListener('scroll', () => {
    let nav = document.querySelector("header");
    let menu =document.querySelector(".menu")

    //translate
    if(scrollY > scrollYOld){
        nav.classList.add('translateY')
        scrollAmount = window.scrollY-100
        if(menu.classList.contains('open')){
            menu.classList.add('translateY')
            setTimeout(()=>{
                menu.classList.remove('translateY')
            }, 750)
        }
    } else {
        if(window.scrollY <= scrollAmount){
            nav.classList.remove('translateY')
        }
    }

    //fermer menu au scroll
    if(menu.classList.contains('open'))
        toggleMenu()
    else
        menu.querySelectorAll('.open').forEach(open => {
            open.classList.remove('open')
        })

    scrollYOld = window.scrollY

    if (window.scrollY > 100) {
        nav.classList.add('background')
    }
})


//toggle le menu (responsive)
function hidden(bol) {
    var nav = document.querySelector("header nav");
    if (bol) {
        if (!document.getElementById('page_actuel')) {
            var name_1 = document.querySelector('.current_page_item a').textContent;
            var page_1 = document.createElement("p");
            page_1.id = "page_actuel";
            page_1.textContent = name_1;
            //temp
            if(name_1 === 'Accueil')
                document.querySelector('header').appendChild(page_1);
            page_1.style.opacity = '0';
            setTimeout(function () {
                page_1.style.opacity = '1';
            }, 300);
        }
        nav.classList.remove('visible');
        nav.classList.add('hidden');
    }
    else {
        var pageActuel = document.getElementById('page_actuel');
        if (pageActuel != null)
            pageActuel.remove();
        nav.classList.remove('open');
        document.querySelector(".menu").classList.remove('open');
        document.getElementById('burger').classList.remove('clicked');
        nav.classList.remove('hidden');
        nav.classList.add('visible');
    }
}

//ouvre-ferme le menu en responsive
function toggleMenu() {
    var menu = document.querySelector("nav.hidden .menu");
    if (menu.classList.contains('open')) {
        menu.querySelector('ul').style.transform = 'translateX(100%)';
        setTimeout(function () {
            menu.classList.remove('open');
            menu.querySelectorAll('.open').forEach(open => {
                open.classList.remove('open')
            })
            document.querySelector("header nav").classList.remove('open');
            menu.querySelector('ul').style.transform = '';
        }, 650);
        setTimeout(function () {
            burger.classList.remove('clicked');
        }, 300);
    }
    else {
        burger.classList.add('clicked');
        menu.classList.add('open');
        document.querySelector("header").classList.add('background');
        document.querySelector("header nav").classList.add('open');
    }
}

