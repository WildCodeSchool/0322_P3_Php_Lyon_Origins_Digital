(function selectActiveNavbarItem(){
    const navGroup = document.getElementById('nav-group');
    const navItems = navGroup.getElementsByClassName('nav-item');
    const activePage = document.querySelector('main');


    for (const navItem of navItems) {

        const icon = navItem.getElementsByTagName('i')[0];
        const iconId = icon.id;


        if (
            activePage.id == navItem.getAttribute('aria-controls')
        ) {
            navItem.parentElement.classList.add('nav-item-link-active');
            navItem.parentElement.classList.add('ps-3');
            navItem.classList.add('nav-item-active');
            navItem.classList.add('rounded-start-pill');
            navItem.classList.add('text-secondary');
            navItem.classList.remove('text-primary');
            navItem.classList.toggle('bg-dark');

            if (icon.classList.contains('bi-person-add')) {
                icon.classList.remove('bi-person-add')
                icon.classList.add('bi-person-fill-add')
            } else {
                icon.classList.remove('bi-'+iconId);
                icon.classList.add('bi-'+iconId+'-fill');
            }


            navItem.setAttribute('aria-selected', 'true')
        }

        if (activePage.id !== navItem.getAttribute('aria-controls')) {
            navItem.parentElement.classList.add('nav-item-link-inactive');
        }

        if (navItem.getAttribute('aria-controls') == 'show' && navItem.getAttribute('aria-selected') == 'false') {
            navItem.remove();
        }

    }



})();