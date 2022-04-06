


class Scroll{
    private scrollY;
    private min = [];
    private max = [];

    constructor() {
        scrollY = this.getY();

        window.addEventListener('scroll', function(e) {
        })
    }

    getY(){
        return window.scrollY;
    }
}




class oldMediaQ{

    private min = [];
    private max = [];
    private event

    constructor(width?, fonc?, sign?: string) {
        this.add(width, fonc, sign)
    }

    private reload(){
        let min = this.getMin()
        let max = this.getMax()
        removeEventListener('resize', this.event)
        this.event = function (){
            let width = window.innerWidth;
            for (let mediaq of min) {
                if(width < mediaq[0]){
                    break
                }
                mediaq[1]()
            }
            for (let mediaq of max) {
                if(width > mediaq[0]){
                    break
                }
                mediaq[1]()
            }
        }
        addEventListener('resize', this.event)
    }
    public add(width, fonc, sign?){
        if( width == undefined || fonc == undefined)
            return;

        if(sign == '<') {
            if (width > window.innerWidth)
                fonc()
        }
        else if(width < window.innerWidth)
            fonc()

        if(sign == '<' || sign == 'max')
            sign = this.getMax();
        else
            sign = this.getMin();
        sign.push([width, fonc]);
        sign.sort((a,b)  => {
            return a[0] - b[0];
        })
        this.reload()
    }
    public getMin(){
        return this.min
    }
    public getMax() {
        return this.max
    }
}

class MediaQ{

    private min = [];
    private max = [];
    private static instance;

    constructor() {
    }

    private static getInstance(){
        if(this.instance == null)
            this.instance = new MediaQ()
        return this.instance
    }


    private reload(){
        let min = this.getMin()
        let max = this.getMax()
        window.onresize = () => {
            let width = window.innerWidth;
            let ids;
            for (let mediaq of min) {
                if(width < mediaq[0]){
                    break
                }
                if(mediaq[2] !== undefined){
                    if(ids.includes(mediaq[2]))
                        return
                    ids.push(mediaq[2])
                }
                mediaq[1]()
            }
            for (let i = max.length-1; i>=0;i--) {
                let mediaq = max[i]
                if(width > mediaq[0]){
                    break
                }
                if(mediaq[2] !== undefined){
                    if(ids.includes(mediaq[2]))
                        return
                    ids.push(mediaq[2])
                }
                mediaq[1]()
            }
        }
    }
    public static add(width, fonc, sign?, id?){
        let mediaQ = this.getInstance()
        if( width === undefined || fonc === undefined)
            return;

        if(sign == '<') {
            if (width > window.innerWidth)
                fonc()
        }
        else if(width < window.innerWidth)
            fonc()

        if(sign == '<' || sign == 'max')
            sign = mediaQ.getMax();
        else
            sign = mediaQ.getMin();
        sign.push([width, fonc, id]);
        sign.sort((a,b)  => {
            return a[0] - b[0];
        })
        mediaQ.reload()
    }
    public getMin(){
        return this.min
    }
    public getMax() {
        return this.max
    }
}




function sizeChecker(width){

    if(window.innerWidth > width)

        return true

    else return false

}

class modaleCreator{


    private element
    private parent
    private static instance;
    public onOff;

    constructor() {
    }

    private static getInstance(){
        if(this.instance == null)
            this.instance = new modaleCreator()
        return this.instance
    }
    public static add(Element){
        let modaleCreator = this.getInstance()
        modaleCreator.setElement(Element)
    }
    public static get(Element){
        let modaleCreator = this.getInstance()
        return modaleCreator.getElement()
    }

    public  static on(){
        this.off()
        let modales: any = document.querySelectorAll('.modale-off')
        for (let modale of modales) {
            modale.classList.remove('modale-off')
            modale.classList.add('modale-on')
        }

        let modaleCreator = this.getInstance()
        let body = modaleCreator.getParent()
        let voile = document.createElement('div')
        voile.classList.add('voile')
        voile.onclick = () => {
            this.off()
        }
        body.appendChild(voile)

        body.appendChild(modaleCreator.getElement())

        document.addEventListener('keydown', (e) => {
            if(e.key == 'Escape')
                this.off()
        })
    }
    public static onOff(func){
        let modale = this.getInstance()
        modale.onOff = func
    }
    public static off(){
        let run =this.getInstance().onOff
        if(run !== undefined)
            run()

        let modales: any = document.querySelectorAll('.modale-on')
        for (let modale of modales) {
            modale.classList.remove('modale-on')
            modale.classList.add('modale-off')
        }

        let modale = document.querySelector('.modale')
        if(modale !== null)
            modale.remove()
        let voile = document.querySelector('.voile')
        if(voile !== null)
            voile.remove()
    }



    public getElement(){
        return this.element
    }
    public setElement(element){
        this.setParent(element.parentNode)
        let oldModale = document.querySelector('.modale')
        if(oldModale !== null)
            oldModale.remove()
        element = element.cloneNode(true)
        element.className = 'modale';
        this.element = element
    }


    private setParent(value) {
        this.parent = value;
    }
    private getParent() {
        return this.parent;
    }



    private create() {
        document.querySelector('body').appendChild(this.element)
    }
}



