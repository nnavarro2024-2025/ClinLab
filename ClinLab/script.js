const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');


allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', () => {
        allSideMenu.forEach(i => i.parentElement.classList.remove('active'));
        li.classList.add('active');
    });
});


const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');
const subMenus = document.querySelectorAll('#sidebar .sub-menu');
const sideMenuText = document.querySelectorAll('#sidebar .side-menu.top li .ClinLabtext');
const brandText = document.querySelector('.ClinLabtext');

menuBar.addEventListener('click', () => {
    sidebar.classList.toggle('hide');
    const isHidden = sidebar.classList.contains('hide');


    subMenus.forEach(subMenu => {
        Object.assign(subMenu.style, isHidden ? {
            position: 'absolute',
            left: '20px',
            width: '200px',
            borderRadius: '20px',
            padding: '10px 20px',
            border: '1px solid #f6f6f6',
            backgroundColor: '#fff',
            boxShadow: '0px 10px 8px rgba(0, 0, 0, 0.1)'
        } : {
            position: '',
            left: '',
            width: '',
            borderRadius: '',
            padding: '',
            border: '',
            backgroundColor: '',
            boxShadow: ''
        });
    });


    sideMenuText.forEach(ClinLabtext => {
        ClinLabtext.style.display = isHidden ? 'none' : 'inline'; 
    });
    brandText.style.display = isHidden ? 'none' : 'inline'; 
});

