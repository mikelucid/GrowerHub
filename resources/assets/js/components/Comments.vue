<template>
  <div class="comment-bottom bg-white p-2 px-4">
    <div class="d-flex flex-row add-comment-section mt-4 mb-4">
      <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/qdiP4DB.jpg" width="38">
      <input type="text" class="form-control mr-3" placeholder="Add comment">
      <button class="btn btn-primary" type="button">Comment</button>
    </div>
      <comment v-for="(comment, index) in comments" v-bind:key="comment.id" @deleted="remove(index)"  v-for="(answer, index) :model="comment"></comment>
  </div>
</template

<script>
import Comment from "./Comment";
import QuestionTitle from "./QuestionTitle";
import Vote from "./Vote";
import UserInfo from "./UserInfo";
export default {
  props: ['comments','questionId'],
  components: {Comment},

  methods: {
    create(){
      axios.post(`/questions/${this.questionId}/comment`, {
        body: this.body
      })
           .catch(error => {
             this.$toast.error(error.response.data.message, "Error")
           })
           .then(({data}) => {
             this.$toast.success(data.message, "Success")
             this.body = ''
             this.$emit('created', data.answer);
           })
    }
  },

  data(){
    return {
      comments: this.comments
    }
  },

  computed: {
    isInvalid(){
      return !this.signedIn || this.body.length < 10;
    }
  }
}
</script>