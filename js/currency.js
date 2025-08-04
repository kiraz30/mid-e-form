// file currency.js
 
function currency(value, separator) {
    if (typeof value == "undefined") return "0";
    if (typeof separator == "undefined" || !separator) separator = ",";
 
    return value.toString()
                .replace(/[^\d]+/g, "")
                .replace(/\B(?=(?:\d{3})+(?!\d))/g, separator);
}
 
window.addEventListener('keyup', function(e) {
    var el = e.target;
    if (el.classList.contains('currency')) {
        el.value = currency(el.value, el.getAttribute('data-separator'));
    }
false});