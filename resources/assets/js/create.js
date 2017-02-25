new Vue({
    el: '#content',
    data: {
        /**
         * Indicates if this is edition page. Always false here.
         */
        editing: false,
        // The current post.
        post,

    },
    methods: {
        /**
         * Dummy method simply returns the empty string, to be compatible
         * with the form.
         * @returns {string}
         */
        tagValues() {
            return '';
        },
    }

});