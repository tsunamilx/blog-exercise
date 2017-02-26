export default {

    /**
     * Gets the value of query parameter from the url.
     *
     * @param {string} name Name of the parameter.
     * @param {string} url Given url or current url if null.
     * @returns {string}
     */
    query(name, url = '') {
        if (!url) {
            url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);

        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
}