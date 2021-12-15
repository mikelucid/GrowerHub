<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <form class="card-body" v-if="editing" @submit.prevent="update">
          <div class="card-title">
            <input type="text" class="form-control form-control-lg" name="" v-model="title">
          </div>

          <hr>

          <div class="media">
            <div class="media-body">
              <div class="form-group">
                <textarea class="form-control" v-model="body" rows="10" required></textarea>
              </div>
              <button class="btn btn-secondary" :disabled="isInvalid">Update</button>
              <button class="btn btn-danger" @click="cancel" type="button">Cancel</button>
            </div>
          </div>
        </form>

        <div class="card-body" v-else>
          <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
              <div class="d-flex flex-column col-md-12">
                <question-title :model="question" label="Asked"></question-title>
                <div v-html="bodyHtml">
                  {{ question.body }}
                </div>

                <comments :comments="question.comments" :question-id="question.id"></comments>
              </div>
            </div>
          </div>
          <div class="card-title">
              <h1></h1>

            </div>
          </div>

          <hr>

          <div class="media">
            <div class="media-body">
              <div class="row">
                <div class="col-4">
                  <div class="ml-auto">
                    <a v-if="authorize('modify',question)"
                       @click.prevent="edit"
                       class="btn btn-sm btn-outline-info">Edit
                    </a>
                    <button v-if="authorize('deleteQuestion',question)"
                            @click.prevent="destroy"
                            class="btn btn-sm btn-outline-danger">Delete
                    </button>
                  </div>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                  <user-info :model="question" label="Asked"></user-info>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vote from './Vote.vue';
import UserInfo from './UserInfo.vue';
import modification from '../mixins/modification.js';
import QuestionTitle from "./QuestionTitle";
import Comments from "./Comments";

export default {

  props: ['question'],
  mixins: [modification],
  components: {QuestionTitle, Vote, UserInfo, Comments},

  data() {
    return {
      title: this.question.title,
      body: this.question.body,
      bodyHtml: this.question.body_html,
      id: this.question.id,
      beforeEditCache: {}
    }
  },

  computed: {
    isInvalid() {
      return this.body.length < 10 || this.title.length < 10;
    },

    endpoint() {
      return `/questions/${this.id}`
    }
  },

  methods: {
    setEditCache() {
      this.beforeEditCache = {
        body: this.body,
        title: this.title
      };
    },

    restoreFromCache() {
      this.body = this.beforeEditCache.body;
      this.title = this.beforeEditCache.title;
    },

    payload() {
      return {
        body: this.body,
        title: this.title
      }
    },

    delete() {
      axios.delete(this.endpoint).then((res) => {
        this.$toast.success(res.data.message, "Success", {timeout: 2000})
      });

      setTimeout(() => {
        window.location.href = "/questions";
      }, 3000);
    }
  }
}
</script>
