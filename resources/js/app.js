/*
========== TABLE OF CONTENT start ==========

- SIDE BAR
- TOM SELECT
- SWIPER JS CLINICS
- SWIPER JS PARNERS
- SWIPER JS DOCTORS
- SWIPER JS DAYS
- MODAL
- PRESCRIPTIONS ACCORDION
- LAB TESTS ACCORDION
- TOAST MSG

========== TABLE OF CONTENT end ==========
*/


////////// SIDE BAR (start) //////////
const sidebar = document.querySelector('#sidebar');
const closeSidebar = document.querySelector('#close-sidebar');
const openSidebar = document.querySelector('#open-sidebar')
const sidebarOverlay = document.querySelector('#sidebar-overlay')

closeSidebar.addEventListener('click', () => {
    toggleSidebar();
})

openSidebar.addEventListener('click', () => {
    toggleSidebar();
})

sidebarOverlay.addEventListener('click', () => {
    toggleSidebar();
})

const toggleSidebar = () => {
    sidebar.classList.toggle('open');

    sidebarOverlay.classList.toggle('hidden');
    sidebarOverlay.classList.toggle('block');

    document.body.classList.toggle('overflow-hidden');
    document.body.classList.toggle('overflow-scroll');


}

////////// SIDE BAR (end) //////////




////////// TOM SELECT (start) //////////
//Translate terms of Tom Select:
var terms= {add:'Search for ',noResult:'No results'};
var locale = document.getElementsByTagName("html")[0].getAttribute("lang");
if(locale == 'ar'){
    terms.add = 'البحث عن';
    terms.noResult = 'لا توجد نتائج';
}

//Search keyword:
let searchKeywordSettings = {

    create: true,
    addPrecedence: true,
    openOnFocus: false,
    closeAfterSelect: true,
    //	If false, items created by the user will not show up as available options once they are unselected.
    persist: false,
    duplicates: true,
    createOnBlur: true,
    onItemAdd: function () {
        this.setTextboxValue('');
        this.refreshOptions();
    },
    render: {
        optgroup_header: function(data, escape) {
			return '<div class="font-bold" style="padding:5px; background:#fafafa">' + escape(data.label) + '</div>';
		},
        option_create: function(data, escape) {
			return `<div class="create">${terms.add}<strong> ${escape(data.input)} </strong>&hellip;</div>`;
		},
        option: function (data, escape) {
            return `<div class="flex justify-start gap-2 items-center">
                    <span class="ms-auto"> <i class="text-main-600 icofont-${escape(data.icon)}"></i> </span>
                    <span> ${escape(data.display)} </span>
                </div>`;
        },

        no_results: function(data,escape){
            return `<div class="p-1">${terms.noResult}</div>`;
        },
        //displayed inside the box as:
        // item: function (data, escape) {
        //     return `<div>  ${escape(data.display)}  </div>`;
        // }
    },

}
document.querySelectorAll('.search-keyword').forEach(item => {
    new TomSelect(item, searchKeywordSettings);
})


//Clinics
let searchClinicSetting = {
    sortField: {
        field: "text",
        direction: "asc",
    },
    render: {

        option: function (data, escape) {
            return `<div class="flex justify-start gap-2 items-center">
                        <span class="nxn-${escape(data.icon)}  text-main-600 w-3"></span>
                        <span> ${escape(data.display)} </span>
                    </div>`;
        },
        no_results: function(data,escape){
            return `<div class="p-1">${terms.noResult}</div>`;
        },
        //displayed inside the box as:
        // item: function (data, escape) {
        //     return `<div>  ${escape(data.display)}  </div>`;
        // }
    }
}
document.querySelectorAll('.search-clinic').forEach(item => {
    new TomSelect(item, searchClinicSetting);
});

//Basic
let searchBasicSetting = {
    sortField: {
        field: "text",
        direction: "asc",
    },
    render: {

        // option: function (data, escape) {
        //     return `<div class="flex justify-start gap-2 items-center">
        //                 <span class="nxn-${escape(data.icon)}  text-main-600 w-3"></span>
        //                 <span> ${escape(data.display)} </span>
        //             </div>`;
        // },
        // no_results: function(data,escape){
        //     return `<div class="p-1">${terms.noResult}</div>`;
        // },
        //displayed inside the box as:
        // item: function (data, escape) {
        //     return `<div>  ${escape(data.display)}  </div>`;
        // }
    }
}
document.querySelectorAll('.search-basic').forEach(item => {
    new TomSelect(item, searchBasicSetting);
});



////////// TOM SELECT (end) //////////


////////// SWIPER JS CLINICS (start) //////////
const swiperClinics = new Swiper('.swiper.clinics',
    {
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        slidesPerView: 'auto',
        spaceBetween: 30,

        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination.clinics',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next.clinics',
            prevEl: '.swiper-button-prev.clinics',
        },


    }
);
////////// SWIPER JS CLINICS (end) //////////


////////// SWIPER JS DAYS (start) //////////
var swiper = new Swiper(".available-days", {

    slidesPerView: 'auto',
    spaceBetween: 30,

    // Optional parameters
    direction: 'horizontal',
    // loop: true,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
////////// SWIPER JS DAYS (end) //////////



////////// SWIPER JS PARTNERS (start) //////////
const swiperParners = new Swiper('.swiper.partners', {

    slidesPerView: 1,
    spaceBetween: 30,
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination.partners',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next.partners',
        prevEl: '.swiper-button-prev.partners',
    },

    //responsivness:
    breakpoints: {
        1280: {
            slidesPerView: 2,
        },
    }
}
);
////////// SWIPER JS PARTNERS (end) //////////




////////// SWIPER JS DOCTCORS (start) //////////
const swiperDoctors = new Swiper('.swiper.doctors', {

    slidesPerView: 1,
    spaceBetween: 50,
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination.doctors',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next.doctors',
        prevEl: '.swiper-button-prev.doctors',
    },

    //responsivness:
    breakpoints: {
        1280: {
            slidesPerView: 5,
        },
        1100: {
            slidesPerView: 4,
        },
        900: {
            slidesPerView: 3,
        },
        580: {
            slidesPerView: 2,
        },
    }
}
);
////////// SWIPER JS DOCTCORS (end) //////////



////////// MODAL (start) //////////
const openModal = document.querySelectorAll('[data-open-modal]');

openModal.forEach((btn) => {
    btn.addEventListener('click', () => {
        //disable scrollable body
        document.body.style.overflow = 'hidden';

        //close all open modals
        const allModals = document.querySelectorAll('.modal-box');
        allModals.forEach((modal) => modal.classList.remove('active'));

        //remove all overlays
        const allModalOverlay = document.querySelectorAll('.modal-overlay');
        allModalOverlay.forEach((overlay) => overlay.remove());

        //select desired modal
        const modal = document.querySelector(btn.dataset.openModal);

        //add an overlay
        var overlayElement = document.createElement('div');
        overlayElement.classList.add('modal-overlay');
        overlayElement.setAttribute('data-close-modal', btn.dataset.openModal);
        document.body.appendChild(overlayElement);

        //close modal buttons:
        var closeModal = document.querySelectorAll('[data-close-modal]');
        closeModal.forEach((btn) => {
            btn.addEventListener('click', () => {
                //enable scrollable body
                document.body.style.overflow = 'scroll';

                //select desired modal
                const modal = document.querySelector(btn.dataset.closeModal);

                //close desired modal
                modal.classList.remove('active')

                //remove all overlays
                const allModalOverlay = document.querySelectorAll('.modal-overlay');
                allModalOverlay.forEach((overlay) => overlay.remove());


            })
        })

        //open desired modal
        modal.classList.add('active');


    })
})


////////// MODAL (end) //////////


////////// PRESCRIPTIONS ACCORDION (start) //////////
const expandPrescriptionBtns = document.querySelectorAll('[data-expand-prescriptions]');

expandPrescriptionBtns.forEach((expandBtn) => {
    expandBtn.addEventListener('click', () => {
        const prescription = document.querySelector(expandBtn.dataset.expandPrescriptions);

        prescription.classList.toggle('h-auto');
        prescription.classList.toggle('h-0');

        expandBtn.classList.toggle('expand');
        expandBtn.classList.toggle('collapes');

        if (expandBtn.classList.contains('expand')) {
            expandBtn.innerHTML = 'Show prescriptions <i class="text-secondary-300 icofont-rounded-right"></i>'
        } else {
            expandBtn.innerHTML = 'Hide prescriptions <i class="text-secondary-300 icofont-rounded-up"></i>'
        }
    })
})
////////// PRESCRIPTIONS ACCORDION (end) //////////


////////// LAB TESTS ACCORDION (start) //////////
const expandLabBtns = document.querySelectorAll('[data-expand-lab-tests]');

expandLabBtns.forEach((expandBtn) => {
    expandBtn.addEventListener('click', () => {
        const prescription = document.querySelector(expandBtn.dataset.expandLabTests);

        prescription.classList.toggle('h-auto');
        prescription.classList.toggle('h-0');

        expandBtn.classList.toggle('expand');
        expandBtn.classList.toggle('collapes');

        if (expandBtn.classList.contains('expand')) {
            expandBtn.innerHTML = 'Show lab tests <i class="text-secondary-300 icofont-rounded-right"></i>'
        } else {
            expandBtn.innerHTML = 'Hide lab tests <i class="text-secondary-300 icofont-rounded-up"></i>'
        }
    })
})
////////// LAB TESTS ACCORDION (end) //////////



////////// TOAST MSG (start) //////////

// Flash Messages
var closeTheToast = () => {
    console.log('YoYo');

}
//Close Button
const closeToast = (element) => {
    console.log(element.parentElement);
    element.parentElement.classList.add('slideDown');
    setTimeout(() => {
        element.parentElement.classList.add('hide');
    }, 5500)
}


////////// TOAST MSG (end) //////////
