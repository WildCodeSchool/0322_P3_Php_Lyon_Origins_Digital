const activePage = document.querySelector('main');

function fillIcons(icon, stroke, fill) {
    if (icon.classList.contains('bi-'+stroke)) {
        icon.classList.remove('bi-'+stroke)
        icon.classList.add('bi-'+fill)
    }
}
function emptyIcons(icon, stroke, fill) {
    if (icon.classList.contains('bi-'+fill)) {
        icon.classList.remove('bi-'+fill)
        icon.classList.add('bi-'+stroke)
    }
}
function removeWhenNotActive(conditionItem, removeItem = conditionItem) {
    if(activePage.id !== conditionItem.getAttribute('aria-controls'))
    {removeItem.parentElement.remove()}
}

function selectActiveNavbarItem(group){
    const navGroup = document.getElementById(group);
    const navItems = navGroup.getElementsByClassName('nav-item');
    const navItemShow = navGroup.querySelector('[aria-controls="show"]')
    const navItemUser = navGroup.querySelector('[aria-controls="user"]')
    const navItemLogout = navGroup.querySelector('[aria-controls="logout"]')

    removeWhenNotActive(navItemShow)
    navItemUser == null ? navItemLogout.remove() : removeWhenNotActive(navItemUser, navItemLogout);

    for (const navItem of navItems) {

        const icon = navItem.getElementsByTagName('i')[0];

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

            fillIcons(icon,'house', 'house-fill')
            fillIcons(icon,'person-check', 'person-fill-check')
            fillIcons(icon,'person-up', 'person-fill-up')
            fillIcons(icon,'person-slash', 'person-fill-slash')
            fillIcons(icon,'play', 'play-fill')
            fillIcons(icon,'gear', 'gear-fill')

            navItem.setAttribute('aria-selected', 'true')
        }

        if (navItem.getAttribute('aria-selected') == 'false') {
            navItem.parentElement.classList.add('nav-item-link-inactive');
        }
    }

    const inactiveNavItems = navGroup.getElementsByClassName('nav-item-link-inactive');

    for (const inactiveNavItem of inactiveNavItems) {

        const icon = inactiveNavItem.getElementsByTagName('i')[0];
        inactiveNavItem.classList.add('z-1')

        inactiveNavItem.addEventListener('mouseover', function(){
            fillIcons(icon,'person-up', 'person-fill-up')
            fillIcons(icon,'house', 'house-fill')
            fillIcons(icon,'person-check', 'person-fill-check')
            fillIcons(icon,'person-slash', 'person-fill-slash')
            fillIcons(icon,'play', 'play-fill')
            fillIcons(icon,'gear', 'gear-fill')
        })

        inactiveNavItem.addEventListener('mouseout', function(){
            emptyIcons(icon,'person-up', 'person-fill-up')
            emptyIcons(icon,'house', 'house-fill')
            emptyIcons(icon,'person-check', 'person-fill-check')
            emptyIcons(icon,'person-slash', 'person-fill-slash')
            emptyIcons(icon,'play', 'play-fill')
            emptyIcons(icon,'gear', 'gear-fill')
        })
    }
}

selectActiveNavbarItem('nav-group');
selectActiveNavbarItem('nav-group-mb');