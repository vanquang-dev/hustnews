document.addEventListener('DOMContentLoaded', () => {
    var trangthai = 'true',
        sidebar = document.getElementById('sidebar')
    var scroll = sidebar.offsetTop;
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > scroll) {
            if (trangthai == 'true') {
                trangthai = 'false'
                sidebar.classList.add('sidebar-fixed');
            }
        } else if (window.pageYOffset <= scroll) {
            if (trangthai == 'false') {
                trangthai = 'true'
                sidebar.classList.remove('sidebar-fixed');
            }
        }
    })
});
document.addEventListener('DOMContentLoaded', () => {
    var menu_category = document.getElementById('menu-category'),
        category_sidebar = document.getElementById('category-sidebar');
    category_sidebar.onmouseenter = () => {
        menu_category.classList.remove('display');
    }
    category_sidebar.onmouseleave = () => {
        menu_category.classList.add('display');
    }

})