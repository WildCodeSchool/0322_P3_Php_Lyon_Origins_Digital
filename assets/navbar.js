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
                navItem.classList.add('text-secondary');
                navItem.classList.remove('text-primary');
                navItem.classList.toggle('bg-dark');
                icon.classList.remove('bi-'+iconId);
                icon.classList.add('bi-'+iconId+'-fill');
                navItem.setAttribute('aria-selected', 'true')
            }

            if (navItem.getAttribute('aria-controls') == 'show' && navItem.getAttribute('aria-selected') == 'false') {
                navItem.remove();
            }

            console.log(navItem.getAttribute('aria-selected'))

    }



})();