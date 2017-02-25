new Vue({
    el: '#content',
    data: {
        // The current post.
        post,
        // The tags of the post.
        tags,
        // The comments of the post.
        comments,
        // The current logged in user.
        user
    },
    methods: {
        /**
         * Checks if current user is the owner of the comment.
         * @param user
         * @returns {boolean}
         */
        isCommentOwner(user) {
            return user.id == this.user.id;
        },

        editComment(comment) {
            $(`#comment-${comment.id}`).removeClass('hidden')
        },

        deleteComment(comment) {
            $(`#comment-${comment.id}-delete`).removeClass('hidden')
        },

        saveComment(comment) {
            let body = comment.body;
            axios.put(`/comments/${comment.id}`, {body})
                .then((response) => {
                    $(`#comment-${comment.id}`).addClass('hidden')
                })
        },

        confirmDeleteComment(comment) {
            axios.delete(`/comments/${comment.id}`)
                .then((response) => {
                    location.href = `/posts/${this.post.id}`;
                })
        }
    }
});