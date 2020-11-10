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