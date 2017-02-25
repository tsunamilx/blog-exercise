new Vue({
    el: '#content',
    data: {
        // Current page.
        page: 0,
        // Indicates if the page is ready.
        ready: false,
        // Indicates the loading status of the "more" button.
        loading: false,
        // Indicates there are more posts to load.
        hasMore: true,
        // All loaded posts.
        posts: []
    },
    mounted() {
      this.load();
    },
    methods: {
        /**
         * Loads the posts by page.
         */
        load() {
            this.loading = true;
            axios.get(`/posts/load?page=${this.page}`)
                .then((response) => {

                    // Check if there are more items.
                    if (!response.data || response.data.length == 0) {
                        this.hasMore = false;
                        return;
                    }

                    // Load the posts into page.
                    for (let post of response.data) {
                        this.posts.push(post);
                    }

                    this.ready = true;
                    this.loading = false;
                    this.page ++;
                })
                .catch((response) => {
                    this.loading = false;
                });
        },

    }
});