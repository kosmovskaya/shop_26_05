class Product {
    constructor(id, name, price, text, pic) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.text=text;
        this.pic = pic;
        this.catalogEl=document.querySelector('.catalog');
    }

    renderProduct() {
        let card=document.createElement('div');
        card.classList.add('card');

        let card_inset=document.createElement('div');
        card_inset.classList.add('card-inset');

        card_inset.innerHTML=`
            <div class="card-pic" style="background-image: url(/images/catalog/${this.pic});"></div>
            <div class="card-name">${this.name}</div>
            <div class="card-price">${this.price} руб.</div>
            <div class="add-to-basket" data-id="${this.id}">добавить в корзину</div>
        `;
        card.appendChild(card_inset);
        this.catalogEl.appendChild(card);
    }
}

let products=[];

let currentCategory=1;

class Catalog {
    constructor() {
        this.el = document.querySelector('.catalog');
        this.paginationEl=document.querySelector('.pagination');
    }

    preloaderOn() {
        let preloader=document.createElement('div');
        preloader.classList.add('preloader');
        this.el.appendChild(preloader);
    }

    preloaderOff() {
        this.el.innerHTML='';
    }

    getFiltersData() {
        
        let dataString='';
        let selects=document.querySelectorAll('.choice_section');
        selects.forEach((value, index)=> {
            let selectName=value.getAttribute('data-name');

            let selectedItem=value.querySelector('[data-selected="true"]');

            if(selectedItem) {
                selectedItem=selectedItem.getAttribute('data-content');
                dataString+=`&${selectName}=${selectedItem}`;
            }
        });

        return dataString;
    }

    getCatalogOptions() {
        let priceEl=document.querySelectorAll('.choice_section_list_item');

        priceEl.forEach((value, index)=>{
            value.addEventListener('click', ()=> {
                value.parentNode.classList.toggle('choice_appearance');
                let selectedEl=value.parentNode.querySelector('[data-selected="true"]');
                if(selectedEl) selectedEl.removeAttribute('data-selected');
                
                value.setAttribute('data-selected', 'true');
                let selectedValue=value.getAttribute('data-content');
                
                value.closest('.choice_section').querySelector('.choice_section_name_text').innerText=value.innerText;

                this.renderCatalog(this.getFiltersData());
            });
        });
    }        
    
    changeCategory() {
        let elNavItems=document.querySelectorAll('nav a');  
        let elFooterCollections=document.querySelectorAll('.collections a');
        let elSandboxPage=document.querySelector('.sandbox_page');
        let elNamePage=document.querySelector('.caption h1');

        function changeNavCatalogPage(elIndex) {
            elNavItems.forEach((value, index) => {
                value.classList.remove('nav-link_current');
            });
            elNavItems.forEach((value, index) => {
                index=elIndex;
                elNavItems[index].classList.add('nav-link_current');
                let sandboxPageText=elNavItems[index].innerText;
                elSandboxPage.innerText=sandboxPageText;
                elNamePage.innerText=sandboxPageText;
            });
        }
    
        function changeFooterCatalogPage(elIndex) {
            elFooterCollections.forEach((value, index) => {
                value.classList.remove('footer-item_current');
            });
            elFooterCollections.forEach((value, index) => {
                index=elIndex;
                elFooterCollections[index].classList.add('footer-item_current');
            });
        }
    
        elNavItems.forEach((value, index) => {
            elNavItems[index].addEventListener('click', () => {
                elNavItems.forEach((value, index) => {
                    value.classList.remove('nav-link_current');
                });
                elNavItems[index].classList.add('nav-link_current');
                let sandboxPageText=elNavItems[index].innerText;
                elSandboxPage.innerText=sandboxPageText;
                elNamePage.innerText=sandboxPageText;

                currentCategory=index+1;
                // console.log(currentCategory);
                changeFooterCatalogPage(index);
                this.renderCatalog();
            });
        });
    
        elFooterCollections.forEach((value, index) => {
            elFooterCollections[index].addEventListener('click', () => {
                elFooterCollections.forEach((value, index) => {
                    value.classList.remove('footer-item_current');
                });
                elFooterCollections[index].classList.add('footer-item_current');
                currentCategory=index+1;
                changeNavCatalogPage(index);
                this.renderCatalog();
            });
        });
    }

    renderCatalog(filterData='', numPage=1) {
        this.el.innerHTML='';
        this.paginationEl.innerHTML='';

        this.preloaderOn();

        let xhr = new XMLHttpRequest;
        xhr.open('GET', `/handlers/catalogHandler.php?cat=${currentCategory}&numPage=${numPage}${filterData}`);
        xhr.send();
        // console.log(currentCategory);
        xhr.addEventListener('load', () => {
            this.preloaderOff();

            let data = JSON.parse(xhr.responseText);
            data.products.forEach((value, index) => {
                products[index] = new Product(value.id, value.name, value.price, value.text, value.pic);
                products[index].renderProduct();
            });

            for(let i=1; i<=data.pagination.countPages; i++) {
                let page=document.createElement('div');
                page.classList.add('page');

                let page_inset=document.createElement('div');
                page_inset.classList.add('page_inset');

                page_inset.innerText=i;

                if(numPage==page_inset.innerText) {
                    page_inset.classList.add('page_inset_current');
                } else {
                    page_inset.classList.remove('page_inset_current');
                }

                page.appendChild(page_inset);

                this.paginationEl.appendChild(page);

                let that=this;
                page_inset.addEventListener('click', function() {
                    let num=this.innerText;

                    that.renderCatalog(that.getFiltersData(), num);
                });
            }

            let elCategories=document.querySelectorAll('.category .choice_section_list_item');
            elCategories.forEach((value, index) => {
                value.innerText=data.categories[index];
            });
        });
    }

    choiceCatalogItems() {
        let choiceSectionEls=document.getElementsByClassName('choice_section');

        for (let i=0; i<choiceSectionEls.length; i++) {
            let choiceNameEl=choiceSectionEls[i].querySelector('.choice_section_name');
            let choiceNameArrowEl=choiceNameEl.querySelector('.choice_section_name_arrow');
            let choiceListEl=choiceSectionEls[i].querySelector('.choice_section_list');

            choiceNameEl.addEventListener('click', ()=> {
                choiceNameArrowEl.classList.toggle('arrow-up');
                choiceListEl.classList.toggle('choice_appearance');
            });
        }
    }
}

let catalog = new Catalog();
catalog.renderCatalog();
catalog.getCatalogOptions();
catalog.choiceCatalogItems();
catalog.changeCategory();




