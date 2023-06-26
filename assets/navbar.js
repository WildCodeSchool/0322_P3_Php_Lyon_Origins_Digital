(function selectActiveNavbarItem(){
    const navGroup = document.getElementById('nav-group');
    const navItems = navGroup.getElementsByClassName('nav-item');
    const navItemShow = navGroup.querySelector('[aria-controls="show"]')
    const activePage = document.querySelector('main');
    const activeNavItem = navGroup.querySelector('[aria-selected="true"]');

    if(navItemShow.getAttribute('aria-selected') == 'false' && activePage.id !== navItemShow.getAttribute('aria-controls'))
    {navItemShow.parentElement.remove()}


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

        if (navItem.getAttribute('aria-selected') == 'false') {
            navItem.parentElement.classList.add('nav-item-link-inactive');
        }
    }

    const inactiveNavItems = navGroup.getElementsByClassName('nav-item-link-inactive');

    for (const inactiveNavItem of inactiveNavItems) {

        const icon = inactiveNavItem.getElementsByTagName('i')[0];
        const iconId = icon.id;
        inactiveNavItem.classList.add('z-1')

        inactiveNavItem.addEventListener('mouseover', function(){
            icon.classList.remove('bi-'+iconId);
            icon.classList.add('bi-'+iconId+'-fill');
        })
        inactiveNavItem.addEventListener('mouseout', function(){
            icon.classList.add('bi-'+iconId);
            icon.classList.remove('bi-'+iconId+'-fill');
        })
    }



})();