// Custom Vue Filters and Directives
if (Vue) {

    // Filters
    Vue.filter("upper", value => {
        if (!value) return value;
        value = value.toString();
        return value.toUpperCase();
    });

    Vue.filter("lower", value => {
        if (!value) return value;
        value = value.toString();
        return value.toLowerCase();
    });

    Vue.filter("title", value => {
        if (!value) return value;
        value = value.toString();
        return value.split(" ")
                    .map(s => s.charAt(0).toUpperCase() + s.slice(1).toLowerCase())
                    .join(" ");
    });

    Vue.filter("number", (value, dp) => {
        var n = parseFloat(value);
        if (isNaN(n)) return value;
        return n.toFixed(dp);      
    });

    // Directives
    Vue.directive("focus", {
        inserted(el) {
            el.focus();
        }
    });

}