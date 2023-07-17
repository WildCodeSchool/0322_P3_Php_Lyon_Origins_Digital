const activePage = document.querySelector('main');

(function setUpActivePage(){
    activePage.classList.add('ps-md-4')
    activePage.classList.add('ps-0')
    activePage.classList.add('overflow-hidden')
})();

(function filterNavItems(){

    const desktopGroup = document.getElementById('nav-group');
    const mobileGroup = document.getElementById('nav-group-mb');

    const groups = [desktopGroup, mobileGroup];

    for (const navGroup of groups) {

        const navItemShow = navGroup.querySelector('[aria-controls="show"]');
        const navItemUser = navGroup.querySelector('[aria-controls="user"]');
        const navItemLogout = navGroup.querySelector('[aria-controls="logout"]');
        const navItemLogin = navGroup.querySelector('[aria-controls="login"]');
        const navItemRegister = navGroup.querySelector('[aria-controls="register"]');
        const navItemSearch = navGroup.querySelector('[aria-controls="search"]');

        removeWhenNotActive(navItemShow)
        removeWhenNotActive(navItemSearch)
        removeWhenNotActive(navItemRegister)
        removeWhenActive(navItemRegister, navItemLogin)
        if (navItemUser == null) navItemLogout.parentElement.remove()
    }

})();

(function setUpActiveNavItem(){
    const desktopGroup = document.getElementById('nav-group');
    const mobileGroup = document.getElementById('nav-group-mb');

    const groups = [desktopGroup, mobileGroup];

    for (const navGroup of groups) {
        navGroup.classList.add('bg-secondary');
        const navItems = navGroup.getElementsByClassName('nav-item');

        for (const navItem of navItems) {

            const icon = navItem.getElementsByTagName('i')[0];

            if (
                activePage.id == navItem.getAttribute('aria-controls')
            ) {
                navItem.classList.remove('text-dark');
                navItem.parentElement.classList.add('nav-item-link-active');
                navItem.parentElement.classList.add('position-relative');
                navItem.classList.add('nav-item-active');
                navItem.classList.add('text-secondary');
                navItem.classList.toggle('bg-dark');

                if (navGroup == mobileGroup) {
                    navItem.parentElement.classList.add('pb-3')
                    navItem.classList.add('rounded-bottom-pill');
                } else {
                    navItem.parentElement.classList.add('ps-3');
                    navItem.classList.add('rounded-start-pill');
                }

                fillIcons(icon,'house', 'house-fill')
                fillIcons(icon,'person-check', 'person-fill-check')
                fillIcons(icon,'person-up', 'person-fill-up')
                fillIcons(icon,'person-add', 'person-fill-add')
                fillIcons(icon,'person-slash', 'person-fill-slash')
                fillIcons(icon,'play', 'play-fill')
                fillIcons(icon,'gear', 'gear-fill')
                fillIcons(icon,'chat-dots', 'chat-dots-fill')

                navItem.setAttribute('aria-selected', 'true')
            }
        }
    }
})();

(function setUpInactiveNavItem(){
    const desktopGroup = document.getElementById('nav-group');
    const mobileGroup = document.getElementById('nav-group-mb');

    const groups = [desktopGroup, mobileGroup];

    for (const navGroup of groups) {
        const navItems = navGroup.getElementsByClassName('nav-item');

        for (const navItem of navItems) {

            if (navItem.getAttribute('aria-selected') == 'false') {
                navItem.parentElement.classList.add('nav-item-link-inactive');
            }
        }

        const inactiveNavItems = navGroup.getElementsByClassName('nav-item-link-inactive');

        for (const inactiveNavItem of inactiveNavItems) {

            const icon = inactiveNavItem.getElementsByTagName('i')[0];
            inactiveNavItem.classList.add('z-1')

            inactiveNavItem.firstElementChild.classList.remove('text-dark')
            inactiveNavItem.firstElementChild.classList.add('text-primary')

            inactiveNavItem.addEventListener('mouseover', function(){
                fillIcons(icon,'person-up', 'person-fill-up')
                fillIcons(icon,'house', 'house-fill')
                fillIcons(icon,'person-add', 'person-fill-add')
                fillIcons(icon,'person-check', 'person-fill-check')
                fillIcons(icon,'person-slash', 'person-fill-slash')
                fillIcons(icon,'play', 'play-fill')
                fillIcons(icon,'gear', 'gear-fill')
                fillIcons(icon,'search', 'search-heart-fill')
                fillIcons(icon,'chat-dots', 'chat-dots-fill')
            })

            inactiveNavItem.addEventListener('mouseout', function(){
                emptyIcons(icon,'person-up', 'person-fill-up')
                emptyIcons(icon,'house', 'house-fill')
                emptyIcons(icon,'person-check', 'person-fill-check')
                emptyIcons(icon,'person-add', 'person-fill-add')
                emptyIcons(icon,'person-slash', 'person-fill-slash')
                emptyIcons(icon,'play', 'play-fill')
                emptyIcons(icon,'gear', 'gear-fill')
                emptyIcons(icon,'search', 'search-heart-fill')
                emptyIcons(icon,'chat-dots', 'chat-dots-fill')
            })
        }
    }
})();

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
function removeWhenActive(conditionItem, removeItem = conditionItem) {
    if(activePage.id == conditionItem.getAttribute('aria-controls'))
    {removeItem.parentElement.remove()}
}
