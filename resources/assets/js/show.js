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
            if (!this.user) {
                return false;
            }
            return user.id == this.user.id;
        },

        /**
         * Enables the edition form of the comment.
         * @param comment
         */
        editComment(comment) {
            $(`#comment-${comment.id}`).removeClass('hidden')
        },

        /**
         * Enables the confirmation of the deletion of hte comment.
         * @param comment
         */
        deleteComment(comment) {
            $(`#comment-${comment.id}-delete`).removeClass('hidden')
        },

        /**
         * Saves the comment.
         * @param comment
         */
        saveComment(comment) {
            let body = comment.body;
            axios.put(`/comments/${comment.id}`, {body})
                .then((response) => {
                    $(`#comment-${comment.id}`).addClass('hidden')
                })
        },

        /**
         * Deletes the comment.
         * @param comment
         */
        confirmDeleteComment(comment) {
            axios.delete(`/comments/${comment.id}`)
                .then((response) => {
                    location.href = `/posts/${this.post.id}`;
                })
        }
    }
});