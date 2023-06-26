function selectActiveNavbarItem(group){
    const navGroup = document.getElementById(group);
    const navItems = navGroup.getElementsByClassName('nav-item');
    const navItemShow = navGroup.querySelector('[aria-controls="show"]')
    const activePage = document.querySelector('main');

    if(navItemShow.getAttribute('aria-selected') == 'false' && activePage.id !== navItemShow.getAttribute('aria-controls'))
    {navItemShow.parentElement.remove()}


    for (const navItem of navItems) {

        const icon = navItem.getElementsByTagName('i')[0];
        const iconId = icon.id;


        if (
            activePage.id == navItem.getAttribute('aria-controls')
        ) {
            navItem.parentElement.classList.add('nav-item-link-active');
            navItem.parentElement.classList.add('position-relative');
            navItem.classList.add('nav-item-active');
            navItem.classList.add('text-secondary');
            navItem.classList.remove('text-primary');
            navItem.classList.toggle('bg-dark');

            if (group == 'nav-group-mb') {
                navItem.parentElement.classList.add('pb-3')
                navItem.classList.add('rounded-bottom-pill');
            } else {
                navItem.parentElement.classList.add('ps-3');
                navItem.classList.add('rounded-start-pill');
            }

            if (icon.classList.contains('bi-person-add')) {
                icon.classList.remove('bi-person-add')
                icon.classList.add('bi-person-fill-add')
            } else {
                icon.classList.remove('bi-'+iconId);
                icon.classList.add('bi-'+iconId+'-fill');
            }

            //to do: show logout only on /user/dashboard
            //fix login icon on hover

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
            if (icon.classList.contains('bi-person-add')) {
                icon.classList.remove('bi-person-add')
                icon.classList.add('bi-person-fill-add')
            } else {
                icon.classList.remove('bi-'+iconId);
                icon.classList.add('bi-'+iconId+'-fill');
            }
        })
        inactiveNavItem.addEventListener('mouseout', function(){
            if (icon.classList.contains('bi-person-fill-add')) {
                icon.classList.add('bi-person-add')
                icon.classList.remove('bi-person-fill-add')
            } else {
                icon.classList.add('bi-'+iconId);
                icon.classList.remove('bi-'+iconId+'-fill');
            }
        })
    }



}

selectActiveNavbarItem('nav-group');
selectActiveNavbarItem('nav-group-mb');