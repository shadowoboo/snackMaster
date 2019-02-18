function searchBar() {
    var country = document.getElementById('country').value;
    var kind = document.getElementById('kind').value;
    var flavor = document.getElementById('flavor').value;
    var name = document.getElementById('searchName').value;
    if (country != 0) {
        country = "'" + country + "'";
    }
    if (kind != 0) {
        kind = "'" + kind + "'";
    }
    if (flavor == 0) {
        var search = "and nation = " + country + " and snackGenre = " + kind + " and snackName like '%" + name + "%'";
    } else {
        var search = "and nation = " + country + " and snackGenre = " + kind + " and " + flavor + "Stars > 0" + " and snackName like '%" + name + "%'";
    }
    location.href = 'shopping.php?search=' + search;
}
window.addEventListener('load', function () {
    document.getElementById('searchClick').addEventListener('click', searchBar);
});