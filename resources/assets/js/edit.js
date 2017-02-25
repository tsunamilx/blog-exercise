new Vue({
    el: '#content',
    data: {
        // Indicate the loading status for deletion.
        loading: false,
        /**
         * Indicates if this is edition page. Always true here.
         */
        editing: true,
        // The current post.
        post,
        // The tags of the post.
        tags,
    },

    methods: {

        /**
         * Extracts the string values of the tags.
         * @returns {string}
         */
        tagValues() {
            let values = [];
            for (let tag of this.tags) {
                values.push(tag.name);
            }

            return values.join(',');
        },

        /**
         * Confirmed the deletion of the post.
         */
        confirmed() {
            console.log(`/posts/${this.post.id}`);
            this.loading = true;
            axios.delete(`/posts/${this.post.id}`)
                .then((response) => {
                    location.href = '/posts';
                })
                .catch((response) => {
                    this.loading = false;
                });
        }
    }

});