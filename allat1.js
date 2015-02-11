
function renderSubCat(catID) {

    mainCatDiv = document.getElementById("parentCat");
    subCatDivs = mainCatDiv.getElementsByTagName("div");
    for (var i = 0, n = subCatDivs.length; i < n; ++i) {
        var el = document.getElementById(subCatDivs[i].id);
        if (el.id == "subcat" + catID) {
            var el2= document.getElementById("cat" + catID);
            if ( el.style.display != 'inline' ) {
                el.style.display = 'inline';
                el2.setAttribute("class","catListDown");
            }
            else {
                el.style.display = 'none';
                el2.setAttribute("class","catList");
            }
        } else if (el.id.indexOf("subcat") != -1) {
            el.style.display = 'none';
        } else if(el.id == "cat" + catID) {
            el.setAttribute("class","catListDown");
        } else if(el.id != "cat" + catID) {
            el.setAttribute("class","catList");
        }
    }
}
function renderCatAndSubOnLoad() {
    mainCatDiv = document.getElementById("parentCat");
    subCatDivs = mainCatDiv.getElementsByTagName("div");
    for (var i = 0, n = subCatDivs.length; i < n; ++i) {
        var el = document.getElementById(subCatDivs[i].id);
        if(el.style.display == 'inline'){
            var catID = el.id.substr(6, 7);
            var el2= document.getElementById("cat" + catID);
            el2.setAttribute("class","catListDown");
        }
    }
}





