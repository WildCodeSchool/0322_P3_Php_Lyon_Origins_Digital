const userDMenu = document.getElementById('userDashboards');
const tabs = userDMenu.querySelectorAll("[role='tab']");

for (const tab of tabs) {

    const anchorName = tab.href.substring(tab.href.indexOf("#"));

    if (anchorName == window.location.hash)
    {
        tab.click();
    }
}